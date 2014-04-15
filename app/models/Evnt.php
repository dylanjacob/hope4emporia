<?php

class Evnt extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'title' => 'required',
		 'author' => 'required',
		 'location' => 'required',
		 'starttime' => 'required',
		 'description' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['title', 'author', 'location', 'enabled', 'description', 'image', 'starttime', 'duration'];

	public function isUpcoming()
	{
		return $this->evntdate >= date('Y-m-d') ? true : false;
	}

	public function scopeActive($query)
	{
		return $query->where('enabled', 1);
	}

	public static function getUpcoming($n=3)
	{
		if ($n>0) {
			$upcoming = Evnt::active()->orderBy('evntdate')->get()->filter(function($event) {
				return $event->isUpcoming();
			})->take($n);
			return $upcoming;
		} else {
			$upcoming = Evnt::active()->orderBy('evntdate')->get()->filter(function($event) {
				return $event->isUpcoming();
			});
			return $upcoming;
		}
		
	}

	public function getSchedule()
	{
		return $this->schedule();
	}

	public function schedule()
	{
		return $this->hasOne('Schedule');
	}
}