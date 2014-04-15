@extends('layouts.fe.default')

@section('carousel')
    <!-- Main component for a primary marketing message or call to action -->
    <!-- Carousel================================================== -->
    <div class="bottom30">
	<div id="myCarousel" class="carousel slide">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="/img/slider/Esthers-Purim-2014.jpg" class="img-responsive" alt="Responsive image">     
        </div>
        <div class="item">
          <img src="/img/slider/Esthers-Purim-2014.jpg" class="img-responsive" alt="Responsive image">      
        </div>
        <div class="item">
          <img src="/img/slider/Esthers-Purim-2014.jpg" class="img-responsive" alt="Responsive image">
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->
	</div>
@stop

@section('content')
<div class="container">
	@if(!Advisory::enabled()->get()->isEmpty())
	  <div class="alert alert-{{ Advisory::enabled()->toArray()['level'] }} alert-dismissable fade in">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
			<i class="fa fa-times"></i>
		</button>
		{{ Advisory::enabled()->toArray()['message'] }}
	  </div>
	@endif
	  <div class="row featured-blocks bottom30">
	  
		  <div class="col-md-4 col-sm-4 featured-block">
		   <a class="img-thumbnail" href="http://preview.imithemes.com/native-church-wp/about-us/staff/"> 
			<img src="/img/test/staff3.jpg" class="img-responsive" alt="Responsive image">
			<strong class="bg-highlight">Our Pastors</strong> 
			<span class="more">Read More</span> 
		   </a>
		  </div>
		  <div class="col-md-4 col-sm-4 featured-block">
		   <a class="img-thumbnail" href="http://preview.imithemes.com/native-church-wp/about-us/staff/"> 
			<img src="/img/test/staff2.jpg" class="img-responsive" alt="Responsive image">
			<strong class="bg-highlight">New Here</strong> 
			<span class="more">Read More</span> 
		   </a>
		  </div>
		  <div class="col-md-4 col-sm-4 featured-block">
		   <a class="img-thumbnail" href="http://preview.imithemes.com/native-church-wp/about-us/staff/"> 
			<img src="/img/test/staff1.jpg" class="img-responsive" alt="Responsive image">
			<strong class="bg-highlight">Sermon Archive</strong> 
			<span class="more">Read More</span> 
		   </a>
		  </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
          <blockquote class="blockquote">
            <p>Imagine a place where  where the dress is casual, the multimedia and upbeat music touch you, the message is relevant and everything is 
              designed to help you and your family wherever you are on your spiritual journey. Hope Community Church is that place, and 
              whether as our guest or as a regular attender, we hope to see you soon!</footer>
          </blockquote>
        </div>
      </div>  
		<div class="events col-md-7 col-sm-12">
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
		<div class="audio col-md-5 col-sm-12">
      <div class="panel panel-default">
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
	</div> <!-- /container -->    
	<div class="row">
		
	</div>
	<div class="clearfix foot-content">
		<div class="container both30">
			  <div class="col-md-4 col-sm-4">
            <h4 class="footer-widget-title">About Our Church</h4>
            <div class="footerwidget1">
              <p><img src="/img/test/logo1.png" alt="Logo"></p>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis consectetur adipiscing elit. Nulla convallis egestas rhoncus</p>
            </div>
        </div>
			   <div class="col-md-4 col-sm-4">
            <h4 class="footer-widget-title">About Our Church</h4>
            <div class="footerwidget2">
              <p><img src="/img/test/logo1.png" alt="Logo"></p>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis consectetur adipiscing elit. Nulla convallis egestas rhoncus</p>
            </div>
        </div>			 
         <div class="col-md-4 col-sm-4">
            <h4 class="footer-widget-title">About Our Church</h4>
            <div class="footerwidget3">
              <p><img src="/img/test/logo1.png" alt="Logo"></p>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis consectetur adipiscing elit. Nulla convallis egestas rhoncus</p>
            </div>
        </div>
		</div>
	</div>
@stop

@section('scripts')
	<script>
      $(document).ready(function() {
         $("#myCarousel").swiperight(function() {
            $("#myCarousel").carousel('prev');
          });
         $("#myCarousel").swipeleft(function() {
            $("#myCarousel").carousel('next');
         });
      });
    </script>
@stop