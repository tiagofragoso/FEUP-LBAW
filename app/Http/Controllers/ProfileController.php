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
        

        return view('pages.profile',  $data);
    }

}