@extends('layouts.dashboard')

@section('scripts')
	<script type="text/javascript" src='//maps.google.com/maps/api/js?sensor=false'></script>
	<script src='/js/jquery.locationpicker.js'></script>
	<script src="/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="/js/timepicker.min.js"></script>
	<script type="text/javascript">
	
	$(document).ready(function() {
		$('#recurrence').hide()
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

		$('#eventType').change(function() {
			if ($('#eventType').val() != 0) {
				$('#recurrence').show();
			} else {
				$('#recurrence').hide();
			}
		});
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
					<div class="col-xs-10"><h3 class="panel-title">Create Event</h3></div>

				</div>
			</div>
			<div class="panel-body">
				{{ Form::open(array('action' => 'EvntsController@store', 'method' => 'post', 'class' => 'form')) }}
					<div class="form-group">
						{{ Form::text('title',null,array('placeholder' => 'Event Title', 'class' => 'form-control', 'autofocus' => '')) }}
					</div>
					<div class="form-group">
						{{ Form::text('author',null,array('placeholder' => 'Author', 'class' => 'form-control')) }}
					</div>
					<!--<div class="row">-->
					<div class="form-group row">
						<div class="col-xs-8">
							{{ Form::text('location',null,array('placeholder' => 'Location', 'class' => 'form-control latlng col-xs-8')) }}
						</div>
						<div class="col-xs-4">
							{{ Form::button('Lookup Address', array('class' => 'picker-search-button btn btn-default pull-right', 'id' => 'latlngbtn'))}}
						</div>
					</div>
					<hr></hr>
					<div class="form-group row">
						<div class="col-md-6">
							{{ Form::label('starttime', 'Start Time') }}
							<div class="input-group input-append">
					   			{{ Form::text('starttime', null, array('placeholder' => 'Start Time', 'id' => 'starttime', 'class' => 'form-control')) }}
									<span class="add-on input-group-btn">
										<button type="button" class="btn btn-default"><i class="fa fa-clock-o"></i></button>
									</span>
							</div>
				    	</div>
						<div class="col-md-6">
							{{ Form::label('start_date', 'Start Date')}}
							{{ Form::text('start_date', date('Y-m-d'), array('class' => 'form-control', 'id' => 'dp1')) }}
						</div>
						
					</div>
					<div class="form-group row">
				    	<div class="col-md-6">
				    		{{ Form::label('duration', "Duration (hours)")}}
				    		{{ Form::selectRange('duration', 1, 24, null, array('class' => 'form-control')) }}
				    	</div>
				    	<div class="col-md-6">
							{{ Form::label('day_of_week', 'Day of Week') }}
							{{ Form::select('day_of_week', Schedule::getDaysOfWeek(), date('w'), array('class' => 'form-control')) }}
						</div>
				    </div>					    
					
					<div class="form-group row">
						<div class="col-md-6">
							{{ Form::label('event_type', 'Event Type') }}
							{{ Form::select('event_type', Schedule::getEventTypes(), null, array('class' => 'form-control', 'id' => 'eventType')) }}
						</div>
						<div class="col-md-6">
							
						</div>
					</div>
					<div id="recurrence">
						<div class="form-group row">
							<div class="col-md-6">
								{{ Form::text('end_date', null, array('placeholder' => 'End Date', 'class' => 'form-control', 'id' => 'dp2')) }}
							</div>
							<div class="col-md-6">
								{{ Form::text('number_of_occurrences', null, array('placeholder' => 'Number of Occurrences', 'class' => 'form-control')) }}
							</div>
						</div>
					</div>
					
					<hr></hr>
					<div class="form-group">
						{{ Form::label('enabled', 'Event Enabled')}}
						{{ Form::checkbox('enabled', null, true) }}
					</div>
				    <div class="form-group">
				    	{{ Form::textarea('description', null, array('placeholder' => 'Event Description', 'class' => 'form-control')) }}
				    </div>
				    <div class="form-group">
				    	{{ Form::label('image', 'Event Image (optional)') }}
				    	{{ Form::file('image') }}
				    </div>
				    <div class="form-group">
				    	{{ Form::submit('Create Event', array('class' => 'btn btn-primary')) }}
				    	<a href="{{ URL::action('EvntsController@index') }}" class="btn btn-default">Cancel</a>
				    </div>
				{{ Form::close() }}
		</div>
	</div>
</div>
@stop