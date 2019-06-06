<?php

namespace App\Http\Controllers;
use App\EventReport;
use App\UserReport;
use App\User;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updateUserReport($id, Request $request) {
        if (!Auth::check()) return response()->json(null, 403);
        if (!Auth::user()->is_admin) return response()->json(null, 403);

        Validator::make($request->all(), [
            'answer' => 'string|required|in:Accepted,Declined'
        ])->validate();
        
        try {
            $report = UserReport::findOrFail($id);
        } catch(\Exception $e) {
            return response()->json('Report not found', 404);
        }

        $reportedUser = $report->reportedUser()->get()->first();
        try {
            UserReport::where('reported_user', $reportedUser->id)->where('status', 'Pending')->update(['status' => $request->answer]);
            if ($request->answer === 'Accepted') {
                $reportedUser->update(['banned' => true]);
            }
        } catch (\Exception $e) {
            return response()->json(null, 400);
        }

        return response()->json(null, 200);
    }

    public function updateEventReport($id, Request $request) {
        if (!Auth::check()) return response()->json(null, 403);
        if (!Auth::user()->is_admin) return response()->json(null, 403);

        Validator::make($request->all(), [
            'answer' => 'string|required|in:Accepted,Declined'
        ])->validate();
        
        try {
            $report = EventReport::findOrFail($id);
        } catch(\Exception $e) {
            return response()->json('Report not found', 404);
        }

        $reportedEvent = $report->event()->get()->first();
        try {
            EventReport::where('event_id', $reportedEvent->id)->where('status', 'Pending')->update(['status' => $request->answer]);
            if ($request->answer === 'Accepted') {
                $reportedEvent->update(['banned' => true]);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
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
        if (Auth::user()->is_admin) return rresponse()->json(null, 403);
        
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