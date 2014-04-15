@extends('layouts.dashboard')

@section('content')
@if (Session::has('errors'))
<div class="alert alert-danger alert-dismissable navbar navbar-fixed-top">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p class="lead text-center"><strong>Ooops!</strong> {{ $errors->first() }}</p>
	</div>
@endif

<div class="container">
	<div class="col-xs-6 col-xs-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-10"><h3 class="panel-title">Create Advisory</h3></div>
				</div>
			</div>
			<div class="panel-body">
				{{ Form::open(array('action' => 'AdvisoriesController@store', 'method' => 'post', 'class' => 'form')) }}
					<div class="form-group">
						{{ Form::text('message',null,array('placeholder' => 'Message', 'class' => 'form-control', 'autofocus' => '')) }}
					</div>
					<div class="form-group">
						{{ Form::select('level', array('danger' => 'Severe','warning' => 'Warning', 'info' => 'Informational'), '0', array('class' => 'form-control')) }}
					</div>
					<div class="form-group">
						<label for="autopass">Enabled</label>
						{{ Form::checkbox('enabled', null, true) }}
					</div>
				    <div class="form-group">
				    	{{ Form::submit('Create Advisory', array('class' => 'btn btn-primary')) }}
				    	<a href="{{ URL::action('AdvisoriesController@index') }}" class="btn btn-default">Cancel</a>
				    </div>
				{{ Form::close() }}
		</div>
	</div>
</div>
@stop
