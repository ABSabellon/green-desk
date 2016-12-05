$(function() {

	$('#professor_sort').click(function() {
		var rows = reservations;
		console.log(rows);

		switch($('#professor_sort').value) {
			case 0: //sort in ascending order
				rows.sort(function( a, b ) { return a - b });
				$('#professor_sort').value = 1;
				break;
			case 1: //sort in descending order
				rows.sort(function( a, b ) { return b - a });
				$('#professor_sort').value = 0;
				break;
		}
		refreshReservations(rows, reservees, rooms);
	});

	$('#time_sort').click(function() {
		var rows = document.getElementById('schedTable').getElementsByTagName('tbody').item(0).rows;

		switch($('#time_sort').value) {
			case 0: //sort in ascending order
				rows.sort(function( a, b ) { return a - b });
				$('#time_sort').value = 1;
				break;
			case 1: //sort in descending order
				rows.sort(function( a, b ) { return b - a });
				$('#time_sort').value = 0;
				break;
		}

		refreshReservations(rows.reservations, rows.reservees, rows.rooms);
	});
	
	$('#room_sort').click(function() {
		var rows = document.getElementById('schedTable').getElementsByTagName('tbody').item(0).rows;

		switch($('#room_sort').value) {
			case 0: //sort in ascending order
				rows.sort(function( a, b ) { return a - b });
				$('#room_sort').value = 1;
				break;
			case 1: //sort in descending order
				rows.sort(function( a, b ) { return b - a });
				$('#room_sort').value = 0;
				break;
		}

		refreshReservations(rows.reservations, rows.reservees, rows.rooms);
	});
	
});
