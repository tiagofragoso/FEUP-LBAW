<?php

namespace App\Http\Controllers;

use App\ThreadComment;
use App\Thread;
use App\Event;
use Illuminate\Http\Request;

class ThreadCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function validateThreadComment($data) {
        return Validator::make($data->all(), [
            'content' => 'required|string|max:2500',
            'thread_id' => 'required',
            'user_id' => 'required'
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
        $thread = Thread::find($id);
        if (is_null($thread)) return response()->json(null, 404);
        $event = Event::find($thread->event_id);
        $this->authorize('create', [$event, ThreadComment::class]);
        $request->request->add(['author_id' => Auth::user()->id]);
        $request->request->add(['thread_id' => $id]);
        $this->validateThreadComment($request);
        $comment = ThreadComment::create($request->all());
        $comment = ThreadComment::find($comment->id);
        return response()->json([
            'id' => $comment->id,
            'content' => $comment->content,
            'author_id' => $comment->author_id,
            'thread_id' => $thread->id,
            'date' => \Carbon\Carbon::createFromFormat('Y-m-d H:i:s.u', $comment->date)->format('M d | H:i'),
            'author' => $comment->author->displayName()
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ThreadComment  $threadComment
     * @return \Illuminate\Http\Response
     */
    public function show(ThreadComment $threadComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ThreadComment  $threadComment
     * @return \Illuminate\Http\Response
     */
    public function edit(ThreadComment $threadComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ThreadComment  $threadComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ThreadComment $threadComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ThreadComment  $threadComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThreadComment $threadComment)
    {
        //
    }
}
