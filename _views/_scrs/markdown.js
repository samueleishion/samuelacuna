// var tags = {}; 
// tags['<'] = '&lt;'; 
// tags['>'] = '&gt;'; 
// tags['['] = '<code>'; 
// tags[']'] = '</code>'; 
// tags["\n"] = '<br>'; 
// tags["\r\n"] = '<br>'; 
// tags
var bold = false; 
var italics = false; 
var header = false; 
var comment = false; 
var keyword = false; 
var actionword = false; 

function markdown(string) {
	var result = "<p>"; 
	var next; 
	for(var i = 0; i < string.length; i++) {
		switch(string[i]) {
			case '<':
				result += '&lt;'; 
				break; 
			case '>':
				result += '&gt;'; 
				break; 
			case "\n":
			case "\r\n":
				result += '<br>'; 
				break; 
			case '{': // {{ code 
				result += search_next(string[++i],'{','<code>'); 
				// next = string[++i]; 
				// if(next!=null) {
				// 	if(next=='{')
				// 		result += '<code>'; 
				// 	else result += '{'+string[i]; 
				// } else result += '{'; 
				break; 
			case '}':
				result += search_next(string[++i],'}','</code>'); 
				// next = string[++i]; 
				// if(next!=null) { 
				// 	if(next=='}')
				// 		result += '</code>'; 
				// 	else result += '}'+string[i]; 
				// } else result += '}'; 
				break; 
			case '_': // __ bold
				result += search_next(string[++i],'_',(bold) ? '</b>' : '<b>'); 
				break; 
			case '*': // ** italics
				result += search_next(string[++i],'*',(italics) ? '</i>' : '<i>'); 
				break; 
			case '#': // ## header, ### subheader 
				result += search_next(string[++i],'#',(header) ? '</h>' : '<h>'); 
				break; 
			case '/': // comment 
				result += search_next(string[++i],'/',(comment) ? '</comment>' : '<comment>'); 
				break; 
			case ':': // keyword 
				result += search_next(string[++i],':',(keyword) ? '</keyword>' : '<keyword>'); 
				break; 
			case ';': // actionword 
				result += search_next(string[++i],';',(actionword) ? '</actionword>' : '<actionword>'); 
				break; 
			case '~': // ~~ tab
				result += search_next(string[++i],'~','&nbsp;&nbsp;&nbsp;&nbsp;'); 
				break; 
			case '[': // url 
			default: 
				result += string[i]; 
			break; 
		}


	}

	result += "</p>"; 
	return result; 
}

function search_next(next,search,result) { 
	var out; 
	if(next!=null) {
		if(next==search) {
			out = result; 
			switch(search) {
				case '_': bold = !bold; break 
				case '*': italics = !italics; break; 
				case '#': header = !header; break; 
				case '/': comment = !comment; break; 
				case ':': keyword = !keyword; break; 
				case ';': actionword = !actionword; break; 
				default: break; 
			}
		} else out = search+next; 
	} else out = search; 
	return out; 
}