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
					<div class="col-xs-10"><h3 class="panel-title">Edit Role</h3></div>
				</div>
			</div>
			<div class="panel-body">
				{{ Form::model($role, array('action' => array('RolesController@update', $role->id), 'method' => 'put', 'class' => 'form')) }}
					<div class="form-group">
						{{ Form::text('role',null,array('placeholder' => 'Role Name', 'class' => 'form-control', 'autofocus' => '')) }}
					</div>
					<div class="form-group">
						<label for="autopass">Enabled</label>
						{{ Form::checkbox('enabled', null, true) }}
					</div>
				    <div class="form-group">
				    	{{ Form::submit('Update Role', array('class' => 'btn btn-primary')) }}
				    	<a href="{{ URL::action('RolesController@index') }}" class="btn btn-default">Cancel</a>
				    </div>
				{{ Form::close() }}
		</div>
	</div>
</div>
@stop
