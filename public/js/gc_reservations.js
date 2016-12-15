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
		var toAppend = '<tr data-id = '+reservations[i].id+' class = "resrows"><td class = "rescollege">' + reservations[i].reservee.professor_college + '</td><td class = "resname" data-status = "' +reservations[i].reservee.professor_status+ '" data-college = "' +reservations[i].reservee.professor_college+ '" data-base = "' +reservations[i].reservee.professor_base+ '">' +reserveeName+ '</td>';
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

$('#recBtn').on('click', function() {

	checkRecommendation();
})

function checkRecommendation() {
	room = $('#schedCtrl_room').val();
	sT = $('#startTime').val();
	eT = $('#endTime').val();
	retrieveRecommendation(null, room, sT, eT);
	$('#fTF').text('Free Time for '+ room);
	$('#fTF').show();
	$('#tTF').text('Time Taken for '+ room);
	$('#tTF').show();
	$('#rTF').text('Free Room for '+ sT+'-'+eT);
	$('#rTF').show();
	$('#viewRecModal').modal();
}

function retrieveRecommendation(filter, room, sT, eT) {

	$.ajax({
		method: 'GET',
		url: urlGetReservations,
		data: {filter:filter}
	})
	.done( function(msg) {
		reservations = acsBubbleSorting(msg.reservations);
		refreshRecommendations(reservations, room, sT ,eT);

	});
}

function forRoom(reservations, room){

	var x = 0;
	
	for (var i = 0; i < reservations.length; i++) {
		if(reservations[i].room_no == room) {
		x+=1;
		}
	}

	var resArr = new Array(x);
	for (var j = 0, i = 0, k = 0; j < resArr.length; j++) {
		resArr[j] = new Array(6);
		k = 0;
		for (; k == 0; i++) {
			if(reservations[i].room_no == room){
				resArr[j][0] = reservations[i].reservee.last_name;
				resArr[j][1] = reservations[i].reservee.first_name;
				resArr[j][2] = reservations[i].reservee.middle_name;
				resArr[j][3] = reservations[i].time_start;
				resArr[j][4] = reservations[i].time_end;
				resArr[j][5] = reservations[i].room_no;
				k = 1;
			}
		}
	}
	

	var table1 = $('#toBeRecTable > tbody');
	var table2 = $('#recTable > tbody');
	if(x == 0){
		toAppend = '<tr><td>7:00:00 - 14:00:00</td></tr>';
		table1.append(toAppend);
	}
	else{
		for (var i = 0; i < resArr.length; i++) {
			// if(i < resArr.length-1){
			// 	var diff = (( new Date('2016-1-1 '+ resArr[i+1][3])) - new Date('2016-1-1 '+ resArr[i][4])) / 1000 / 60 / 60;
			// 	console.log("from "+ resArr[i+1][3] +" to "+resArr[i][4]+" is "+diff);
			// 	var the10Min = 0.166;
			// 	var the5Min = 0.1;
			// }

			if(resArr.length == 1){
				if(resArr[i][3] == '7:00:00'){
					toAppend = '<tr><td>'+resArr[i][4]+' - 14:00:00</td></tr>';
					table1.append(toAppend);
				}
				else if(resArr[i][4] == '14:00:00'){
					toAppend = '<tr><td>24:01:00 - '+resArr[i][3]+'</td></tr>';
					table1.append(toAppend);
				}
				else{
					toAppend = '<tr><td>7:00:00 - '+resArr[i][3]+'</td></tr>';
					table1.append(toAppend);
					toAppend = '<tr><td>'+resArr[i][4]+' - 14:00:00</td></tr>';
					table1.append(toAppend);
				}
			}else{
				if(i == 0){
					if(resArr[i][3] == '7:00:00'){
						toAppend = '<tr><td>'+resArr[i][4]+' - '+resArr[i+1][3]+'</td></tr>';
						table1.append(toAppend);
					}
					else if(resArr[i][3] != '7:00:00'){
						toAppend = '<tr><td>7:00:00 - '+resArr[i][3]+'</td></tr>';
						table1.append(toAppend);

						var diff = (( new Date('2016-1-1 '+ resArr[i+1][3])) - new Date('2016-1-1 '+ resArr[i][4])) / 1000 / 60 / 60;
						
						if(diff > 0.09){
							toAppend = '<tr><td>'+resArr[i][4]+' - '+resArr[i+1][3]+'</td></tr>';
							table1.append(toAppend);
						}

						// toAppend = '<tr><td>'+resArr[i][4]+' - '+resArr[i+1][3]+'</td></tr>';
						// table1.append(toAppend);
					}
				}
				if(i > 0 && i < resArr.length-1){

					var diff = (( new Date('2016-1-1 '+ resArr[i+1][3])) - new Date('2016-1-1 '+ resArr[i][4])) / 1000 / 60 / 60;
						
					if(diff > 0.09){
						toAppend = '<tr><td>'+resArr[i][4]+' - '+resArr[i+1][3]+'</td></tr>';
						table1.append(toAppend);
					}

					// toAppend = '<tr><td>'+resArr[i][4]+' - '+resArr[i+1][3]+'</td></tr>';
					// table1.append(toAppend);
				}
				if(i == resArr.length-1 && resArr[i][4] != '14:00:00'){
					toAppend = '<tr><td>'+resArr[i][4]+' - 14:00:00</td></tr>';
					table1.append(toAppend);
				}
				
			}

			var reserveeName = resArr[i][0] +', '+ resArr[i][1] +' '+ resArr[i][2];
			toAppend = '<tr><td class = "restime"><time datetime="' +resArr[i][3]+ '">' +resArr[i][3]+ '</time>-<time datetime="' +resArr[i][4]+ '">' +resArr[i][4]+ '</time></td><td>'+reserveeName+'<td></tr>'
			table2.append(toAppend);
			
		}
		// for (var i = 0; i < reservations.length; i++) {
		// 		var reserveeName = resArr[i][0] +', '+ resArr[i][1] +' '+ resArr[i][2];
		// 		toAppend = '<tr><td class = "restime"><time datetime="' +resArr[i][3]+ '">' +resArr[i][3]+ '</time>-<time datetime="' +resArr[i][4]+ '">' +resArr[i][4]+ '</time></td><td>'+reserveeName+'<td></tr>'
		// 		table2.append(toAppend);
		// }

	}
}

// function(reservations){

// }

function forTime(reservations, room, sT, eT){
	var table3 = $('#roomRecTable > tbody');

	// reservations = roomFilter(reservation);
	var rejected = new Array(reservation.length);
	for(a = 0, b = 0; a < reservations.length; a++){
		if(reservations[a].room_no != room){
			if((reservations[a].time_start < sT || reservations[a].time_end < sT) || (reservations[a].time_start > eT || reservations[a].time_end > eT)){
				var go = true;
				for(c = 0; c < rejected.length; c++){
					if(rejected[c] == null){
						go = true;
					}
					else if(reservations[a].room_no == rejected[c]){
						go = false;
					}
				}
				if(go == true){
					toAppend = '<tr><td>'+reservations[a].room_no+'</td></tr>'
					table3.append(toAppend);
				}

			}else{
				rejected[b] = reservations[a].room_no;
				b++;
			}
		}
	}
}


function refreshRecommendations(reservations, room, sT, eT) {
	$('#recommendationList').empty();
	$('#tobeRecList').empty();
	$('#roomRecList').empty();

	if(sT == null || eT == null || sT == "" || eT == "" || sT == " " || eT == " "){
		$('#inputWarning').text("Please Select a time to be recommended");
		$('#inputWarning').show();
		document.getElementById("roomRecTable").style.visibility="hidden";
	}
	else if(sT == eT || sT > eT){
		$('#inputWarning').text("Please Correct your time to be recommended");
		$('#inputWarning').show();
		document.getElementById("roomRecTable").style.visibility="hidden";
	}
	else{
		document.getElementById("roomRecTable").style.visibility="visible";
		forTime(reservations, room, sT, eT);
	}

	if(room == null){
		$('#inputWarning').text("Please Select a room to be recommended");
		$('#inputWarning').show();
		document.getElementById("toBeRecTable").style.visibility="hidden";
		document.getElementById("recTable").style.visibility="hidden";
	}
	else{
		document.getElementById("toBeRecTable").style.visibility="visible";
		document.getElementById("recTable").style.visibility="visible";
		forRoom(reservations, room);
	}
	
}


function acsBubbleSorting(reservations){
	n = reservations.length;
	for (c = 0; c < ( n - 1 ); c++) {
      for (d = 0; d < n - c - 1; d++) {
        if (reservations[d].time_start > reservations[d+1].time_start){
          swap = reservations[d];
          reservations[d] = reservations[d+1];
          reservations[d+1] = swap;
        }
      }
    }
   

    return reservations;
}
