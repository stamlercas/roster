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
Route::get('/roster', [
    'uses' => 'RosterController@getRoster',
    'as' => 'roster.get'
]);
Route::get('/roster/{team}', [
    'uses' => 'RosterController@getFantasyDataTeamData',
    'as' => 'roster.team'
]);
Route::get('/teams', [
	'uses' => 'RosterController@getFantasyDataTeams',
	'as' => 'roster.teams'
]);