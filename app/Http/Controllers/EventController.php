<?php

namespace App\Http\Controllers;
use App;
use App\Event;
use App\Category;
use App\Currency;
use App\Participation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function validateEvent($data) {
        return Validator::make($data->all(), [
            'title' => 'required|string|max:60',
            'location' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:100',
            'brief' => 'required|string|max:140',
            'description' => 'required|string',
            'category' => 'required',
            'type' => 'required',
            'private' => 'required',
            'status' => 'required',
            'price' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date|after:now'
        ])->validate();
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

        return view('pages.event_form', ['title' => 'Create event']);

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

        $this->validateEvent($request);

        $event = Event::create($request->except('photo'));

        Participation::create(['event_id' => $event->id, 'user_id' => Auth::user()->id, 'type' => 'Owner']);

        return $this->show($event->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        $joined = 'false';
        if (Auth::check()){
         $user = Auth::user();
         $participants = $event->participatesAs('Participant')->where('user_id','=',$user->id)->get();
        
         if (sizeof($participants)==0){
            $joined = 'false';  
         }
         else{
            $joined = 'true';
         }

        }

        if ($event->private)
            $this->authorize('view', $event);

        $owner = $event->participatesAs('Owner')->first();
        $hosts = $event->participatesAs('Host')->get();
        $artists = $event->participatesAs('Artist')->get()->take(6);
        
        $posts = $event->posts()->get();
        $questions = $event->questions()->get();

       
        return view('pages.event', 
            [ 'title' => $event->name,
            'event' => $event,
            'owner' => $owner,
            'hosts' => $hosts,
            'artists' => $artists,
            'posts' => $posts,
            'questions'=> $questions,
            'joined'=> $joined]);  
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $this->authorize('update', $event);
        return view('pages.event_form', ['title' => 'Edit event', 'event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $this->authorize('update', $event);
        $this->validateEvent($request);
        $event->update($request->except(['photo']));
        return $this->show($id);
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

    public function joinEvent($id){
        if (!Auth::check()) return response(403);
        
        $event = Event::findOrFail($id);
        $user = Auth::user();
        $participants = $event->participatesAs('Participant')->where('user_id','=',$user->id)->get();
        if (sizeof($participants) == 0){
            Participation::create(['event_id' => $event->id, 'user_id' => $user->id, 'type' => 'Participant']);
            return response(200);
        } else {
            Participation::where(['event_id' => $event->id, 'user_id' => $user->id, 'type' => 'Participant'])->delete();
            return response(0);
        }
       
        
    }
}
