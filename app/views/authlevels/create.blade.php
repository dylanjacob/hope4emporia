@extends('layouts.dashboard')

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
						<h3 class="panel-title col-xs-10">Add New AuthLevel</h3>
					</div>
				</div>
				<div class="panel-body">
					<div class="col-xs-10 col-xs-offset-1">
						{{ Form::open(array('action' => 'AuthLevelsController@store', 'method' => 'post', 'class' => 'form-horizontal')) }}
						<div class="form-group">
							{{ Form::text('resource', null, array('placeholder' => 'Resource Name', 'class' => 'form-control')) }}
						</div>
						<div class="form-group">
							{{ Form::label('maintenance', 'Minimum Role for Maintenance')}}
							{{ Form::select('maintenance', Role::active()->dropdown(), null,array('class' => 'form-control',))}}
						</div>
						<div class="form-group">
							{{ Form::label('query', 'Minimum Role for Query')}}
							{{ Form::select('query', Role::active()->dropdown(), null,array('class' => 'form-control',))}}
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Add Auth Level</button>
							<a href="{{ URL::action('AuthLevelsController@index') }}" class="btn btn-default">Cancel</a>
						</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop