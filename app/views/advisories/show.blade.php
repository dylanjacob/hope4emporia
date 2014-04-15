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
					<div class="col-xs-10"><h3 class="panel-title">Advisory #{{ $advisory->id }}</h3></div>
					<div class="col-xs-2"><a href="{{ URL::action('AdvisoriesController@index') }}" class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i></a></div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-4"><strong>ID:</strong></div>
					<div class="col-xs-8">{{ $advisory->id }}</div>
				</div>
				<div class="row">
					<div class="col-xs-4"><strong>Message:</strong></div>
					<div class="col-xs-8">{{ $advisory->message }}</div>
				</div>
				<div class="row">
					<div class="col-xs-4"><strong>Enabled:</strong></div>
					<div class="col-xs-8">{{ $advisory->enabled }}</div>
				</div>
				<div class="row">
					<div class="col-xs-4"><strong>Level:</strong></div>
					<div class="col-xs-8">{{ $advisory->level }}</div>
				</div>
		</div>
	</div>
</div>
@stop