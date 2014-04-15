@extends('layouts.master')
@section('navbar')
  <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://hope4emporia.bubblecore.net/"><img src="/img/logo/shade-header1.png"></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="http://hope4emporia.bubblecore.net/">Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">About Us<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/about">Our Church</a></li>
                <li><a href="/pastor">Our Pastor</a></li>
                <li><a href="/staff">Our Staff</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ministries<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/youth-min">Youth</a></li>
                <li><a href="/children-min">Children</a></li>
                <li><a href="/small-group">Small Group</a></li>
                <li><a href="/prayer-team">Prayer Team</a></li>
                <li><a href="/music">Music</a></li>
                <li><a href="/art">Art</a></li>
              </ul>
            </li>
            <li><a href="/sermons">Sermons</a></li>
            <li><a href="/blog">Blog</a></li>
            <li><a href="/events">Events</a></li>
            <li><a href="/announcements">Announcements</a></li>
            <li><a href="/location">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
@stop

@section('foot')
  <div id="footer">
    <div class="container">
      <div class="col-md-6 col-sm-12"><span class="glyphicon glyphicon-copyright-mark"></span> Hope Community Church</div>
      <div class="col-md-6 visible-md visible-lg text-right">
        <a href="//www.facebook.com/hopecommunitychurchemporia">
          <i class="fa fa-facebook-square fa-2x"></i>
        </a>
        <a href="//#">
          <i class="fa fa-rss-square fa-2x"></i>
        </a>
        <a href="mailto:tonleag@gmail.com">
          <i class="fa fa-envelope fa-2x"></i>
        </a>
      </div>
    </div>
  </div>
@stop