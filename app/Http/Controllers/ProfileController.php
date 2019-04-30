<?php

namespace App\Http\Controllers;
use App\User;
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

        return view('pages.user_profile', $data);
    }

    public function showProfile() 
    {
        if (!Auth::check()) return redirect('/login');

        $data = $this->getEventsData(Auth::user());

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
}
