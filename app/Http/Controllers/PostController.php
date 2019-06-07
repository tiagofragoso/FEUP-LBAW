<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Poll;
use App\Event;
use App\PollOption;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function validatePost($data)
    {
        return Validator::make($data->all(), [
            'content' => 'required|string|max:5000',
            'event_id' => 'required',
            'author_id' => 'required',
            'type' => 'required|in:Post,Poll,File'
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

        $this->authorize('create', [new Post(), $event]);

        $request->request->add(['author_id' => Auth::user()->id, 'event_id' => $id]);

        $this->validatePost($request);
        return DB::transaction(function () use($request, $id) {
            try {
                $post = Post::create($request->except(['poll_options', 'title', 'file']));
            } catch (\Exception $e) {
                //log this
                return response()->json(null, 400);
            }
    
            $returnObject = [
                'id' => $post->id,
                'content' => $post->content,
                'author_id' => $post->author_id,
                'type' => $post->type,
                'date' => $post->date,
                'author' => $post->author->displayName()
            ];
    
            if ($request->type === 'Post') {
                return response()->json($returnObject, 201);
            } else if ($request->type === 'Poll') {
                $title = $request->title;
                if (empty($title)) {
                    return response()->json('1', 400);
                }
                $poll_options = $request->poll_options;
                if (empty($poll_options)) {
                    return response()->json('2', 400);
                }
                $poll_options = json_decode($poll_options);
                if (is_array($poll_options)) {
                    if (count($poll_options) < 2) {
                        return response()->json('3', 400);        
                    } else {
                        try {
                            Poll::create(['post_id' => $post->id, 'title' => $title]);
                            $poll_opt_objects = array();
                            foreach ($poll_options as $key => $value) {
                                array_push($poll_opt_objects, PollOption::create(['post_id' => $post->id, 'name' => $value]));
                            }
                            $returnObject['title'] = $title;
                            $returnObject['poll_options'] = json_encode($poll_opt_objects);
                            return response()->json($returnObject, 201);
                        } catch(\Exception $e) {
                            //log this
                            return response()->json($e->getMessage(), 400);
                        }
                    } 
                } else {
                    return response()->json('5', 400);        
                }
            } else if ($request->type === 'File') {
                if (!$request->hasFile('file')) {
                    return response()->json(null, 400);
                } else {
                    $path = $request->file('file')->store('events/files', 'public');
                    try {
                        File::create(['post_id' => $post->id, 'file' => $path]);
                        $returnObject['file'] = $request->file('file')->getClientOriginalName();
                        return response()->json($returnObject, 201);
                    } catch(\Exception $e) {
                        //log this
                        return response()->json($e->getMessage(), 400);
                    }
                }
            } else {
                return response()->json(null, 400);
            }
        });
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

    public function pollVote(Request $request, $postId)
    {
        $pollOption = $request->pollOption;
        if (!Auth::check()) return response()->json(null, 403);
        if (is_null(Poll::where('post_id', $postId)->get()->first())) return response()->json(null, 404);
        $post = Poll::where('post_id', $postId)->get()->first();
    
        $event = Event::find(Post::find($postId)->event_id);
        if (!($post->hasVote(Auth::user()->id))) {
            $this->authorize('canVote', $event);
            Auth::user()->voteOnPoll($postId, $pollOption);
            return response()->json(null, 200);
        } else{
            $this->authorize('canVote', $event);
            $post->changeVote(Auth::user()->id,$pollOption);
            return response()->json(null, 200);
        }
        
    }

    public function likePost($id){
       
        if (!Auth::check()) return response()->json(null, 403);
        
        if (is_null(Post::find($id))) return response()->json(null, 404);
        Auth::user()->likePost($id);
        return response()->json(null, 200);
        
    }
    public function dislikePost($id){
        
        if (!Auth::check()) return response()->json(null, 403);
        if (is_null(Post::find($id))) return response()->json(null, 404);
        Auth::user()->dislikePost($id);
        return response()->json(null, 200);

    }
}
