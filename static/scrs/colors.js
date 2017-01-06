COLORS = [[63,172,163], 
		  [175,77,51], 
		  [163,127,144], 
		  [216,144,103], 
		  [159,90,123], 
		  [85,194,185]]; 

// Selected color index to compare 
var sel1 = choose_random_color(); 
var sel2 = choose_random_color(); 

// Selected colors to use and modify 
var cur1 = COLORS[sel1]; 
var cur2 = COLORS[sel2]; 

// Select color index current colors will be changing to
var sel1 = choose_random_color(); 
var sel2 = choose_random_color(); 


function colors_equal(one,two) {
	var result = true; 
	for(var i = 0;i < one.length;i++) {
		result = result && (one[i]==two[i]); 
	}
	return result; 
}

function choose_random_color() {
	return Math.floor((10*Math.random())%COLORS.length); 
}

function array_to_color(array) {
	var color = "#"; 
	var v1,v2; 
	var val; 

	for(var i = 0; i < array.length; i++) {
		v1 = Math.floor(array[i]/16); 
		v2 = array[i]%16; 

		val = (v1>9) ? String.fromCharCode(97+(v1%10)) : v1.toString(); 
		color += val; 

		val = (v2>9) ? String.fromCharCode(97+(v2%10)) : v2.toString(); 
		color += val; 
	}

	return color; 
} 

function active_gradient() {
	var str1 = ""; 
	var str2 = ""; 
	var hex1,hex2; 

	// If colors match, get a new color 
	if(colors_equal(COLORS[sel1],cur1)) {
		sel1 = choose_random_color(); }
	if(colors_equal(COLORS[sel2],cur2)) {
		sel2 = choose_random_color(); }

	// Change colors 
	for(var i = 0; i < cur1.length; i++) {
		if(cur1[i] < COLORS[sel1][i]) cur1[i]++; 
		else if(cur1[i]==COLORS[sel1][i]) cur1[i] = cur1[i]; 
		else cur1[i]--; 
		str1 += cur1[i].toString()+","; 

		if(cur2[i] < COLORS[sel2][i]) cur2[i]++; 
		else if(cur2[i]==COLORS[sel2][i]) cur2[i] = cur2[i]; 
		else cur2[i]--; 
		str2 += cur2[i].toString()+","; 
	}	
}

function change_a_color() {
	active_gradient(); 
	hex1 = array_to_color(cur1); 

	// change link colors 
	$('a.button').css({'color':'#bbb'}); 
	$('a.button:hover').css({'color':hex1}); 
	$('a:not(.button), li.filter').css({'color':hex1,'background-color':'#fff'}); 
	$('a:hover:not(.button), li.filter:hover').css({'color':'#fff','background-color':hex1}); 
	$('.resumetop,.resumefoot, .pl .graph .value, .lang').css({'color':'#fff','background-color':hex1}); 
	$('.resumetop a.button,.resumefoot a.button').css({'color':'rgba(255,255,255,0.4)'}); 
	$('.resumetop a.button:hover,.resumefoot a.button:hover').css({'color':'rgba(255,255,255,1)'}); 
}


function change_color() {
	active_gradient(); 

	// Show new colors 
	hex1 = array_to_color(cur1); 
	hex2 = array_to_color(cur2); 
	$('#s1').attr('stop-color',hex1); 
	$('#s2').attr('stop-color',hex2); 
}