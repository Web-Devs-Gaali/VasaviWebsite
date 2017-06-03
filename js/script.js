$(document).ready(function() 
{
	//date 
	var today = new Date();
	var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
	$('#date').html("Date: " + today.toLocaleDateString('en-US', options));
	//date

	//hover dropdown
	$('ul.nav li.dropdown').hover(function() {
  		$(this).find('.dropdown-menu').stop(true, true).delay(100).slideToggle(300);
	}, 
	function() {
  		$(this).find('.dropdown-menu').stop(true, true).delay(100).slideToggle(300);
	});
	//hover dropdown
});