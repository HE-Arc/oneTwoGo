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
Route::resource("/themes", "ThemeController")->middleware('admin');
Route::post('/themes/{id}/toggleActive', 'ThemeController@toggleActive')->name('themes.toggleActive')->middleware('admin');
Route::resource("/constraints", "ConstraintController")->middleware('admin');
Route::post('/constraints/{id}/toggleActive', 'ConstraintController@toggleActive')->name('constraints.toggleActive')->middleware('admin');
Route::get('/constraint/random', 'ConstraintController@random')->name('constraints.random');

Route::redirect('/story', '/story/create', 301);
Route::get('/story/random', 'StoryController@random')->name('stories.random');
Route::get('/story/randomPage', 'StoryController@randomPage')->name('stories.randomPage');
Route::get('/story/fresh', 'StoryController@fresh')->name('stories.fresh');
Route::get('/story/freshPage', 'StoryController@freshPage')->name('stories.freshPage');
Route::get('/story/top', 'StoryController@top')->name('stories.top');
Route::get('/story/topPage', 'StoryController@topPage')->name('stories.topPage');
Route::get('/story/byUser/{id}', 'StoryController@byUser')->name('stories.byUser');
Route::get('/story/byUserPage/{id}', 'StoryController@byUserPage')->name('stories.byUserPage');
Route::get('/story/byTheme/{id}', 'StoryController@byTheme')->name('stories.byTheme');
Route::get('/story/byThemePage/{id}', 'StoryController@byThemePage')->name('stories.byThemePage');

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
