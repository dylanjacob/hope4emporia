@extends('layouts.master')
<?php
$user = Auth::user();
?>

@section('scripts')

@stop

@section('navbar')
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">HCC</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        @if(Request::segment(1) == "admin")
        <li class="active">
        @else
        <li>
        @endif
          <a href="/a">Home</a>
        </li>
        @if(AuthLevel::resource("announcements")->canQuery(Auth::user()->id))
          @if(Request::segment(1) == "announcements")
          <li class="active">
          @else
          <li>
          @endif
            <a href="/a/announcements">Announcements</a>
          </li>
        @endif
        @if(AuthLevel::resource("posts")->canQuery(Auth::user()->id))
          @if(Request::segment(1) == "posts")
          <li class="active">
          @else
          <li>
          @endif
            <a href="/a/posts">Blog</a>
          </li>
        @endif
        @if(AuthLevel::resource("events")->canQuery(Auth::user()->id))
          @if(Request::segment(1) == "events")
          <li class="active">
          @else
          <li>
          @endif
            <a href="/a/events">Events</a>
          </li>
        @endif
        @if(AuthLevel::resource("sermons")->canQuery(Auth::user()->id))
          @if(Request::segment(1) == "sermon")
          <li class="active">
          @else
          <li>
          @endif
            <a href="/a/sermons">Sermons</a>
          </li>
        @endif
        
        @if(Auth::user()->isAdmin())
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
          <ul class="dropdown-menu">
            @if(Request::segment(1) == "users" && AuthLevel::resource("users")->canQuery(Auth::user()->id)) 
            <li class="active">
            @else
            <li>
            @endif
              <a href="/a/users">Users</a>
            </li>
            @if(Request::segment(1) == "roles"  && AuthLevel::resource("roles")->canQuery(Auth::user()->id))
            <li class="active">
            @else
            <li>
            @endif
              <a href="/a/roles">Roles</a>
            </li>
            @if(Request::segment(1) == "advisories" && AuthLevel::resource("advisories")->canQuery(Auth::user()->id))
            <li class="active">
            @else
            <li>
            @endif
              <a href="/a/advisories">Advisories</a>
            </li>
            @if(Request::segment(1) == "authlevels" && AuthLevel::resource("authlevels")->canQuery(Auth::user()->id))
            <li class="active">
            @else
            <li>
            @endif
              <a href="/a/authlevels">Auth Levels</a>
            </li>
            @if(Request::segment(1) == "apps" && AuthLevel::resource("apps")->canQuery(Auth::user()->id))
              <li class="active">
              @else
              <li>
              @endif
                <a href="/a/apps">Applications</a>
              </li>
          </ul>
        </li>
        @endif
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><div class="navbar-text">Welcome {{ $user->firstName }}</div></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="/auth/logout">Logout</a></li>
            <li><a href="#">Account Settings</a></li>

          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

@stop