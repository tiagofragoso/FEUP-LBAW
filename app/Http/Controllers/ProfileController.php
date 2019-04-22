<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    
    public function show() {
        if (!Auth::check()) return redirect('/login');

        $events['joined'] = Auth::user()->participations('Participant')->get();
        $events['joined'] = $events['joined']->map(function ($item, $key) { return $item->event()->get()[0]; });
        $events['hosting']  = Auth::user()->participations('Host')->get();
        $events['hosting'] = $events['hosting']->map(function ($item, $key) { return $item->event()->get()[0]; });
        $events['performing']  = Auth::user()->participations('Artist')->get();
        $events['performing'] = $events['performing']->map(function ($item, $key) { return $item->event()->get()[0]; });

        return view('pages.profile',  $events);
    }

}