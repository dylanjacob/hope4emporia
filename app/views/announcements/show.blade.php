@extends('layouts.dashboard')

@section('content')
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-10"><h3 class="panel-title col-xs-10">{{ $announcement->title }}</h3></div>
						<div class="col-xs-2"><a href="{{ URL::action('AnnouncementsController@index') }}" class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i></a></div>
					</div>
				</div>
				<ul class="list-group">
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Name:</strong>
							</div>
							<div class="col-xs-10">
								{{ $announcement->title }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Author:</strong>
							</div>
							<div class="col-xs-10">
								{{ $announcement->author }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Publish Date:</strong>
							</div>
							<div class="col-xs-10">
								{{ date('Y-m-d', strtotime($announcement->pubdate)) }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Expire Date:</strong>
							</div>
							<div class="col-xs-10">
								{{ date('Y-m-d', strtotime($announcement->expiredate)) }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Enabled:</strong>
							</div>
							<div class="col-xs-10">
								{{ $announcement->enabled ? "Yes" : "No" }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Body:</strong>
							</div>
							<div class="col-xs-10">
								{{ $announcement->body }}
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
@stop