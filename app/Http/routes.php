<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::resource('sprints', 'SprintController');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('accounts', 'AccountController');

Route::resource('profiles', 'ProfileController');
//Route::get('/{profiles}','ProfileController@show');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');








Route::resource('projects', 'ProjectController');

Route::resource('hide', 'HideController');


Route::resource('teams', 'TeamController');


Route::resource('assign', 'AssignController');


Route::resource('assign_teams', 'AssignTeamsController');



Route::resource('queries', 'QueryController');
Route::get('queries', 'QueryController@search');

Route::resource('messages1s', 'Message1Controller');
Route::resource('sentmessages', 'SentmessageController');
Route::resource('codeshares', 'CodeshareController');
Route::resource('eissues', 'EissueController');
Route::resource('eothers', 'EotherController');
Route::resource('comments', 'CommentController');
Route::resource('accountheaddashboards', 'AccountheaddashboardController');

Route::get('messages1/delete/{messages1}', ['as' => 'messages1.delete', 'uses' => 'Message1Controller@destroy']);


