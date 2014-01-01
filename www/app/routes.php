<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@getIndex');

Route::controller('users', 'UsersController');

Route::get( 'decks/{deck?}', 'DecksController@getDecks' );

Route::controller('decks', 'DecksController');

Route::controller('cards', 'CardsController');

Route::get( 'search/{id}', 'SearchController@doSearch' );

Route::get( 'search','SearchController@showSearch' );

Route::controller('single', 'SingleController');