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

Route::get( 'decks/deleteDeck/{deck?}', 'DecksController@postDeleteDeck' );

Route::controller('decks', 'DecksController');

Route::get( 'card/deleteCard/{id}', 'CardsController@postDeleteCard' );

Route::controller('cards', 'CardsController');

Route::get( 'search/card/{id}', 'SearchController@postCard' );

Route::get( 'search/AjaxSearch', 'SearchController@postAjaxSearch' );

Route::get( 'search/lookup/{id}','SearchController@doLookup' );

Route::controller('single', 'SingleController');