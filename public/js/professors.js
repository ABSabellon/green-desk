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
	var setChecked;
	for (var i = 0; i < profs.length; i++) {
		setChecked = (profs[i].is_active == 1)? 'checked':'';
		table.append('<tr data-id = "' +profs[i].id+ '">'+
			'<td class = "proffname" contenteditable="false">'+profs[i].first_name+'</td>' +
			'<td class = "profmname" contenteditable="false">'+profs[i].middle_name+'</td>' +
			'<td class = "proflname" contenteditable="false">'+profs[i].last_name+'</td>' +
			'<td class = "profstatus" contenteditable="false">'+profs[i].professor_status+'</td>' +
			'<td class = "profcollege" contenteditable="false">'+profs[i].professor_college+'</td>' +
			'<td class = "profbase" contenteditable="false">'+profs[i].professor_base+'</td>' +
			'<td>' +
			'<label class="switch">' +
			'<input data-id = '+profs[i].id+' class = "setActive" type="checkbox" '+setChecked+'>' +
			'<div class="slider round"></div>' +
			'</label>' +
			'</td>' +
			'<td>'+
			'<button type="button" class="profeditbtn hide-text btn btn-default btn-xs glyphicon glyphicon-pencil">'+
			'Edit'+
			'</button>'+
			'</td>'+
			'</tr>');
	}
}

$(document).on('change', '.setActive', function() {
	setActiveProf($(this).attr('data-id'), $(this)[0].checked);
})

function setActiveProf(id, set) {
	$.ajax({
		method: 'POST',
		url: urlSetActive,
		data: {id: id, set:set}
	})
	.done( function(msg) {
		
	});
}

$(document).on('click', '.profeditbtn', function () {
	var currentTD = $(this).parents('tr').find('td');
	if ($(this).html() == 'Edit') {
	// if ($(this).hasClass("glyphicon glyphicon-pencil")) {
		currentTD = $(this).parents('tr').find('td');
		$.each(currentTD, function () {
			$(this).prop('contenteditable', true)
		});
	} else {
		$.each(currentTD, function () {
			$(this).prop('contenteditable', false)
		});
		var row = $(this).parents('tr');
		var id = row.attr('data-id');
		var fname = row.find('td.proffname')[0].innerText;
		var mname = row.find('td.profmname')[0].innerText;
		var lname = row.find('td.proflname')[0].innerText;
		$.ajax({
			method: 'POST',
			url: urlEditProf,
			data: {id: id, firstname: fname, middlename: mname, lastname: lname}
		})
		.done( function(msg) {
			
		});
	}
	$(this).html($(this).html() == 'Edit' ? 'Save' : 'Edit')
});

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
