<?php

class AnnouncementsController extends \BaseController {

	/**
	 * Display a listing of announcements
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Request::wantsJson()) {
			return Response::json(Announcement::all());
		}
		$announcements = Announcement::all();

		return View::make('announcements.index', compact('announcements'));
	}

	/**
	 * Show the form for creating a new announcement
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('announcements.create');
	}

	/**
	 * Store a newly created announcement in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::except('_token');
		$data['enabled'] = true;
		$validator = Validator::make($data, Announcement::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$announcement = Announcement::create($data);

		$user = Auth::user();
		Activity::log($user->getDisplayName()." created a new Announcement.", array('url' => action('AnnouncementsController@show', $announcement->id), 'type' => 'announcement'));

		return Redirect::action('AnnouncementsController@index');
	}

	/**
	 * Display the specified announcement.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$announcement = Announcement::findOrFail($id);

		return View::make('announcements.show', compact('announcement'));
	}

	/**
	 * Show the form for editing the specified announcement.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$announcement = Announcement::find($id);

		return View::make('announcements.edit', compact('announcement'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$announcement = Announcement::findOrFail($id);

		$data = Input::except('_token', 'enabled');

		$data['enabled'] = Input::has('enabled') ? true : false;

		$validator = Validator::make($data, Announcement::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$announcement->update($data);
		$user = Auth::user();
		Activity::log($user->getDisplayName()." modified an Announcement.", array('url' => action('AnnouncementsController@show', $announcement->id), 'type' => 'announcement'));

		return Redirect::action('AnnouncementsController@index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Announcement::destroy($id);

		$user = Auth::user();
		Activity::log($user->getDisplayName()." deleted an Announcement.", array('action' => 'delete', 'type' => 'announcement'));

		return Response::make('Announcement Deleted Successfully!');
	}

}