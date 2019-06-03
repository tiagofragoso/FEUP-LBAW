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

Route::redirect('/', 'search');


// Events
Route::get('events/create', 'EventController@create');
Route::post('events', 'EventController@store');
Route::get('events/{id}', 'EventController@show');
Route::get('events/{id}/edit', 'EventController@edit');
Route::put('events/{id}', 'EventController@update');


// API
Route::put('api/profile', 'ProfileController@update');
Route::put('api/profile/password', 'ProfileController@updatePassword');
Route::put('api/users/{id}/follows','ProfileController@followUser');
Route::delete('api/users/{id}/follows', 'ProfileController@unfollowUser');

Route::put('api/events/{id}/join','EventController@joinEvent');
Route::delete('api/events/{id}/join','EventController@leaveEvent');

Route::put('api/reports/{id}','ReportController@report');

Route::get('api/search', 'SearchController@getEvents');

Route::post('api/events/{id}/posts', 'PostController@store');

Route::put('api/posts/{id}/like','PostController@likePost');
Route::delete('api/posts/{id}/like','PostController@dislikePost');

Route::put('api/comments/{id}/like','CommentController@likeComment');
Route::delete('api/comments/{id}/like','CommentController@dislikeComment');


// Auth
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//Profile
Route::get('profile', 'ProfileController@showProfile');
Route::get('users/{id}', 'ProfileController@show');
Route::get('settings', 'ProfileController@edit');

//About
Route::view('about', 'pages.about');

//Search
Route::get('search', 'SearchController@show')->name('search');