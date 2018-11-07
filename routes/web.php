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
Route::resource("/constraints", "ConstraintController");

Route::get('resizeImage', 'ImageController@resizeImage');
Route::post('resizeImagePost',['as'=>'resizeImagePost','uses'=>'ImageController@resizeImagePost']);

Route::redirect('/story', '/story/create', 301);
Route::get('/story/index', 'StoryController@index')->name('displayStories');
Route::get('/story/create', 'StoryController@create')->name('createStory')->middleware('auth');
Route::post('/story/store', 'StoryController@store')->name('storeStory');
Route::get('/story/{id}', 'StoryController@access');
Route::get('/story/show', 'StoryController@show')->name('showStory');
Route::get('/story/preview', 'StoryController@preview')->name('showPreviewStory');

Route::get('/constraint/random', 'ConstraintController@random');
