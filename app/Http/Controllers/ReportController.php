<?php

namespace App\Http\Controllers;
use App\EventReport;
use App\UserReport;
use App\User;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request){

        if (!Auth::check()) return response(403);

        //$this->authorize('update', App\EventReport::class);
        if (!Auth::user()->is_admin) return response(403);

        if ($request->status == 'delete') {
            $status = 'Accepted';
        } else if ($request->status == 'dismiss') {
            $status = 'Declined';
        }

        if ($request->type == 'event') {
            Event::findOrFail($request->id);
            EventReport::where('event_id', '=', $request->id)->update(['status' => $status]);
            return response(200);

        } else if ($request->type == 'user') {
            User::findOrFail($request->id);
            UserReport::where('reported_user', '=', $request->id)->update(['status' => $status]);
            return response(200);
        } 
        
        return response(200);
    }

}