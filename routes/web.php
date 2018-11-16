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
    return view('home');
})->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource("/themes", "ThemeController");
Route::post('/themes/{id}/toggleActive', 'ThemeController@toggleActive')->name('themes.toggleActive');
Route::resource("/constraints", "ConstraintController");
Route::post('/constraints/{id}/toggleActive', 'ConstraintController@toggleActive')->name('constraints.toggleActive');

Route::get('resizeImage', 'ImageController@resizeImage');
Route::post('resizeImagePost',['as'=>'resizeImagePost','uses'=>'ImageController@resizeImagePost']);

Route::redirect('/story', '/story/create', 301);
Route::get('/story/index', 'StoryController@index')->name('displayStories');
Route::get('/story/create', 'StoryController@create')->name('createStory')->middleware('auth');
Route::post('/story/store', 'StoryController@store')->name('storeStory');
Route::get('/story/{id}', 'StoryController@access');
Route::get('/story/{id}/show', 'StoryController@show')->name('story.show');
Route::post('/story/{id}/comment', 'StoryController@comment')->name('story.comment')->middleware('auth');
Route::post('/story/{id}/dislike', 'StoryController@dislike')->name('story.dislike')->middleware('auth');
Route::post('/story/{id}/like', 'StoryController@like')->name('story.like')->middleware('auth');

Route::post('/commentary/create', 'CommentaryController@create')->name('commentary.create')->middleware('auth');;
Route::post('/commentary/store', 'CommentaryController@store')->name('commentary.store')->middleware('auth');
Route::get('/commentary/show', 'CommentaryController@show')->name('commentary.show');

Route::get('/constraint/random', 'ConstraintController@random');
