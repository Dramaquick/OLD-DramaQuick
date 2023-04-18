<?php

namespace App\Http\Controllers;

use App\Models\DSession;
use App\Models\User;
use App\Models\DQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class SessionController extends Controller
{

    /**
     * Stores a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->merge(['Owner_Id' => auth()->id()]);

        $validated = Validator::make($request[0]->all(), [
            'Session_Title' => 'required|max:255',
            'Session_Description' => 'required|max:255',
            'Session_MinUser' => 'required|min:1',
            'Session_MaxUser' => 'required|min:1',
            'Session_Speed' => 'required|in:1,2,3',
            'Owner_Id' => 'required',
            'Session_Tags' => 'nullable|array',
            'Session_Tags.*' => 'exists:d_session_tags,Tag_Id'
        ]);

        $validation = Validator::make($request[1]->all(), [
            'question*.Title' => 'required|max:255',
            'question*.Description' => 'required|max:255',
            'question*.Type' => 'required|in:1,2,3,4,5,6'
        ]);

        if($validated->fails() || $validation->fails()) {
            $failed = $validated->failed();
            $fail = $validation->failed();

            if (isset($failed['Session_Title']['Required'])) session()->flash('status', 1101);
            else if (isset($failed['Session_Title']['Max'])) session()->flash('status', 1102);
            else if (isset($failed['Session_Description']['Required'])) session()->flash('status', 1103);
            else if (isset($failed['Session_Description']['Max'])) session()->flash('status', 1104);
            else if (isset($failed['Session_Speed']['Required'])) session()->flash('status', 1109);
            else if (isset($fail['Question_Title']['Required'])) session()->flash('status', 1117);
            else if (isset($fail['Question_Title']['Max'])) session()->flash('status', 1118);
            else if (isset($fail['Question_Description']['Required'])) session()->flash('status', 1119);
            else if (isset($fail['Question_Description']['Max'])) session()->flash('status', 1120);
            else if (isset($fail['Question_Type']['Required'])) session()->flash('status', 1121);
            else if (isset($fail['Question_Type']['In'])) session()->flash('status', 1122);

            return back()->withInput();
            }
        else {

        $tags = $request->input('Session_Tags');

        $session = DSession::create($validated);
        $session->tags()->attach($tags);

        return to_route('session.show', [$session]);

        };

    }

    /**
     * Display the specified resource.
     * @param  \App\DSession  $session
     * @return \Illuminate\Http\Response
     */
    public function show(DSession $session) {

        $owner = User::find($session->Owner_Id, [ 'name' ]);

        User::where('id', auth()->id())->update(['Session_Id' => $session->Session_Id]);
        event(new \App\Events\JoinSessionEvent($session->Session_Id, auth()->user()));

        return Inertia::render('Session/Session-start', [
            'session' => $session,
            'owner' => $owner,
        ]);

    }

}
