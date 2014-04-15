<?php

class Role extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'role' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['role', 'enabled'];

	public function scopeActive($query) 
	{
		return $query->select('id', 'role')->where('enabled', true);
	}

	public function scopeDropdown($query)
	{
		return $query->orderBy('id')->lists('role', 'id');
	}

	public function users()
	{
		return $this->belongsToMany('User');
	}
}