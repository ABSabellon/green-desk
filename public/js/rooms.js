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
