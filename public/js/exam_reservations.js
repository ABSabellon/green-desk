$(document).on('click', 'table .resrows', function(){
	$('#inputWarning').hide();
	$("table tr").css("background", "#FFF");
	$("table tr").css("color", "#000");
	$(this).css("background", "#00d771");
	$(this).css("color", "#FFF");  
	resId = $(this).attr('data-id');
	$('#schedCtrl_subject > span').html($(this).find('td.ressubj')[0].innerText);
	$('#schedCtrl_section > span').html($(this).find('td.ressect')[0].innerText);
	$('#schedCtrl_takers > span').html($(this).find('td.restakers')[0].innerText);
	$('#schedCtrl_profName > span').html($(this).find('td.resname')[0].innerText);
	$('#schedCtrl_profType > span').html($(this).find('td.resname').attr('data-status'));
	$('#schedCtrl_profBase > span').html($(this).find('td.resname').attr('data-base'));
	$('#schedCtrl_profCollege > span').html($(this).find('td.resname').attr('data-college'));

	if($(this).find('td.restime')[0] != null) {
		$('#editBtn').text('Edit');
		var times = $(this).find('td.restime')[0].innerText.split('-');
		$('#startTime').val(times[0]);
		$('#endTime').val(times[1]);
		$('#dateInput').val($(this).find('td.resdate')[0].innerText);
		$('#schedCtrl_room').val($(this).find('td.resroom')[0].innerText);
		$('#schedCtrl_room').selectpicker('refresh');
	} else {
		$('#editBtn').text('Create');
		$('#startTime').val('');
		$('#endTime').val('');
		$('#schedCtrl_room').val('');
		$('#schedCtrl_room').selectpicker('refresh');
		$('#dateInput').val('');

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
	retrieveExamDetails('subject', null);
	retrieveExamDetails('section', null);
	retrieveExamDetails('takers', null);
	retrieveExamDetails('profs', null);
	console.log($('#schedCtrl_room').val());
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
		var reserveeName = reservations[i].reservee.first_name +' '+ reservations[i].reservee.middle_name +' '+ reservations[i].reservee.last_name;
		var toAppend = '<tr data-id = '+reservations[i].id+' class = "resrows"><td class = "ressubj">' +reservations[i].exam.subject+ '</td><td class = "ressect">' +reservations[i].exam.section+ '</td><td class = "restakers">' +reservations[i].exam.takers+ '</td><td class = "resname" data-status = "' +reservations[i].reservee.professor_status+ '" data-college = "' +reservations[i].reservee.professor_college+ '" data-base = "' +reservations[i].reservee.professor_base+ '">' +reserveeName+ '</td>';
		if(reservations[i].time_start == null) {
			toAppend = toAppend + '<td>No reservation yet</td><td></td><td></td></tr>'
		} else {
			toAppend = toAppend + '<td class = "resdate">' +reservations[i].date+ '</td><td class = "restime"><time datetime="' +reservations[i].time_start+ '">' +reservations[i].time_start+ '</time>-<time datetime="' +reservations[i].time_end+ '">' +reservations[i].time_end+ '</time></td><td class = "resroom">' +reservations[i].room_no+ '</td></tr>'
		}				
		table.append(toAppend);
	}
}

$('#editBtn').on('click', function() {
	checkReservation();
})

function checkReservation() {
	var diff = (( new Date('2016-1-1 '+ $('#endTime').val())) - new Date('2016-1-1 '+$('#startTime').val())) / 1000 / 60 / 60;
	if(diff > 3) {
		$('#inputWarning').text('You can only reserve for a maximum of 3 hours!');
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
	var startTime = $('#startTime').val();
	var endTime = $('#endTime').val();
	var room = $('#schedCtrl_room').val();
	var date = $('#dateInput').val();

	$.ajax({
		method: 'POST',
		url: urlEditReservation,
		data: {index: resId, date:date, startTime:startTime, endTime: endTime, room:room}
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

function retrieveExamDetails(ret, filter){
	var url;
	if(ret == 'subject')
		url = urlGetSubjects;
	else if(ret == 'section')
		url = urlGetSections;
	else if(ret == 'takers')
		url = urlGetTakers;
	else if(ret == 'profs')
		url = urlGetProfessors;
	$.ajax({
		method: 'GET',
		url: url,
		data: {filter:filter}
	})
	.done( function(msg) {
		if(ret == 'subject')
			refreshSubjects(msg.subjects)
		else if(ret == 'section')
			refreshSections(msg.sections)
		else if(ret == 'takers')
			refreshTakers(msg.takers)
		else if(ret == 'profs')
			refreshProfs(msg.reservees);
		
	});
}

function refreshSubjects(subjects) {
	var subjList = $('#subjectSelect');
	subjList.empty();
	for (var i = 0; i < subjects.length; i++) {
		subjList.append(
			'<option data-id = ' +subjects[i].id+ '>' +subjects[i].subject+ '</option>'
			)
	}
	subjList.selectpicker('refresh');
}

function refreshSections(sections) {
	var secList = $('#sectionSelect');
	secList.empty();
	for (var i = 0; i < sections.length; i++) {
		secList.append(
			'<option data-id = ' +sections[i].id+ '>' +sections[i].section+ '</option>'
			)
	}
	secList.selectpicker('refresh');
}

function refreshTakers(takers) {
	var takerList = $('#takersSelect');
	takerList.empty();
	for (var i = 0; i < takers.length; i++) {
		takerList.append(
			'<option data-id = ' +takers[i].id+ '>' +takers[i].taker+ '</option>'
			)
	}
	takerList.selectpicker('refresh');
}

function refreshProfs(profs) {
	var profList = $('#professorSelect');
	profList.empty();
	for (var i = 0; i < profs.length; i++) {
		var name = profs[i].last_name + ', ' + profs[i].first_name + ' ' + profs[i].middle_name;
		profList.append(
			'<option data-id = ' +profs[i].id+ '>' +name+ '</option>'
			)
	}
	profList.selectpicker('refresh');
}

$('#doneBtn').on('click', function () {
	addReservation(); 
})

function addReservation() {
	var subject = $('#subjectSelect').find(":selected").attr('data-id');
	var section = $('#sectionSelect').find(":selected").attr('data-id');
	var taker = $('#takersSelect').find(":selected").attr('data-id');
	var prof = $('#professorSelect').find(":selected").attr('data-id');

	$.ajax({
		method: 'POST',
		url: urlAddReservation,
		data: {subject:subject, section:section, taker:taker, prof:prof}
	})
	.done( function(msg) {
		retrieveReservations(null);
	});
}
