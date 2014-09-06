COLORS = [//[191,238,230], 
		  [63,172,163], 
		  [175,77,51], 
		  [163,127,144], 
		  [216,144,103], 
		  [159,90,123], 
		  [85,194,185]]; 

var ajaxLoadedSubmit;
	
$(function() {
	$('#Grid').mixitup(); 
}); 

$(document).ready(function() {
	ajaxLoadedSubmit = false; 
	interval = window.setInterval("change_a_color()",100); 

	$('.gallery,.preview').css('width',($(document).width()-242)/2); 
	$('.preview').css('width',($('.preview').width()+20)); 

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
					// Determine whether project is public or private
					if($('input#status').val()==1) {
						$('.status .submit#knob').css({
							'left':'20px'
						}); 
						$('.status .button#slide').css({
							'background-color':'#33d8a7'
						}); 
						$('.status .label').html('public');
					}  
				}, 
				complete: function(data) {
					feedPreview(); 
				}
			}); 
		}
	}); 
	$('ul#menu li.curtainOpen').next().click(); 
	
	// Show curtains
	showCurtains(); 
	
	// Submit stuff
	activateSubmit(); 
	
	// Upload images 
	$('body').on('change','input#images',function() {
		$('input#proj').attr("value",$('input#project').val()); 
		var form = new FormData($('#uploadform')[0]); 
		$.ajax({ 
			url: '_controllers/operator.php',
			type: 'POST', 
			xhr: function() {
				var myxhr = $.ajaxSettings.xhr(); 
				if(myxhr.upload) {
					myxhr.upload.addEventListener('progress', progress, false); 
				}
				return myxhr; 
			}, 
			success: function(data) {
				location.reload(); 
			}, 
			error: function(data) {
				console.log("ERROR on upload"); 
				// console.log(data); 
			}, 
			data: form, 
			cache: false, 
			contentType: false, 
			processData: false
		}); 
	}); 
	
}).ajaxComplete(function() {
	
	// Submit loaded stuff
	if(!ajaxLoadedSubmit) {
		$('.submit').off('click',function() {return 0;}); 
		activateSubmit();
	}

	updatePreview(); 
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
		// var id = $(this).attr('id').toLowerCase();
		// console.log('out '+id);  
		onSubmit($(this));   
	});  
}

// Function to preview the modified entry/project 
function updatePreview() {
	$('.gallery #newname, .gallery #newdesc').on('keyup',function() {
		feedPreview(); 
	}); 
}

function feedPreview() {
	$('.preview').html(' '); 

	var title = $('.gallery #newname').val(); 
	var entry = $('.gallery #newdesc').val(); 
	var type = $('.gallery #newtype').val(); 
	var imgs = $('.gallery img'); 
	var cover; 
	var content; 

	if(type=="portfolio") {
		content = '<content>'; 
		content += '<h1>'+title+'</h1>'+content+'<br>'; 
		for(var i=0; i<imgs.length; i++)
			content += '<img src="'+imgs[i]["src"]+'">'; 
	} else {
		content = '<content class="markdown">'; 
		// console.log(imgs.length); 
		// console.log(imgs); 
		if(imgs.length>0)
			cover = imgs[0]["src"]; 
		else cover = '_views/_imgs/_uploads/_default.png'; 
		// console.log(cover); 
		content += '<div class="entrycover" style="background-image:url('+cover+');"></div>';
		content += '<h1>'+title+'</h1>'; 
		// console.log(entry); 
		//for(var i=1; i<imgs.length; i++)
			//content += '<img src="'+imgs[i]["src"]+'">'; 
		// console.log(markdown(entry)); 
		content += markdown(entry); 
		// console.log(markdown(entry)); 
		//content += '<p>'+markdown(entry)+'</p>'; 
	} 
	content += '</content>'; 

	// console.log(content); 

	$('.preview').append(content); 
	$('.preview').height($('.gallery').height()+20); 
}

function onSubmit(button) {
	// console.log('click'); 
	var id = button.attr('id').toLowerCase();  
	// console.log(id); 
	switch(id) {
		case 'addproject': 
			var name = $('#newProjectName').val(); 
			var desc = $('#newProjectDescription').val(); 
			var page = $('input[name="newProjectType"]:checked').val(); 
			$.ajax({
				type:'post',
				url:'_controllers/operator.php', 
				data: {
					action:id, 
					name:name, 
					desc:desc, 
					page:page
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
		case 'editproject':
			var newname = $('input#newname').val(); 
			var newdesc = $('textarea#newdesc').val(); 
			var proj = $('input#project').val(); 
			var types = []; 
			$("input[name='types[]']:checked").each(function(){
				types.push($(this).val()); 
			}); 
			$.ajax({
				type:'post',
				url:'_controllers/operator.php', 
				data: {
					action: id, 
					project: proj, 
					newname: newname, 
					newdesc: newdesc, 
					types: types
				}, 
				success: function(data) {
					var projid = $('input#project').val();
					$.ajax({
						type:'post', 
						url:'_controllers/operator.php', 
						data: {
							action:'loadproject', 
							project: projid
						}, 
						success: function(data) {
							alert("success!"); 
							$('.gallery').html(data); 
							// Determine whether project is public or private
							if($('input#status').val()==1) {
								$('.status .submit#knob').css({
									'left':'20px'
								}); 
								$('.status .button#slide').css({
									'background-color':'#33d8a7'
								}); 
								$('.status .label').html('public');
							}  
						}, 
						error: function(data) {
							alert("There was an error. Please try again later. "); 
						}
					});  
					// location.reload(); 
				}
			}); 
			break; 
		case 'addimages':
			$('input#images').trigger('click'); 
			break;  
		case 'imgcover':
			var img = button.attr('image'); 
			var proj = $('#project').val(); 
			$.ajax({
				type:'post',
				url:'_controllers/operator.php', 
				data: { 
					action:id, 
					project:proj, 
					image:img
				}, 
				success: function(data) {
					var projid = $('input#project').val();
					$.ajax({
						type:'post', 
						url:'_controllers/operator.php', 
						data: {
							action:'loadproject', 
							project: projid
						}, 
						success: function(data) {
							alert("success!"); 
							$('.gallery').html(data); 
							// Determine whether project is public or private
							if($('input#status').val()==1) {
								$('.status .submit#knob').css({
									'left':'20px'
								}); 
								$('.status .button#slide').css({
									'background-color':'#33d8a7'
								}); 
								$('.status .label').html('public');
							}  
						}, 
						error: function(data) {
							alert("There was an error. Please try again later. "); 
						}
					});  
					// location.reload(); 
				}
			}); 
			break; 
		case 'delimg':
			var img = button.attr('image'); 
			var proj = $('#project').val(); 
			$.ajax({
				type:'post',
				url:'_controllers/operator.php', 
				data: {
					action:id, 
					project:proj, 
					image:img
				}, success: function(data) {
					var projid = $('input#project').val();
					$.ajax({
						type:'post', 
						url:'_controllers/operator.php', 
						data: {
							action:'loadproject', 
							project: projid
						}, 
						success: function(data) {
							alert("success!"); 
							$('.gallery').html(data); 
							// Determine whether project is public or private
							if($('input#status').val()==1) {
								$('.status .submit#knob').css({
									'left':'20px'
								}); 
								$('.status .button#slide').css({
									'background-color':'#33d8a7'
								}); 
								$('.status .label').html('public');
							}  
						}, 
						error: function(data) {
							alert("There was an error. Please try again later. "); 
						}
					});  
					// location.reload(); 
				}
			}); 
			break; 
		case 'knob':
			slideKnob(); 
			break; 
		default: 
			data = null; 
			break;
	}
}

function progress(e) {
	if(e.lengthComputable) {
		$('progress').attr({value:e.loaded,max:e.total}); 
	}
}

// move status slider knob
function slideKnob() {
	var status = $('input#status'); 
	var value = status.val(); 
	// console.log('prev val: '+value);
	
	if(value==1) {
		$('.status .submit#knob').animate({
			'left':'-11px'
		},100); 
		$('.status .button#slide').css({
			'background-color':'#f3f3f3'
		});
	} else {
		$('.status .submit#knob').animate({
			'left':'20px'
		},100); 
		$('.status .button#slide').css({
			'background-color':'#33d8a7'
		}); 
	}
	
	var a = 'projectstatus'; 
	var project = $('input#project').val(); 
	var update = (value==1) ? 0 : 1; 
	$.ajax({
		type:'post',
		url:'_controllers/operator.php', 
		data: {
			action:a, 
			project:project, 
			status:update
		}, 
		success: function(data) {
			status.val((value==1) ? 0 : 1);  
		}
	}); 
	
	// console.log('curr val: '+value); 
}
