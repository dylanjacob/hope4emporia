@extends('layouts.dashboard')

<?php
$ApiApp = ApiApp::findOrFail($id);
?>

@section('scripts')
<script type="text/javascript">
/**
 * Function generates a random string for use in unique IDs, etc
 *
 * @param <int> n - The length of the string
 */
function randString(n)
{
    if(!n)
    {
        n = 5;
    }

    var text = '';
    var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    for(var i=0; i < n; i++)
    {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }

    return text;
}
$(document).ready(function() {

	$('#regen-secret').click(function(){
		$('#secret').val(randString(36));
	});
});
	
</script>
@stop

@section('content')
@if(Session::has('errors'))
	<div class="alert alert-danger alert-dismissable navbar navbar-fixed-top">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p class="lead text-center"><strong>Ooops!</strong> {{ $errors->first() }}</p>
	</div>
@endif

@if(Session::has('status'))
	<div class="alert alert-success alert-dismissable navbar navbar-fixed-top">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p class="lead text-center">{{ Session::get('status') }}</p>
	</div>
@endif

	<div class="container">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<h3 class="panel-title col-xs-10">Add New Application</h3>
					</div>
				</div>
				<div class="panel-body">
					<div class="col-xs-10 col-xs-offset-1">
						{{ Form::model($ApiApp, array('action' => array('AppController@update', $ApiApp->id), 'method' => 'put', 'class' => 'form-horizontal')) }}
						<div class="form-group">
							{{ Form::text('id', null, array('placeholder' => 'Application ID', 'class' => 'form-control')) }}
						</div>
						<div class="form-group">
							{{ Form::text('name', null, array('placeholder' => 'Application Name', 'class' => 'form-control')) }}
						</div>
						<div class="form-group">
							{{ Form::text('secret', null, array('id' => 'secret', 'class' => 'form-control', 'readonly' =>''))}}
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Add Application</button>
							<button type="button" id="regen-secret" class="btn btn-default">Regenerate Secret</button>
							<a href="/a/apps" class="btn btn-default">Cancel</a>
						</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop