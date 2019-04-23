<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
