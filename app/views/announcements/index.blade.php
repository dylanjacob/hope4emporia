@extends('layouts.dashboard')

@section('scripts')
<script type="text/javascript">
	var announcementId;
	function deleteAnnouncement(id) {
		$('#delete-confirm').modal();
		announcementId = id;
	}

	$(document).ready(function() {

		function getAnnouncements() {
			var result;
			$.ajax({
				url: '/a/announcements',
				type: 'GET',
				headers: 'Accept: application/json',
				dataType: 'json',
				success: function(data) {
					$.each(data, function(index, announcement) {
						result += "<tr><td>"+announcement['id']+"</td><td>"+announcement['title']+"</td><td>"+announcement['pubdate']+"</td><td>"+announcement['enabled']+"</td><td><a href=\"javascript:void(0)\" onclick=\"deleteAnnouncement('"+announcement['id']+"')\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-trash-o\"></i></a><a href=\"/a/announcements/"+announcement['id']+"\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-arrow-right\"></i></a><a href=\"/a/announcements/"+announcement['id']+"/edit\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-pencil\"></i></a></td></tr>";
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
		
		getAnnouncements();

		$('#confirm-delete').click(function() {
			$('#delete-confirm').modal('hide');
			$.ajax({
				url:'/a/announcements/'+announcementId,
				type: 'DELETE',
				success: function(data) {
				$('#result').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p id="message" class="lead text-center"><strong>Success!</strong> '+data+'</p></div>');
				
				getAnnouncements();
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
		        <p>Are you sure you want to delete this announcement?</p>
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
					<div class="col-xs-10"><h3 class="panel-title">Announcements</h3></div>
					<div class="col-xs-2">
						<a href="{{ action('AnnouncementsController@create') }}" class="btn btn-default btn-xs"><i class="fa fa-plus"></i></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Publish Date</th>
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