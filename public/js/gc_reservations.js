$(document).on('click', 'table .resrows', function(){
	$('#inputWarning').hide();
	$("table tr").css("background", "#FFF");
	$("table tr").css("color", "#000");
	$(this).css("background", "#00d771");
	$(this).css("color", "#FFF");
	resId = $(this).attr('data-id');
	$('#schedCtrl_profName > span').html($(this).find('td.resname')[0].innerText);
	$('#schedCtrl_profType > span').html($(this).find('td.resname').attr('data-status'));
	$('#schedCtrl_profBase > span').html($(this).find('td.resname').attr('data-base'));
	$('#schedCtrl_profCollege > span').html($(this).find('td.resname').attr('data-college'));

	if($(this).find('td.restime')[0] != null) {
		$('#editBtn').text('Edit');
		var times = $(this).find('td.restime')[0].innerText.split('-');
		$('#startTime').val(times[0]);
		$('#endTime').val(times[1]);
		$('#schedCtrl_room').val($(this).find('td.resroom')[0].innerText);
		$('#schedCtrl_room').selectpicker('refresh');

	} else {
		$('#editBtn').text('Create');
		$('#startTime').val('');
		$('#endTime').val('');
		$('#schedCtrl_room').val('');
		$('#schedCtrl_room').selectpicker('refresh');
	}
});

var resId;


$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#inputWarning').hide();
	retrieveReservations(null);
	retrieveRooms(null);
});

function retrieveReservations(filter) {
	$.ajax({
		method: 'GET',
		url: urlGetReservations,
		data: {filter:filter}
	})
	.done( function(msg) {
		reservations = msg.reservations;
		refreshReservations(msg.reservations);
	});
}

function refreshReservations(reservations) {
	$('#reservationList').empty();
	var table = $('#schedTable > tbody');
	for (var i = 0; i < reservations.length; i++) {
		var reserveeName = reservations[i].reservee.last_name +', '+ reservations[i].reservee.first_name +' '+ reservations[i].reservee.middle_name;
		var toAppend = '<tr data-id = '+reservations[i].id+' class = "resrows"><td class = "resname" data-status = "' +reservations[i].reservee.professor_status+ '" data-college = "' +reservations[i].reservee.professor_college+ '" data-base = "' +reservations[i].reservee.professor_base+ '">' +reserveeName+ '</td>';
		if(reservations[i].time_start == null) {
			toAppend = toAppend + '<td>No reservation yet</td><td></td></tr>'
		} else {
			toAppend = toAppend + '<td class = "restime"><time datetime="' +reservations[i].time_start+ '">' +reservations[i].time_start+ '</time>-<time datetime="' +reservations[i].time_end+ '">' +reservations[i].time_end+ '</time></td><td class = "resroom">' +reservations[i].room_no+ '</td></tr>'
		}				
		table.append(toAppend);
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
	} else if(resId == null) {
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
		data: {index: resId, startTime:startTime, endTime: endTime, room:room}
	})
	.done( function(msg) {
		if(msg.warning != null) {
			$('#inputWarning').text(msg.warning);
			$('#inputWarning').show();
		} else {
			$('#inputWarning').hide();
		}
		retrieveReservations(null);
	});
}

var filter = $('#filterSearch').val();

$('#filterSearch').on('change', function() {
	filter = $('#filterSearch').val();
	$('#searchRes').val('');
	if(filter == '0')
		retrieveReservations(null);
	else
		retrieveReservations('notnull');
});
