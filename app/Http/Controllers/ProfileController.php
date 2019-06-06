<?php

namespace App\Http\Controllers;

use App\User;
use App\EventReport;
use App\UserReport;
use App\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            if (Auth::check() && Auth::user()->id == $id) {
                return redirect('profile');
            }

            $user = User::findOrFail($id);
            if ($user->banned && !Auth::user()->is_admin) {
                abort(403);
            }
            if ($user->is_admin) {
                abort(403);
            }

            $data = $this->getEventsData($user);
            $data['follow'] = (Auth::check() && Auth::user()->hasFollow($id));

            return view('pages.user_profile', $data);
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return;
        }
    }

    public function showProfile()
    {
        try{
        if (!Auth::check()) return redirect('/login');

        if (Auth::user()->is_admin) {
            $data = $this->getReportsData();
            return view('pages.admin_profile', $data);
        } else {
            $data = $this->getEventsData(Auth::user());
            return view('pages.profile',  $data);
        }  
    }catch(\Illuminate\Database\QueryException $e) {
        report($e);
        return;
    }
}

    private function getEventsData($user)
    {
        try{
        $data['joined'] = $user->events('Participant')->orderByDesc('start_date')->get();
        $data['performing'] = $user->events('Artist')->orderByDesc('start_date')->get();
        $data['hosting'] = $user->events(['Host', 'Owner'])->orderByDesc('start_date')->get();

        if (Auth::check()) {
            $data['joined'] = Auth::user()->eventsParticipation($data['joined']);
            $data['hosting'] = Auth::user()->eventsParticipation($data['hosting']);
            $data['performing'] = Auth::user()->eventsParticipation($data['performing']);
        }

        $data['user'] = $user;

        return $data;
    }  catch(\Illuminate\Database\QueryException $e) {
        report($e);
        return;
    }
    }

    private function getReportsData() {
        try{
        $pendingEventReports = EventReport::all()->where('status', 'Pending')->groupBy('event_id');

        $pendingEventReports = $pendingEventReports->map(function($value, $key) {
            return ['type' => 'event', 'count' => $value->count(), 'report_id' => $value->first()->id, 'event' => $value->first()->event()->get()->first(), 'status' => $value->first()->status];
        });
        
        
        $pendingUserReports = UserReport::all()->where('status', 'Pending')->groupBy('reported_user');
        
        $pendingUserReports = $pendingUserReports->map(function($value) {
            return ['type' => 'user', 'count' => $value->count(), 'report_id' => $value->first()->id, 'user' => $value->first()->reportedUser()->get()->first(), 'status' => $value->first()->status];
        });


        $answeredEventReports = EventReport::all()->whereNotIn('status', 'Pending')->groupBy('event_id');
        
        $answeredEventReports = $answeredEventReports->map(function($value, $key) {
            return ['type' => 'event', 
            'count' => $value->count(), 
            'report_id' => $value->first()->id, 
            'event' => $value->first()->event()->get()->first(), 
            'status' => $value->contains(function ($value) {
                return $value->status === 'Accepted';
                })? 'Accepted' : 'Declined'];
        });

        $answeredUserReports = UserReport::all()->whereNotIn('status', 'Pending')->groupBy('reported_user');

        $answeredUserReports = $answeredUserReports->map(function($value) {
            return ['type' => 'user', 
            'count' => $value->count(), 
            'report_id' => $value->first()->id, 
            'user' => $value->first()->reportedUser()->get()->first(), 
            'status' => $value->contains(function ($value) {
                return $value->status === 'Accepted';
                })? 'Accepted' : 'Declined'];
        });

        $pending = $pendingEventReports->concat($pendingUserReports)->sortByDesc('count');
        $answered = $answeredEventReports->concat($answeredUserReports)->sortByDesc('count');

        return ['pending' => $pending, 'answered' => $answered];
    }catch(\Illuminate\Database\QueryException $e) {
        report($e);
        return;
    }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if (!Auth::check()) return redirect('/login');

        return view('pages.settings', ['user' => Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
        if (!Auth::check()) return redirect('/login');

        $user = Auth::user();

        $request->validate([
            'name' => 'nullable|string|max:30',
            'email' => 'required|unique:users,email,' . $user->id . '|email|max:255',
            'username' => 'required|string|unique:users,username,' . $user->id . '|max:15',
            'birthdate' => 'nullable|date'
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = strtolower($request->input('username'));
        $user->birthdate = $request->input('birthdate');
        $user->save();

        return response()->json(null, 200);
        }catch(\Illuminate\Database\QueryException $e) {
            report($e);
            return response()->json(null, 400);
        }
    }

    public function updatePassword(Request $request)
    {
        try{
        if (!Auth::check()) return redirect('/login');

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'errors' => [
                    'password' => ['Current password doesn\'t match.']
                ]
            ], 422);
        }

        $request->validate([
            'new_password' => 'required|string|min:6|confirmed'
        ]);

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return response()->json(null, 200);
        } catch(\Illuminate\Database\QueryException $e) {
            report($e);
            return response()->json(null, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function followUser($id)
    {
        try{
        if (!Auth::check()) return response()->json(null, 403);
        if (User::find($id) == null) return response()->json(null, 404);

        if (Auth::user()->hasFollow($id)) return response()->json(null, 200);

        Auth::user()->follow($id);
        return response()->json(null, 200);
        }catch(\Illuminate\Database\QueryException $e) {
            report($e);
            return response()->json(null, 400);
        }
    }

    public function unfollowUser($id)
    {
        try{
        if (!Auth::check()) return response()->json(null, 403);
        if (User::find($id) == null) return response()->json(null, 404);

        if (!Auth::user()->hasFollow($id)) return response()->json(null, 200);

        Auth::user()->unfollow($id);
        return response()->json(null, 200);
        }catch(\Illuminate\Database\QueryException $e) {
            report($e);
            return response()->json(null, 400);
        }
    }

    public function showInvites() {
        try{
        if (!Auth::check()) return redirect('/login');

        $user = Auth::user();

        if ($user->is_admin) {
            abort(403); 
        }

        $invites = Invite::where('invited_user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy(function($inv){
                return $inv->status === 'Pending'? 'pending': 'answered';
            })->sortByDesc(function($item, $key) {return $key;})
            ->flatten()
            ->map(function ($e) {
            switch($e->type) {
                case "Participant":
                    $e['formattedType'] = "join";
                    break;
                case "Artist":
                    $e['formattedType'] = "perform at";
                    break;
                case "Host":
                    $e['formattedType'] = "co-host";
                    break;
            }
            return $e;
        });

        return view('pages.invites', ['user' => $user, 'invites' => $invites]);
    }
    catch(\Illuminate\Database\QueryException $e) {
        report($e);
        return null;
    }

    }

    public function banUser($id)
    {
        try{
        if (!Auth::user()->is_admin) return response()->json(null, 403);

        if (User::find($id) == null) return response()->json(null, 404);

        User::find($id)->update(['banned' => true]);

        return response()->json(null, 200);
        }catch(\Illuminate\Database\QueryException $e) {
            report($e);
            return response()->json(null, 400);
        }
    }

    
}
