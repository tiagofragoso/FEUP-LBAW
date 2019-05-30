<?php

namespace App\Http\Controllers;
use App\EventReport;
use App\UserReport;
use App\User;
use App\Event;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function report($id,Request $request){
        if($request->status == 'delete'){
            if ($request->type == 'event'){
                EventReport::find($id)->update(['status'=>'Accepted']);
                Event::find($request->id)->update(['banned'=>true]);
            }
               
            else {
                UserReport::find($id)->update(['status'=>'Accepted']);
                User::find($request->id)->update(['banned'=>true]);

            }
        }
        else if ($request->status == 'dismiss'){
            if ($request->type == 'event'){
                EventReport::find($id)->update(['status'=>'Declined']);


            } else {
                UserReport::find($id)->update(['status'=>'Declined']);

            }
        }    
       
        return response(200);
        
        
    }

}