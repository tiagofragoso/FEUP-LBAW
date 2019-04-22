<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

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
        $data['user'] = $user;

        if ($user->is_admin) {
            abort(404); 
        }

        $data['joined'] = $user->participations('Participant')->get();
        $data['joined'] = $data['joined']->map(function ($item, $key) { return $item->event()->get()[0]; });
        $data['hosting']  = $user->participations('Host')->get();
        $data['hosting'] = $data['hosting']->map(function ($item, $key) { return $item->event()->get()[0]; });
        $data['performing']  = $user->participations('Artist')->get();
        $data['performing'] = $data['performing']->map(function ($item, $key) { return $item->event()->get()[0]; });

        return view('pages.user_profile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
