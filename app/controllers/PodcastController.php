<?php

class PodcastController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$sermons = Sermon::recent()->get();
		$view = View::make('podcast.index', compact('sermons'));
		
		return Response::make($view->render(), 200)->header('Content-Type', 'application/xml');
		#return Response::make(\Illuminate\View\Environment->of($view));
		
	}

}