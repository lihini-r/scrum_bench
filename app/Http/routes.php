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

Route::resource('tasks', 'TaskController');
Route::resource('notifications', 'NotifyController');
Route::resource('notify_project_assigns', 'NotifyprojectassignController');
Route::resource('todolists', 'TodolistController');
Route::resource('queries', 'QueryController');
Route::get('queries', 'QueryController@search');
Route::resource('messages1s', 'Message1Controller');
Route::resource('sentmessages', 'SentmessageController');
Route::resource('codeshares', 'CodeshareController');
Route::resource('eissues', 'EissueController');
Route::resource('eothers', 'EotherController');
Route::resource('comments', 'CommentController');
Route::resource('accountheaddashboards', 'AccountheaddashboardController');

Route::POST('user_stories/assign/{story_id}', ['uses' => 'StoryController@updateAssignee', 'as' => 'user_stories.assign']);
Route::PATCH('workflows/storyStatus/{story_id}', ['uses' => 'WorkflowController@updateWorkflowStatus', 'as' => 'workflows.storyStatus']);
Route::POST('sprints/status/{id}', ['uses' => 'SprintController@updateSprint', 'as' => 'sprints.status']);
Route::resource('user_stories', 'StoryController');
Route::resource('worklogs', 'WorklogController');
Route::resource('workflows', 'WorkflowController');
Route::resource('sprint_schedules', 'SprintScheduleController');
Route::resource('story_search', 'StorySearchController');
Route::resource('dev_dashboard', 'DevDashboardController');
Route::GET('sprint_schedules/sprint/{sprint_id}', ['uses' => 'SprintScheduleController@getIndex', 'as' => 'sprint_schedules.get_sprint']);







Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('accounts', 'AccountController');

Route::resource('profiles', 'ProfileController');
//Route::get('/{profiles}','ProfileController@show');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('accounts', 'AccountController');

Route::resource('profiles', 'ProfileController');
//Route::get('/{profiles}','ProfileController@show');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::POST('profiles/upload/{id}', ['uses' => 'ProfileController@uploadProfilePicture', 'as' => 'profiles.upload']);

Route::POST('accounts/show/{id}', ['uses' => 'AccountController@showProjectProgress', 'as' => 'accounts.showProgress']);

Route::resource('ideas', 'IdeaController');

Route::resource('activities', 'ActivityController');

Route::resource('users', 'UserController');

Route::POST('accounts/hide/{id}', ['uses' => 'AccountController@hide', 'as' => 'accounts.hide']);


Route::resource('accountunhide', 'AccountunhideController');

Route::POST('accounts/unhide/{id}', ['uses' => 'AccountunhideController@unhide', 'as' => 'accountunhide.unhide']);

Route::resource('superadmindashboards', 'SuperadmindashboardController');
//Route::POST('cleanActivityLog', 'ActivityController@cleanActivityLog');










Route::resource('search', 'SearchController');




Route::resource('projects', 'ProjectController');




Route::resource('hide', 'HideController');


Route::resource('teams', 'TeamController');


Route::resource('assign', 'AssignController');


Route::resource('assign_teams', 'AssignTeamsController');

Route::resource('assign_lead', 'LeadController');

Route::resource('test_case', 'TestCaseController');

Route::resource('release_backlog', 'ReleaseBacklogController');






Route::get('messages1/delete/{messages1}', ['as' => 'messages1.delete', 'uses' => 'Message1Controller@destroy']);



