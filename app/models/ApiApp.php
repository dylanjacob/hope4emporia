<?php

class ApiApp extends \Eloquent {
	protected $fillable = ['id', 'name', 'secret'];
	protected $table = "oauth_clients";
	public $incrementing = false;
}