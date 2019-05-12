<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function show()
    {
        $events = Event::where([
                ['private', 'false'],
                ['banned', 'false'],
                ['start_date', '>', DB::raw('CURRENT_TIMESTAMP')]
            ])
            ->orderBy('participants', 'desc')
            ->take(6)
            ->get();

        return view('pages.search', ['events' => $events]);
    }
}
