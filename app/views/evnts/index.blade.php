@extends('layouts.dashboard')

@section('scripts')
<script type="text/javascript">
	var eventId;
	function deleteEvent(id) {
		$('#delete-confirm').modal();
		eventId = id;
	}

	$(document).ready(function() {

		function getEvents() {
			var result;
			$.ajax({
				url: '/a/events',
				type: 'GET',
				headers: 'Accept: application/json',
				dataType: 'json',
				success: function(data) {
					$.each(data, function(index, event) {
						var enabled = event['enabled'] == 1 ? "Yes" : "No";
						result += "<tr><td>"+event['id']+"</td><td>"+event['title']+"</td><td>"+enabled+"</td><td><a href=\"javascript:void(0)\" onclick=\"deleteEvent('"+event['id']+"')\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-trash-o\"></i></a><a href=\"{{ URL::action('EvntsController@index') }}/"+event['id']+"\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-arrow-right\"></i></a><a href=\"{{ URL::action('EvntsController@index')}}/"+event['id']+"/edit\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-pencil\"></i></a></td></tr>";
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
		
		getEvents();

		$('#confirm-delete').click(function() {
			$('#delete-confirm').modal('hide');
			$.ajax({
				url:'/a/events/'+eventId,
				type: 'DELETE',
				success: function(data) {
				$('#result').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p id="message" class="lead text-center"><strong>Success!</strong> '+data+'</p></div>');
				
				getEvents();
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

<div class="container">
	<div id="delete-confirm" class="modal fade">
		<div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title">Confirm</h4>
		      </div>
		      <div class="modal-body">
		        <p>Are you sure you want to delete this event?</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" id="confirm-delete" class="btn btn-danger">Delete</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	<div class="col-xs-6 col-xs-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-10"><h3 class="panel-title">Events</h3></div>
					<div class="col-xs-2">
						<a href="{{ action('EvntsController@create') }}" class="btn btn-default btn-xs"><i class="fa fa-plus"></i></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Title</th>
						<th>Enabled</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody id="list">


					
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop