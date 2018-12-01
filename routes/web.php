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

// Login and register
Auth::routes();

// Home Controller
Route::get('/', 'HomeController@index')->name('home');

// User Controller
Route::get('/users/{search?}', 'UserController@index')->name('user.index');
Route::get('/account', 'UserController@account')->name('user.edit_profile');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/image/{image_path}', 'UserController@get_image')->name('user.image');
Route::get('/profile/{id}', 'UserController@profile')->name('user.profile');

// Image Controller
Route::get('/new-image', 'ImageController@new_image')->name('new.image');
Route::post('/image/upload', 'ImageController@upload')->name('upload.image');
Route::get('/image/file/{image_path}', 'ImageController@get_image')->name('image.file');
Route::get('/image/{id}', 'ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');

// Comment Controller
Route::post('/new-comment', 'CommentController@new_comment')->name('new.comment');

// Like Controller
Route::get('/likes', 'LikeController@index')->name('likes');
Route::get('/new-like/{image_id}', 'LikeController@new_like')->name('new.like');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('delete.like');

// Follow Controller
Route::get('/follow/{follower}/{followed}', 'FollowController@follow')->name('follow');
Route::get('/unfollow/{follower}/{followed}', 'FollowController@unfollow')->name('unfollow');