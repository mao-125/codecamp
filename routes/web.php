<?php

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
    return view('welcome');
});

Route::resource('posts', 'PostController');
Auth::routes();

Route::resource('users', 'UserController')->only([
  'show',
]);
Route::resource('follows', 'FollowController')->only([
  'store', 'destroy'
]);
Route::get('/follow/{user}', 'FollowController@index')->name('follows.index');
Route::get('/follower/{user}', 'FollowController@followerIndex')->name('follows.follower');

Route::get('likes', 'LikeController@index')->name('likes.index');
Route::patch('/posts/{post}/toggle_like', 'PostController@toggleLike')->name('posts.toggle_like');

Route::get('/posts/{post}/edit_image', 'PostController@editImage')->name('posts.edit_image');
Route::patch('/posts/{post}/edit_image', 'PostController@updateImage')->name('posts.update_image');

Route::resource('comments', 'CommentController')->only([
  'store', 'destroy'
]);