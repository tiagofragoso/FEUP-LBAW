<?php

namespace App\Http\Controllers;

use App\Invite;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InvitesController extends Controller
{
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
            Invite::create(['user_id' => $user->id, 
                'invited_user_id' => $request->invited_id,
                'event_id' => $request->event_id,
                'type' => $request->type]);
            return response()->json(null, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
