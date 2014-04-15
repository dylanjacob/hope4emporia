<?php

class Schedule extends \Eloquent {

	private $eventTypes = [
		0 => '1 Time', 
		1 => 'Weekly', 
		2 => 'Bi-Weekly',
		3 => 'Monthly',
		4 => 'Bi-Monthly',
		5 => 'Yearly',
		6 => 'Semi-Annually'
	];
	
	private $intervals = [
			0 => null,
			1 => 'P1W',
			2 => 'P2W',
			3 => 'P1M',
			4 => 'P2M',
			5 => 'P1Y',
			6 => 'P6M'
		];

	private $days = [
		0 => 'Sunday',
		1 => 'Monday',
		2 => 'Tuesday',
		3 => 'Wednesday',
		4 => 'Thursday',
		5 => 'Friday',
		6 => 'Saturday'
	];


	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'event_id' => 'required|numeric',
		'event_type' => 'required|numeric|digits_between:0,6',
		'day_of_week' => 'required|numeric|digits_between:0,6',
		'start_date' => 'required|date',
		'end_date' => 'date',
		'number_of_occurrences' => 'numeric'
	];

	// Don't forget to fill this array
	protected $fillable = ['event_id', 'event_type', 'day_of_week', 'start_date', 'end_date', 'number_of_occurrences'];

	public function event() {
		return $this->belongsTo('Evnt');
	}

	public static function getEventTypes()
	{
		return $eventTypes;
	}

	public static function getEventType($type)
	{
		return $eventTypes[$type];
	}

	public static function getDaysOfWeek()
	{
		return $days;
	}

	public function getOccurrences() {
		$start = new DateTime($this->start_date);
		$end = new DateTime($this->end_date);
		$interval = new DateInterval($this->intervals[$this->event_type]);

		$occurrences = [
			0 => [
				'evnt' => $this->event,
				'date' => $start->format('Y-m-d')
			]
		];
		$date = $start->add($interval);
		for($i=1; $i < $this->number_of_occurrences; $i++) {
			Log::info($date->format('Y-m-d'));
			$date = $date->add($interval);
			$occurrences[] = [
				$i => [
					'event' => $this->event,
					'date' => $date->format('Y-m-d')
				]
			];
		}
		Log::info($occurrences);
		return $occurrences;

	}

	public static function getNumOccurrences($startDate, $endDate, $dayOfWeek)
	{
		$start = new DateTime($startDate);
		$end = new DateTime($endDate);
		$days = $start->diff($end, true)->days;

		return intval($days / 7) + ($start->format('w') + $days % 7 >= $dayOfWeek);
	}

	public static function getEndDate($startDate, $numOccur, $weekDay, $eventType = 1)
	{
		$start = new DateTime($startDate);
		$end = null;
		switch ($eventType) {
			case 0:  // 1 time event
				$end = $start;
				break;

			case 1:  // weekly
				$day = $this->days[$weekDay];
				if ($start->format('w') == $weekDay) {
					$start = $start->sub(new DateInterval('P1D'));
				}
				$first = $start->add(DateInterval::createFromDateString('next '.$day));
				$next = $first;
				for($i = 1; $i < $numOccur; $i++) {
					$next = $next->add(DateInterval::createFromDateString('next '.$day));
				}
				$end = $next;
				break;

			case 2: // Bi-Weekly
				$day = $this->days[$weekDay];
				if ($start->format('w') == $weekDay) {
					$start = $start->sub(new DateInterval('P1D'));
				}
				$first = $start->add(DateInterval::createFromDateString('next '.$day));
				$next = $first;
				for($i = 1; $i < ($numOccur*2)-1; $i++) {
					$next = $next->add(DateInterval::createFromDateString('next '.$day));
				}
				$end = $next;
				break;

			case 3: // Monthly
				$day = $this->days[$weekDay];
				if ($start->format('w') == $weekDay) {
					$start = $start->sub(new DateInterval('P1D'));
				}
				$first = $start->add(DateInterval::createFromDateString('next '.$day));
				
				$end = $first->add(new DateInterval('P'.$numOccur.'M'));
				break;

			case 4: // Bi-Monthly
				$day = $this->days[$weekDay];
				if ($start->format('w') == $weekDay) {
					$start = $start->sub(new DateInterval('P1D'));
				}
				$first = $start->add(DateInterval::createFromDateString('next '.$day));
				
				$end = $first->add(new DateInterval('P'. $numOccur*2 .'M'));
				break;

			case 5: // Yearly
				$day = $this->days[$weekDay];
				if ($start->format('w') == $weekDay) {
					$start = $start->sub(new DateInterval('P1D'));
				}
				$first = $start->add(DateInterval::createFromDateString('next '.$day));
				
				$end = $first->add(new DateInterval('P'. $numOccur*2 .'M'));
				break;

			case 6: // Semi Anually
				$day = $this->days[$weekDay];
				if ($start->format('w') == $weekDay) {
					$start = $start->sub(new DateInterval('P1D'));
				}
				$first = $start->add(DateInterval::createFromDateString('next '.$day));
				
				$end = $first->add(new DateInterval('P'. $numOccur*6 .'M'));
				break;

			default: // assume 1 time event
				$end = $start;
				break;

		}
		return $end;
	}

}