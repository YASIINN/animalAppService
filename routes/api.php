<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("/test", function () {
    return "asd";
});


Route::get("/user", "UserController@index");
Route::post("/user", "UserController@store");
Route::put("/user/{id}", "UserController@update");
Route::delete("/user/{id}", "UserController@destroy");
Route::get("/user/{id}", "UserController@show");
Route::post("/login", "UserController@login");
Route::post("/register", "UserController@store");
Route::post("/userPost", "UserController@userPost");


Route::get("/animalpost", "AnimalPostController@index");
Route::post("/animalpost", "AnimalPostController@store");
Route::put("/animalpost/{id}", "AnimalPostController@update");
Route::delete("/animalpost/{id}", "AnimalPostController@destroy");
Route::get("/animalpost/{id}", "AnimalPostController@show");
Route::post("/likeorunlike", "AnimalPostController@likeorunlike");

Route::get("/category", "CategoryController@index");
Route::post("/category", "CategoryController@store");
Route::put("/category/{id}", "CategoryController@update");
Route::delete("/category/{id}", "CategoryController@destroy");
Route::get("/category/{id}", "CategoryController@show");


Route::get("/animaltype", "AnimalTypeController@index");
Route::post("/animaltype", "AnimalTypeController@store");
Route::put("/animaltype/{id}", "AnimalTypeController@update");
Route::delete("/animaltype/{id}", "AnimalTypeController@destroy");
Route::get("/animaltype/{id}", "AnimalTypeController@show");

/*Route::get("/animaltype");
Route::delete("/animaltype/{id}");
Route::put("/animaltype/{id}");*/
