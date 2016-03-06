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

Route::POST('user_stories/assign/{story_id}', ['uses' => 'StoryController@updateAssignee', 'as' => 'user_stories.assign']);
Route::POST('sprints/status/{id}', ['uses' => 'SprintController@updateSprint', 'as' => 'sprints.status']);
Route::resource('user_stories', 'StoryController');
Route::resource('worklogs', 'WorklogController');
Route::resource('workflows', 'WorkflowController');
Route::resource('sprint_schedules', 'SprintScheduleController');

Route::resource('messages1s', 'Message1Controller');
Route::resource('sentmessages', 'SentmessageController');
Route::resource('codeshares', 'CodeshareController');
Route::resource('eissues', 'EissueController');
Route::resource('comments', 'CommentController');
Route::resource('accountheaddashboards', 'AccountheaddashboardController');

Route::resource('projects', 'ProjectController');

Route::resource('hide', 'HideController');


Route::resource('teams', 'TeamController');

Route::resource('assign', 'AssignController');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('accounts', 'AccountController');

Route::resource('profiles', 'ProfileController');
//Route::get('/{profiles}','ProfileController@show');

