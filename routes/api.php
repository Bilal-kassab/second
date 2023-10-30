<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('posts',[PostController::class,'index']);

Route::get('postlang',[PostController::class,'indexlang'])->middleware('lang');

Route::get('post/{id}',[PostController::class,'show']);
Route::post('post',[PostController::class,'store']);
Route::post('deleteposts/{id}',[PostController::class,'deletepost']);

Route::get('check',function(){
    $array=[
        'data'=>auth()->user(),
        'message'=>"Donee!!",
        'stsuts'=>"202",
    ];
   // return response()->json($array,220,["message"=>"had"]);
    //return response($array,$stsuts);
    return response()->json($array);
    
    

})->middleware('check-pass');



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
     Route::post('/logout', [AuthController::class, 'logout']);/// need the token from login api
     Route::post('/refresh', [AuthController::class, 'refresh']);
     Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});