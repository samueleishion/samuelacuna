$(document).ready(function() {
	// Navigation Bar
	$('nav a').on('click',function(e) {
		var id = $(this).attr('id'); 
		if(id!=null) e.preventDefault(); 
		scrollTo(id); 
	}); 
}); 

	
function scrollTo(id) {
	var qty = $('section#'+id).offset().top;   
	$('html,body').animate({
		scrollTop: qty
	},1000); 
}