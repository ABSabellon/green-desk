<html>

<head>
	<title>
		Green Desk
	</title>
	<!-- Token used to verify ajax requests -->
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="{{ URL::to('utils/bootstrap-3.3.6-dist/css/bootstrap.min.css') }}">
	<!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->

	<!-- jQuery library -->
	<script type="text/javascript" src="{{ URL::to('utils/jquery.min.js') }}"></script>
	<script src="{{ URL::to('utils/jquery-ui.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::to('utils/jquery-ui.css') }}">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->

	<!-- Latest compiled JavaScript -->
	<script type="text/javascript" src="{{ URL::to('utils/bootstrap-3.3.6-dist/js/bootstrap.min.js') }}"></script>
	
	<!-- Styles -->
	<link rel="stylesheet" href="{{ URL::to('css/newView_GC_Style.css') }}">
	
</head>

<body>

	<!-- Add Room Modal -->
	<div id="addRoomModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Add Room Modal content-->
			<div class="modal-content">
				<div id="reservation">
					<div class="modal-header modalHeadStyle">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title modalTitle">Add Room</h4>
					</div>
					<div class="modal-body">
						<ul>
							<li><textarea id = "roomName" class="roomText" placeholder="Room Name" required></textarea></li>
							<li><textarea id = "roomType" class="roomText" placeholder="Room Type" required></textarea></li>
							<li>
								<label for = "typeOp">Floor:</label>
								<div id = "typeOp">
									<form id = "typeForm">
										<label class="radio-inline"><input type="radio" name="floorradio" value = "4">4</label>
										<label class="radio-inline"><input type="radio" name="floorradio" value = "3">3</label>
										<label class="radio-inline"><input type="radio" name="floorradio" value = "2">2</label>
										<label class="radio-inline"><input type="radio" name="floorradio" value = "1">G</label>
										<label class="radio-inline"><input type="radio" name="floorradio" value = "0">B</label>
									</form>
								</div>
							</li>
						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default button" id="doneRoomBtn">Done</button>
						<button type="button" class="btn btn-default button" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- DELETE ROOM CONFIRMATION MODAL -->
	<!-- delete Room Modal -->
	<div id="deleteRoomModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
			<!-- Add Room Modal content-->
			<div class="modal-content">
				<div id="reservation">
					<div class="modal-header modalHeadStyle">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title modalTitle">Are you sure you want to delete this entry?</h4>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger button" id="deleteRoomConfirmBtn">Delete</button>
						<button type="button" class="btn btn-default button" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>

		</div>
	</div>

	<!-- ----------NAVBAR---------- -->
	<!-- ----------MAIN CONTAINER----------- -->
	<div class="container-fluid">
		<div class="row">
			<!-- ----------TOOLBAR---------- -->
			<nav class="navbar navbar-default" id = "toolbar">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="/" id="toolTitle">
							Green Desk
						</a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a href="/gradeconsultation">Grade Consultation</a></li>
							<!-- <li><a href="/finalexams" >Finals</a></li> -->
							<li><a href="/proflist" >Professor List</a></li>
							<li class="active"><a href="/roomlist" >Rooms</a></li>
						</ul> 
					</div><!--/.nav-collapse -->
				</div><!--/.container-fluid -->
			</nav>
		</div>
	</div>

	<div class="row" id="firstRow">
		<div class = "col-xs-4">
		</div>
		<div class = "col-xs-8">
			<p style = "margin-left: -40px;">
				<input id = "searchRes" type="search" placeholder="Search..." class = "searchBar" />
				Filter by: 
				<select id = "filterSearch">
					<option value = "0">Room</option>
					<option value = "1">Floor</option>
					<option value = "2">Room Type</option>
				</select>
			</p>
		</div>
	</div>

	<br/>

	<div id="viewRoomModal" class="panel panel-default">
		<div id="reservation">
			<div class="panel-heading">
				<h2 class="modal-title modalTitle">Room List</h2>
			</div>
			<div class="panel-body" id = "roomTable">
				<table id = "roomTbl" class="table table-condensed searchableTable">
					<thead>
						<tr>
							<th>Room</th>
							<th>Floor</th>
							<th>Room Type</th>
							<th>Status</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody id = "roomList">
					
					</tbody>
				</table>
			</div>
			<div class="panel-footer">
				<button type="button" class="btn button" data-toggle="modal" data-target="#addRoomModal">Add New Room</button>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	var urlGetRooms = '{{ route("get.rooms") }}';
	var urlAddRoom = '{{ route("add.room") }}';
	var urlSetActiveRoom = '{{ route("set.activeRoom") }}';
	var urlEditRoom = '{{ route("edit.room") }}';
	var urlDeleteRoom = '{{ route("delete.room") }}';

$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#inputWarning').hide();	
	retrieveRooms(null);
});

</script>
<script src="{{ URL::to('js/rooms.js') }}"></script>
<script src="{{ URL::to('js/searching.js') }}"></script>
