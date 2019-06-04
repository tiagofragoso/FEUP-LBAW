<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function validatePost($data) {
        return Validator::make($data->all(), [
            'content' => 'required|string|max:5000',
            'event_id' => 'required',
            'author_id' => 'required',
            'type' => 'required'
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
        if(!Auth::check()) return response()->json(null, 403);
        $event = Event::find($id);
        if (is_null($event)) return response()->json(null, 404);
        $this->authorize('create', [$event, Post::class]);
        $request->request->add(['author_id' => Auth::user()->id]);
        $request->request->add(['event_id' => $id]);
        $this->validatePost($request);
        if ($request->type == 'Post') {
            $post = Post::create($request->all());
            $post = Post::find($post->id);
            return response()->json([
                'id' => $post->id,
                'content' => $post->content,
                'author_id' => $post->author_id,
                'type' => $post->type,
                'date' => \Carbon\Carbon::createFromFormat('Y-m-d H:i:s.u', $post->date)->format('M d | H:i'),
                'author' => $post->author->displayName()
            ], 201);
        } else {
            return response()->json(null, 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post)
    {
        //
    }

    public function likePost($id){
       
        if (!Auth::check()) return response(403);
        
        if (is_null(Post::find($id))) return response(404);
        Auth::user()->likePost($id);
        return response(200);
        
    }
    public function dislikePost($id){
        
        if (!Auth::check()) return response(403);
        if (is_null(Post::find($id))) return response(404);
        Auth::user()->dislikePost($id);
        return response(200);

    }

}
