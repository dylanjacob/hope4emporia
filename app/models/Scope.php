<?php

class Scope extends \Eloquent {
	protected $fillable = ['scope','name','description'];
	protected $table = "oauth_scopes";
}