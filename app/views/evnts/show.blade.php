@extends('layouts.dashboard')

@section('scripts')
<script src="//maps.google.com/maps/api/js?v=3&sensor=false"></script>
@if(preg_match('/^(-?\d{1,2}\.\d{6}),(-?\d{1,2}\.\d{6})$/', $evnt->location))
<script type="text/javascript">
function init_map(){
	var myOptions = {
		zoom:14,
		center: new google.maps.LatLng({{ $evnt->location }}),
		mapTypeId: google.maps.MapTypeId.HYBRID
	};
	map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
	marker = new google.maps.Marker({map: map,position: new google.maps.LatLng({{ $evnt->location }}) });
}
google.maps.event.addDomListener (window, "load", init_map);
</script>
@endif
@stop

@section('content')
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-10"><h3 class="panel-title col-xs-10">{{ $evnt->title }}</h3></div>
						<div class="col-xs-2"><a href="{{ URL::action('EvntsController@index') }}" class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i></a></div>
					</div>
				</div>
				<ul class="list-group">
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Event ID:</strong>
							</div>
							<div class="col-xs-10">
								{{ $evnt->id }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Event Name:</strong>
							</div>
							<div class="col-xs-10">
								{{ $evnt->title }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Event Author:</strong>
							</div>
							<div class="col-xs-10">
								{{ $evnt->author }}
							</div>
						</div>
					</li>
					@if($evnt->schedule->event_type != 0)
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Recurrence:</strong>
							</div>
							<div class="col-xs-10">
								{{ Schedule::getEventType($evnt->schedule->event_type) }} on {{ Schedule::getDaysOfWeek()[$evnt->schedule->day_of_week] }}s
							</div>
						</div>
					</li>
					@endif
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Event Start Date:</strong>
							</div>
							<div class="col-xs-10">
								{{ $evnt->schedule->start_date }}
							</div>
						</div>
					</li>
					@if($evnt->schedule->event_type != 0)
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Repeat End Date:</strong>
							</div>
							<div class="col-xs-10">
								{{ $evnt->schedule->end_date }}
							</div>
						</div>
					</li>
					@endif
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Event Start Time:</strong>
							</div>
							<div class="col-xs-10">
								{{ date('g:i A', strtotime($evnt->starttime)) }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Event End Time:</strong>
							</div>
							<div class="col-xs-10">
								{{ date('g:i A', strtotime($evnt->starttime)+($evnt->duration*60*60)) }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Event Location:</strong>
							</div>
							@if(preg_match('/^(-?\d{1,2}\.\d{6}),(-?\d{1,2}\.\d{6})$/', $evnt->location))
							<div class="col-xs-10">
								<div style="height:300px;width:500px;overflow:hidden;">
									<div id="gmap_canvas" style="height:300px; width:500px;"></div>
								</div>
							</div>
							@else
							<div class="col-xs-10">
								{{ $evnt->location }}
							</div>
							@endif
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<strong>Event Image:</strong>
							</div>
							<div class="col-xs-10">
								{{ $evnt->image }}
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
@stop