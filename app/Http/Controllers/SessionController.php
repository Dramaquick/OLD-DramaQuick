<?php

namespace App\Http\Controllers;

use App\Models\DSession;
use Illuminate\Http\Request;
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

        $validated = $request->validate([
            'Session_Title' => 'required|max:255',
            'Session_Description' => 'required|max:255',
            'Session_MinUser' => 'required|min:1',
            'Session_MaxUser' => 'required|min:1',
            'Session_Speed' => 'required|in:1,2,3',
            'Owner_Id' => 'required',
        ]);

        //$tags = $request->input('Session_Tags');

        $session = DSession::create($validated);
        //$session->tags()->attach($tags);

        return to_route('session.show', [$session]);

    }

    /**
     * Display the specified resource.
     * @param  \App\DSession  $session
     * @return \Illuminate\Http\Response
     */
    public function show(DSession $session) {

        //$session->load('tags');

        return Inertia::render('Session/Session-start', [
            'session' => $session,
        ]);

    }

}
