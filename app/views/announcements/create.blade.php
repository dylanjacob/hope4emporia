@extends('layouts.dashboard')

@section('scripts')
	<script src="/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('input#dp1').datepicker({
			'format': 'yyyy-mm-dd',
			'setValue': "{{ date('Y-m-d') }}"
		});
		$('input#dp2').datepicker({
			'format': 'yyyy-mm-dd',
			'setValue': "{{ date('Y-m-d', strtotime(date('Y-m-d'). '+ 30 days')) }}"
		});
	});
	</script>
@stop

@section('styles')
	<link rel="stylesheet" href="/css/datepicker.css" />
@stop

@section('content')
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
					<div class="col-xs-10"><h3 class="panel-title">Create Announcement</h3></div>

				</div>
			</div>
			<div class="panel-body">
				{{ Form::open(array('action' => 'AnnouncementsController@store', 'method' => 'post', 'class' => 'form')) }}
					<div class="form-group">
						{{ Form::text('title',null,array('placeholder' => 'Announcement Title', 'class' => 'form-control', 'autofocus' => '')) }}
					</div>
					<div class="form-group">
						{{ Form::text('author',null,array('placeholder' => 'Author', 'class' => 'form-control')) }}
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							{{ Form::label('pubdate', 'Publish Date') }}
						    <input id="dp1" name="pubdate" class="form-control" type="text" value="{{ date('Y-m-d') }}"></input>	
					    </div>
					    <div class="form-group col-md-6">
					    	{{ Form::label('enddate', "Expire Date (default: 30 days)")}}
					    	<input id="dp2" name="enddate" class="form-control" type="text" value="{{ date('Y-m-d', strtotime(date('Y-m-d'). '+ 30 days')) }}"></input>				    
					    </div>
					    
					</div>
					<div class="form-group">
						{{ Form::label('enabled', 'Announcement Enabled')}}
						{{ Form::checkbox('enabled', null, true, array('class' => 'form-control')) }}
					</div>
				    <div class="form-group">
				    	{{ Form::textarea('body', null, array('placeholder' => 'Announcement Body', 'class' => 'form-control')) }}
				    </div>
				    <div class="form-group">
				    	{{ Form::submit('Create Announcement', array('class' => 'btn btn-primary')) }}
				    	<a href="{{ URL::action('AnnouncementsController@index') }}" class="btn btn-default">Cancel</a>
				    </div>
				{{ Form::close() }}
		</div>
	</div>
</div>
@stop