<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Image;


class ImageController extends Controller
{

    // function to search or get caption and category value to display
    public function index(Request $request){

        if(Auth::user()) {
            $images = $this->authFilter($request);
        }else {
            $images = $this->guestFilter($request);
        }

        return view('welcome',compact('images'));

    }


    // function to get and post/display uploaded image data
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


    // function to delete data
    public function destroy($id)
    {
        $image = Image::find($id);
        $image->delete();
        Session::flash('danger', 'Images deleted');
        return redirect('/');
    }

// user log in to update, delete, upload data
    public function authFilter(Request $request)
    {
        $user_id = Auth::user()->id;

        if($request->query('q')){
            $images = Image::where('user_id',$user_id )
                ->where('caption','LIKE','%'.$request->query('q').'%')
                ->paginate(6);
        }

        elseif ($request->query('category') && $request->query('category') != "All"){
            $images = Image::where('user_id',$user_id )
                ->where('category','LIKE','%'.$request->query('category').'%')
                ->paginate(6);
        }
        elseif(!$request->query('q') || ($request->query('category') && $request->query('category') == "All") ) {
           $images = Image::where('user_id', Auth::user()->id)->paginate(6);
        }

        return $images;
    }


    // guest not log in but can view and search datas
    public function guestFilter(Request $request)
    {
        if($request->query('q')){
            $images = Image::where('caption','LIKE','%'.$request->query('q').'%')->paginate(6);
        }

        elseif ($request->query('category') && $request->query('category') != "All"){
            $images = Image::where('category','LIKE','%'.$request->query('category').'%')->paginate(6);
        }

        elseif (!$request->query('q') || ($request->query('category') && $request->query('category') == "All")){
            $images = Image::latest()->paginate(6);
        }

        return $images;
    }

    // // function to
    // public function search()
    // {
    //     $search_text = $_GET['query'];
    //     $image = Image::where('caption','LIKE', '%'.$search_text.'%')->get();
    //     return view('welcome', compact('image'));
    // }



}


