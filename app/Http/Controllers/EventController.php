<?php

namespace App\Http\Controllers;
use App;
use App\Event;
use App\Category;
use App\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Event::class);

        $currencies = Currency::all();
        $locale = App::getLocale();
        foreach($currencies as $c) {
            $c->symbol = $c->getSymbol($locale);
        }

        return view('pages.event_form', 
            ['title' => 'Create event',
            'categories' => Category::all(),
            'currencies' => $currencies]
        );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Event::class);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:60',
            'location' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:100',
            'brief' => 'nullable|string|max:140',
            'category' => 'required',
            'type' => 'required',
            'private' => 'required',
            'status' => 'required',
            'price' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date|after:now'
        ])->validate();

        $event = Event::create($request->except('photo'));

        return $this->show($event);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event =collect(DB::select('SELECT title, "category", "start_date", 
        end_date, "location", "address", participants, 
        price, brief, "description", "type", "private",
        "status", currencies.code AS currency, 
        categories.name AS "category"
         FROM events 
        LEFT JOIN currencies ON (events.currency = currencies.id)
        LEFT JOIN categories ON (events.category = categories.id)
         WHERE events.id = ?;', [$id]))->first();

        $hosts = DB::select('SELECT users.id AS id, users.name, users.username FROM participations, users
    WHERE participations.event_id = ?
        AND participations.type = ? 
        AND participations.user_id = users.id',[$id,"Host"]);    
        
        $numberHosts = count($hosts) - 1;
        $firstHost = collect($hosts)->first();
        $hostsInformation = array('firstHost'=> $firstHost,'numberHosts'=> $numberHosts);
        
        $artists = DB::select('SELECT users.id AS id, users.name, users.username FROM participations, users
        WHERE participations.event_id = ?
            AND participations.type = ? 
            AND participations.user_id = users.id',[$id,"Artist"]);
      
        
        $posts = DB::select('SELECT posts.*, users.name AS author 
        FROM posts LEFT JOIN users ON (posts.author_id = users.id)
        WHERE posts.event_id = ?
        ORDER BY posts.date DESC',[$id]);
       
        foreach($posts as $post)
        {
            $comments =  DB::select('SELECT * 
            FROM comments
            WHERE post_id = ?
            ORDER BY date DESC',[$post->id]);
            $post->allComents = $comments;
        }
     
    return view('pages.event', ['event' => $event,'host'=>$hostsInformation,'artists'=>$artists,'posts'=>$posts]);  

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
