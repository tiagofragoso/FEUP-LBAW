<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
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

    public function validateComment($data) {
        return Validator::make($data->all(), [
            'content' => 'required|string|max:5000',
            'post_id' => 'required',
            'user_id' => 'required',
        ])->validate();
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
        $post = Post::find($id);
        if (is_null($post)) return response()->json(null, 404);
        $request->request->add(['user_id' => Auth::user()->id]);
        $request->request->add(['post_id' => $id]);
        $event = Event::find($post->event_id);
        $c = new Comment();
        $this->authorize('create', [$c, $event]);

        $this->validateComment($request);
        $comment = Comment::create($request->all());
        $comment = Comment::find($comment->id);

        return response()->json([
            'id' => $comment->id,
            'content' => $comment->content,
            'user_id' => $comment->user_id,
            'date' => (new \DateTime($comment->date))->format('M d | H:i'),
            'user' => $comment->user->displayName(),
            'photo' => $comment->user->photo(),
            'post_id' => $id,
        ], 201); 
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
    public function likeComment($id)
    {
        if (!Auth::check()) return response(403);
        $comment = Comment::find($id);
        if (is_null($comment)) return response(404);
        $post = Post::find($comment->post_id);
        $event = Event::find($post->event_id);
        $c = new Comment();
        $this->authorize('create', [$c, $event]);
        Auth::user()->likeComment($id);
        return response(200);
    }
    public function dislikeComment($id)
    {
        if (!Auth::check()) return response(403);
        $comment = Comment::find($id);
        if (is_null($comment)) return response(404);
        $post = Post::find($comment->post_id);
        $event = Event::find($post->event_id);
        $c = new Comment();
        $this->authorize('create', [$c, $event]);
        Auth::user()->dislikeComment($id);
        return response(200);
    }
}
