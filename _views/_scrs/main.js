$(document).ready(function() {
	// Log in and out
	$('input#login').on('click',function(e) {
		e.preventDefault(); 
		var uname = $('input#uname').val(); 
		var pword = $('input#pword').val(); 
		$.ajax({
			type:'post',
			url:'_controllers/operator.php', 
			data: {
				action:'login', 
				uname:uname, 
				pword:pword
			}, 
			success: function(data) {
				location.reload(); 
			}
		})
	}); 
	
	$('input#logout').on('click',function(e) {
		$.ajax({
			type:'post',
			url:'_controllers/operator.php', 
			data: {
				action:'logout'
			}, 
			success: function(data) {
				location.reload(); 
			}
		})
	}); 
}); 
