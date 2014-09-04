$(document).ready(function() {

	// console.log($('#description').text()); 
	var entry = $('.markdown .entrytext'); 
	// console.log(markdown(entry.text())); 
	entry.html(markdown(entry.text())); 

}); 