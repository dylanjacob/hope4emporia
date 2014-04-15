@extends('layouts.dashboard')

<?php
	$sermon = Sermon::all();
?>

@section('scripts')
<script type="text/javascript">
	var sermonId;
	function deleteSermon(id) {
		$('#delete-confirm').modal();
		sermonId = id;
	}

	$(document).ready(function() {

		function getSermons() {
			var result;
			$.ajax({
				url: '/a/sermons',
				type: 'GET',
				headers: 'Accept: application/json',
				dataType: 'json',
				success: function(data) {
					$.each(data, function(index, sermon) {
						result += "<tr><td>"+sermon['id']+"</td><td>"+sermon['name']+"</td><td><a href=\"javascript:void(0)\" onclick=\"deleteSermon('"+sermon['id']+"')\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-trash-o\"></i></a><a href=\"/a/sermons/"+sermon['id']+"\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-arrow-right\"></i></a><a href=\"/a/sermons/"+sermon['id']+"/edit\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-pencil\"></i></a></td></tr>";
					});
				$('#list').html('');
				$('#list').html(result);
				},
				fail: function(err) {
					console.log(err);
				}
			});

			return result;
		}
		
		getSermons();

		$('#confirm-delete').click(function() {
			$('#delete-confirm').modal('hide');
			$.ajax({
				url:'/a/sermons/'+sermonId,
				type: 'DELETE',
				success: function(data) {
				$('#result').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p id="message" class="lead text-center"><strong>Success!</strong> '+data+'</p></div>');
				
				getSermons();
				},
				error: function(err) {
				$('#result #message').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p id="message" class="lead text-center"><strong>Ooops!</strong> '+err+'</p></div>');
			}});
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
	<div id="result"></div>
	<div class="container">
		<div id="delete-confirm" class="modal fade">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title">Confirm</h4>
		      </div>
		      <div class="modal-body">
		        <p>Are you sure you want to delete this sermon?</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" id="confirm-delete" class="btn btn-danger">Delete</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<h3 class="panel-title col-xs-10">Sermons</h3>
						@if(AuthLevel::resource('sermons')->canUpdate(Auth::user()->id))
						<div class="col-xs-2">
							<a href="{{ action('SermonsController@create') }}" class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i></a>
						</div>
						@endif
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<th>ID</th>
						<th>Name</th>
						<th>Actions</th>
					</thead>
					<tbody id="list">
						
					</tbody>
				</table>
			</div>
		</div>
		
	</div>
	
@stop