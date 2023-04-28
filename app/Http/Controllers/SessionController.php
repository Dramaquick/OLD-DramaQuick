<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DQuestion;
use App\Models\DAnswer;
use App\Models\DSession;
use App\Models\DSessionTag;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class SessionController extends Controller
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
        $request->merge(['Owner_Id' => auth()->id()]);

        $questions = $request->Session_Questions;

        $tags = $request->Session_Tags;

        // On recreer le store de session comme avant

        $validated = Validator::make($request->all(), [
            'Session_Title' => 'required|max:100|min:1',
            'Session_Description' => 'required|max:255|min:1',
            'Session_MinUser' => 'required|min:1',
            'Session_MaxUser' => 'required|min:1',
            'Session_Speed' => 'required|in:1,2,3',
            'Owner_Id' => 'required',
            'Session_Tags' => 'nullable|array',
            'Session_Tags.*' => 'exists:d_session_tags,Tag_Id',
            'Session_Questions' => 'required|array',
            'Session_Questions.*.Question_Title' => 'required|max:100|min:2',
            'Session_Questions.*.Question_Description' => 'required|max:255|min:2',
            'Session_Questions.*.Question_Type' => 'required|in:1,2,3,4,5,6,7',
            'Session_Questions.*.Question_Options' => 'array|required_if:Session_Questions.*.Question_Type,1,4,5,7',
            'Session_Questions.*.Question_Options.*.value' => 'max:255|min:1',
        ]);

        if ($validated->fails()) {
            $failed = $validated->failed();

            if (isset($failed['Session_Title']['Required']) || isset($failed['Session_Title']['Min'])) {
                session()->flash('status', 2101);
                return redirect()->back()->withInput();
            }
            else if (isset($failed['Session_Title']['Max'])) {
                session()->flash('status', 2102);
                return redirect()->back()->withInput();
            }
            else if (isset($failed['Session_Description']['Required']) || isset($failed['Session_Description']['Min'])) {
                session()->flash('status', 2103);
                return redirect()->back()->withInput();
            }
            else if (isset($failed['Session_Description']['Max'])) {
                session()->flash('status', 2104);
                return redirect()->back()->withInput();
            }
            else if (isset($failed['Session_Speed']['Required'])) {
                session()->flash('status', 2105);
                return redirect()->back()->withInput();
            }
            else if (isset($failed['Session_Speed']['In'])) {
                session()->flash('status', 2106);
                return redirect()->back()->withInput();
            }
            else if (isset($failed['Session_MinUser']['Required'])) {
                session()->flash('status', 2107);
                return redirect()->back()->withInput();
            }
            else if (isset($failed['Session_MinUser']['Min'])) {
                session()->flash('status', 2108);
                return redirect()->back()->withInput();
            }
            else if (isset($failed['Session_MaxUser']['Required'])) {
                session()->flash('status', 2109);
                return redirect()->back()->withInput();
            }
            else if (isset($failed['Session_MaxUser']['Min'])) {
                session()->flash('status', 2110);
                return redirect()->back()->withInput();
            }
            else if (isset($failed['Session_Questions']['Required'])) {
                session()->flash('status', 2112);
                return redirect()->back()->withInput();
            }
            else if (isset($failed['Session_Questions']['Array'])) {
                session()->flash('status', 2113);
                return redirect()->back()->withInput();
            }
            // On vérifie que tous les tags existent
            foreach($tags as $tag) {
                $exist = DSessionTag::where('Tag_Id', $tag)->exists();
                if (!$exist) {
                    session()->flash('status', 2111);
                    return redirect()->back()->withInput();
                }
            }
            // On vérifie toutes les questions
            for($i = 1; $i <= count($questions); $i++) {
                if (isset($failed['Session_Questions.'.($i-1).'.Question_Title']['Required']) || isset($failed['Session_Questions.'.($i-1).'.Question_Title']['Min'])) {
                    session()->flash('status', 2114);
                    return redirect()->back()->withInput();
                }
                else if (isset($failed['Session_Questions.'.($i-1).'.Question_Title']['Max'])) {
                    session()->flash('status', 2115);
                    return redirect()->back()->withInput();
                }
                else if (isset($failed['Session_Questions.'.($i-1).'.Question_Description']['Required']) || isset($failed['Session_Questions.'.($i-1).'.Question_Description']['Min'])) {
                    session()->flash('status', 2116);
                    return redirect()->back()->withInput();
                }
                else if (isset($failed['Session_Questions.'.($i-1).'.Question_Description']['Max'])) {
                    session()->flash('status', 2117);
                    return redirect()->back()->withInput();
                }
                else if (isset($failed['Session_Questions.'.($i-1).'.Question_Type']['Required'])) {
                    session()->flash('status', 2118);
                    return redirect()->back()->withInput();
                }
                else if (isset($failed['Session_Questions.'.($i-1).'.Question_Type']['In'])) {
                    session()->flash('status', 2118);
                    return redirect()->back()->withInput();
                }
                else if (isset($failed['Session_Questions.'.($i-1).'.Question_Options']['Array'])) {
                    session()->flash('status', 2120);
                    return redirect()->back()->withInput();
                }
                // On vérifie que si le type de la question est 1,4,5, il y a au moins 2 options et au plus 10
                if ($questions[$i-1]['Question_Type'] == 1 || $questions[$i-1]['Question_Type'] == 4 || $questions[$i-1]['Question_Type'] == 5) {
                    if (count($questions[$i-1]['Question_Options']) < 2) {
                        session()->flash('status', 2121);
                        return redirect()->back()->withInput();
                    } else if (count($questions[$i-1]['Question_Options']) > 10) {
                        session()->flash('status', 2122);
                        return redirect()->back()->withInput();
                    }
                    // On vérifie que ces options sont valides
                    $counter_2 = 0;
                    foreach($questions[$i-1]['Question_Options'] as $option) {
                        if (isset($failed['Session_Questions.'.($i-1).'.Question_Options.'.( $counter_2).'.value']['Min'])) {
                            session()->flash('status', 2123);
                            return redirect()->back()->withInput();
                        }
                        else if (isset($failed['Session_Questions.'.($i-1).'.Question_Options.'.( $counter_2).'.value']['Max'])) {
                            session()->flash('status', 2124);
                            return redirect()->back()->withInput();
                        }
                        $counter_2++;
                    }
                }
                // On vérifie maintenant pour les questions de type 7 (slider), il faut 3 options
                // Tout d'abord, on met les informations de slider dans options
                if ($questions[$i-1]['Question_Type'] == 7) {
                    $questions[$i-1]['Question_Options'] = $questions[$i-1]['Question_Slider'];
                    if (count($questions[$i-1]['Question_Options']) != 3) {
                        session()->flash('status', 2125);
                        return redirect()->back()->withInput();
                    }
                    // On vérifie que ces options sont valides
                    $counter = 0;
                    foreach($questions[$i-1]['Question_Options'] as $option) {
                        if (isset($failed['Session_Questions.'.($i-1).'.Question_Options.'. ($counter) .'.Option_Value']['Min']) || isset($failed['Session_Questions.'.($i-1).'.Question_Options.*.Option_Value']['Required'])) {
                            session()->flash('status', 2123);
                            return redirect()->back()->withInput();
                        }
                        if ($questions[$i-1]['Question_Options']['min'] > $questions[$i-1]['Question_Options']['max']) {
                            session()->flash('status', 2127);
                            return redirect()->back()->withInput();
                        }
                        // On vérifie que la dernière valeur et soit un 1, soit un 2
                        if ($questions[$i-1]['Question_Options']['type'] != 1 && $questions[$i-1]['Question_Options']['type'] != 2) {
                            session()->flash('status', 2128);
                            return redirect()->back()->withInput();
                        }
                        $counter++;
                    }
                }
                // Pour toutes les questions de type 2,3,6, on réinitialise les options
                if ($questions[$i-1]['Question_Type'] == 2 || $questions[$i-1]['Question_Type'] == 3 || $questions[$i-1]['Question_Type'] == 6) {
                    $questions[$i-1]['Question_Options'] = [];
                }
            }

        }

        // On crée la session

        // On attache les tags à la session

        $session = DSession::create([
            'Session_Title' => $request->Session_Title,
            'Session_Description' => $request->Session_Description,
            'Session_MinUser' => $request->Session_MinUser,
            'Session_MaxUser' => $request->Session_MaxUser,
            'Session_Speed' => $request->Session_Speed,
            'Owner_Id' => $request->Owner_Id,
        ]);

        $tags = $request->input('Session_Tags');

        $session->tags()->attach($tags);

        // On crée les questions

        $questions = $request->input('Session_Questions');

        // function arrayToString($array, $type)
        function arrayToString($array) {
            return implode(',', $array);
        }

        function arrayToArray($array) {
            $finalarray = [];
            for($i = 0; $i < count($array); $i++) {
                array_push($finalarray, $array[$i]['value']);                
            }
            return $finalarray;
        }

        foreach ($questions as $question) {
            if ($question['Question_Type'] == 1 || $question['Question_Type'] == 4 || $question['Question_Type'] == 5) {
                $question['Question_Options'] = arrayToString(arrayToArray($question['Question_Options']));
            }
            else if ($question['Question_Type'] == 7) {
                $question['Question_Options'] = arrayToString($question['Question_Slider']);
            }
            else {
                $question['Question_Options'] = "Null";
            }
            $question = DQuestion::create([
                'Question_Title' => $question['Question_Title'],
                'Question_Description' => $question['Question_Description'],
                'Question_Type' => $question['Question_Type'],
                'Session_Id' => $session->Session_Id,
                'Question_Options' => $question['Question_Options'],
            ]);

        }

        session() -> flash('status', 2001);
        return redirect()->route('session.show', $session->Session_Id);
    }

    /**
     * Display the specified resource.
     *
     * @param int  $id
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