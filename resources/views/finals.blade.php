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

	<!-- Add Exam Modal -->
	<div id="addExamModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Add Exam Modal content-->
			<div class="modal-content">
				<div id="reservation">
					<div class="modal-header modalHeadStyle">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title modalTitle">Add Exam</h4>
					</div>
					<div class="modal-body">
						<ul>
							
							<li><label for="courseSelect">Course:&nbsp</label>
									<select class = "form-control selectpicker" data-live-search="true" id = "collegeSelect">
										<option value = "ccs">CCS</option>
										<option value = "gcoe">GCOE</option>
										<option value = "cos">COS</option>
										<option value = "rvcob">RVCOB</option>
										<option  value = "cla">CLA</option>
										<option  value = "coed">COED</option>
										<option value = "soe">SOE</option>
									</select>
							</li>
							<li><label for="courseSelect">Subject:&nbsp</label>
									<select class = "form-control selectpicker" data-live-search="true" id = "subjectSelect">
									</select>
							</li>
							<li><label for="sectionSelect">Section:&nbsp</label>
									<select class = "form-control selectpicker" data-live-search="true" id = "sectionSelect">
									</select>
							</li>
							<li><label for="takersSelect">Takers:&nbsp</label>
									<select class = "form-control selectpicker" data-live-search="true" id = "takersSelect">
									</select>
							</li>
							<li><label for="profSelect">Professor:&nbsp</label>
									<select class = "form-control selectpicker" data-live-search="true" id = "professorSelect">
									</select>
							</li>
						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default button" data-dismiss="modal" id="doneBtn">Done</button>
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
							<li><a href="/gradeconsultation">Grade Consultation</a></li>
							<li class="active"><a href="/finalexams" >Finals</a></li>
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
						<option value = "0">subject</option>
						<option value = "1">section</option>
						<option value = "2">takers</option>
						<option value = "3">professor</option>
						<option value = "4">date</option>
						<option value = "5">time</option>
						<option value = "6">room</option>
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
					<p id = "schedCtrl_subject">Subject: <span></span></p>
					<p id = "schedCtrl_section">Section: <span></span></p>
					<p id = "schedCtrl_takers">Takers: <span></span></p>
					<p id = "schedCtrl_profName">Prof Name: <span></span></p>
					<p id = "schedCtrl_profType">Prof Type: <span></span></p>
					<p id = "schedCtrl_profCollege">Prof College: <span></span></p>
					<p id = "schedCtrl_profBase">Prof Base: <span></span></p>
					<p>
						Date: <input id = "dateInput" type="date"></input>
					</p>
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
					<span style = "color:red" id = "inputWarning"></span>
					<button id = "editBtn" class="button" style = "margin-top: 30px;">Edit</button>
				</div>
				<div id = "schedCtrlFooter">
								
					<button type="button" class="btn btn-block buttonFooter"data-toggle="modal" data-target="#addExamModal">Add New Exam</button>
					
				</div>
			</div>
			<!-- ----------SCHED TABLE COLUMN---------- -->
			<div class="col-xs-9" id="schedTableCol">
				<!-- ----------SCHED TABLE---------- -->
				<div class = "table-responsive" id="schedTableContainer">
					<table class="table searchableTable" id="schedTable">
						<thead>
						  <tr>
							<th id = "subject_sort" value = "1">Subject</th>
							<th id = "section_sort" value = "1">Section</th>
							<th id = "takers_sort" value = "1">Takers</th>
							<th id = "professor_sort" value = "1">Professor</th>
							<th id = "date_sort" value = "1">Date</th>
							<th id = "time_sort" value = "1">Time</th>
							<th id = "room_sort" value = "1">Room</th>
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
	var urlGetReservations = '{{ route("get.reservations.exam") }}';
	var urlEditReservation = '{{ route("edit.reservation.exam") }}';
	var urlGetRooms = '{{ route("get.rooms") }}';
	var urlGetProfessors = '{{ route("get.professors") }}';
	var urlAddProfessor = '{{ route("add.professor") }}';
	var urlSearchReservations = '{{ route("search.reservations") }}';
	var urlSetActive = '{{ route("set.active") }}';
	var urlGetSubjects = '{{ route("get.subjects") }}';
	var urlGetSections = '{{ route("get.sections") }}';
	var urlGetTakers = '{{ route("get.takers") }}';
	var urlAddReservation = '{{ route("add.reservation.exam") }}';
</script>

<script src="{{ URL::to('js/exam_reservations.js') }}"></script>
<script src="{{ URL::to('js/rooms.js') }}"></script>
<script src="{{ URL::to('js/searching.js') }}"></script>
<script src="{{ URL::to('js/sortTable.js') }}"></script>							
