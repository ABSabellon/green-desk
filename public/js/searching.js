var tableId = $('.searchableTable').attr('id');

$('#searchRes').keyup(function(event) {
	searchResTerm = event.target.value;
	searchReservations();
});

function searchReservations() {	
	console.log(tableId);
	var input, filter, table, tr, td, i, type;
	type = $('#filterSearch').find(":selected").val();
	input = document.getElementById("searchRes");
	filter = input.value.toUpperCase();
	table = document.getElementById(tableId);
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[type];
		if (td) {
			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
		}       
	}
}
