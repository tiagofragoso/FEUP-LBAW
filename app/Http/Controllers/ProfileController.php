<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    
    public function show() {
        if (!Auth::check()) return redirect('/login');

        $data['joined'] = Auth::user()->participations('Participant')->get();
        $data['joined'] = $data['joined']->map(function ($item, $key) { return $item->event()->get()[0]; });
        $data['hosting']  = Auth::user()->participations('Host')->get();
        $data['hosting'] = $data['hosting']->map(function ($item, $key) { return $item->event()->get()[0]; });
        $data['performing']  = Auth::user()->participations('Artist')->get();
        $data['performing'] = $data['performing']->map(function ($item, $key) { return $item->event()->get()[0]; });
        $data['user'] = Auth::user();
        

        return view('pages.profile',  $data);
    }

}