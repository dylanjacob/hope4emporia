<?php

class AdvisoriesController extends \BaseController {

	/**
	 * Display a listing of advisories
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Request::wantsJson()) {
			return Response::json(Advisory::all());
		}
		$advisories = Advisory::all();

		return View::make('advisories.index', compact('advisories'));
	}

	/**
	 * Show the form for creating a new advisory
	 *
	 * @return Response
	 */
	public function create()
	{		
		return View::make('advisories.create');
	}

	/**
	 * Store a newly created advisory in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		if (Input::get('enabled')) {
			$data['enabled'] = true;
		} else {
			$data['enabled'] = false;
		}
		$validator = Validator::make($data, Advisory::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$advisory = Advisory::create($data);
		$user = Auth::user();
		Activity::log($user->getDisplayName()." created a new Advisory.", array('url' => action('AdvisoriesController@show', $advisory->id), 'type' => 'advisory'));

		return Redirect::action('AdvisoriesController@index');
	}

	/**
	 * Display the specified advisory.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$advisory = Advisory::findOrFail($id);

		return View::make('advisories.show', compact('advisory'));
	}

	/**
	 * Show the form for editing the specified advisory.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$advisory = Advisory::find($id);

		return View::make('advisories.edit', compact('advisory'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$advisory = Advisory::findOrFail($id);

		$data = Input::all();
		if (Input::get('enabled')) {
			$data['enabled'] = true;
		} else {
			$data['enabled'] = false;
		}

		$validator = Validator::make($data, Advisory::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$advisory->update($data);
		$user = Auth::user();
		Activity::log($user->getDisplayName()." modified an Advisory.", array('url' => action('AdvisoriesController@show', $advisory->id), 'type' => 'advisory'));

		return Redirect::action('AdvisoriesController@index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Advisory::destroy($id);

		$user = Auth::user();
		Activity::log($user->getDisplayName()." deleted an Advisory.", array('action' => 'delete', 'type' => 'advisory'));	

		return Response::make('Successfully Deleted Advisory!');
	}

}