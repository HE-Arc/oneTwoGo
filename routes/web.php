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

Route::redirect('/story', '/story/create', 301);

Route::get('/story/create', 'StoryController@create')->name('createStory');
Route::post('/story/store', 'StoryController@store')->name('storeStory');

Route::get('/constraint/random', 'ConstraintController@random');
/*
TOREMOVE WHEN StoryController will be uploaded
*/
Route::get('/story/show', function() {
  return view('story/show');
})->name('story/showDebug');
