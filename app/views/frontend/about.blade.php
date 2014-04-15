@extends('layouts.fe.default')

@section('content')

<div class="row">
	<div class="col-lg-12 pghead about">
		<span> This is a test</span>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<div class="panel panel-default top30">
			  <div class="panel-body">
			    <h1>About The Church</h1>
			  </div>
			</div>
			<div class="panel panel-default top30">
			  <div class="panel-body">
			    Contact Us Today
			  </div>
			</div>
		</div>
		<div class="col-lg-4">
		 	<div class="row">
		 		<div class="panel panel-default top30">
				  <div class="panel-body">
				    Blog Posts
				  </div>
				</div>
		 		<div class="panel panel-default top30">
				  <div class="panel-body">
				    <header class="listing-header audio">
			              <i class="fa fa-star fa-3"></i><h3> Featured Sermon<h3>                        
			          </header>
					<?php $sermon = Sermon::newest(); ?>
					<div class="media">
						<div class="square pull-left">
							<img class="media-object" alt="" src="http://preview.imithemes.com/native-church-wp/wp-content/uploads/2014/03/gallery-img2.jpg">
						</div>
						<div class="media-body">
							<a href="{{ $sermon->audio_url }}"><h4 class="media-heading">{{ $sermon->name }}</h4></a>
							<p>{{ $sermon->author }}</p>
							<p>{{ $sermon->pubdate }}</p>
						</div>
					</div>
				  </div>
				</div>
				<div class="panel panel-default top30">
				  <div class="panel-body">
				    <header class="listing-header highlights">
				<i class="fa fa-calendar fa-3"></i><h3> Upcoming Events<h3>                        
			</header>
			<table class="table">
			  <thead>
			  </thead>
			  <tbody>
				@foreach(Evnt::all() as $evnts)
          <tr>
  				  <td class="event-date"> <span class="date">{{ substr($evnts->evntdate,-2,2) }}</span> <span class="month">{{ date("M", mktime(0, 0, 0, substr($evnts->evntdate,-5,2), 10)) }}</span> </td>
  				  <td class="event-detail">
  					<h4><a href="http://preview.imithemes.com/native-church-wp/?event=summer-fest">{{ $evnts->title }}</a></h4>
  					<span class="event-dayntime meta-data">{{ date('l', strtotime( $evnts->evntdate)) }} | {{ $evnts->evntdate }}</span> 
  				  </td>
  				  <td class="to-event-url">
  					<div><a href="http://preview.imithemes.com/native-church-wp/?event=summer-fest" class="btn btn-default btn-md">Details</a>
  					</div>
  				  </td>        
  				</tr>
			  @endforeach
			  </tbody>
			</table>
				  </div>
				</div>
		 	</div>
		</div>
	</div>
</div>
@stop