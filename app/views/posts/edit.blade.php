@extends('layouts.dashboard')

@section('scripts')
	<script src="/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript">
	
	$(document).ready(function() {
		$('input#dp1').datepicker({
			'format': 'yyyy-mm-dd',
			'setValue': "{{ date('Y-m-d') }}"
		});
	});
	</script>
@stop

@section('styles')
	<link rel="stylesheet" href="/css/datepicker.css" />
@stop

@section('content')

@if (Session::has('errors'))
<div class="alert alert-danger alert-dismissable navbar navbar-fixed-top">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p class="lead text-center"><strong>Ooops!</strong> {{ Session::get('errors') }}</p>
	</div>
@endif

<div class="container">
	<div class="col-xs-6 col-xs-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-10"><h3 class="panel-title">Create Post</h3></div>

				</div>
			</div>
			<div class="panel-body">
				{{ Form::model($post, array('action' => array('PostsController@update', $post->id), 'method' => 'put', 'class' => 'form')) }}
					<div class="form-group">
						{{ Form::text('title',null,array('placeholder' => 'Post Title', 'class' => 'form-control', 'autofocus' => '')) }}
					</div>
					<div class="form-group">
						{{ Form::text('author',null,array('placeholder' => 'Author', 'class' => 'form-control')) }}
					</div>
				    <div class="form-group">
				    	{{ Form::textarea('body', null, array('placeholder' => 'Post Body', 'class' => 'form-control')) }}
				    </div>
				    <div class="form-group">
				    	{{ Form::label('pubdate', "Publish Date")}}
				    	{{ Form::text('pubdate', null, array('placeholder' => 'Publish Date', 'id' => 'dp1', 'class' => 'form-control', 'value' => date('Y-m-d'))) }}
				    </div>
				    <div class="form-group">
				    	{{ Form::label('image', 'Post Image (optional)') }}
				    	{{ Form::file('image') }}
				    </div>
				    <div class="form-group">
				    	{{ Form::submit('Update Post', array('class' => 'btn btn-primary')) }}
				    	<a href="{{ URL::action('PostsController@index') }}" class="btn btn-default">Cancel</a>
				    </div>
				{{ Form::close() }}
		</div>
	</div>
</div>
@stop