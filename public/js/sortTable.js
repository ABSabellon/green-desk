$(function() {

	$('#professor_sort').click(function() {
		var mod = $('#professor_sort').attr('value');

		// sort( 0, mod );
		sort( 'professor', mod );

		$('#professor_sort').attr('value', mod * -1);
	});

	$('#time_sort').click(function() {
		var mod = $('#time_sort').attr('value');
		
		// sort( 1, mod );
		sort( 'time', mod );

		$('#time_sort').attr('value', mod * -1);
	});
	
	$('#room_sort').click(function() {
		var mod = $('#room_sort').attr('value');
		
		// sort( 2, mod );
		sort( 'room', mod );

		$('#room_sort').attr('value', mod * -1);
	});

	$('#subject_sort').click( function() {
		var mod = $('#subject_sort').attr('value');

		sort( 'subject', mod );

		$('#subject_sort').attr( 'value', mod * -1 );
	});

	$('#section_sort').click( function() {
		var mod = $('#section_sort').attr('value');

		sort( 'section', mod );

		$('#section_sort').attr( 'value', mod * -1 );
	});

	$('#takers_sort').click( function() {
		var mod = $('#takers_sort').attr('value');

		sort( 'takers', mod );

		$('#takers_sort').attr( 'value', mod * -1 );
	})
	
	$('#date_sort').click( function() {
		var mod = $('#date_sort').attr('value');

		sort( 'date', mod );

		$('#date_sort').attr( 'value', mod * -1 );
	})

	// $('#firstname').click( function () {
	// 	var mod = $('#date_sort').attr('value');

	// 	sort( 'date', mod );

	// 	$('#date_sort').attr( 'value', mod * -1 );
	// })

	function sort( column, mod ) {
		var rows = document.getElementById('schedTable').getElementsByTagName('tbody').item(0).rows;
		var arr = [];

		for(var i = 0; i < rows.length; i++) {
			var cells = rows[i].cells;
			// arr[i] = [];
			arr[i] = [];
			
			for( var j = 0; j < cells.length; j++ ) {
				// arr[i][j] = cells[j].innerHTML;
				var header = document.getElementById('schedTable').tHead.rows[0].cells[j].innerHTML;
				// console.log(header);
				switch(header) {
					case "Professor":
						arr[i]['professor'] = cells[j].innerHTML; break;
					case "Time":
						arr[i]['time'] = cells[j].innerHTML; break;
					case "Room":
						arr[i]['room'] = cells[j].innerHTML; break;
					case "Subject":
						arr[i]['subject'] = cells[j].innerHTML; break;
					case "Section":
						arr[i]['section'] = cells[j].innerHTML; break;
					case "Takers":
						arr[i]['takers'] = cells[j].innerHTML; break;
					case "Date":
						arr[i]['date'] = cells[j].innerHTML; break;
				}
			}

			// arr[i][cells.length] = {
			// 	id : rows[i].getAttribute('data-id'),
			// 	status : cells[0].getAttribute('data-status'),
			// 	college : cells[0].getAttribute('data-college'),
			// 	base : cells[0].getAttribute('data-base')
			// };

			arr[i]['data'] = {
				id : rows[i].getAttribute('data-id'),
				status : cells[0].getAttribute('data-status'),
				college : cells[0].getAttribute('data-college'),
				base : cells[0].getAttribute('data-base')
			};
		}

		arr.sort( function( a, b ) {
			return mod * (a[column].localeCompare(b[column]));
		});

		refresh( arr );
	}

	function refresh( reservations ) {
		$('#reservationList').empty();
		var table = $('#schedTable > tbody');

		for (var i = 0; i < reservations.length; i++) {
			var reserveeName = reservations[i]['professor'];
			var toAppend = '<tr data-id = '+reservations[i]['data'].id+' class = "resrows">';

			if(reservations[i]['subject']) {
				toAppend = toAppend + '<td class = "ressubj">' + reservations[i]['subject'] + '</td>';
			}

			if(reservations[i]['section']) {
				toAppend = toAppend + '<td class = "ressect">' + reservations[i]['section'] + '</td>';
			}

			if(reservations[i]['takers']) {
				toAppend = toAppend + '<td class = "restakers">' + reservations[i]['takers'] + '</td>';
			}
			
			toAppend = toAppend + '<td class = "resname" data-status = "' +reservations[i]['data'].status+ '" data-college = "' +reservations[i]['data'].college+ '" data-base = "' +reservations[i]['data'].base+ '">' +reserveeName+ '</td>';
			
			if(reservations[i]['date']) {
				toAppend = toAppend + '<td class = "resdate">' + reservations[i]['date'] + '</td>';
			}

			if(reservations[i]['time'] == "No reservation yet") {
				toAppend = toAppend + '<td>No reservation yet</td><td></td></tr>'
			} else {
				toAppend = toAppend + '<td class = "restime">' + reservations[i]['time'] + '</td><td class = "resroom">' +reservations[i]['room']+ '</td></tr>'
			}

			// console.log(toAppend);
			
			table.append(toAppend);
		}
	}

	// function refresh( reservations ) {
	// 	$('#reservationList').empty();
	// 	var table = $('#schedTable > tbody');
	// 	for (var i = 0; i < reservations.length; i++) {
	// 		var reserveeName = reservations[i][0];
	// 		var toAppend = '<tr data-id = '+reservations[i][3].id+' class = "resrows"><td class = "resname" data-status = "' +reservations[i][3].status+ '" data-college = "' +reservations[i][3].college+ '" data-base = "' +reservations[i][3].base+ '">' +reserveeName+ '</td>';
	// 		if(reservations[i][1] == "No reservation yet") {
	// 			toAppend = toAppend + '<td>No reservation yet</td><td></td></tr>'
	// 		} else {
	// 			toAppend = toAppend + '<td class = "restime">' + reservations[i][1] + '</td><td class = "resroom">' +reservations[i][2]+ '</td></tr>'
	// 		}				
	// 		table.append(toAppend);
	// 	}
	// }
});
