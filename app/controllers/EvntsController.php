<?php

class EvntsController extends \BaseController {

	/**
	 * Display a listing of evnts
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Request::wantsJson()) {
			return Response::json(Evnt::all());
		}

		$evnts = Evnt::all();

		return View::make('evnts.index', compact('evnts'));
	}

	/**
	 * Show the form for creating a new evnt
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('evnts.create');
	}

	/**
	 * Store a newly created evnt in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::except('_token', 'event_type', 'day_of_week', 'start_date', 'end_date', 'number_of_occurrences');
		$data['enabled'] = Input::has('enabled') ? true : false;
		$eventType = Input::get('event_type');
		$dayOfWeek = Input::get('day_of_week');
		$startDate = Input::get('start_date');
		$endDate = Input::get('end_date');
		$numOccurr = Input::get('number_of_occurrences');

		$validator = Validator::make($data, Evnt::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		if ($eventType == 0) {
			$schedule = Schedule::create(['event_type' => $eventType, 'day_of_week' => $dayOfWeek, 'start_date' => $startDate, 'end_date' => null, 'number_of_occurrences' => 1]);
		} else {
			if (is_null($numOccurr) || $numOccurr == 0) {
				// End Date is provided, need to calculate number of occurences between start and end dates
				$schedule = Schedule::create([
					'event_type' => $eventType, 
					'day_of_week' => $dayOfWeek, 
					'start_date' => $startDate, 
					'end_date' => $endDate, 
					'number_of_occurrences' => Schedule::getNumOccurrences($startDate, $endDate, $dayOfWeek)
				]);
			} else {
				// Occurrences are provided, need to calculate end date
				$endDate = Schedule::getEndDate($startDate, $numOccurr, $dayOfWeek, $eventType)->format('Y-m-d');
				$schedule = Schedule::create([
					'event_type' => $eventType, 
					'day_of_week' => $dayOfWeek, 
					'start_date' => $startDate, 
					'end_date' => $endDate, 
					'number_of_occurrences' => $numOccurr
				]);
				
			}
		}

		$event = Evnt::create($data);
		$event->schedule()->save($schedule);
		$user = Auth::user();
		Activity::log($user->getDisplayName()." created a new Event.", array('url' => action('EvntsController@show', $event->id), 'type' => 'event'));

		return Redirect::action('EvntsController@index');
	}

	/**
	 * Display the specified evnt.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$evnt = Evnt::findOrFail($id);

		return View::make('evnts.show', compact('evnt'));
	}

	/**
	 * Show the form for editing the specified evnt.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$evnt = Evnt::find($id);

		return View::make('evnts.edit', compact('evnt'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$evnt = Evnt::findOrFail($id);
		Log::info(Input::has('enabled') ? Input::get('enabled') : "false");
		$data = Input::except('_token');
		$data['enabled'] = Input::has('enabled') ? Input::get('enabled') : false;

		$validator = Validator::make($data, Evnt::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$evnt->update($data);
		$user = Auth::user();
		Activity::log($user->getDisplayName()." modified an Event.", array('url' => action('EvntsController@show', $evnt->id), 'type' => 'event'));

		return Redirect::action('EvntsController@index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Schedule::where('evnt_id', $id)->delete();
		Evnt::destroy($id);

		$user = Auth::user();
		Activity::log($user->getDisplayName()." delete an Event.", array('action' => 'delete', 'type' => 'event'));

		return Response::make('Successfully Deleted Event!');
	}

}