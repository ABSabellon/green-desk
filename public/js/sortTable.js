$(function() {

	$('.header_sort').click(function() {
		if(document.getElementById('schedTable'))
			var table = document.getElementById('schedTable');
		if(document.getElementById('profTbl'))
			var table = document.getElementById('profTbl');
		var mod = $(this).attr('value');
		var name = $(this).attr('name');

		for( var i = 0; i < table.tHead.rows[0].cells.length; i++ ) {
			table.tHead.rows[0].cells[i].innerHTML = table.tHead.rows[0].cells[i].innerText;
		}

		if( mod == 1 ) {
			$(this).append('<span class="glyphicon glyphicon-chevron-up"></span>');
		}
		else if( mod == -1 ) {
			$(this).append('<span class="glyphicon glyphicon-chevron-down"></span>');
		}

		// sort( 0, mod );
		sort( name, mod );

		$(this).attr('value', mod * -1);
	});

	// $('#professor_sort').click(function() {
	// 	var mod = $('#professor_sort').attr('value');

	// 	$(this).empty();
	// 	if( mod == 1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-up"></span>');
	// 	}
	// 	else if( mod == -1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-down"></span>');
	// 	}
	// 	else {
	// 		$(this).append('Professor');
	// 	}

	// 	// sort( 0, mod );
	// 	sort( 'professor', mod );

	// 	$('#professor_sort').attr('value', mod * -1);
	// });

	// $('#time_sort').click(function() {
	// 	var mod = $('#time_sort').attr('value');
		
	// 	$(this).empty();
	// 	if( mod == 1 ) {
	// 		$(this).append('Time' + ' <span class="glyphicon glyphicon-chevron-up"></span>');
	// 	}
	// 	else if( mod == -1 ) {
	// 		$(this).append('Time' + ' <span class="glyphicon glyphicon-chevron-down"></span>');
	// 	}
	// 	else {
	// 		$(this).append('Time');
	// 	}
		
	// 	// sort( 1, mod );
	// 	sort( 'time', mod );

	// 	$('#time_sort').attr('value', mod * -1);
	// });
	
	// $('#room_sort').click(function() {
	// 	var mod = $('#room_sort').attr('value');
		
	// 	$(this).empty();
	// 	if( mod == 1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-up"></span>');
	// 	}
	// 	else if( mod == -1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-down"></span>');
	// 	}
	// 	else {
	// 		$(this).append('Professor');
	// 	}
		
	// 	// sort( 2, mod );
	// 	sort( 'room', mod );

	// 	$('#room_sort').attr('value', mod * -1);
	// });

	// $('#subject_sort').click( function() {
	// 	var mod = $('#subject_sort').attr('value');

	// 	$(this).empty();
	// 	if( mod == 1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-up"></span>');
	// 	}
	// 	else if( mod == -1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-down"></span>');
	// 	}
	// 	else {
	// 		$(this).append('Professor');
	// 	}
		
	// 	sort( 'subject', mod );

	// 	$('#subject_sort').attr( 'value', mod * -1 );
	// });

	// $('#section_sort').click( function() {
	// 	var mod = $('#section_sort').attr('value');

	// 	$(this).empty();
	// 	if( mod == 1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-up"></span>');
	// 	}
	// 	else if( mod == -1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-down"></span>');
	// 	}
	// 	else {
	// 		$(this).append('Professor');
	// 	}
		
	// 	sort( 'section', mod );

	// 	$('#section_sort').attr( 'value', mod * -1 );
	// });
	
	// $('#firstname_sort').click( function() {
	// 	var mod = $('#firstname_sort').attr('value');

	// 	$(this).empty();
	// 	if( mod == 1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-up"></span>');
	// 	}
	// 	else if( mod == -1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-down"></span>');
	// 	}
	// 	else {
	// 		$(this).append('Professor');
	// 	}
		
	// 	sort( 'firstname', mod );

	// 	$('#firstname_sort').attr( 'value', mod * -1 );
	// });

	// $('#middle_initial_sort').click( function() {
	// 	var mod = $('#middle_initial_sort').attr('value');

	// 	$(this).empty();
	// 	if( mod == 1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-up"></span>');
	// 	}
	// 	else if( mod == -1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-down"></span>');
	// 	}
	// 	else {
	// 		$(this).append('Professor');
	// 	}
		
	// 	sort( 'middle_initial', mod );

	// 	$('#middle_initial_sort').attr( 'value', mod * -1 );
	// });

	// $('#lastname_sort').click( function() {
	// 	var mod = $('#lastname_sort').attr('value');

	// 	$(this).empty();
	// 	if( mod == 1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-up"></span>');
	// 	}
	// 	else if( mod == -1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-down"></span>');
	// 	}
	// 	else {
	// 		$(this).append('Professor');
	// 	}
		
	// 	sort( 'lastname', mod );

	// 	$('#lastname_sort').attr( 'value', mod * -1 );
	// });

	// $('#type_sort').click( function() {
	// 	var mod = $('#type_sort').attr('value');

	// 	$(this).empty();
	// 	if( mod == 1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-up"></span>');
	// 	}
	// 	else if( mod == -1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-down"></span>');
	// 	}
	// 	else {
	// 		$(this).append('Professor');
	// 	}
		
	// 	sort( 'type', mod );

	// 	$('#type_sort').attr( 'value', mod * -1 );
	// });

	// $('#college_sort').click( function() {
	// 	var mod = $('#college_sort').attr('value');

	// 	$(this).empty();
	// 	if( mod == 1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-up"></span>');
	// 	}
	// 	else if( mod == -1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-down"></span>');
	// 	}
	// 	else {
	// 		$(this).append('Professor');
	// 	}
		
	// 	sort( 'college', mod );

	// 	$('#college_sort').attr( 'value', mod * -1 );
	// });

	// $('#base_sort').click( function() {
	// 	var mod = $('#base_sort').attr('value');

	// 	$(this).empty();
	// 	if( mod == 1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-up"></span>');
	// 	}
	// 	else if( mod == -1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-down"></span>');
	// 	}
	// 	else {
	// 		$(this).append('Professor');
	// 	}
		
	// 	sort( 'base', mod );

	// 	$('#base_sort').attr( 'value', mod * -1 );
	// });

	// $('#active_sort').click( function() {
	// 	var mod = $('#active_sort').attr('value');

	// 	$(this).empty();
	// 	if( mod == 1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-up"></span>');
	// 	}
	// 	else if( mod == -1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-down"></span>');
	// 	}
	// 	else {
	// 		$(this).append('Professor');
	// 	}
		
	// 	sort( 'active', mod );

	// 	$('#active_sort').attr( 'value', mod * -1 );
	// });

	// $('#takers_sort').click( function() {
	// 	var mod = $('#takers_sort').attr('value');

	// 	$(this).empty();
	// 	if( mod == 1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-up"></span>');
	// 	}
	// 	else if( mod == -1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-down"></span>');
	// 	}
	// 	else {
	// 		$(this).append('Professor');
	// 	}
		
	// 	sort( 'takers', mod );

	// 	$('#takers_sort').attr( 'value', mod * -1 );
	// })
	
	// $('#date_sort').click( function() {
	// 	var mod = $('#date_sort').attr('value');

	// 	$(this).empty();
	// 	if( mod == 1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-up"></span>');
	// 	}
	// 	else if( mod == -1 ) {
	// 		$(this).append('Professor' + ' <span class="glyphicon glyphicon-chevron-down"></span>');
	// 	}
	// 	else {
	// 		$(this).append('Professor');
	// 	}
		
	// 	sort( 'date', mod );

	// 	$('#date_sort').attr( 'value', mod * -1 );
	// })

	// $('#firstname').click( function () {
	// 	var mod = $('#date_sort').attr('value');

	// 	sort( 'date', mod );

	// 	$('#date_sort').attr( 'value', mod * -1 );
	// })

	function sort( column, mod ) {
		if(document.getElementById('schedTable'))
			var table = document.getElementById('schedTable');
		if(document.getElementById('profTbl'))
			var table = document.getElementById('profTbl');
		var rows = table.getElementsByTagName('tbody').item(0).rows;
		var arr = [];

		for(var i = 0; i < rows.length; i++) {
			var cells = rows[i].cells;
			// arr[i] = [];
			arr[i] = [];
			
			for( var j = 0; j < cells.length; j++ ) {
				// arr[i][j] = cells[j].innerHTML;
				var header = table.tHead.rows[0].cells[j].getAttribute('name');
				console.log(header);
				arr[i][header] = cells[j].innerHTML;

				// switch(header) {
				// 	case "Professor":
				// 		arr[i]['professor'] = cells[j].innerHTML; break;
				// 	case "Time":
				// 		arr[i]['time'] = cells[j].innerHTML; break;
				// 	case "Room":
				// 		arr[i]['room'] = cells[j].innerHTML; break;
				// 	case "Subject":
				// 		arr[i]['subject'] = cells[j].innerHTML; break;
				// 	case "Section":
				// 		arr[i]['section'] = cells[j].innerHTML; break;
				// 	case "Firstname":
				// 		arr[i]['firstname'] = cells[j].innerHTML; break;
				// 	case "Middle Initial":
				// 		arr[i]['middle_initial'] = cells[j].innerHTML; break;
				// 	case "Lastname":
				// 		arr[i]['lastname'] = cells[j].innerHTML; break;
				// 	case "Type":
				// 		arr[i]['type'] = cells[j].innerHTML; break;
				// 	case "College":
				// 		arr[i]['college'] = cells[j].innerHTML; break;
				// 	case "Base":
				// 		arr[i]['base'] = cells[j].innerHTML; break;
				// 	case "Active":
				// 		arr[i]['active'] = cells[j].innerHTML; break;
				// 	case "Takers":
				// 		arr[i]['takers'] = cells[j].innerHTML; break;
				// 	case "Date":
				// 		arr[i]['date'] = cells[j].innerHTML; break;
				// }
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

		if(document.getElementById('schedTable'))
			refresh( arr );
		if(document.getElementById('profTbl'))
			refreshProfs( arr );
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
			
			if(reservations[i]['college']) {
				toAppend = toAppend + '<td class = "rescollege">' + reservations[i]['college'] + '</td>';
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

	function refreshProfs(profs) {
		$('#profList').empty();
		var table = $('#profTbl > tbody');
		
		for (var i = 0; i < profs.length; i++) {
			table.append('<tr data-id = "' +profs[i].id+ '">'+
				'<td class = "proffname" contenteditable="false">'+profs[i]['firstname']+'</td>' +
				'<td class = "profmname" contenteditable="false">'+profs[i]['middle initial']+'</td>' +
				'<td class = "proflname" contenteditable="false">'+profs[i]['lastname']+'</td>' +
				'<td class = "profstatus" contenteditable="false">'+profs[i]['type']+'</td>' +
				'<td class = "profcollege" contenteditable="false">'+profs[i]['college']+'</td>' +
				'<td class = "profbase" contenteditable="false">'+profs[i]['base']+'</td>' +
				'<td>' +
				profs[i]['active'] +
				'</td>' +
				'<td>'+
				'<button type="button" class="profeditbtn hide-text btn btn-default btn-xs glyphicon glyphicon-pencil">'+
				'Edit'+
				'</button>'+
				'</td>'+
				'</tr>');
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
