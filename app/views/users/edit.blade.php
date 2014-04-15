@extends('layouts.dashboard')

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
	$('#passwords').hide();
	$('input[name="autopass"]').click(function () {
		
		$('#passwords').slideToggle({
			'duration': 400
		});
	});
});
</script>
@stop

@section('styles')
	
@stop

@section('content')
@if (Session::has('errors'))
<div class="alert alert-danger alert-dismissable navbar navbar-fixed-top">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p class="lead text-center"><strong>Ooops!</strong> {{ $errors->first() }}</p>
	</div>
@endif

<div class="container">
	<div class="col-xs-6 col-xs-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-10"><h3 class="panel-title">Create User</h3></div>
				</div>
			</div>
			<div class="panel-body">
				{{ Form::model($user, array('action' => array('UsersController@update', $user->id), 'method' => 'put', 'class' => 'form')) }}
					<div class="form-group">
						{{ Form::text('firstName',null,array('placeholder' => 'First Name', 'class' => 'form-control', 'autofocus' => '')) }}
					</div>
					<div class="form-group">
						{{ Form::text('lastName',null,array('placeholder' => 'Last Name', 'class' => 'form-control')) }}
					</div>
					<div class="form-group">
						{{ Form::email('email',null,array('placeholder' => 'E-Mail Address', 'class' => 'form-control')) }}
					</div>
					<div class="form-group">
						{{ Form::text('username',null,array('placeholder' => 'Username', 'class' => 'form-control')) }}
					</div>
					<div class="form-group">
						{{ Form::select('role', Role::active()->dropdown(), $user->getRoleIds(), array('multiple' => '', 'class' => 'form-control')) }}
					</div>
					<div class="form-group">
						<label for="autopass">Change Password?</label>
						{{ Form::checkbox('autopass', null, false, array('id' => 'autopass')) }}
					</div>
					<div id="passwords">
						<div class="form-group">
							{{ Form::password('password', array('placeholder' => 'Password', 'class' => 'form-control')) }}
							{{ Form::password('password_confirmation', array('placeholder' => 'Confirm Password', 'class' => 'form-control')) }}
						</div>
					</div>
				    <div class="form-group">
				    	{{ Form::submit('Update User', array('class' => 'btn btn-primary')) }}
				    	<a href="{{ URL::Action('UsersController@index') }}" class="btn btn-default">Cancel</a>
				    </div>
				{{ Form::close() }}
		</div>
	</div>
</div>
@stop