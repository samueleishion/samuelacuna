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
	
	// Admin project menu
	$('ul#menu li').on('click',function() {
		var id = $(this).attr('id').substring(3); 
		if(id=='add') {
			
		} else {
			$.ajax({
				type:'post', 
				url:'_controllers/operator.php', 
				data: {
					action:'loadproject', 
					project: id
				}, 
				success: function(data) {
					$('.gallery').html(data); 
				}
			}); 
		}
	}); 
}); 
