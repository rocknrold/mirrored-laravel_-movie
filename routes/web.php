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
Auth::routes();

Route::get('/','HomeController@index')->name('home')->middleware('auth');;

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('film', 'FilmController')->middleware('auth');

Route::middleware(['direct.access'])->group(function () {
	Route::post('/film/restore/{id}','FilmController@restore')->name('film.restore');
	Route::get('film/restore/{id}','FilmController@restore')->name('film.restore');
});

Route::resource('film', 'FilmController')->middleware('auth');

Route::resource('contact','ContactController')->middleware('auth');

Route::resource('actor', 'ActorController')->middleware('auth');

Route::middleware(['direct.access'])->group(function () {
	Route::post('/actor/restore/{id}','ActorController@restore')->name('actor.restore');
	Route::get('actor/restore/{id}','ActorController@restore')->name('actor.restore');
});

Route::resource('filmUser', 'FilmUserController')->middleware('auth');

Route::resource('genre', 'GenreController')->middleware('auth');

Route::resource('producer', 'ProducerController')->middleware('auth');

Route::resource('role', 'RoleController')->middleware('auth');