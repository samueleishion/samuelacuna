$(document).ready(function() {
	$('.log').on("click", function() {
		var id = $(this).attr('id'); 
		$.ajax({
			type:'post', 
			url:'_controllers/operator.php', 
			data: {
				action:id
			},
			success: function(data) { 
				location.reload(); 
			} 
		}); 
	}); 
}); 
