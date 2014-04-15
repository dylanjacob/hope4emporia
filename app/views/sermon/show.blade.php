@extends('layouts.dashboard')

<?php
	$sermon = Sermon::find($id);
	$ext = substr($sermon->filename, strpos($sermon->filename, '.')+1, strlen($sermon->filename));
?>

@section('scripts')
<script src="/js/jquery.jplayer.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
      $("#jquery_jplayer_1").jPlayer({
        ready: function () {
          $(this).jPlayer("setMedia", {
            title: "{{ $sermon->name }}",
            {{ $ext }}: "{{ $sermon->audio_url }}"
          });
        },
        swfPath: "/js",
        supplied: "{{ $ext }}"
      });
    });
</script>
@stop

@section('styles')
<link type="text/css" href="/css/jplayer.blue.monday.css" rel="stylesheet" />
@stop


@section('content')
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-10"><h3 class="panel-title col-xs-10">{{ $sermon->name }}</h3></div>
						<div class="col-xs-2"><a href="{{ URL::action('SermonsController@index') }}" class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i></a></div>
					</div>
				</div>
				<ul class="list-group">
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-3">
								<h5>Sermon ID:</h5>
							</div>
							<div class="col-xs-9">
								<p>{{ $sermon->id }}</p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-3">
								<h5>Sermon Name:</h5>
							</div>
							<div class="col-xs-9">
								<p>{{ $sermon->name }}</p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-3">
								<h5>Sermon Author:</h5>
							</div>
							<div class="col-xs-9">
								{{ $sermon->author }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-3">
								<h5>Sermon Publish Date:</h5>
							</div>
							<div class="col-xs-9">
								{{ $sermon->pubdate }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-3">
								<h5>Sermon Filename:</h5>
							</div>
							<div class="col-xs-9">
								{{ $sermon->filename }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-3">
								<h5>Sermon Subtitle:</h5>
							</div>
							<div class="col-xs-9">
								{{ $sermon->subtitle }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-3">
								<h5>Sermon Summary:</h5>
							</div>
							<div class="col-xs-9">
								{{ $sermon->summary }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-3">
								<h5>Sermon Description:</h5>
							</div>
							<div class="col-xs-9">
								{{ $sermon->description }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-3">
								<h5>Sermon URL:</h5>
							</div>
							<div class="col-xs-9">
								{{ $sermon->audio_url }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-3">
								<h5>Sermon Detail URL:</h5>
							</div>
							<div class="col-xs-9">
								{{ $sermon->detail_url }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-3">
								<h5>Sermon Image:</h5>
							</div>
							<div class="col-xs-9">
								<img src="{{ $sermon->image_url }}" alt="sermon image" />
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-3">
								<h5>Sermon Duration:</h5>
							</div>
							<div class="col-xs-9">
								{{ $sermon->duration }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-3">
								<h5>Sermon Size:</h5>
							</div>
							<div class="col-xs-9">
								{{ $sermon->length }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-xs-3">
								<h5>Sermon Stream:</h4>
							</div>
							<div class="col-xs-9">
								<div id="jquery_jplayer_1" class="jp-jplayer"></div>
								<div id="jp_container_1" class="jp-audio">
								    <div class="jp-type-single">
								      	<div class="jp-gui jp-interface">
								        	<ul class="jp-controls">
								          		<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
												<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
												<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
												<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
												<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
												<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
								        	</ul>
								        	<div class="jp-progress">
								          		<div class="jp-seek-bar">
								            		<div class="jp-play-bar"></div>
								          		</div>
								        	</div>
								        	<div class="jp-volume-bar">
								          		<div class="jp-volume-bar-value"></div>
								        	</div>
								        	<div class="jp-time-holder">
							          			<div class="jp-current-time"></div>
							          			<div class="jp-duration"></div>
						          				<ul class="jp-toggles">
						            				<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
						            				<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
						          				</ul>
						        			</div>
							      		</div>
								      	<div class="jp-details">
								        	<ul>
								         		<li><span class="jp-title"></span></li>
								        	</ul>
								      	</div>
								      	<div class="jp-no-solution">
								        	<span>Update Required</span>
								        	To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
								    	</div>
								    </div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
@stop