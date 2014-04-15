@extends('layouts.dashboard')
<?php
	$sermon = Sermon::find($id);
?>

@section('scripts')
	<script src="/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('input#pubdate').datepicker({
			'format': 'yyyy-mm-dd',
			'setValue': "{{ date('Y-m-d', time()) }}"
		});
	});
	</script>
@stop

@section('styles')
	<link rel="stylesheet" href="/css/datepicker.css" />
@stop

@section('content')
@if(Session::has('errors'))
	<div class="alert alert-danger alert-dismissable navbar navbar-fixed-top">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p class="lead text-center"><strong>Ooops!</strong> {{ $errors->first() }}</p>
	</div>
@endif

@if(Session::has('status'))
	<div class="alert alert-success alert-dismissable navbar navbar-fixed-top">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p class="lead text-center">{{ Session::get('status') }}</p>
	</div>
@endif

	<div class="container">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<h3 class="panel-title col-xs-10">Edit {{ $sermon->name }}</h3>
					</div>
				</div>
				<div class="panel-body">
					<div class="col-xs-10 col-xs-offset-1">
						{{ Form::model($sermon, array('action' => array('SermonsController@update', $sermon->id), 'method' => 'put', 'files' => true, 'class' => 'form-horizontal')) }}
						<div class="form-group">
							{{ Form::text('name', null, array('placeholder' => 'Sermon Name', 'class' => 'form-control')) }}
						</div>
						<div class="form-group">
							{{ Form::text('subtitle',null, array('placeholder' => 'Subtitle', 'id' => 'subtitle', 'class' => 'form-control'))}}
						</div>
						<div class="form-group">
							{{ Form::text('author',null, array('placeholder' => 'Author Name', 'id' => 'author', 'class' => 'form-control'))}}
						</div>
						<div class="form-group">
							{{ Form::textarea('summary',null, array('placeholder' => 'Summary', 'id' => 'summary', 'class' => 'form-control'))}}
						</div>
						<div class="form-group">
							{{ Form::textarea('description',null, array('placeholder' => 'Description', 'id' => 'description', 'class' => 'form-control'))}}
						</div>
						<div class="form-group">
							{{ Form::text('pubdate', null, array('placeholder' => 'Publish Date', 'id' => 'pubdate', 'class' => 'form-control')) }}
						</div>
						<div class="form-group">
							<label for="sermon">Select the Audio File</label>
							{{ Form::file('sermon') }}
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Update Sermon</button>
							<a href="{{ URL::action('SermonsController@index') }}" class="btn btn-default">Cancel</a>
						</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop