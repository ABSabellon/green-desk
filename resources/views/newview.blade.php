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
	                    {{-- <ul class="nav navbar-nav">
	                        <li><a href="#">Airsoft Store</a></li>
	                        <li><a href="#">Game Sites</a></li>
	                    </ul> --}}
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
		</div>
		<div class = "col-xs-8">
			<p style = "margin-left: -40px;">
				<input type="search" placeholder="Search Professor" class = "searchBar" />
				Filter by: 
				<select>
					<option value = "prof">professor</option>
					<option value = "time">time</option>
					<option value = "room">room</option>
				</select>
			</p>
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
					<button id = "editBtn" class="button">Edit</button>
				</div>

				<div id = "inputWarning" class="alert alert-warning">
					<strong>Warning!</strong>
				</div>

				<div id = "schedCtrlFooter">
					<button type="button" class="btn btn-block buttonFooter"data-toggle="modal" data-target="#viewProfModal">View All Professors</button>				
					<button type="button" class="btn btn-block buttonFooter"data-toggle="modal" data-target="#addProfModal">Add New Professor</button>
				</div>
				
			</div>


			<!-- ----------SCHED TABLE COLUMN---------- -->
			<div class="col-xs-9" id="schedTableCol">
				<!-- ----------SCHED TABLE---------- -->
				<div class = "table-responsive" id="schedTableContainer">
					<table class="table" id="schedTable">
						<thead>
						  <tr>
							<th>Professor</th>
							<th>Time</th>
							<th>Room</th>
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
	var urlGetReservations = '{{ route("get.reservations") }}';
	var urlGetRooms = '{{ route("get.rooms") }}';
	var urlEditReservation = '{{ route("edit.reservation") }}';
	var urlGetProfessors = '{{ route("get.professors") }}';
	var urlAddProfessor = '{{ route("add.professor") }}';

	$(document).on('click', 'table .resrows', function(){
		$('#inputWarning').hide();
		$("table tr").css("background", "#FFF");
		$("table tr").css("color", "#000");
		$(this).css("background", "#00d771");
		$(this).css("color", "#FFF");

		resIndex = $('#schedTable tr').index(this) - 1;
		var reserveeName = reservees[resIndex].first_name +' '+ reservees[resIndex].middle_name +' '+ reservees[resIndex].last_name;
		
		$('#schedCtrl_profName > span').html(reserveeName);
		$('#schedCtrl_profType > span').html(reservees[resIndex].professor_status);
		$('#schedCtrl_profBase > span').html(reservees[resIndex].professor_base);
		$('#schedCtrl_profCollege > span').html(reservees[resIndex].professor_college);
		$('#startTime').val(reservations[resIndex].time_start);
		$('#endTime').val(reservations[resIndex].time_end);

		$('#schedCtrl_room').val(rooms[resIndex]);

		if(reservations[resIndex].time_start == null) {
			$('#editBtn').text('Create');
		} else {
			$('#editBtn').text('Edit');
		}

	});
</script>
								
<script type="text/javascript">
	var reservations;
	var reservees;
	var reserveeTypes;
	var rooms;
	var resIndex;


	$(document).ready(function(){
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    $('#inputWarning').hide();
		retrieveReservations(null);
		retrieveRooms(null);
		retrieveProfessors(null);
	});

	function retrieveReservations(filter) {
		$.ajax({
			method: 'GET',
			url: urlGetReservations,
			data: {filter:filter}
		})
		.done( function(msg) {
			reservations = msg.reservations;
			reservees = msg.reservees;
			reserveeTypes = msg.reserveeTypes;
			rooms = msg.rooms;
			refreshReservations(msg.reservations, msg.reservees, msg.rooms);
		});
	}

	function refreshReservations(reservations, reservees, rooms) {
		$('#reservationList').empty();
		var table = $('#schedTable > tbody');
		for (var i = 0; i < reservations.length; i++) {
			var type = (reservations[i].exam_id == null) ? 'Grade Consultation':'Exam';
			var reserveeName = reservees[i].first_name +' '+ reservees[i].middle_name +' '+ reservees[i].last_name;
			var toAppend = '<tr class = "resrows"><td>' +reserveeName+ '</td>'
			if(reservations[i].time_start == null) {
				toAppend = toAppend + '<td>No reservation yet</td><td></td></tr>'
			} else {
				toAppend = toAppend + '<td><time datetime="' +reservations[i].time_start+ '">' +reservations[i].time_start+ '</time>-<time datetime="' +reservations[i].time_end+ '">' +reservations[i].time_end+ '</time></td><td>' +rooms[i]+ '</td></tr>'
			}				
			table.append(toAppend);
		}
	}

	function retrieveRooms(filter){
		$.ajax({
			method: 'GET',
			url: urlGetRooms,
			data: {filter:filter}
		})
		.done( function(msg) {
			refreshRooms(msg.rooms)
		});
	}

	function refreshRooms(rooms) {
		var roomList = $('#schedCtrl_room');
		roomList.empty();
		for (var i = 0; i < rooms.length; i++) {
			roomList.append(
				'<option>' +rooms[i].room_no+ '</option>'
			)
		}
	}

	$('#editBtn').on('click', function() {
		checkReservation();
	})

	function checkReservation() {
		var diff = (( new Date('2016-1-1 '+ $('#endTime').val())) - new Date('2016-1-1 '+$('#startTime').val())) / 1000 / 60 / 60;
		if(diff > 1) {
			$('#inputWarning').text('You can only reserve for a maximum of 1 hour!');
			$('#inputWarning').show();
		} else if(diff < 0) {
			$('#inputWarning').text('Your start time cannot be later than your end time!');
			$('#inputWarning').show();
		} else if(resIndex == null) {
			$('#inputWarning').text('Please choose a reservation');
			$('#inputWarning').show();
		} else {
			editReservation();
		}
	}

	function editReservation() {
		console.log('edit');
		var startTime = $('#startTime').val();
		var endTime = $('#endTime').val();
		var room = $('#schedCtrl_room').val();

		$.ajax({
			method: 'POST',
			url: urlEditReservation,
			data: {index: resIndex+1, startTime:startTime, endTime: endTime, room:room}
		})
		.done( function(msg) {
			// var rows = $('tr', '#schedTable');
			// var timeTd = rows.eq(resIndex+1).find('td').eq(1);
			// var roomTd = rows.eq(resIndex+1).find('td').eq(2);
			// timeTd.empty();
			// roomTd.empty();

			// timeTd.append('<td><time datetime="' +startTime+ '">' +startTime+ '</time>-<time datetime="' +endTime+ '">' +endTime+ '</time></td>');
			// roomTd.append('<td>' +room+ '</td></tr>');
			retrieveReservations(null);
		});
	}

	function retrieveProfessors(filter) {
		$.ajax({
			method: 'GET',
			url: urlGetProfessors,
			data: {filter:filter}
		})
		.done( function(msg) {
			refreshProfessors(msg.reservees);
		});
	}

	function refreshProfessors(profs) {
		$('#profList').empty();
		var table = $('#profTbl > tbody');
		for (var i = 0; i < profs.length; i++) {
			table.append('<tr>'+
							'<td>'+profs[i].first_name+'</td>' +
							'<td>'+profs[i].last_name+'</td>' +
							'<td>'+profs[i].professor_status+'</td>' +
							'<td>'+profs[i].professor_college+'</td>' +
							'<td>'+profs[i].professor_base+'</td>' +
							'<td>' +
								'<label class="switch">' +
								  '<input type="checkbox">' +
								  '<div class="slider round"></div>' +
								'</label>' +
							'</td>' +
						  '</tr>');
		}
		
	}

	$('#doneBtn').on('click', function() {
		addReservee();
		$('#addProfModal').modal('toggle');
	});

	function addReservee() {
		var firstName = $('#firstName').val();
		var lastName = $('#lastName').val();
		var profType = $('input[name=optradio]:checked', '#typeForm').val();
		var college = $('#collegeSelect').val();
		var profBase = $('input[name=optradio]:checked', '#baseForm').val();
		
		$.ajax({
			method: 'POST',
			url: urlAddProfessor,
			data: {firstName:firstName, lastName:lastName, profType:profType, college:college, profBase:profBase}
		})
		.done( function(msg) {
			retrieveProfessors(null);
			retrieveReservations(null);
		});
	}

</script>						
								
								
