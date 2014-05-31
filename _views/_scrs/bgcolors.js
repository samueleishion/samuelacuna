COLORS = [//[191,238,230], 
		  [63,172,163], 
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

//var width = window.innerWidth; //window.width; 
//var height = window.innerHeight; //window.height; 
var vertices, voronoi, svg, path; 
var links = []; 
var d3_geom_voronoi = d3.geom.voronoi().x(function(d) { return d.x; }).y(function(d) { return d.y; }); 
var w = window.innerWidth,
    h = window.innerHeight,
    radius = 1,
    links = [],
    simulate = true,
    // zoomToAdd = true,
    // https://github.com/mbostock/d3/blob/master/lib/colorbrewer/colorbrewer.js#L105
    color = d3.scale.quantize().domain([10000, 7250]).range(["rgba(255,255,255,0)","rgba(255,255,255,0)","rgba(255,255,255,0)","rgba(255,255,255,0)","rgba(255,255,255,0.01)","rgba(255,255,255,0.05)","rgba(255,255,255,0.1)"])

function change_color() {
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

	// Show new colors 
	hex1 = array_to_color(cur1); 
	hex2 = array_to_color(cur2); 
	$('#s1').attr('stop-color',hex1); 
	$('#s2').attr('stop-color',hex2); 
}

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

function get_random_int(min,max) {
	return Math.floor(Math.random() * (max-min+1))+min; 
}

$(document).ready(function() {
	$('#s1').attr('stop-color',array_to_color(cur1)); 
	$('#s2').attr('stop-color',array_to_color(cur2)); 
	interval = window.setInterval("change_color()",100); 
	//draw(); 

    var numVertices = (w*h) / 3000;
    console.log("numVertices = "+numVertices); 
    var vertices = d3.range(numVertices).map(function(i) {
        angle = radius * (i+10);
        return {x: angle*Math.cos(angle)+(w/2), y: angle*Math.sin(angle)+(h/2)};
    });
    // var d3_geom_voronoi = d3.geom.voronoi().x(function(d) { return d.x; }).y(function(d) { return d.y; })
    // var prevEventScale = 1;
    // var zoom = d3.behavior.zoom().on("zoom", function(d,i) {
    //     if (zoomToAdd){
    //       if (d3.event.scale > prevEventScale) {
    //           angle = radius * vertices.length;
    //           vertices.push({x: angle*Math.cos(angle)+(w/2), y: angle*Math.sin(angle)+(h/2)})
    //       } else if (vertices.length > 2 && d3.event.scale != prevEventScale) {
    //           vertices.pop();
    //       }
    //       force.nodes(vertices).start()
    //     } else {
    //       if (d3.event.scale > prevEventScale) {
    //         radius+= .01
    //       } else {
    //         radius -= .01
    //       }
    //       vertices.forEach(function(d, i) {
    //         angle = radius * (i+10);
    //         vertices[i] = {x: angle*Math.cos(angle)+(w/2), y: angle*Math.sin(angle)+(h/2)};
    //       });
    //       force.nodes(vertices).start()
    //     }
    //     prevEventScale = d3.event.scale;
    // });

    svg = d3.select("svg")
            .attr("width", w)
            .attr("height", h)

    var force = d3.layout.force()
            .charge(-300)
            .size([w, h])
            .on("tick", update);

    force.nodes(vertices).start();

    var circle = svg.selectAll("circle");
    var path = svg.selectAll("path");
    var link = svg.selectAll("line");

    function update(e) {
        path = path.data(d3_geom_voronoi(vertices))
        path.enter().append("path")
            // drag node by dragging cell
            /*.call(d3.behavior.drag()
              .on("drag", function(d, i) {
                  vertices[i] = {x: vertices[i].x + d3.event.dx, y: vertices[i].y + d3.event.dy}
              })
            )*/ 
            .style("fill", function(d, i) { return color(0) }) 
            // .on("mousemove", function (d,i) {
            // 	vertices[0].x = d3.mouse(this)[0]; 
            // 	vertices[0].y = d3.mouse(this)[1]; 
            // })
            .on("tick", function(d,i) {
            	for(var i = 0; i < 4; i++) {
            		vertices[get_random_int(0,vertices.length)].x = get_random_int(0,w); 
            		vertices[get_random_int(0,vertices.length)].y = get_random_int(0,h); 
            	}
            }) 
        path.attr("d", function(d) { return "M" + d.join("L") + "Z"; })
            .transition().duration(100).style("fill", function(d, i) { return color(d3.geom.polygon(d).area()) })
        path.exit().remove();

        circle = circle.data(vertices)
        circle.enter().append("circle")
              .attr("r", 0)
              //.transition().duration(1000).attr("r", 5);
        circle.attr("cx", function(d) { return d.x; })
              .attr("cy", function(d) { return d.y; });
        //circle.exit().transition().attr("r", 0).remove();

        link = link.data(d3_geom_voronoi.links(vertices))
        link.enter().append("line")
        link.attr("x1", function(d) { return d.source.x; })
            .attr("y1", function(d) { return d.source.y; })
            .attr("x2", function(d) { return d.target.x; })
            .attr("y2", function(d) { return d.target.y; })

        link.exit().remove()

        if(!simulate) {
        	console.log("stopping"); 
        	force.stop()
        } 
    }
}); 

$(window).resize(function() {
    svg = d3.select("svg")
            .attr("width", window.innerWidth)
            .attr("height", window.innerHeight)
})

