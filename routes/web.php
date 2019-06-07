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

Route::get('', 'HomeController@show');

// Events
Route::get('events/create', 'EventController@create');
Route::post('events', 'EventController@store');
Route::get('events/{id}', 'EventController@show');
Route::get('events/{id}/edit', 'EventController@edit');
Route::put('events/{id}', 'EventController@update');

// API
Route::get('api/feed', 'HomeController@getActivity');

Route::put('api/profile', 'ProfileController@update');
Route::put('api/profile/password', 'ProfileController@updatePassword');
Route::delete('api/profile/delete','ProfileController@deleteAccount');
Route::post('api/profile/photo','ProfileController@uploadPhoto');
Route::put('api/users/{id}/follows','ProfileController@followUser');
Route::delete('api/users/{id}/follows', 'ProfileController@unfollowUser');
Route::put('api/users/{id}/ban','ProfileController@banUser');
Route::post('api/users/{id}/report','ReportController@reportUser');
Route::put('api/users/reports/{id}','ReportController@updateUserReport');
Route::get('api/users/{id}/followers', 'ProfileController@followers');
Route::get('api/users/{id}/following', 'ProfileController@following');

Route::put('api/events/{id}/join','EventController@joinEvent');
Route::delete('api/events/{id}/join','EventController@leaveEvent');
Route::put('api/events/{id}/ban','EventController@banEvent');
Route::post('api/events/{id}/report','ReportController@reportEvent');
Route::put('api/events/reports/{id}','ReportController@updateEventReport');

Route::get('api/search', 'SearchController@getEvents');

Route::post('api/events/{id}/posts', 'PostController@store');
Route::put('api/polls/{poll_id}/votes','PostController@pollVote');
Route::post('api/events/{id}/questions', 'QuestionController@store');
Route::post('api/events/{id}/threads', 'ThreadController@store');
Route::post('api/questions/{id}/answer', 'AnswerController@store');
Route::post('api/threads/{id}/comments', 'ThreadCommentController@store');

Route::post('api/posts/{id}/comments','CommentController@store');
Route::put('api/posts/{id}/like','PostController@likePost');
Route::delete('api/posts/{id}/like','PostController@dislikePost');

Route::put('api/comments/{id}/like','CommentController@likeComment');
Route::delete('api/comments/{id}/like','CommentController@dislikeComment');

Route::post('api/events/{event_id}/tickets','EventController@acquireTicket');

Route::get('api/invites/following', 'InvitesController@getFollowing');
Route::get('api/invites/search', 'InvitesController@search');
Route::post('api/invites', 'InvitesController@store');
Route::put('api/invites/{id}', 'InvitesController@respond');

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
Route::get('invites', 'ProfileController@showInvites');
Route::get('tickets','ProfileController@showTickets');  

//About
Route::view('about', 'pages.about');

//Search
Route::get('search', 'SearchController@show')->name('search');

//Recover password
Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset','Auth\ResetPasswordController@reset');
