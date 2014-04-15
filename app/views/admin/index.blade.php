@extends('layouts.dashboard')
<?php
	#use \Illuminate\Database\Eloquent\Collection;

	$sermon = Sermon::newest();	

	$icon = array(
		'user' => 'fa-user',
		'advisory' => 'fa-exclamation',
		'announcement' => 'fa-bullhorn',
		'app' => 'fa-code',
		'authlevel' => 'fa-lock',
		'event' => 'fa-calendar',
		'post' => 'fa-envelope',
		'role' => 'fa-certificate',
		'sermon' => 'fa-microphone'
	);
	date_default_timezone_set('America/Chicago')
?>

@section('content')
<div id="result">
@if (Session::has('errors'))

<div class="alert alert-danger alert-dismissable navbar navbar-fixed-top">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<p class="lead text-center"><strong>Ooops!</strong> {{ $errors->first() }}</p>
</div>

@endif
@if(count($a = Advisory::enabled()->get()))
<div class="alert alert-{{ $a[0]->level }} alert-dismissable navbar navbar-fixed-top">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
	<p class="lead text-center"><strong>Hey You!</strong> {{ $a[0]->message }}</p>
</div>
@endif
</div>

<div class="container">
	<div class="row">
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-1"><i class="fa fa-comments fa-2x"></i></div>
						<div class="col-xs-11"><h3 class="panel-title">Recent Activity</h3></div>
					</div>
				</div>
				<ul class="list-group">
				@if(count(Activity::getRecentLogs(3)) > 0)
					@foreach(Activity::getRecentLogs(3) as $activity)
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<i class="fa {{ $icon[$activity->context->type] }} fa-2x pull-right"></i>
							</div>
							<div class="col-xs-8">
								<div class="detail">
									<h4 class="media-heading">{{ $activity->message }}</h4>
									<div class="meta-data"><small>{{ date('D, F jS h:i A', strtotime($activity->created_at." UTC")) }}</small></div>
								</div>
							</div>
							<div class="col-xs-2">
								@if(isset($activity->context->url))
								<a href="{{ $activity->context->url }}" class="btn btn-success">Detail</a>
								@endif
							</div>
						</div>
					</li>
					@endforeach
				@else
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<p><i class="fa fa-dashboard fa-2x pull-right"></i></p>
							</div>
							<div class="col-xs-8">
								<div class="detail">
									<h4 class="media-heading">No Recent Activity</h4>
								</div>
							</div>
							<div class="col-xs-2">

							</div>
						</div>
					</li>
				@endif
				</ul>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-1"><i class="fa fa-calendar fa-2x"></i></div>
						<div class="col-xs-11"><h3 class="panel-title">Upcoming Events</h3></div>
					</div>
				</div>
				<ul class="list-group">
				@if(count(Evnt::getUpcoming(3)) > 0)
					@foreach(Evnt::getUpcoming(3) as $event)
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<div class="event-date pull-right">
									<div class="date">
										{{ date('d', strtotime($event->evntdate)) }}
									</div>
									<div class="month">
										{{ date('M', strtotime($event->evntdate)) }}
									</div>
								</div>
							</div>
							<div class="col-xs-8">
								<div class="event-detail">
									<h4 class="media-heading"><a href="{{ URL::action('EvntsController@show', $event->id) }}">{{ $event->title }}</a></h4>
									<div class="event-dayntime meta-data"><small>{{ date('l', strtotime($event->evntdate)) }} @ {{ date('g:i A', strtotime( $event->starttime)) }} | {{ date('Y-m-d', strtotime( $event->evntdate)) }}</small></div>
								</div>
							</div>
							<div class="col-xs-2">
								<div class="to-event-url">
									<a href="{{ URL::action('EvntsController@show', $event->id) }}" class="btn btn-success btn-md pull-right">Details</a>
								</div>
							</div>
						</div>
					</li>
					@endforeach
				@else
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<p><i class="fa fa-dashboard fa-2x pull-right"></i></p>
							</div>
							<div class="col-xs-8">
								<div class="detail">
									<h4 class="media-heading">No Recent Activity</h4>
								</div>
							</div>
							<div class="col-xs-2">

							</div>
						</div>
					</li>
				@endif
				</ul>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-1"><i class="fa fa-bullhorn fa-2x"></i></div>
						<div class="col-xs-11"><h3 class="panel-title">Announcements</h3></div>
					</div>
				</div>
				<ul class="list-group">
				@if(count(Announcement::getActive()) > 0)
					@foreach(Announcement::getActive() as $announcement)
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<div class="announcement-pubdate pull-right">
									<div class="date">
										{{ date('d', strtotime($announcement->pubdate)) }}
									</div>
									<div class="month">
										{{ date('M', strtotime($announcement->pubdate)) }}
									</div>
								</div>
							</div>
							<div class="col-xs-8">
								<div class="announcement-detail">
									<h4 class="media-heading"><a href="{{ URL::action('AnnouncementsController@show', $announcement->id) }}">{{ $announcement->title }}</a></h4>
									<div class="posted-by"><small>Posted By: {{ $announcement->author }}</small></div>
								</div>
							</div>
							<div class="col-xs-2">
								<div class="to-announcement-url">
									<a href="{{ URL::action('AnnouncementsController@show', $announcement->id) }}" class="btn btn-success btn-md pull-right">Details</a>
								</div>
							</div>
						</div>
					</li>
					@endforeach
				@else
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-2">
								<p><i class="fa fa-dashboard fa-2x pull-right"></i></p>
							</div>
							<div class="col-xs-8">
								<div class="detail">
									<h4 class="media-heading">No Recent Activity</h4>
								</div>
							</div>
							<div class="col-xs-2">

							</div>
						</div>
					</li>
				@endif
				</ul>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-1"><i class="fa fa-star fa-2x"></i></div>
						<div class="col-xs-11"><h3 class="panel-title">Featured Sermon</h3></div>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-10">
							<div class="media">
								<div class="square pull-left">
									<img class="media-object" alt="" src="http://www.riverchasebaptist.org/clientimages/31474/sermon-cards/mark%20sermon%20series%20master.jpg" />
								</div>
								<div class="media-body">
									<a href="{{ URL::action('SermonsController@show', $sermon->id)}}"><h4 class="media-heading">{{ $sermon->name }}</h4></a>
									<div class="meta-data">{{ $sermon->author }}<br />
									{{ date('Y-m-d', strtotime($sermon->pubdate)) }}</div>
								</div>
							</div>
						</div>					
						<div class="col-xs-2">
							<div class="to-sermon-url">
								<a href="{{ URL::action('SermonsController@show', $sermon->id) }}" class="btn btn-success btn-md pull-right">Details</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- $newest['res']." ".$newest['action']." on ".$newest['date'] --}}
<?php $test = Evnt::find(12)->schedule->getOccurrences(); ?>
@stop