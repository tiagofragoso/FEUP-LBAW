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

        if (!Auth::check()) return response()->json(null, 403);

        //$this->authorize('update', App\EventReport::class);
        if (!Auth::user()->is_admin) return response()->json(null, 403);

        if ($request->status == 'delete') {
            $status = 'Accepted';
        } else if ($request->status == 'dismiss') {
            $status = 'Declined';
        }

        if ($request->type == 'event') {
            Event::findOrFail($request->id);
            EventReport::where('event_id', '=', $request->id)->update(['status' => $status]);
            Event::find($request->id)->update(['banned' => true]);
            return response()->json(null, 200);

        } else if ($request->type == 'user') {
            User::findOrFail($request->id);
            UserReport::where('reported_user', '=', $request->id)->update(['status' => $status]);
            User::find($request->id)->update(['banned' => true]);
            return response()->json(null, 200);
        } 
        
        return response()->json(null, 200);
    }

    public function reportEvent($id)
    {
        if (!Auth::check()) return response()->json(null, 403);
        if (Auth::user()->is_admin) return response()->json(null, 403);

        if (Event::find($id) == null) return response()->json(null, 404);

        $user_id = Auth::user()->id;

        $event = EventReport::where('event_id',$id)
                ->where('user_id',$user_id)
                ->where('status','Pending')->count();

        if ($event < 1){
            EventReport::create(['event_id'=>$id,'user_id'=>$user_id]);
            return response()->json(null, 200);
        }
        
        return response()->json(null, 422);

       
    }

    public function reportUser($id)
    {
        if (!Auth::check()) return response()->json(null, 403);
        if (Auth::user()->is_admin) return response()->json(null, 403);
        
        if (User::find($id) == null) return response()->json(null, 404);
        
        $user_id = Auth::user()->id;

        
        $user = UserReport::where('reported_user', $id)
        ->where('user_id', $user_id)
        ->where('status', 'Pending')->count();
        
        if ($user < 1) {
            UserReport::create(['user_id' => $user_id, 'reported_user' => $id]);
            return response()->json(null, 200);
        } 
            
        return response()->json(null, 422);
    }

}