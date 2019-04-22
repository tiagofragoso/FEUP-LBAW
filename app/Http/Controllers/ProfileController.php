<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    
    public function show() {
        if (!Auth::check()) return redirect('/login');

        $events['joined'] = Auth::user()->participations('Participant')->get();
        $events['joined']->map(function ($item, $key) { return $item->event(); });
        $events['hosting']  = Auth::user()->participations('Host')->orderByDesc('date')->get();
        $events['performing']  = Auth::user()->participations('Artist')->orderByDesc('date')->get();

        echo $events['joined'];

        return view('pages.profile',  $events);
    }

}
