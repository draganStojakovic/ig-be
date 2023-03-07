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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');
});

Route::get('posts', 'PostsController@index');
Route::get('posts/{id}', 'PostsController@show');
Route::post('posts', 'PostsController@store');
Route::put('posts/{id}', 'PostsController@update');
Route::delete('posts/{id}', 'PostsController@destroy');

Route::get('comments', 'CommentsController@index');
Route::get('comments/{id}', 'CommentsController@show');
Route::post('comments', 'CommentsController@store');
Route::put('comments/{id}', 'CommentsController@update');
Route::delete('comments/{id}', 'CommentsController@destroy');

Route::get('users/{id}', 'UsersController@show');

Route::post('user-set-public-true', 'UsersController@setPublicTrue');
Route::post('user-set-public-false', 'UsersController@setPublicFalse');

Route::post('follow', 'UsersController@follow');
Route::post('unfollow', 'UsersController@unfollow');

Route::post('like-post', 'UsersController@likePost');
Route::post('unlike-post', 'UsersController@unlikePost');

Route::post('like-comment', 'UsersController@likeComment');
Route::post('unlike-comment', 'UsersController@unlikeComment');