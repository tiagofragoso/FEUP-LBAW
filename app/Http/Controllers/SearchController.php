<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        $events = $this->getEvents($request);
        return view('pages.search', ['events' => $events]);
    }

    public function getEvents(Request $request) {
        if (!empty($request->except('page'))) {
            if ($request->has('search')) {
                $events = Event::where([
                        ['private', 'false'],
                        ['banned', 'false'],
                        ['start_date', '>', DB::raw('CURRENT_TIMESTAMP')]
                    ])
                    ->whereRaw("search @@ plainto_tsquery('english', ?)", $request->input('search'))
                    ->orderByRaw("ts_rank(search, plainto_tsquery('english', ?)) DESC", $request->input('search'));
            }
        }
        else {
            $events = Event::where([
                    ['private', 'false'],
                    ['banned', 'false'],
                    ['start_date', '>', DB::raw('CURRENT_TIMESTAMP')]
                ])
                ->orderBy('participants', 'desc');
        }

        $events = $events->paginate(6);
        return $events;
    }
}
