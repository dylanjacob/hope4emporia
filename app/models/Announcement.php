<?php

class Announcement extends \Eloquent {
	protected $table = "announcements";
	// Add your validation rules here
	public static $rules = [
		'title' => 'required',
		'author' => 'required',
		'pubdate' => 'required',
		'enddate' => 'required',
		'body' => 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['title', 'author', 'pubdate', 'enddate', 'enabled', 'body'];

	public function isActive()
	{
		return $this->pubdate <= date('Y-m-d H:i:s') && $this->enddate >= date('Y-m-d H:i:s') ? true : false;
	}

	public static function getActive()
	{ 
		return Announcement::all()->filter(function($event) {
			return $event->isActive();
		});
	}
}