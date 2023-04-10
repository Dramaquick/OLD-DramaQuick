<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function store(Request $request) {

        $request->merge(['Session_OwnerId' => auth()->id()]);

        $validated = $request->validate([
            'Session_Title' => 'required|max:255',
            'Session_Description' => 'required|max:255',
            'Session_MinUsers' => 'required|min:1',
            'Session_MaxUsers' => 'required|min:1',
            'Session_Speed' => 'required|in:1,2,3',
        ]);

        $tags = $request->input('Session_Tags');

        $session = Session::create($validated);
        $session->tags()->attach($tags);

        return view('session.show', ['session' => $session]);

    }

    public function show(Session $session) {

        $session->load('tags');

        return view('session.show', ['session' => $session]);

    }

}
