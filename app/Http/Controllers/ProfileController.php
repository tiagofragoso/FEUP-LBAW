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
        if (Auth::check() && Auth::user()-> id == $id) {
            return redirect('profile');
        } 

        $user = User::findOrFail($id);

        if ($user->is_admin) {
            abort(403); 
        }

        $data = $this->getEventsData($user);
        $data['follow'] = (Auth::check() && Auth::user()->hasFollow($id));

        return view('pages.user_profile', $data);
    }

    public function showProfile() 
    {
        if (!Auth::check()) return redirect('/login');

        $data = $this->getEventsData(Auth::user());
        
        if (Auth::user()->is_admin){
            $pendingEventReports = EventReport::all()->where('status','Pending')->groupBy('event_id');

            foreach($pendingEventReports as $eventReport){
                
                $eventReport['reports'] = $eventReport->toArray();
                $eventReport['status'] = $eventReport->first()->status;
                $eventReport['event'] = $eventReport->first()->first()->event()->get()->first();
                $eventReport['user'] =  $eventReport->first()->first()->user()->get()->first();
            }
    
            $pendingUserReports = UserReport::all()->where('status','Pending')->groupBy('reported_user');

            foreach($pendingUserReports as $userReport){

                $userReport['reports'] = $userReport->toArray();
                $userReport['status'] = $userReport->first()->status;
                $userReport['reportedUser'] = $userReport->first()->reportedUser()->get()->first();
                $userReport['user'] = $userReport->first()->user()->get()->first();
               
            }
            $allEventReports = EventReport::all()->whereNotIn('status','Pending')->groupBy('event_id');
            foreach($allEventReports as $eventReport){

                $eventReport['reports'] = $eventReport->toArray();
                $eventReport['status'] = $eventReport->first()->status;
                $eventReport['event'] = $eventReport->first()->event()->get()->first();
                $eventReport['user'] =  $eventReport->first()->user()->get()->first();
            }
            
            $allUserReports = UserReport::all()->whereNotIn('status','Pending')->groupBy('reported_user');
        
            foreach($allUserReports as $userReport){
                
                $userReport['reports'] = $userReport->toArray();
                $userReport['status'] = $userReport->first()->status;
                $userReport['reportedUser'] = $userReport->first()->reportedUser()->get()->first();
                $userReport['user'] = $userReport->first()->user()->get()->first();
            }
            $pendingReports['user'] = $pendingUserReports;
            $pendingReports['event'] = $pendingEventReports;
            $allReports['user'] = $allUserReports;
            $allReports['event'] = $allEventReports;
            $data['pendingReports'] = $pendingReports;
            $data['allReports'] = $allReports;

            $data['user'] = Auth::user();
            return view('pages.admin_profile',$data);
        }
        else 
            return view('pages.profile',  $data);
    }

    public function getEventsData($user) {
        $data['joined'] = $user->events('Participant')->orderByDesc('start_date')->get();
        $data['performing'] = $user->events('Artist')->orderByDesc('start_date')->get();
        $data['hosting'] = $user->events(['Host', 'Owner'])->orderByDesc('start_date')->get();

        $data['user'] = $user;

        if (Auth::check()) {
            $data['joined'] = Auth::user()->eventsParticipation($data['joined']);
            $data['hosting'] = Auth::user()->eventsParticipation($data['hosting']);
            $data['performing'] = Auth::user()->eventsParticipation($data['performing']);
        }
        
        return $data;
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
        if (!Auth::check()) return redirect('/login');

        $user = Auth::user();

        $request->validate([
            'name' => 'nullable|string|max:30',
            'email' => 'required|unique:users,email,'.$user->id.'|email|max:255',
            'username' => 'required|string|unique:users,username,'.$user->id.'|max:15',
            'birthdate' => 'nullable|date'
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = strtolower($request->input('username'));
        $user->birthdate = $request->input('birthdate');
        $user->save();

        return response(200);
    }

    public function updatePassword(Request $request) {

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

        return response(200);

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

    public function followUser($id){
        if (!Auth::check()) return response(403);
        if (User::find($id) == null) return reponse(404);

        if (Auth::user()->hasFollow($id)) return response(200);

        Auth::user()->follow($id);
        return response(200);
    }

    public function unfollowUser($id){
        if (!Auth::check()) return response(403);
        if (User::find($id) == null) return reponse(404);

        if (!Auth::user()->hasFollow($id)) return response(200);

        Auth::user()->unfollow($id);
        return response(200);
    }

    public function showInvites() {

        if (!Auth::check()) return redirect('/login');

        $user = Auth::user();

        if ($user->is_admin) {
            abort(403); 
        }

        $invites = Invite::where('invited_user_id', $user->id)->get()->map(function ($e) {
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

}
