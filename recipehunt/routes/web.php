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
//Route::get('profile', function () {
//    return View::make('profile');
//});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/profile', 'ProfileController@index');
Route::get('/job', 'RequestController@index');
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');
Route::post('/jobrequest', 'RequestController@request');
Route::post('/upvote/{id}', 'UpvoteController@check');
Route::post('/bookmark/{id}', 'BookmarkController@bookmark');
Route::post('/update/{id}', 'ProfileController@update');
Route::post('/search', 'RecipeController@search');
Route::post('/category', 'RecipeController@category');
Route::resource('/recipe', 'RecipeController');
Route::resource('/comment', 'CommentController');
