<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\albumController;
use App\Http\Controllers\picturesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $count_album = DB::table('album')->count();
    $count_picture = DB::table('pictures')->count();
    return view('dashboard.index',["count_album"=>$count_album,'count_picture'=>$count_picture]);
});


Route::resource('/album', albumController::class);

Route::resource('/pictures', picturesController::class);

Route::get('/album/move/{id}/', [albumController::class , 'movePictures']);
Route::put('/album/moveTo/{id}/', [albumController::class , 'movePicturesTo']);
// Route::get('/album/move/', function(){
//     return view('album.movePictures');
// });
