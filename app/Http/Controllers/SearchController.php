<?php

namespace App\Http\Controllers;

use App\Event;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Exception;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        $events = $this->getEvents($request);
        $categories = Category::all();
        return view('pages.search', ['events' => $events, 'categories' => $categories]);
    }

    public function getEvents(Request $request) {
        if ($request->has('search') && $request->search != '') {
            $events = Event::where([
                    ['private', 'false'],
                    ['banned', 'false'],
                    ['start_date', '>', DB::raw('CURRENT_TIMESTAMP')]
                ])
                ->whereRaw("search @@ plainto_tsquery('english', ?)", $request->search);
        }
        else {
            $events = Event::where([
                    ['private', 'false'],
                    ['banned', 'false'],
                    ['start_date', '>', DB::raw('CURRENT_TIMESTAMP')]
                ]);
        }

        if ($request->has('start_date') && $request->has('end_date')) {
            $events = $events->whereBetween('start_date', [$request->start_date, $request->end_date]);
            $events = $events->whereBetween('end_date', [$request->start_date, $request->end_date]);
        }
        else if ($request->has('start_date')) {
            $events = $events->where('start_date', '>', $request->start_date);
        }
        else if ($request->has('end_date')) {
            $events = $events->where('end_date', '<', $request->end_date);
        }

        if ($request->has('location')) {
            $events = $events->where('location', 'ILIKE', '%'.$request->location.'%');
        }

        if ($request->has('start_price') && $request->has('end_price')) {
            $events = $events->whereBetween('price', [$request->start_price, $request->end_price]);
        }
        else if ($request->has('start_price')) {
            $events = $events->where('price', '>', $request->start_price);
        }
        else if ($request->has('end_price')) {
            $events = $events->where('price', '<', $request->end_price);
        }

        if ($request->has('category')) {
            $events = $events->where('category', '=', $request->category);
        }

        if ($request->has('status')) {
            $events = $events->where('status', '=', $request->status);
        }

        if ($request->has('sort_by')) {
            $events = $events->orderBy($request->sort_by, 'DESC');
        }
        else if ($request->has('search') && $request->search != '') {
            $events = $events->orderByRaw("ts_rank(search, plainto_tsquery('english', ?)) DESC", $request->search);
        }
        else {
            $events = $events->orderBy('participants', 'DESC');
        }

        $events = $events->paginate(6);
        return $events;
    }
}
