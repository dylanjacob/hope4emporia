<?php

class Advisory extends \Eloquent {

	protected $tables = 'advisories';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'message' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['message', 'level', 'enabled'];

	public function scopeEnabled($query)
	{
		return $query->select('message', 'level', 'enabled')->where('enabled', true)->first();
	}

	public function isEnabled()
	{
		return $this->enabled;
	}

}