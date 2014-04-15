@extends('layouts.dashboard')

<?php
	$app = ApiApp::find($id);
?>

@section('content')
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-10"><h3 class="panel-title col-xs-10">{{ $app->name }}</h3></div>
						<div class="col-xs-2"><a href="{{ URL::action('AppController@index') }}" class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i></a></div>
					</div>
				</div>
				<div class="panel-body">
					<p> Use these details to configure your application's oauth settings. </p>
				</div>
				<ul class="list-group">
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Client ID:</strong>
							</div>
							<div class="col-xs-10">
								{{ $app->id }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Client Name:</strong>
							</div>
							<div class="col-xs-10">
								{{ $app->name }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Client Secret:</strong>
							</div>
							<div class="col-xs-10">
								{{ $app->secret }}
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
@stop