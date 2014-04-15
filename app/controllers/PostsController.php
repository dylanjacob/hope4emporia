<?php

class PostsController extends \BaseController {

	/**
	 * Display a listing of posts
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::all();

		if (Request::wantsJson()) {
			return Response::json($posts);
		}

		return View::make('posts.index', compact('posts'));
	}

	/**
	 * Show the form for creating a new post
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('posts.create');
	}

	/**
	 * Store a newly created post in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::except('_token');

		$validator = Validator::make($data, Post::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$post = Post::create($data);
		$post->url = url('/posts/'.$post->id, null, false);
		
		if (Input::hasFile('image')) {
			$path = 'img/posts/';
			$filename = $post->id.'.'.Input::file('image')->getClientOriginalExtension();
			Input::file('image')->move(public_path().'/'.$path,$filename);
			$post->image_url = url($path.$filename, null, false);
		}
		$post->save();

		$user = Auth::user();
		Activity::log($user->getDisplayName()." created a new Post.", array('url' => action('PostsController@show', $post->id), 'type' => 'post'));

		return Redirect::action('PostsController@index');
	}

	/**
	 * Display the specified post.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = Post::findOrFail($id);

		return View::make('posts.show', compact('post'));
	}

	/**
	 * Show the form for editing the specified post.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = Post::find($id);

		return View::make('posts.edit', compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$post = Post::findOrFail($id);

		$data = Input::except('_token');

		$validator = Validator::make($data, Post::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$post->update($data);

		$user = Auth::user();
		Activity::log($user->getDisplayName()." modified a Post.", array('url' => action('PostsController@show', $post->id), 'type' => 'post'));

		return Redirect::action('PostsController@index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$post = Post::findOrFail($id);

		if (!is_null($post->image_url)) {
			foreach(glob(public_path().'/img/posts/'.$post->id.'.*') as $file) {
				unlink($file);	
			}
			
		}
		$post->delete();

		$user = Auth::user();
		Activity::log($user->getDisplayName()." deleted a Post.", array('action' => 'delete', 'type' => 'post'));

		return Response::make('Post Deleted Successfully!', 200);
	}

}