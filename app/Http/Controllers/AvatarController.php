<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class AvatarController extends Controller
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
        $validation = validator($request->all(), [
            'avatar' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        if($validation->fails()) {
            $failed = $validation->failed();

            if(isset($failed['avatar']['Required'])) session()->flash('status', 1108);
            else if(isset($failed['avatar']['Mimes'])) session()->flash('status', 1107);
            else if(isset($failed['avatar']['Max'])) session()->flash('status', 1106);
        
        } else {
            // Convert image to webp
            $finalImage = Image::make($request->avatar)->encode('webp', 90);

            // Resize image if it's too big
            if($finalImage->width() > 500) 
                $finalImage->resize(500, null, function ($constraint) { $constraint->aspectRatio(); });

            // Save image
            $destinationPath = public_path('avatars/');
            $finalImage->save($destinationPath . auth()->id() . '.webp');

            session()->flash('status', 1003);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
        if(File::exists(public_path('avatars/' . $user->id . '.webp')))
            return response()->file(public_path('avatars/' . $user->id . '.webp'));
        else
            return response()->file(public_path('avatars/default.svg'));

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
