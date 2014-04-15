<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Request::wantsJson()) {
			return Response::json(User::all());
		}
		$users = User::all();

		return View::make('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::except('_token', 'role');
		$rules = array(
			'firstName' => 'required',
			'lastName' => 'required',
			'username' => 'required|unique:users',
			'email' => 'required|email|unique:users'
		);
		$validator = Validator::make($data, $rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$user_data = Input::except('_token', 'autopass');
		$user_data['password'] = Hash::make(Str::random(16));
		$user = User::create($user_data);
		Role::find(Input::get('role'))->users()->save($user);
		$result = null;
		if (isset($data['autopass']) && $data['autopass']) {
			switch ($response = Password::remind(Input::only('email')))
			{
				case Password::INVALID_USER:
					Log::info('Password reminder: INVALID USER');
					$result = array('error' => Lang::get($response));

				case Password::REMINDER_SENT:
					Log::info('Password reminder: REMINDER SENT');
					$result = array('status' => Lang::get($response));
			}
		}

		$theUser = Auth::user();
		Activity::log($theUser->getDisplayName()." created a new User.", array('url' => action('UsersController@show', $user->id), 'type' => 'user'));

		return Redirect::action('UsersController@index')->with($result);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);

		return View::make('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified hccevent.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);

		return View::make('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::findOrFail($id);

		if (Input::get('password') == '') {
			$rules = array(
				'firstName' => 'required',
				'lastName' => 'required',
				'username' => 'required',
				'email' => 'required|email'
			);	
			$validator = Validator::make($data = Input::except('_token', 'password', 'password_confirmation', 'role'), $rules);
			$data = Input::except('_token', 'password', 'password_confirmation');
		} else {
			$rules = array(
				'firstName' => 'required',
				'lastName' => 'required',
				'username' => 'required',
				'email' => 'required|email',
				'password' => 'required|confirmed'
			);	
			$validator = Validator::make($data = Input::except('_token', 'role'), $rules);
			$data = Input::except('_token', 'password_confirmation');
			$data['password'] = Hash::make(Input::get('password'));
		}


		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user->update($data);
		Role::find(Input::get('role'))->users()->save($user);

		$theUser = Auth::user();
		Activity::log($theUser->getDisplayName()." modified a User.", array('url' => action('UsersController@show', $user->id), 'type' => 'user'));

		return Redirect::action('UsersController@index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
		if ($user->username == "admin") {
			return Response::make('You cannot delete the admin user!', 400);
		}
		if ($user->username == Auth::user()->username) {
			return Response::make('You cannot delete yourself silly williy!', 400);
		}

		User::destroy($id);

		$theUser = Auth::user();
		Activity::log($theUser->getDisplayName()." deleted a User.", array('action' => 'delete', 'type' => 'user'));

		return Response::make('User Deleted Successfully!');
	}

}