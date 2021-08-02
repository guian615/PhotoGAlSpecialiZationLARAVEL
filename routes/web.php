<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\Image;

use Illuminate\Support\Facades\Request;

Auth::routes();

Route::get('/', [App\Http\Controllers\ImageController::class, 'index'])->name('index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/image', [App\Http\Controllers\ImageController::class, 'post'])->name('post');

Route::put('/image/{image}', [App\Http\Controllers\EditController::class, 'update'])->name('image.update');
Route::get('/image/{image}/edit', [App\Http\Controllers\EditController::class, 'edit'])->name('edit');

Route::delete('/image/{id}', [App\Http\Controllers\ImageController::class, 'destroy'])->name('destroy');


// Route::any('/',function(){
//     $q = Request::get ( 'q' );

//    $images = Image::where('caption','LIKE','%'.$q.'%');//->orWhere('category','LIKE','%'.$q.'%')->get();

//     if(count(array($images)) > 0)
//       return view("welcome",compact('images'));//->withDetails($user)->withQuery ( $q );
//     //  //  return view('welcome',compact('caption'));
//     // else return  ('no data found');//->withMessage('No Details found. Try to search again !');
// });
Route::any('/search',function(){
    $q = Image::get ( 'q' );
    $image = Image::where('caption','LIKE','%'.$q.'%')->orWhere('category','LIKE','%'.$q.'%')->get();
    if(count(array($image)) > 0)
        return view('welcome');//->withDetails($image)->withQuery ( $q );
    else return view ('welcome');//->withMessage('No Details found. Try to search again !');
});
