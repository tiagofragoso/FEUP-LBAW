<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function show()
    {
        if (!Auth::check())
            return redirect('/search');

        $events = $this->getTrending();

        return view('pages.home', ['events' => $events]);
    }

    public function getTrending()
    {
        return Event::where([
            ['private', 'false'],
            ['banned', 'false'],
            ['start_date', '>', DB::raw('CURRENT_TIMESTAMP')]
        ])
        ->orderBy('participants', 'DESC')
        ->get();
    }
}
