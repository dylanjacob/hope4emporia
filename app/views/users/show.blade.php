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
					<div class="col-xs-10"><h3 class="panel-title">Show User</h3></div>
					<div class="col-xs-2"><a href="{{ URL::action('UsersController@index') }}" class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i></a></div>
				</div>
			</div>
			<ul class="list-group">
				<li class="list-group-item">
					<div class="row">
						<div class="col-xs-3">
							<strong>User ID:</strong>
						</div>
						<div class="col-xs-9">
							{{ $user->id }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-xs-3">
							<strong>User Name:</strong>
						</div>
						<div class="col-xs-9">
							{{ $user->firstName }} {{ $user->lastName }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-xs-3">
							<strong>Username:</strong>
						</div>
						<div class="col-xs-9">
							{{ $user->username }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-xs-3">
							<strong>Email:</strong>
						</div>
						<div class="col-xs-9">
							{{ $user->email }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-xs-3">
							<strong>User Role:</strong>
						</div>
						<div class="col-xs-9">
							{{ $user->role->role }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-xs-3">
							<strong>Last Updated:</strong>
						</div>
						<div class="col-xs-9">
							{{ date('Y-m-d H:i A', strtotime($user->updated_at)) }}
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
@stop