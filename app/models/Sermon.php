<?php

class Sermon extends \Eloquent {
	protected $fillable = [
		'name', 
		'author', 
		'filename', 
		'pubdate', 
		'summary', 
		'description', 
		'length', 
		'duration', 
		'detail_url', 
		'image_url', 
		'subtitle',
		'audio_url'
	];

	public static $rules = [
		 'name' => 'required',
		 'author' => 'required',
		 'subtitle' => 'required',
		 'audio_url' => '',
		 'pubdate' => 'required|date',
		 'detail_url' => '',
		 'image_url' => '',
		 'description' => 'required',
		 'summary' => 'required',
		 'filename' => '',
		 'length' => 'required',
		 'duration' => 'required'
	];

	public function scopeRecent($query, $n = 3)
	{
		return $query->orderBy('created_at', 'desc')->take($n);
	}

	public function scopeNewest($query)
	{
		return $query->orderBy('created_at', 'desc')->first();
	}
}