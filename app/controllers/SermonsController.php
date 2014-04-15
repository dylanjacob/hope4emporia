<?php
#use PhpId3\Id3TagsReader;
class SermonsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Request::wantsJson()) {
			return Response::json(Sermon::all());
		}
		return View::make('sermon.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('sermon.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
		$data = Input::except('_token');

		$data['filename'] = trim(Input::get('filename'));
		if (!Request::isJson()) {
			$name = time();
			$ext = ".".Input::file('sermon')->getClientOriginalExtension();

			$data['filename'] = $name.$ext;	
		}
		Input::file('sermon')->move(storage_path().'/uploads/', $data['filename']);
		$path = storage_path().'/uploads/'.$data['filename'];
		$data['length'] = filesize($path);
		
		$data['pubdate'] = date('Y-m-d H:i:s O');
		
		$id3 = new getID3;
		$mp3 = $id3->analyze(storage_path().'/uploads/'.$data['filename']);
		$data['duration'] = $mp3['playtime_string'];

		$validator = Validator::make($data, Sermon::$rules);

		if ($validator->fails())
		{
			if (Request::isJson() && Request::path() == '/sermons/create') {
				Log::error($validator->messages());
				return Response::json(['error' => $validator->messages()]);
			}
			return Redirect::back()->withErrors($validator)->withInput();
		}
		
		$sermon = Sermon::create($data);
		$sermon->audio_url = url('/audio/'.$sermon->id,null,false);
		$sermon->detail_url = url('/sermons/'.$sermon->id, null, false);
		$sermon->image_url = url('/img/sermons/'. $sermon->id, null, false);
		$sermon->save();

		if (Request::isJson() && Request::path() == 'sermons/create') {
			
			return Response::json(['status' => 'success', 'sermon' => $sermon]);
		}

		$user = Auth::user();
		Activity::log($user->getDisplayName()." created a new Sermon.", array('url' => action('SermonsController@show', $sermon->id), 'type' => 'sermon'));

		
		return Redirect::action('SermonsController@index')->with('status', 'Successfully Added Sermon!');
		

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('sermon.show')->with('id', $id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('sermon.edit')->with('id', $id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$sermon = Sermon::find($id);
		$data = Input::except('_token');
		$data['audio_url'] = url('/audio/'.$sermon->id,null,false);
		$data['detail_url'] = url('/sermons/'.$sermon->id, null, false);
		$data['image_url'] = null;
		$path = storage_path().'/uploads/'.$sermon->filename;
		$data['length'] = filesize($path);
		
		$id3 = new getID3;
		$mp3 = $id3->analyze(storage_path().'/uploads/'.$sermon->filename);
		
		$data['duration'] = $mp3['playtime_string'];

		$validator = Validator::make($data, Sermon::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		
		if (Input::hasFile('sermon')) {
			$ext = ".".Input::file('sermon')->getClientOriginalExtension();
			$newname = time().$ext;
			unlink(realpath(storage_path().'/uploads/'.$sermon->filename));
			Input::file('sermon')->move(storage_path().'/uploads', $newname);
			$sermon->filename = $newname;
		}

		$sermon->update($data);

		$user = Auth::user();
		Activity::log($user->getDisplayName()." modified a Sermon.", array('url' => action('SermonsController@show', $sermon->id), 'type' => 'sermon'));

		return Redirect::action('SermonsController@index')->with('status', 'Successfully updated '.$sermon->name);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$sermon = Sermon::find($id);
		unlink(storage_path().'/uploads/'.$sermon->filename);
		$sermon->delete();

		$user = Auth::user();
		Activity::log($user->getDisplayName()." deleted a Sermon.", array('action' => 'delete', 'type' => 'sermon'));

		return Response::make('Sermon Deleted Successfully!');
	}

}