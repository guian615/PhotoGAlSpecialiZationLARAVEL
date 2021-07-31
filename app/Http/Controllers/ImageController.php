<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Image;

use Auth;
use Session;


class ImageController extends Controller
{

    public function index(){
        $images = Image::latest()->paginate(3);
        return view('welcome')->with('images', $images);

    }
    public function post(Request $request)
    {
        $this->validate($request,[
            'image' => 'required',
            'caption' => 'required',
            'category' => 'required'
        ]);

        $images = $request->image;
        foreach ($images as $image){
            $image_new_name = time().$image->getClientOriginalName();
            $image->move('images', $image_new_name);
            $post = new Image;
            $post->user_id = Auth::user()->id;
            $post->image = 'images/' .$image_new_name;
            $post->caption = $request->caption;
            $post->category = $request->category;
            $post->save();

        }


        Session::flash('success', 'Images uploaded');





        return redirect('/');
    }
    public function destroy($id)
    {
        $image = Image::find($id);
        $image->delete();
        Session::flash('danger', 'Images deleted');
        return redirect('/');
    }


    // public function store()
    // {
    //     $data = request()->validate([
    //         'caption' => 'required',
    //         'category' => 'required',
    //         'image' =>'required'
    //     ]);

    //     $imagePath = request('image')->store('profile','public');

    //     $image = Image::make(public_path("storage/{$imagePath}"));
    //     $image->save();

    //     auth()->user()->posts->create([
    //         'caption' => $data['caption'],
    //         'category' => $data['category'],
    //         'image' => $imagePath
    //     ]);

    //     return redirect('/profile/'. auth()->user()->id);
    //     dd(request()->all());


    // }
}


