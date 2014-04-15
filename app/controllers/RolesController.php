<?php

class RolesController extends \BaseController {

	/**
	 * Display a listing of roles
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Request::wantsJson()) {
			return Response::json(Role::all());
		}
		$roles = Role::all();

		return View::make('roles.index', compact('roles'));
	}

	/**
	 * Show the form for creating a new role
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('roles.create');
	}

	/**
	 * Store a newly created role in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
		Input::get('enabled') ? $data['enabled']=true : $data['enabled']=false;

		$validator = Validator::make($data, Role::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$role = Role::create($data);

		$user = Auth::user();
		Activity::log($user->getDisplayName()." created a new Role.", array('url' => action('RolesController@show', $role->id), 'type' => 'role'));

		return Redirect::route('roles.index');
	}

	/**
	 * Display the specified role.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$role = Role::findOrFail($id);

		return View::make('roles.show', compact('role'));
	}

	/**
	 * Show the form for editing the specified role.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$role = Role::find($id);
		if ($role->role == "Administrator") {
			return Redirect::back()->withErrors(new \Illuminate\Support\MessageBag(['You Cannot Modify the Administrator Role.']));
		}

		return View::make('roles.edit', compact('role'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$role = Role::findOrFail($id);

		$data = Input::all();
		Input::get('enabled') ? $data['enabled']=true : $data['enabled']=false;

		$validator = Validator::make($data, Role::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$role->update($data);

		$user = Auth::user();
		Activity::log($user->getDisplayName()." modified a Role.", array('url' => action('RolesController@show', $role->id), 'type' => 'role'));

		return Redirect::route('roles.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$role = Role::find($id);

		if ($role->role == "Administrator") {
			return Redirect::back()->withErrors(new \Illuminate\Support\MessageBag(['You Cannot Delete the Administrator Role.']));
		}

		$role->delete();

		$user = Auth::user();
		Activity::log($user->getDisplayName()." deleted a Role.", array('action' => 'delete', 'type' => 'role'));

		return Response::make('Role Deleted Successfully!');
	}

}