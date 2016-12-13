<!DOCTYPE html>
<html lang="en">
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
	<script src="{{ URL::to('utils/jquery.searchabledropdown-1.0.8.min.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::to('utils/jquery-ui.css') }}">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->

	<!-- Latest compiled JavaScript -->
	<script type="text/javascript" src="{{ URL::to('utils/bootstrap-3.3.6-dist/js/bootstrap.min.js') }}"></script>

	<!-- bootstrap-select library -->
	<script type="text/javascript" src="{{ URL::to('utils/bootstrap-select/bootstrap-select.min.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::to('utils/bootstrap-select/bootstrap-select.min.css') }}">

	<!-- Styles -->
	<link rel="stylesheet" href="{{ URL::to('css/newView_GC_Style.css') }}">
</head>
<body>

	<!-- View Recommendation Modal -->
	<div id="viewRecModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div id="reservation">
					<div class="modal-header modalHeadStyle">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title modalTitle">Recommendations</h4>
						<h4 class="modal-title modalTitle" id="recHead"></h4>
					</div>
					<div class="modal-body">
						<table class="table searchableTable" id="toBeRecTable">
							<thead>
								<tr>
									<th class = "header_sort" id = "fTF" value = 1></th>
								</tr>
							</thead>
							<tbody id = "tobeRecList">
							</tbody>
						</table>
						<table class="table searchableTable" id="recTable">
							<thead>
								<tr>
									<th class = "header_sort" id = "tTF" value = 1>Time Taken</th>
									<th class = "header_sort" id = "profname_sort" value = 1>Taken By</th>
								</tr>
							</thead>
							<tbody id = "recommendationList">
							</tbody>
						</table>
						<table class="table searchableTable" id="roomRecTable">
							<thead>
								<tr>
									<th class = "header_sort" id = "rTF" value = 1></th>
								</tr>
							</thead>
							<tbody id = "roomRecList">
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default button" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>

		</div>
	</div>

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
							<li class="active"><a href="/gradeconsultation">Grade Consultation</a></li>
							<li><a href="/finalexams" >Finals</a></li>
							<li><a href="/proflist" >Professor List</a></li>
						</ul> 
					</div><!--/.nav-collapse -->
				</div><!--/.container-fluid -->
			</nav>
		</div>
	</div>

	<div class="container">
		<!-- ----------FIRST ROW---------- -->
		<div class="row" id="firstRow">
			&nbsp
		</div>
		<!-- ----------SECOND ROW---------- -->
		<div class="row" id="firstRow">
			<div class = "col-xs-4">
				<a class="btn btn-primary" id = "editprofbtn" href="{{ route('export') }}">Export</a>
			</div>
			<div class = "col-xs-8">
				<p style = "margin-left: -40px;">
					<input id = "searchRes" type="search" placeholder="Search..." class = "searchBar" />
					Filter by: 
					<select id = "filterSearch">
						<option value = "0">professor</option>
						<option value = "1">time</option>
						<option value = "2">room</option>
					</select>
				</p>
			</div>
		</div>
		<!-- ----------THIRD ROW---------- -->
		<div class="row" id="thirdRow">
			<!-- ----------SCHED TABLE CONTROL PANEL COL---------- -->
			<div class="col-xs-3" id = "schedCtrlCol" style = "height: 400px;">

				<div id = "schedCtrlHeader">
					<p>
						Reservations
					</p>
				</div>

				<div id = "schedCtrlBody">
					<p id = "schedCtrl_profName">Prof Name: <span></span></p>
					<p id = "schedCtrl_profType">Prof Type: <span></span></p>
					<p id = "schedCtrl_profCollege">Prof College: <span></span></p>
					<p id = "schedCtrl_profBase">Prof Base: <span></span></p>
					<p>
						Start: <input id = "startTime" type="time"></input>
					</p>
					<p>
						End : <input id = "endTime" type="time"></input>
					</p>
					<p>Room: 
						<select id = "schedCtrl_room" class = "selectpicker" data-live-search = "true">

						</select>
					</p>
					<ul>
						<button id = "recBtn" class="button" style="margin-top: 15px;">Recommendation</button>
						<span style = "color:red" id = "inputWarning"></span>
						<button id = "editBtn" class="button" style="margin-top: 15px;">Edit</button>
					</ul>
				</div>


				<div id = "schedCtrlFooter">
				</div>

			</div>


			<!-- ----------SCHED TABLE COLUMN---------- -->
			<div class="col-xs-9" id="schedTableCol">
				<!-- ----------SCHED TABLE---------- -->
				<div class = "table-responsive" id="schedTableContainer">
					<table class="table searchableTable" id="schedTable">
						<thead>
							<tr>
								<th class = "header_sort" name = "college" value = 1>College</th>
								<th class = "header_sort" id = "professor_sort" value = 1>Professor</th>
								<th class = "header_sort" id = "time_sort" value = 1>Time</th>
								<th class = "header_sort" id = "room_sort" value = 1>Room</th>
							</tr>
						</thead>
						<tbody id = "reservationList">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script>
	var urlGetReservations = '{{ route("get.reservations.gc") }}';
	var urlGetRooms = '{{ route("get.rooms") }}';
	var urlEditReservation = '{{ route("edit.reservation.gc") }}';
	var urlGetProfessors = '{{ route("get.professors") }}';
	var urlAddProfessor = '{{ route("add.professor") }}';
	var urlSearchReservations = '{{ route("search.reservations") }}';
	var urlSetActive = '{{ route("set.active") }}';
</script>

<script src="{{ URL::to('js/gc_reservations.js') }}"></script>
<script src="{{ URL::to('js/rooms.js') }}"></script>
<script src="{{ URL::to('js/searching.js') }}"></script>
<script src="{{ URL::to('js/sortTable.js') }}"></script>
