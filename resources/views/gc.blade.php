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
	
	<!-- Styles -->
	<link rel="stylesheet" href="{{ URL::to('css/newView_GC_Style.css') }}">
</head>
<body>

	<!-- Add Prof Modal -->
	<div id="addProfModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Add Prof Modal content-->
			<div class="modal-content">
				<div id="reservation">
					<div class="modal-header modalHeadStyle">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title modalTitle">Add Professor</h4>
					</div>
					<div class="modal-body">
						<ul>
							<li><textarea id = "firstName" class="profText" placeholder="First Name" ></textarea></li>
							<li><textarea id = "lastName" class="profText" placeholder="Last Name" ></textarea></li>
							<li>
								<label for = "typeOp">Type:</label>
								<div id = "typeOp">
									<form id = "typeForm">
										<label class="radio-inline"><input type="radio" name="optradio" value = "Full Time">Full Time</label>
										<label class="radio-inline"><input type="radio" name="optradio" value = "Part Time">Part Time</label>
									</form>
								</div>
							</li>
							<li><label for="collegeSelect">College:
								<select class = "form-control" id = "collegeSelect">
									<option>CCS</option>
									<option>GCOE</option>
									<option>COS</option>
									<option>RVCOB</option>
									<option>CLA</option>
									<option>COED</option>
									<option>SOE</option>
								</select>
							</li>
							<li>
								<label for = "typeOp">Base:</label>
								<div id = "typeOp">
									<form id = "baseForm">
										<label class="radio-inline"><input type="radio" name="optradio" value = "Manila">Manila</label>
										<label class="radio-inline"><input type="radio" name="optradio" value = "STC">STC</label>
									</form>
								</div>
							</li>
						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default button" id="doneBtn">Done</button>
						<button type="button" class="btn btn-default button" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>

		</div>
	</div>

	<!-- View Prof Modal -->
	<div id="viewProfModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- View Prof Modal content-->
			<div class="modal-content">	
				<div id="reservation">
					<div class="modal-header modalHeadStyle">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title modalTitle">Professor List</h4>
					</div>
					<div class="modal-body" id = "profTable">
						<table id = "profTbl" class="table table-condensed">
							<thead>
								<tr>
									<th>Firstname</th>
									<th>Lastname</th>
									<th>Type</th>
									<th>College</th>
									<th>Base</th>
									<th>Active</th>
									<th>&nbsp</th>
								</tr>
							</thead>
							<tbody id = "profList">

							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-block button" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>

		</div>
	</div>

	<!-- Import Prof Modal -->
 	<div id="importModal" class="modal fade" role="dialog">
 		<div class="modal-dialog">
 			<!-- View Prof Modal content-->
 			<div class="modal-content">
 				<div id="reservation">
 					{!! Form::open(array('url'=>route('import'),'method'=>'POST', 'files'=>true))!!}
 					 	{{ csrf_field() }}
 						<div class="modal-header modalHeadStyle">
 							<button type="button" class="close" data-dismiss="modal">&times;</button>
 							<h4 class="modal-title modalTitle">Import</h4>
 						</div>
 						<div class="modal-body">
 							<input type="file" name="importfile"/>
 						</div>
 						<div class="modal-footer">
 							<button type="submit" class="btn btn-block button">Import</button>
 							<button type="button" class="btn btn-block button" data-dismiss="modal">Close</button>
 						</div>
 					{!! Form::close() !!}
 				</div>
 			</div>
 
 		</div>
 	</div>

 	<!-- Import Prof Modal -->
 	<div id="importProfModal" class="modal fade" role="dialog">
 		<div class="modal-dialog">
 			<!-- View Prof Modal content-->
 			<div class="modal-content">
 				<div id="reservation">
 					{!! Form::open(array('url'=>route('professor.import'),'method'=>'POST', 'files'=>true))!!}
 					 	{{ csrf_field() }}
 						<div class="modal-header modalHeadStyle">
 							<button type="button" class="close" data-dismiss="modal">&times;</button>
 							<h4 class="modal-title modalTitle">Import Professors</h4>
 						</div>
 						<div class="modal-body">
 							<input type="file" name="importfile"/>
 						</div>
 						<div class="modal-footer">
 							<button type="submit" class="btn btn-block button">Import</button>
 							<button type="button" class="btn btn-block button" data-dismiss="modal">Close</button>
 						</div>
 					{!! Form::close() !!}
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
				<button type="button" class="btn btn-primary"data-toggle="modal" data-target="#importModal">Import</button>
			</div>
			<div class = "col-xs-8">
				<p style = "margin-left: -40px;">
					<input id = "searchRes" type="search" placeholder="Search Professor" class = "searchBar" />
					Filter by: 
					<select id = "filterSearch">
						<option value = "prof">professor</option>
						<option value = "room">room</option>
					</select>
				</p>
			</div>
		</div>
		<!-- ----------THIRD ROW---------- -->
		<div class="row" id="thirdRow">
			<!-- ----------SCHED TABLE CONTROL PANEL COL---------- -->
			<div class="col-xs-3" id = "schedCtrlCol">

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
						<select id = "schedCtrl_room">

						</select>
					</p>
					<span style = "color:red" id = "inputWarning"></span>
					<button id = "editBtn" class="button">Edit</button>
				</div>


				<div id = "schedCtrlFooter">
					<button type="button" class="btn btn-block buttonFooter" data-toggle="modal" data-target="#viewProfModal">View All Professors</button>				
					<button type="button" class="btn btn-block buttonFooter" data-toggle="modal" data-target="#addProfModal">Add New Professor</button>
				</div>

			</div>


			<!-- ----------SCHED TABLE COLUMN---------- -->
			<div class="col-xs-9" id="schedTableCol">
				<!-- ----------SCHED TABLE---------- -->
				<div class = "table-responsive" id="schedTableContainer">
					<table class="table" id="schedTable">
						<thead>
							<tr>
								<th id = "professor_sort" value = "0">Professor</th>
								<th id = "time_sort" value = "0">Time</th>
								<th id = "room_sort" value = "0">Room</th>
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
<script src="{{ URL::to('js/professors.js') }}"></script>
<script src="{{ URL::to('js/sortTable.js') }}"></script>
