<?php

namespace App\Http\Controllers;

use App\Invite;
use App\Event;

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

        $this->validator($request);

        $user = Auth::user();

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

        Validator::make($request->all(), ['event_id' => 'numeric|required'])->validate();

        try {
            Event::findOrFail($request->event_id);
        } catch(\Exception $e) {
            return response()->json('Event not found', 404);
        }

        $following = $user->following()->get()->map(function ($u) use($request) {
            $ret = $u->makeHidden(['email', 'followers', 'following', 'birthdate'])->toArray();
            $invite = Invite::where('invited_user_id', $u->id)->where('event_id', $request->event_id)->first();
            if (empty($invite)) {
                $ret['invited'] = false;
            } else {
                $ret['invited'] = true;
                $ret['invite_status'] = $invite->status;
                $ret['invite_type'] = $invite->type;
            }
            return $ret;
        })->toArray();
        
        return response()->json($following, 200);

    }
}
