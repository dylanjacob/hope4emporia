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

#Log::info(Session::all());

Route::get('/template', function()
{
	return View::make('template');
});



Route::get('/', function()
{
	return View::make('frontend.home');
});
Route::get('template3', function()
{
	return View::make('template3');
});
Route::get('staff', function()
{
	return View::make('frontend.staff');
});
Route::get('location', function()
{
	return View::make('frontend.location');
});
Route::get('about', function()
{
	return View::make('frontend.about');
});
Route::get('pastor', function()
{
	return View::make('frontend.pastor');
});


Route::get('column', function()
{
	return View::make('columntest');
});


Route::get('home', function()
{
	return View::make('home');
});


Route::get('/stream', function()
{
	return View::make('streamtest');
});

Route::get('/podcast', function() {
	$sermons = Sermon::recent()->get();
	$view = View::make('podcast.index', compact('sermons'));
		
	return Response::make($view->render(), 200)->header('Content-Type', 'application/xml');
});

Route::get('/podcast.xml', function() {
	return Redirect::to('/podcast');
});

Route::get('/events/rss', function() {
	$events = Evnt::getUpcoming(0);
	$view = View::make('evnts.rss', compact('events'));
	return Response::make($view->render(), 200)->header('Content-Type', 'application/xml');
});

Route::resource('/audio', 'AudioController');

Route::group(array('before' => 'force.ssl'), function()
{
	Route::controller('auth', 'AuthController');
	Route::controller('oauth', 'OauthController');
	Route::controller('password', 'RemindersController');
});

Route::group(array('prefix' => 'a', 'before' => 'auth|force.ssl|check.authlevel'), function()
{
	Route::resource('apps', 'AppController');
	Route::resource('users', 'UsersController');
	Route::resource('roles', 'RolesController');
	Route::resource('advisories', 'AdvisoriesController');
	Route::resource('authlevels', 'AuthLevelsController');
	Route::resource('sermons', 'SermonsController');
	Route::resource('announcements', 'AnnouncementsController');
	Route::resource('events', 'EvntsController');
	Route::resource('posts', 'PostsController');
});

Route::group(array('before' => 'auth|force.ssl'), function()
{
	Route::controller('/a', 'AdminController');
});

Route::group(array('before' => 'oauth|force.ssl'), function()
{
	Route::post('sermons/create', 'SermonsController@store');
	Route::controller('upload', 'UploadController');
});

