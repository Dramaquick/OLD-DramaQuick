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
    public function show($session_id, $position)
    { 
        $user = auth()->user();
        if ($user->Session_Id != $session_id) {
            return redirect('/');
        }
        // Get questions
        $questions = DQuestion::where('Session_Id', $session_id)->orderBy('Question_Id')->get();
        // Get session
        $session = DSession::find($session_id);
        // Get question
        $question = $questions[$position - 1];
        // Set the position of the question
        $question->position = $position;
        $answer = DAnswer::where('Question_Id', $question->Question_Id)->where('User_Id', $user->id)->first();
        if ($answer) {
            return redirect('/');
        }
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
            case 2 :
                return Inertia::render('Session/Session-text', [
                    'question' => $question,
                    'session' => $session,
                ]);
            case 3 :
                return Inertia::render('Session/Session-lowtext', [
                    'question' => $question,
                    'session' => $session,
                ]);
            case 4 :
                return Inertia::render('Session/Session-checkbox', [
                    'question' => $question,
                    'session' => $session,
                ]);
            case 5 :
                return Inertia::render('Session/Session-radiobutton', [
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