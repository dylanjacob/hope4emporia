@extends('layouts.dashboard')

@section('content')
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-10"><h3 class="panel-title col-xs-10">{{ $post->title }}</h3></div>
						<div class="col-xs-2"><a href="{{ URL::action('PostsController@index') }}" class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i></a></div>
					</div>
				</div>
				<ul class="list-group">
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Post ID:</strong>
							</div>
							<div class="col-xs-10">
								{{ $post->id }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Post Title:</strong>
							</div>
							<div class="col-xs-10">
								{{ $post->title }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Post Author:</strong>
							</div>
							<div class="col-xs-10">
								{{ $post->author }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Publish Date:</strong>
							</div>
							<div class="col-xs-10">
								{{ date('m-d-Y', strtotime($post->pubdate)) }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Post Body:</strong>
							</div>
							<div class="col-xs-10">
								{{ $post->body }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Post Image:</strong>
							</div>
							<div class="col-xs-10">
								<img src="{{ $post->image_url }}" alt="post image" class="img-responsive" />
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
@stop