<?php

namespace App\Http\Controllers;

use App\Event;
use App\Participation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function validateEvent($data)
    {
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

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('events', 'public');
            $event = Event::create(array_merge($request->except('photo'), ['photo' => $path]));
        } else {
            $event = Event::create($request->except('photo'));
        }

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

        if ($event->private)
            $this->authorize('view', $event);

        $owner = $event->participatesAs('Owner')->first();
        $hosts = $event->participatesAs('Host')->get();
        $artists = $event->participatesAs('Artist')->get()->take(6);

        $posts = $event->posts()->get();
        $questions = $event->questions()->get();

        return view(
            'pages.event',
            [
                'event' => $event,
                'owner' => $owner,
                'hosts' => $hosts,
                'artists' => $artists,
                'posts' => $posts,
                'questions' => $questions
            ]
        );
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

        if ($request->hasFile('photo')) {
            try {
                $old = Storage::disk('public')->get($event->photo);
            } catch (Exception $e) {}
            if (isset($old)) {
                Storage::disk('public')->delete($event->photo);
            }
            $path = $request->file('photo')->store('events', 'public');
            $event = $event->update(array_merge($request->except('photo'), ['photo' => $path]));
        } else {
            $event = $event->update($request->except('photo'));
        }

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
}
