var ajaxLoadedSubmit; 

$(document).ready(function() {
	ajaxLoadedSubmit = false; 
	
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
	
	$('#logout').on('click',function(e) {
		e.preventDefault(); 
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
	$('ul#menu li').on('click',function(e) {
		var id = $(this).attr('id').substring(4); 
		if($(this).attr('id')=='addProject') {
			e.preventDefault(); 
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
	
	// Show curtains
	showCurtains(); 
	
	// Submit stuff
	activateSubmit(); 
	
}).ajaxComplete(function() {
	
	// Submit loaded stuff
	if(!ajaxLoadedSubmit) {
		$('.submit').off('click',function() {return 0;}); 
		activateSubmit();
	} 
}); 

// Show curtains
function showCurtains() {
	$('.curtainOpen').on('click',function() {
		var id = $(this).attr('id'); 
		$('.curtain#'+id).fadeIn(); 
	}); 
	$('.curtainClose').on('click',function() {
		var id = $(this).attr('id'); 
		$('.curtain#'+id).fadeOut(); 
	})
}

// Function to activate form submissions
function activateSubmit() {
	// Submit stuff
	$('.submit').on('click', function(e) {
		e.preventDefault(); 
		onSubmit($(this)); 
	});  
}

function onSubmit(button) {
	console.log('click'); 
	var id = button.attr('id').toLowerCase();  
	switch(id) {
		case 'addproject': 
			var name = $('#newProjectName').val(); 
			var desc = $('#newProjectDescription').val(); 
			$.ajax({
				type:'post',
				url:'_controllers/operator.php', 
				data: {
					action:id, 
					name:name, 
					desc:desc
				}, 
				success: function(data) { 
					location.reload(); 
				}
			}); 
			break;
		case 'delproject':
			 var proj = $('input#project').val(); 
			 $.ajax({
			 	type:'post',
			 	url:'_controllers/operator.php',
			 	data: {
			 		action:id, 
			 		project:proj
			 	}, 
			 	success: function(data) {
			 		location.reload(); 
			 	}
			 }); 
			 break; 
		default: 
			data = null; 
			break;
	}
}
// Function for ajaxRequests
function ajaxRequest(data) {
	$.ajax({
		type:'post',
		url:'_controllers/operator.php', 
		data: data, 
		success: function(data) {
			console.log(data); 
		}
	})
}
