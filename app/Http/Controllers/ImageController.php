<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Image;


class ImageController extends Controller
{

    public function index(Request $request){
        if($request->query('q')){

            $images = Image::where('caption','LIKE','%'.$request->query('q').'%')->paginate(3);
        }
        else{

            $images = Image::latest()->paginate(3);
            return view('welcome',compact('images'));//->with('images', $images);
        }
        return view('welcome',compact('images'));

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

    public function search()
    {
        $search_text = $_GET['query'];
        $image = Image::where('caption','LIKE', '%'.$search_text.'%')->get();
        return view('welcome', compact('image'));
    }
}


