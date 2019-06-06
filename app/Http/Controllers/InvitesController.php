<?php

namespace App\Http\Controllers;

use App\Invite;
use App\Event;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InvitesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    private function validator($data)
    {
        return Validator::make($data->all(), [
            'invited_id' => 'numeric|required',
            'event_id' => 'numeric|required',
            'type' => 'in:Participant,Host,Artist|required'
        ])->validate();
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(null, 403);
        }
        
        $user = Auth::user();

        if ($user->is_admin) {
            return response()->json(null, 403);
        }

        $this->validator($request);

        if ($user->id == $request->invited_id) {
            return response()->json(null, 400);
        }

        try {
            $event = Event::findOrFail($request->event_id);
        } catch(\Exception $e) {
            return response()->json('Event not found', 404);
        }

        $canInvite = $event->hosts()->get()->where('id', $user->id)->count() === 1;
        
        if (!$canInvite) {
            return response()->json(null, 403);
        }

        try {
            Invite::create(['user_id' => $user->id, 
                'invited_user_id' => $request->invited_id,
                'event_id' => $request->event_id,
                'type' => $request->type]);
            return response()->json(null, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function getFollowing(Request $request) {
        if (!Auth::check()) return response()->json(null, 403);

        $user = Auth::user();

        if ($user->is_admin) {
            return response()->json(null, 403);
        }

        Validator::make($request->all(), ['event_id' => 'numeric|required'])->validate();

        try {
            Event::findOrFail($request->event_id);
        } catch(\Exception $e) {
            return response()->json('Event not found', 404);
        }

        $following = $this->mapUsers($user->following()->get(), $request->event_id)->toArray();
        
        return response()->json($following, 200);
    }

    public function search(Request $request) {
        if (!Auth::check()) return response()->json(null, 403);

        Validator::make($request->all(), ['event_id' => 'numeric|required', 'query_term' => 'string|required'])->validate();

        try {
            Event::findOrFail($request->event_id);
        } catch(\Exception $e) {
            return response()->json('Event not found', 404);
        }

        $formattedQuery = "%".$request->query_term."%";

        try {
            $users = User::where('name', 'ilike', $formattedQuery)->orWhere('username', 'ilike', $formattedQuery)->where('id', '<>', Auth::user()->id)->limit(10)->get();
        } catch(\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
        if ($users->count() > 0) {
            $formatted = $this->mapUsers($users, $request->event_id)->toArray();
            return response()->json($formatted, 200);
        } else {
            return response()->json([], 200);
        }
    }

    private function mapUsers($users, $event_id) {
        $mapped = $users->map(function ($u) use($event_id) {
            $ret = $u->makeHidden(['email', 'followers', 'following', 'birthdate'])->toArray();
            $invite = Invite::where('invited_user_id', $u->id)->where('event_id', $event_id)->first();
            if (empty($invite)) {
                $ret['invited'] = false;
            } else {
                $ret['invited'] = true;
                $ret['invite_status'] = $invite->status;
                $ret['invite_type'] = $invite->type;
            }
            return $ret;
        });
        return $mapped;
    }

    public function respond($id, Request $request) {
        if (!Auth::check()) return response()->json(null, 403);

        $user = Auth::user();

        if ($user->is_admin) {
            return response()->json(null, 403);
        }

        Validator::make($request->all(), ['answer' => 'string|required|in:Accepted,Declined'])->validate();

        try {
            $invite = Invite::findOrFail($id);
        } catch(\Exception $e) {
            return response()->json('Invite not found', 404);
        }

        try {
            $invite->status = $request->answer;
            $invite->save();
        } catch(\Exception $e) {
            return response()->json('Could not update invite', 400);
        }
        
        return response()->json(null, 200);

    }
}
