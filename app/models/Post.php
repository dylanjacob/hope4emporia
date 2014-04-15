<?php

class Post extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'title' => 'required',
		'author' => 'required',
		'body' => 'required',
		'pubdate' => 'required|date'
	];

	// Don't forget to fill this array
	protected $fillable = ['title', 'author', 'body', 'pubdate', 'image_url', 'url'];

}