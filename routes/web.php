<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('film', 'FilmController');

Route::middleware(['direct.access'])->group(function () {
	Route::post('/film/restore/{id}','FilmController@restore')->name('film.restore');
	Route::get('film/restore/{id}','FilmController@restore')->name('film.restore');
});

Route::resource('film', 'FilmController')->middleware('auth');

Route::resource('contact','ContactController')->middleware('auth');

Route::resource('actor', 'ActorController');

Route::middleware(['direct.access'])->group(function () {
	Route::post('/actor/restore/{id}','ActorController@restore')->name('actor.restore');
	Route::get('actor/restore/{id}','ActorController@restore')->name('actor.restore');
});

Route::resource('filmUser', 'FilmUserController');

Route::resource('contact','ContactController')->middleware('auth');

Route::resource('genre', 'GenreController');