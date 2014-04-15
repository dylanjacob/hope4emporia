<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable = ['firstName', 'lastName', 'email', 'username', 'password'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function isAdmin()
	{
		return $this->roles->contains(1) ? true : false;
	}

	public function isGuest()
	{
		return $this->roles->contains(id) == 3 ? true : false;
	}

	public function roles()
	{
		return $this->belongsToMany('Role');
	}

	public function getDisplayName()
	{
		return $this->firstName." ".$this->lastName;
	}

	public function getRoleIds()
	{
		$roles = $this->belongsToMany('Role')->get();
		$arr = array();
		$roles->each(function($result) {
			$arr[] = $result->id;

		});

		return $arr;
	}

}