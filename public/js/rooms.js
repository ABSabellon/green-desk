function retrieveRooms(filter){
	$.ajax({
		method: 'GET',
		url: urlGetRooms,
		data: {filter:filter}
	})
	.done( function(msg) {
		// refreshRooms(msg.rooms)
		refreshRoomsList(msg.rooms)
	});
}

// function refreshRooms(rooms) {
// 	var roomList = $('#schedCtrl_room');
// 	roomList.empty();
// 	for (var i = 0; i < rooms.length; i++) {
// 		roomList.append(
// 			'<option>' +rooms[i].room_no+ '</option>'
// 			)
// 	}
// 	roomList.selectpicker('refresh');
// }

function refreshRoomsList(rooms) {
	$('#roomList').empty();
	var table = $('#roomTbl > tbody');
	var setChecked;
	for (var i = 0; i < rooms.length; i++) {
		setChecked = (rooms[i].available == 1)? 'checked':'';
		table.append('<tr data-id = "' +rooms[i].id+ '">'+
			'<td class = "rname" contenteditable="false">'+rooms[i].room_no+'</td>' +
			'<td class = "rtype" contenteditable="false">'+rooms[i].floor+'</td>' +
			'<td class = "rfloor" contenteditable="false">'+rooms[i].room_type+'</td>' +
			'<td>' +
			'<label class="switch">' +
			'<input data-id = '+rooms[i].id+' class = "setActive" type="checkbox" '+setChecked+'>' +
			'<div class="slider round"></div>' +
			'</label>' +
			'</td>' +
			'<td>'+
			'<button type="button" class="roomeditbtn hide-text btn btn-primary btn-xs glyphicon glyphicon-pencil">'+
			'Edit'+
			'</button>'+
			'</td>'+
			'<td>'+
			'<button type="button" class="roomdeletebtn hide-text btn btn-danger btn-xs glyphicon glyphicon-trash">'+
			'</button>'+
			'</td>'+
			'</tr>');
	}
}

//Set active
$(document).on('change', '.setActive', function() {
	setActiveRoom($(this).attr('data-id'), $(this)[0].checked);
})

function setActiveRoom(id, set) {
	$.ajax({
		method: 'POST',
		url: urlSetActiveRoom,
		data: {id: id, set:set}
	})
	.done( function(msg) {
		
	});
}

//Add
$('#doneRoomBtn').on('click', function() {
	addRoom();
	$('#addRoomModal').modal('toggle');
});

function addRoom() {
	var roomName = $('#roomName').val();
	var roomType = $('#roomType').val();
	var floor = $('input[name=floorradio]:checked', '#typeForm').val();
	
	$.ajax({
		method: 'POST',
		url: urlAddRoom,
		data: {roomName:roomName, roomType:roomType, floor:floor}
	})
	.done( function(msg) {
		retrieveRooms(null);
		retrieveReservations(null);
	});
}

//Delete
$(document).on('click', '.roomdeletebtn', function () {
	var currentTD = $(this).parents('tr').find('td');
	var row = $(this).parents('tr');
	var id = row.attr('data-id');
	// console.log(id);
	$('#deleteRoomModal').modal('show');
	$('#deleteRoomConfirmBtn').on('click', function() {
		deleteRoom(id);
		$('#deleteRoomModal').modal('hide');
		$(this).removeData('#deleteRoomModal')
		id = null;			//needed because of weird bug
	});
});

function deleteRoom(id){
	// if(confirm("Are you sure you would want to delete this entry?")){
	// 	var currentTD = $(this).parents('tr').find('td');
	// 	var row = $(this).parents('tr');
	// 	var id = row.attr('data-id');	
	if(id == null)			//needed because of weird bug
		return false
	// console.log(id + " deleted");
	$.ajax({
		method: 'POST',
		url: urlDeleteRoom,
		data: {id: id}
	})
	.done( function(msg) {
		retrieveRooms(null);
		retrieveReservations(null);
	});
	// }
	// else{
	// 	return false;
	// }
}

//Edit
$(document).on('click', '.roomeditbtn', function () {
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
		console.log(id);
		var rName = row.find('td.rname')[0].innerText;
		var rType = row.find('td.rtype')[0].innerText;
		var flr = row.find('td.rfloor')[0].innerText;

		$.ajax({
			method: 'POST',
			url: urlEditRoom,
			data: {id: id, roomName:rName, roomType: rType, floor:flr}
		})
		.done( function(msg) {
		});
	}
	$(this).html($(this).html() == 'Edit' ? 'Save' : 'Edit')
});
