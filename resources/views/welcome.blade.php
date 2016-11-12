<!DOCTYPE html>
<html lang="en">
<head>
	<title>
		Green Desk
	</title>
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
	<link rel="stylesheet" href="{{ URL::to('css/mainViewStyle.css') }}">
	
	<!-- Scripts -->
	<script src = "{{ URL::to('js/calendar.js') }}"></script>
	<script src = "{{ URL::to('js/resEdit.js') }}"></script>
</head>
<body>
	
	<!-- Reservation Modal -->
	<div id="resModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Reservation Modal content-->
			<div class="modal-content">
				<div id="reservation">
					<div class="modal-header modalHeadStyle">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title modalTitle">*Reservation Name*</h4>
					</div>
					<div class="modal-body">
						<ul>
							<li><textarea class="profText" placeholder="Time" disabled></textarea></li>
							<li><textarea class="profText" placeholder="Event Type" disabled></textarea></li>
							<li><textarea class="profText" placeholder="Reservee" disabled></textarea></li>
							<li><textarea class="profText" placeholder="Description" id="modalDesc" disabled></textarea></li>
							<li><textarea class="profText" placeholder="Notes and Comments" id="modalNotes" disabled></textarea></li>
						</ul>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default button" id="editBtn">Edit</button>
						<button type="button" class="btn btn-default button" >Cancel</button>
						<button type="button" class="btn btn-default button" data-dismiss="modal">Close</button>

					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- AddModalTabbing Script -->
	<script type="text/javascript">
	
	function openTab(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
	</script>
	<!-- Add Modal -->
	<div id="addModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Add Modal content-->
			<div class="modal-content">
				<div id="add">
					<div class="modal-header modalHeadStyle">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title modalTitle">Add Reservation</h4>
					</div>
					<div class="modal-body">
						
						<ul>
								<li><p>Start Time: <input id = "timeStart" type = "time" value = "07:30"></input></p></li>
								<li><p>End Time : <input id = "timeEnd" type = "time" value = "17:45"></input></p></li>
								<li><textarea id = "firstName" class="addText" placeholder="First Name"></textarea></li>
								<li><textarea id = "lastName" class="addText" placeholder="Last Name"></textarea></li>
								<li style = "margin-bottom: 5px;">Patron: 
									<select id = "patron">
										<option value="fullTimeProf">Full Time Prof</option>
										<option value="partTimeProf">Part Time Prof</option>
										<option value="student">Student</option>
										<option value="staff">Staff</option>
										<option value="others">Others</option>
									</select>
								</li>
								<li><textarea id = "eventName" class="addText" placeholder="Event Name" ></textarea></li>						
								<li><textarea id = "description" class="addText" placeholder="Description" id="modalDesc" ></textarea></li>
								<li><textarea id = "notes" class="addText" placeholder="Notes and Comments" id="modalNotes" ></textarea></li>
						</ul>
						<ul class="tab">
							<li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'Event')" id = "open">Event</a></li>
							<li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'Exam')">Exam</a></li>
						</ul>						
						<div id="Event" class="tabcontent">
							<ul>
								<li><textarea id = "eventType" class="addText" placeholder="Event Type" ></textarea></li>								
							</ul>
						</div>
						
						<div id="Exam" class="tabcontent">
							<ul>
								<li><textarea id = "examType" class="addText" placeholder="Exam Type" ></textarea></li>
								<li><textarea id = "section" class="addText" placeholder="Section" ></textarea></li>
								<li><textarea id = "subject" class="addText" placeholder="Subject" ></textarea></li>
							</ul>
						</div>
						<script>document.getElementById("open").click();</script>
					</div>
					<div class="modal-footer">
					
						<button type="button" class="btn btn-default button" data-dismiss="modal" onclick="refreshReservations()">Done</button>
						<button type="button" class="btn btn-default button" data-dismiss="modal">Close</button>

					</div>
				</div>
			</div>

		</div>
	</div>

	<!-- ----------MAIN CONTAINER----------- -->
	<div class="container">
		<!-- ----------TOOLBAR---------- -->
		<div class="row">
			<div class="col-md-12" id = "toolbar">
				<ul class="nav nav-pills">
				<!--
					<li><a data-toggle="modal" data-target="#diceModal" class = "toolBarItem"></a></li>
					<li><a data-toggle="modal" data-target="#loreModal" class = "toolBarItem">Lore</a></li>
					<li><a href="LobbyProf.html" href="#" class = "toolBarItem" onClick = "leaveMsg()">Leave</a></li> 
				-->
			</ul>
			<p id = "toolTitle">
				Green Desk
			</p>
		</div>
	</div>
	<!-- ----------FIRST ROW---------- -->
	<div class="row">
		<!-- -----------FLOORS---------- -->
		<div class="col-md-3 firstRow" id="floorsDiv">
			<select>
				<option value="B">Basement</option>
				<option value="G">Ground</option>
				<option value="2">Second Floor</option>
				<option value="3">Third Floor</option>
				<option value="4">Fourth Floor</option>
				<option value="5">Fifth Floor</option>
			</select>
		</div>
		<!-- -----------ROOM_FILTERS---------- -->
		<div class="col-md-6 firstRow" id="roomFilterDiv">
			<select class = "div-toggle" data-target=".view">
				<option value="building"	data-show=".building_view">Building View</option>
				<option value="list"		data-show=".list_view">List View</option>
			</select>
		</div>
		<!-- -----------RESERVATION_FILTERS---------- -->
		<div class="col-md-3 firstRow" id="reservationFilterDiv">
		</div>
	</div>

	<!-- ----------SECOND ROW---------- -->
	<div class="row">
		<!-- -----------CALENDAR---------- -->
		<div class="col-md-3 secondRow" id="calendarDiv">
			
			<script type="text/javascript">
				$( function() {
					$( "#datepicker,#defaultPopup,#defaultInline" ).datepicker({
						dateFormat: "yy-mm-dd",
						yearRange: "-100:+0",
						showOtherMonths: true,
						changeMonth: true,
						changeYear: true
					});
					$( "#datepicker" ).datepicker( "option", "showAnim", "slideDown" );
				} );
			</script>
			<div id="datepicker"></div>
		</div>
		<div class="view">
			<!-- -----------ROOM_LIST---------- -->
			<div class="col-md-6 secondRow list_view hide" id="roomListDiv">
				<!-- -----------ROOM LIST HEADER---------- -->
				<div class="row" id="roomListHeader">Rooms:</div>
				<!-- -----------ROOM LIST BODY---------- -->
				<div><input type="search" placeholder="Search Room" class = "searchBar"></textarea></div>
				<div id="rmListDiv">
					<ul class="nav nav-pills nav-stacked roomList" id="room_list">
						<li class="roomListItem"><a id = "MRW304" href = "#" onclick = "getSelectedRoom(this.id);"><div class = "roomName">MRW403</div><div class = "roomType">classroom</div></a></li>
						<li class="roomListItem"><a href = "#"><div class = "roomName">MRW404</div><div class = "roomType">classroom</div></a></li>
						<li class="roomListItem"><a href = "#"><div class = "roomName">MRW410</div><div class = "roomType">dance room</div></a></li>
						<li class="roomListItem"><a href = "#"><div class = "roomName">MRW411</div><div class = "roomType">classroom</div></a></li>
						<li class="roomListItem"><a href = "#"><div class = "roomName">MRW412</div><div class = "roomType">classroom</div></a></li>
						<li class="roomListItem"><a href = "#"><div class = "roomName">MRW413</div><div class = "roomType">classroom</div></a></li>
						<li class="roomListItem"><a href = "#"><div class = "roomName">MRW414</div><div class = "roomType">classroom</div></a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-6 secondRow building_view hide">
				<img src = "MDR.png" style="max-width:100%; max-height:100%;"> 
				</div>

			</div>
			<!-- -----------RESERVATIONS---------- -->
			<div class="col-md-3 secondRow" id="resDiv">

				<div id = "resHeader">
					<p>
						Reservations
					</p>
				</div>
				<div><input type="search" placeholder="Search Reservation" class = "row searchBar" style = "margin-left: 1px;"></input></div>
				<div id = "resBody">

					<!-- -----------RESERVATION ITEM LIST---------- -->
					<ul class="nav nav-pills nav-stacked resList" id="reservationList">
						<!-- -----------RESERVATION ITEMS---------- -->
						<li class="eListItem"><a data-toggle="modal" data-target="#resModal"><div class = "row eListItemHead"><div class = "col-md-6 resItemName">EventName</div>
							<div class = "col-md-6 resItemType">EventType</div></div>
							<div class="row eListItemBody"><div class="col-md-12"><p class = "resItemTime">1000-1045</p>
								<p class = "resItemPerson">by Reservee</p></div></div></a>
						</li>

						<li class="eListItem"><a data-toggle="modal" data-target="#resModal"><div class = "row eListItemHead"><div class = "col-md-6 resItemName">EventName</div>
							<div class = "col-md-6 resItemType">EventType</div></div>
							<div class="row eListItemBody"><div class="col-md-12"><p class = "resItemTime">1000-1045</p>
								<p class = "resItemPerson">by Reservee</p></div></div></a>
						</li>

						<li class="eListItem"><a data-toggle="modal" data-target="#resModal"><div class = "row eListItemHead"><div class = "col-md-6 resItemName">EventName</div>
							<div class = "col-md-6 resItemType">EventType</div></div>
							<div class="row eListItemBody"><div class="col-md-12"><p class = "resItemTime">1000-1045</p>
								<p class = "resItemPerson">by Reservee</p></div></div></a>
						</li>

						<li class="eListItem"><a data-toggle="modal" data-target="#resModal"><div class = "row eListItemHead"><div class = "col-md-6 resItemName">EventName</div>
							<div class = "col-md-6 resItemType">EventType</div></div>
							<div class="row eListItemBody"><div class="col-md-12"><p class = "resItemTime">1000-1045</p>
								<p class = "resItemPerson">by Reservee</p></div></div></a>
						</li>

					</ul>
				</div>
				<button type="button" class="btn btn-block" id = "AddBtn" data-toggle="modal" data-target="#addModal"><div class = "row eListItemHead">Add Reservation</button></div>
			</div>

	</div>
	</body>
</html>
<script type="text/javascript">
	var token = "{{ Session::token() }}";
	var selectedRoom;

	$(document).on('change', '.div-toggle', function() {
		var target = $(this).data('target');
		var show = $("option:selected", this).data('show');
		$(target).children().addClass('hide');
		$(show).removeClass('hide');
	});
	$(document).ready(function(){
		$('.div-toggle').trigger('change');
		refreshRooms();
	});

	function getSelectedRoom(roomName) {
		selectedRoom = roomName;
	}

</script>

<script type="text/javascript">
	var urlAdd = "{{ route('add.reservation') }}";

	function refreshReservations(){
		var date = $('#datepicker').val();
		var sTime = $('#timeStart').val();
		var eTime = $('#timeEnd').val();
		var firstName = $('#firstName').val();
		var lastName = $('#lastName').val();
		var patron = $('#patron').find(":selected").text();
		var eventName = $('#eventName').val();
		var description = $('#description').val();
		var notes = $('#notes').val();
		var is_Exam = $('#Exam').is(":visible");

		if(is_Exam) {
			var eventType = null;
			var examType = $('#examType').val();
			var subject = $('#subject').val();
			var section = $('#section').val();
		} else {
			var eventType = $('#eventType').val();
			var examType = null;
			var subject = null;
			var section = null;
		}

		$.ajax({
			method: 'POST',
			url: urlAdd,
			data: {token: token, startTime: sTime, endTime: eTime, firstName:firstName, lastName:lastName, patron:patron, 
				eventName:eventName, description:description, notes:notes, isExam:is_Exam, eventType:eventType, examType:examType, 
				section:section, subject:subject, date:date, room:selectedRoom}
		})
		.done( function(msg) {
			var resList = $('#reservationList');
			resList.empty();
			for (var i = 0; i < msg.length; i++) {
				resList.append(
					'<li class="eListItem"><a data-toggle="modal" data-target="#resModal"><div class = "row eListItemHead"><div class = "col-md-6 resItemName">'+
					msg[i].name
					+'</div><div class = "col-md-6 resItemType">'+
					msg[i].type
					+'</div></div><div class="row eListItemBody"><div class="col-md-12"><p class = "resItemTime">'+
					msg[i].time
					+'</p><p class = "resItemPerson">by '+
					msg[i].reservation
					+'</p></div></div></a></li>'
				)
			}
		});
	}

</script>

<script type="text/javascript">
	var urlGetRooms = "{{ route('get.rooms') }}"

	function refreshRooms(){
		$.ajax({
			method: 'GET',
			url: urlGetRooms + '?_token=' + token,
			data: {}
		})
		.done( function(msg) {
			var roomList = $('#room_list');
			$('#room_list').empty();
			for (var i = 0; i < msg.rooms.length; i++) {
				roomList.append(
					'<li class="roomListItem"><a id = "'+ msg.rooms[i].room_no +'" href = "#" onclick = "getSelectedRoom(this.id);"> '+
					'<div class = "roomName">'+
					msg.rooms[i].room_no
					+'</div><div class = "roomType">'+
					msg.rooms[i].room_type
					+'</div></a></li>'
				)
			}
		});
	}

</script>
								
								
								
								
