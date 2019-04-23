<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    
    public function show() {
        if (!Auth::check()) return redirect('/login');

        $data = Auth::user()->events();
        $data['user'] = Auth::user();

        if (Auth::check()) {
            $data['joined'] = Auth::user()->eventsParticipation($data['joined']);
            $data['hosting'] = Auth::user()->eventsParticipation($data['hosting']);
            $data['performing'] = Auth::user()->eventsParticipation($data['performing']);
            
        }
    
        return view('pages.profile',  $data);
    }

}