<?php

class AppController extends \BaseController {

	public function __construct()
	{
		$this->beforeFilter('csrf', array('on' => 'store'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Request::wantsJson()) {
			return Response::json(ApiApp::all());
		}
		return View::make('apps.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('apps.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		Log::info(Input::all());

		$validator = Validator::make(
			Input::except('_token'),
			array(	'id' => 'required|min:6',
					'name' => 'required|min:6',
					'secret' => 'required')
		);

		if ($validator->fails()) {
			return Redirect::back()->withInput()->withErrors($validator->messages());
		}

		$app = ApiApp::create(Input::except('_token'));
		$user = Auth::user();
		Activity::log($user->getDisplayName()." created a new Application.", array('url' => action('AppController@show', $app->id), 'type' => 'app'));

		return Redirect::action('AppController@index')->with('status', 'Application Created Successfully!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('apps.show')->with('id', $id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('apps.edit')->with('id', $id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		Log::info(Input::all());

		$validator = Validator::make(
			Input::except('_token'),
			array(	'id' => 'required|min:6',
					'name' => 'required|min:6',
					'secret' => 'required')
		);

		if ($validator->fails()) {
			return Redirect::back()->withInput()->withErrors($validator->messages());
		}

		$app = ApiApp::find($id);

		$app->id = Input::get('id');
		$app->name = Input::get('name');
		$app->secret = Input::get('secret');
		$app->save();

		$user = Auth::user();
		Activity::log($user->getDisplayName()." modified an Application.", array('url' => action('AppController@show', $app->id), 'type' => 'app'));

		return Redirect::action('AppController@index')->with('status', 'Application Created Successfully!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$app = ApiApp::find($id);
		$app->delete();

		$user = Auth::user();
		Activity::log($user->getDisplayName()." deleted an Application.", array('action' => 'delete', 'type' => 'app'));

		return Response::make('Application Deleted Successfully!');
	}

}