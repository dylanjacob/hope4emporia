@extends('layouts.dashboard')

@section('scripts')
	<script type="text/javascript" src='//maps.google.com/maps/api/js?sensor=false'></script>
	<script src='/js/jquery.locationpicker.js'></script>
	<script src="/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="/js/timepicker.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		var start = $('#starttime').timepicker();
		$('input#dp1').datepicker({
			'format': 'yyyy-mm-dd',
			'setValue': "{{ date('Y-m-d') }}"
		});
		$('input#dp2').datepicker({
			'format': 'yyyy-mm-dd',
			'setValue': "{{ date('Y-m-d') }}"
		});
		$('.latlng').locationPicker('test');
		$('.picker-search-button[value="Search"]').hide();
	});
	</script>
@stop

@section('styles')
	<link rel="stylesheet" href="/css/datepicker.css" />
	<link rel="stylesheet" href="/css/timepicker.min.css" />
@stop

@section('content')
<script type="text/javascript">

</script>

@if (Session::has('errors'))
<div class="alert alert-danger alert-dismissable navbar navbar-fixed-top">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p class="lead text-center"><strong>Ooops!</strong> {{ Session::get('errors') }}</p>
	</div>
@endif

<div class="container">
	<div class="col-xs-6 col-xs-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-10"><h3 class="panel-title">Update Event</h3></div>

				</div>
			</div>
			<div class="panel-body">
				{{ Form::model($evnt, array('action' => array('EvntsController@update', $evnt->id), 'method' => 'put', 'class' => 'form')) }}
					<div class="form-group">
						{{ Form::text('title',null,array('placeholder' => 'Event Title', 'class' => 'form-control', 'autofocus' => '')) }}
					</div>
					<div class="form-group">
						{{ Form::text('author',null,array('placeholder' => 'Author', 'class' => 'form-control')) }}
					</div>
					<div
					<div class="row">
						<div class="form-group col-xs-8">
						{{ Form::text('location',null,array('placeholder' => 'Location', 'class' => 'form-control latlng')) }}
						</div>
						<div class="form-group col-xs-4">
							{{ Form::button('Lookup Address', array('class' => 'picker-search-button btn btn-default', 'id' => 'latlngbtn'))}}
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							{{ Form::select('event_type', Schedule::getEventTypes(), null, array('class' => 'form-control')) }}
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							{{ Form::label('starttime', 'Start Time') }}
							<div class="input-group input-append">
						   		{{ Form::text('starttime', null, array('placeholder' => 'Start Time', 'id' => 'starttime', 'class' => 'form-control')) }}
									<span class="add-on input-group-btn">
										<button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
									</span>
							</div>
					    </div>
					    <div class="form-group col-md-6">
					    	{{ Form::label('duration', "Duration (hours)")}}
					    		{{ Form::selectRange('duration', 1, 24, null, array('class' => 'form-control')) }}
					    </div>					    
					</div>
					<div class="form-group">
						{{ Form::label('enabled', 'Event Enabled')}}
						{{ Form::checkbox('enabled', true, true) }}
					</div>
				    <div class="form-group">
				    	{{ Form::textarea('description', null, array('placeholder' => 'Event Description', 'class' => 'form-control')) }}
				    </div>
				    <div class="form-group">
				    	{{ Form::label('image', 'Event Image (optional)') }}
				    	{{ Form::file('image') }}
				    </div>
				    <div class="form-group">
				    	{{ Form::submit('Update Announcement', array('class' => 'btn btn-primary')) }}
				    	<a href="{{ URL::action('EvntsController@index') }}" class="btn btn-default">Cancel</a>
				    </div>
				{{ Form::close() }}
		</div>
	</div>
</div>
@stop