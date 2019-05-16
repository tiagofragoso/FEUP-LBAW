<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        if ($request->has('search')) {
            $events = Event::where([
                    ['private', 'false'],
                    ['banned', 'false'],
                    ['start_date', '>', DB::raw('CURRENT_TIMESTAMP')]
                ])
                ->whereRaw("search @@ plainto_tsquery('english', ?)", $request->input('search'))
                ->orderByRaw("ts_rank(search, plainto_tsquery('english', ?)) DESC", $request->input('search'));
        }
        else {
            $events = Event::where([
                    ['private', 'false'],
                    ['banned', 'false'],
                    ['start_date', '>', DB::raw('CURRENT_TIMESTAMP')]
                ])
                ->orderBy('participants', 'desc');
        }

        $events = $events->take(6)->get();
        return view('pages.search', ['events' => $events]);
    }
}
