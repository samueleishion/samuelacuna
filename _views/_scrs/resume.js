var PLS = [
	{'title':'HTML','value':0.9,'years':10}, 
	{'title':'CSS','value':0.9,'years':10}, 
	{'title':'JS','value':0.75,'years':6}, 
	{'title':'jQuery','value':0.85,'years':5}, 
	{'title':'d3','value':0.65,'years':1}, 
	{'title':'PHP','value':0.85,'years':8}, 
	{'title':'SQL','value':0.75,'years':8}, 
	{'title':'Python','value':0.85,'years':4}, 
	{'title':'Java','value':0.75,'years':3}, 
	{'title':'C','value':0.65,'years':2}, 
	{'title':'C#','value':0.75,'years':1}, 
	{'title':'Scala','value':0.5,'years':1}, 
	{'title':'Ruby','value':0.5,'years':1}, 
	{'title':'R','value':0.5,'years':1} 
]; 

var LANGS = { 
	'Espa&ntilde;ol':'24 a&ntilde;os', 
	'English':'19 years', 
	'Frean&ccedil;ais':'6 ans'
}; 

$(document).ready(function() { 
	var id, str, barw; 

	for(var i=0; i<PLS.length;i++) {
		id = (PLS[i]['title']=='C#') ? 'CSharp' : PLS[i]['title']; 

		str = '<div class="pl">'; 
		str += '<table><tr><td>'; 
		str += '<span class="pllabel">'+PLS[i]['title']+'</span>'; 
		str += '</td><td>'; 
		str += '<div class="graph">'; 
		str += '<div class="value" id="'+id+'"><span class="years">'+PLS[i]['years']+' year'+((PLS[i]['years']>1) ? 's' : '')+'</span></div>'; 
		str += '</div>'; 
		str += '</td><tr></table>'; 
		str += '</div>'; 
		$('.skills .cs-skills').append(str); 
	}

	barw = $('.graph').width(); 
	for(var i=0; i<PLS.length;i++) {
		id = (PLS[i]['title']=='C#') ? 'CSharp' : PLS[i]['title']; 
		$('.value#'+id).width((PLS[i]['value']*barw)-30); 
	}


})