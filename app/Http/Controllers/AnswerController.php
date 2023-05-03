<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DQuestion;
use App\Models\DAnswer;
use App\Models\DSession;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class AnswerController extends Controller
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
        // On regarde le type de la question
        $question = DQuestion::where('Question_Id', $request->Question_Id)->first();
        $type = $question->Question_Type;

        // Si le type vaut 6, c'est un paint, on stocke l'image dans le dossier public/paints au format webp avec comme nom, l'id de la question et l'id du user, on fait une validation
        if ($type == 6) {
            // Mon image ressemble à : data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gHYSUNDX1BST0ZJTEUAAQEAAAHI....
            $image = $request->Answer_Values;
            // On enlève le début de la chaine de caractère pour ne garder que le base64
            $path = public_path('paints/');
            $image = Image::make(file_get_contents($image))->encode('webp', 90);   
            $destinationPath = public_path('paints/');
            $image->save($destinationPath . $request->User_Id .'_' . $request->Question_Id . '.webp');
            $path = $request->User_Id .'_' . $request->Question_Id . '.webp';

            $answer = DAnswer::create([
                'Answer_Values' => $path,
                'Question_Id' => $request->Question_Id,
                'Session_Id' => $request->Session_Id,
                'User_Id' => $request->User_Id
            ]);
            return redirect('/api/nextquestion/' . $answer->Session_Id);
        }

        $validated = Validator::make($request->all(), [
            'Question_Id' => 'required',
            'Session_Id' => 'required',
            'User_Id' => 'required'
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        $answer = $request->Answer_Values;

        if (gettype($request->Answer_Values) == 'array') {
            $answer = implode(',', $request->Answer_Values);
        }

        // SI une réponse existe déjà pour cette question par cet utilisateur, on enregistre pas la réponse
        $answerExist = DAnswer::where('Question_Id', $request->Question_Id)->where('User_Id', $request->User_Id)->first();
        if ($answerExist) {
            return redirect('/api/nextquestion/' . $answerExist->Session_Id);
        } else {
        $answer = DAnswer::create(
            [
                'Answer_Values' => $answer,
                'Question_Id' => $request->Question_Id,
                'Session_Id' => $request->Session_Id,
                'User_Id' => $request->User_Id
            ]
        );
        return redirect()->guest(route('session.nextQuestion', ['session' => $answer->Session_Id]));
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($session_id, $position)
    {
        $position = $position - 1;
        // On récupère la question
        $questions = DQuestion::where('Session_Id', $session_id)->orderBy('Question_Id')->get();
        // Get session
        $session = DSession::find($session_id);
        // Get question
        try {
        $question = $questions[$position];
        } catch (\Throwable $th) {
            return redirect("/api/session/resetResult/". auth()->user()->id);
        }
        // On récupère les réponses
        $answers = DAnswer::where('Question_Id', $question->Question_Id)->get();
        // On récupère le nombre de réponses
        $answersNumber = DAnswer::where('Question_Id', $question->Question_Id)->count();
        $answers->number = $answersNumber;

        // On regarde le type de la question
        $type = $question->Question_Type;

        //Get number of questions in the session
        $number_of_questions = DQuestion::where('Session_Id', $question->Session_Id)->count();
        $session->number_of_questions = $number_of_questions;

        $question->position = $position+1;

        // Si le type vaut 1, 5 ou 7 et que pour le type 6, le type du slider est 1, on retourne la vue avec les réponses
        if ($type == 1 || $type == 7) {
            return Inertia::render('Session/Session-answer-PieChart', [
                'answers' => $answers,
                'question' => $question,
                'session' => $session
            ]);
        } else if ($type == 2 || $type == 3) {
            return Inertia::render('Session/Session-answer-text', [
                'answers' => $answers,
                'question' => $question,
                'session' => $session
            ]);
        } else if ($type == 4 || $type == 5) {
            return Inertia::render('Session/Session-answer-BarChart', [
                'answers' => $answers,
                'question' => $question,
                'session' => $session
            ]);
        } else if ($type == 6) {
            return Inertia::render('Session/Session-answer-paint', [
                'answers' => $answers,
                'question' => $question,
                'session' => $session
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

    /**
     * Get the number of all answers.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function allAnswers()
    {
        $answersNumber = DAnswer::count();
        return response()->json(['answers' => $answersNumber]);
    }

    /**
     * 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getNumberOfSame($response){
        $answersNumber = DAnswer::where('Answer_Values', $response)->count();
        return response()->json(['answers' => $answersNumber]);
    }
}   
