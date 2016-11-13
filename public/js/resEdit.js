$(function(){
	/*
	$('#logOut').click(function(){
		setTimeout('window.location="login.html"', 1000);
	});
	
	$('.list-group-item').click(function(){
		setTimeout('window.location="playScrn.html"', 1000);
	});
	
	$('form').submit(function(){
		console.log("create");
		setTimeout('window.location="gmScreen.html"', 500);
		return false;
	});
	*/
	$('#editBtn').click(function(){
		
		console.log($('#editBtn').html());
		if($('#editBtn').html()=="Save"){
			$('.profText').attr("disabled",'true');
			$('#editBtn').html('Edit');
			$('.profText').css("background-color","rgba(155,155,155,0.0)");
		}
		else{
			$('.profText').removeAttr("disabled");
			$('#editBtn').html('Save');
			$('.profText').css("background-color","rgba(255,255,255,0.0)");
		}
	});
	
});