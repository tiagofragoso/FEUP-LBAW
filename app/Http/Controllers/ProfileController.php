<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    
    public function show() {
        if (!Auth::check()) return redirect('/login');

        $data['joined'] = Auth::user()->events('Participant')->orderByDesc('start_date')->get();
        $data['performing'] = Auth::user()->events('Artist')->orderByDesc('start_date')->get();
        $data['hosting'] = Auth::user()->events('Host')->get()->merge(Auth::user()->events('Owner')->get());

        $data['user'] = Auth::user();

        if (Auth::check()) {
            $data['joined'] = Auth::user()->eventsParticipation($data['joined']);
            $data['hosting'] = Auth::user()->eventsParticipation($data['hosting']);
            $data['performing'] = Auth::user()->eventsParticipation($data['performing']);
            
        }
    
        return view('pages.profile',  $data);
    }

}