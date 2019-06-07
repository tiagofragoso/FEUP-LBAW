<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function validateThread($data) {
        return Validator::make($data->all(), [
            'content' => 'required|string|max:5000',
            'event_id' => 'required',
            'author_id' => 'required' 
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if (!Auth::check()) return response()->json(null, 403);
        $event = Event::find($id);
        if (is_null($event)) return response()->json(null, 404);
        $t = new Thread();
        $this->authorize('create', [$t, $event]);
        $request->request->add(['event_id' => $id]);
        $request->request->add(['author_id' => Auth::user()->id]);
        $this->validateThread($request);
        $thread = Thread::create($request->all());
        $thread = Thread::find($thread->id);
        return response()->json([
            'id' => $thread->id,
            'content' => $thread->content,
            'author_id' => $thread->author_id,
            'date' =>  (new \DateTime($thread->date))->format('M d | H:i'),
            'author' => $thread->author->displayName()
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
