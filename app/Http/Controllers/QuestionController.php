<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DQuestion;
use App\Models\DAnswer;
use App\Models\DSession;
use Inertia\Inertia;

class QuestionController extends Controller
{
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $question
     * @return \Illuminate\Http\Response
     */
    public function show($question_id, $number)
    { 
        // Get question
        $question = DQuestion::where('Question_Id', $question_id)->first();
        $question->number = $number;
        // Get session
        $session = DSession::where('Session_Id', $question->Session_Id)->first();
        //Get number of questions in the session
        $number_of_questions = DQuestion::where('Session_Id', $question->Session_Id)->count();
        $session->number_of_questions = $number_of_questions;
        // Get the type of question
        $type = $question->Question_Type;
        // On retourne vers la page correspond au type de la question avec les options
        switch ($type) {
            case 1 :
                return Inertia::render('Session/Session-select', [
                    'question' => $question,
                    'session' => $session,
                ]);
            case 6 :
                return Inertia::render('Session/Session-paint', [
                    'question' => $question,
                    'session' => $session,
                ]);
            case 7 :
                return Inertia::render('Session/Session-slider', [
                    'question' => $question,
                    'session' => $session,
                ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}