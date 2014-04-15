<?php

class AuthLevelsController extends \BaseController {

	/**
	 * Display a listing of authlevels
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Request::wantsJson()) {
			return Response::json(AuthLevel::all());
		}
		$authlevels = AuthLevel::all();

		return View::make('authlevels.index', compact('authlevels'));
	}

	/**
	 * Show the form for creating a new authlevel
	 *
	 * @return Response
	 */
	public function create()
	{
		#return AuthLevel::resource('authlevels')->canUpdate(Auth::user()->id) ? Redirect::('/admin')->withErrors(new /Illuminate/Support/MessageBag(['Insufficient Priveleges']) : 
		return View::make('authlevels.create');
	}

	/**
	 * Store a newly created authlevel in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), AuthLevel::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$authlevel = AuthLevel::create($data);
		$user = Auth::user();
		Activity::log($user->getDisplayName()." created a new Auth Level.", array('url' => action('AuthLevelsController@show', $authlevel->id), 'type' => 'authlevel'));

		return Redirect::action('AuthLevelsController@index');
	}

	/**
	 * Display the specified authlevel.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$authlevel = AuthLevel::findOrFail($id);

		return View::make('authlevels.show', compact('authlevel'));
	}

	/**
	 * Show the form for editing the specified authlevel.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$authlevel = AuthLevel::find($id);

		return View::make('authlevels.edit', compact('authlevel'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$authlevel = AuthLevel::findOrFail($id);

		$validator = Validator::make($data = Input::all(), AuthLevel::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$authlevel->update($data);
		$user = Auth::user();
		Activity::log($user->getDisplayName()." modified an Auth Level.", array('url' => action('AuthLevelsController@show', $authlevel->id), 'type' => 'authlevel'));

		return Redirect::action('AuthLevelsController@index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		AuthLevel::destroy($id);

		$user = Auth::user();
		Activity::log($user->getDisplayName()." deleted an Auth Level.", array('action' => 'delete', 'type' => 'authlevel'));

		return Response::make('Auth Level Successfully Deleted!', 200);
	}

}