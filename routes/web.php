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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// this routes for profile index & update
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile/update', 'ProfileController@update')->name('profile.update');

// this routes for Posts
Route::get('/posts', 'PostController@index')->name('posts');
Route::get('/posts/trashed', 'PostController@postsToTrashed')->name('posts.trashed');
Route::get('/post/create', 'PostController@create')->name('post.create');
Route::post('/post/store', 'PostController@store')->name('post.store');
Route::get('/post/show/{slug}', 'PostController@show')->name('post.show');
Route::get('/post/edit/{id}', 'PostController@edit')->name('post.edit');
Route::post('/post/update/{id}', 'PostController@update')->name('post.update');
Route::get('/post/destroy/{id}', 'PostController@destroy')->name('post.destroy'); //softdelete
Route::get('/post/hdelete/{id}', 'PostController@hdelete')->name('post.hdelete'); //hard delete
Route::get('/post/restore/{id}', 'PostController@restore')->name('post.restore');

//thi routes for tag
Route::get('/tags', 'TagController@index')->name('tags');
Route::get('/tags/trashed', 'TagController@postsToTrashed')->name('tags.trashed');
Route::get('/tag/create', 'TagController@create')->name('tag.create');
Route::post('/tag/store', 'TagController@store')->name('tag.store');
Route::get('/tag/show/{slug}', 'TagController@show')->name('tag.show');
Route::get('/tag/edit/{id}', 'TagController@edit')->name('tag.edit');
Route::post('/tag/update/{id}', 'TagController@update')->name('tag.update');
Route::get('/tag/destroy/{id}', 'TagController@destroy')->name('tag.destroy'); //softdelete
Route::get('/tag/hdelete/{id}', 'TagController@hdelete')->name('tag.hdelete'); //hard delete
Route::get('/tag/restore/{id}', 'TagController@restore')->name('tag.restore');

//thi routes for user
Route::get('/users', 'UserController@index')->name('users');
Route::get('/user/create', 'UserController@create')->name('user.create');
Route::post('/user/store', 'UserController@store')->name('user.store');
Route::get('/user/destroy/{id}', 'UserController@destroy')->name('user.destroy');
