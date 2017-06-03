$(document).ready(function() 
{
	//date 
	var today = new Date();
	var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
	$('#date').html("Date: " + today.toLocaleDateString('en-US', options));
	//date
});