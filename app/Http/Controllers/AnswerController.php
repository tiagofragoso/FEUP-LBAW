<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Event;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function validateAnswer($data) {
        return Validator::make($data->all(), [
            'content' => 'required|string|max:1000',
            'question_id' => 'required'
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
        try {
            if (!Auth::check()) return response()->json(null, 403);
            $question = Question::find($id);
            if (is_null($question)) return response()->json(null, 404);
            $event = Event::find($question->event_id);
            $a = new Answer();
            $this->authorize('create', [$a, $event]);
            $request->request->add(['question_id' => $id]);
            $this->validateAnswer($request);
            $answer = Answer::create($request->all());
            return response()->json($answer, 201);
            return response(200);
        } catch (\Illuminate\Database\QueryException $e) {
            report($e);
            return response()->json(null, 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
