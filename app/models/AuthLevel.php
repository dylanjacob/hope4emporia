<?php

class AuthLevel extends \Eloquent {

	protected $table = "authlevels";
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['resource', 'maintenance', 'query'];

	public function canQuery($userId)
	{
		$userRole = User::find($userId)->roles;

		return $userRole->contains($this->query) ? true : false;
	}

	public function canUpdate($userId)
	{
		$userRole = User::find($userId)->roles;

		return $userRole->contains($this->maintenance) ? true : false;
	}

	public function scopeResource($query, $res)
	{
		return $query->where('resource', $res)->first();
	}

}