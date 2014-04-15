@extends('layouts.dashboard')

@section('content')
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-10"><h3 class="panel-title col-xs-10">{{ $authlevel->resource }}</h3></div>
						<div class="col-xs-2"><a href="{{ URL::action('AuthLevelsController@index') }}" class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i></a></div>
					</div>
				</div>
				<ul class="list-group">
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Resource:</strong>
							</div>
							<div class="col-xs-10">
								{{ $authlevel->resource }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Maintenance:</strong>
							</div>
							<div class="col-xs-10">
								{{ Role::find($authlevel->maintenance)->role }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Query:</strong>
							</div>
							<div class="col-xs-10">
								{{ Role::find($authlevel->query)->role }}
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
@stop