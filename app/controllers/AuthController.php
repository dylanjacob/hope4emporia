<?php

class AuthController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		if (Auth::check()) {
			return Redirect::intended('/a');
		}
		return View::make('admin.login');
	}

	public function postIndex()
	{
		$credentials = Input::only('username', 'password');
		$remember = Input::has('remember');
		if (Auth::attempt($credentials, $remember)) {
			return Redirect::intended('/a');
		}
		return Redirect::action('AuthController@getIndex')->withErrors('Incorrect Username or Password');
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::action('AuthController@getIndex')->with('status', 'You have logged out successfully.');
	}
}