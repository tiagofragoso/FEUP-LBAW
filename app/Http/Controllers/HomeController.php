<?php

namespace App\Http\Controllers;

use App\Event;
use App\Participation;
use App\Poll;
use App\Post;
use App\File;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function show(Request $request)
    {
        if (!Auth::check())
            return redirect('/search');

        $events = $this->getTrending();

        $activity = $this->getActivity($request);

        return view('pages.home', ['events' => $events, 'activity' => $activity]);
    }

    public function getTrending()
    {
        return Event::where([
            ['private', 'false'],
            ['banned', 'false'],
            ['start_date', '>', DB::raw('CURRENT_TIMESTAMP')]
        ])
        ->orderBy('participants', 'DESC')
        ->get();
    }

    public function getActivity(Request $request)
    {
        $participations = Participation::select(
                'users.id as user_id',
                'users.username',
                'participations.type',
                'participations.date',
                'events.id',
                'events.title',
                'events.location',
                'events.start_date'
            )
            ->leftJoin('users', 'participations.user_id', '=', 'users.id')
            ->leftJoin('events', 'participations.event_id', '=', 'events.id')
            ->whereIn('participations.user_id', Auth::user()
                ->following()
                ->get()
                ->map(function($user){
                    return $user->id;
                })
                ->toArray()
            )
            ->orWhere('participations.user_id', '=', Auth::user()->id)
            ->get();

        foreach ($participations as $p) {
            $p['joined'] = Auth::user()->hasParticipation($p->id, ['Participant', 'Owner', 'Host']);
        }

        $posts = Post::select(
                'posts.*',
                'users.name as author_name',
                'users.username as username',
                'participations.type as event_participation',
                'events.id as event_id',
                'events.title as event_title'
            )
            ->leftJoin('participations', 'participations.event_id', '=', 'posts.event_id')
            ->leftJoin('events', 'participations.event_id', '=', 'events.id')
            ->leftJoin('users', 'users.id', '=', 'posts.author_id')
            ->where('participations.user_id', '=', Auth::user()->id)
            ->orderBy('posts.date', 'DESC')
            ->get();

        foreach ($posts as $key => $value) {
            $post = Post::find($value->id);
            $value['commentsContent'] = $post->comments()->get();
            foreach ($value['commentsContent'] as $key1 => $comment) {
                $comment['comments'] = Comment::find($comment->id)->comments()->get();
            }

            if ($value->type == 'Poll') {
                $value['poll_options'] = $post->poll()->first()->pollOptions()->get();
            }
            elseif ($value->type == 'File') {
                $value['files'] = $post->file()->get();
            }
        }

        foreach($posts as $post) {
            $post['hasLike'] = $post->hasLike(Auth::user()->id);
            foreach($post->commentsContent as $comment) {
                $comment['hasLike'] = $comment->hasLike(Auth::user()->id);
                foreach($comment->comments as $commentComment) {
                    $commentComment['hasLike'] = $commentComment->hasLike(Auth::user()->id);
                }
            }
        }

        if ($request->has('page')) {
            return $participations->toBase()->merge($posts)->sortByDesc('date')->forPage($request->page, 10);
        }
        else {
            return $participations->toBase()->merge($posts)->sortByDesc('date')->forPage(1, 10);
        }
    }
}
