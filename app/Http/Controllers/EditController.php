<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function edit(Image $image)
    {
    //    $follows = (auth()->user())? auth()->user()->following->contains($user->id) : false;
    $this->middleware('auth');

       return view("layouts.edit", compact('image'));
    }

    // public function update(Request $request)
    // {
    //     $this->validate($request,[
    //         'image' => 'required',
    //         'caption' => 'required',
    //         'category' => 'required'
    //     ]);
    //     return back();
    // }
    public function update(Request $request,Image $image)
{



    $this->validate($request, [
        'image' => 'sometimes',
        'caption' => 'required',
        'category' => 'required'
    ]);

    $input = $request->all();

    $image->fill($input)->save();


    return redirect('/layouts/welcome')->with('status', 'Profile updated!');

}

}


