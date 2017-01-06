var vertices, voronoi, svg, path; 
var links = []; 
var d3_geom_voronoi = d3.geom.voronoi().x(function(d) { return d.x; }).y(function(d) { return d.y; }); 
var w = window.innerWidth,
    h = window.innerHeight,
    radius = 1,
    links = [],
    simulate = true,
    // https://github.com/mbostock/d3/blob/master/lib/colorbrewer/colorbrewer.js#L105
    color = d3.scale.quantize().domain([10000, 7250]).range(["rgba(255,255,255,0)","rgba(255,255,255,0)","rgba(255,255,255,0)","rgba(255,255,255,0.01)","rgba(255,255,255,0.05)","rgba(255,255,255,0.1)","rgba(255,255,255,0.2)"])

function get_random_int(min,max) {
    return Math.floor(Math.random() * (max-min+1))+min; 
}

$(document).ready(function() {
    $('#s1').attr('stop-color',array_to_color(cur1)); 
    $('#s2').attr('stop-color',array_to_color(cur2)); 
    interval = window.setInterval("change_color()",100); 

    var numVertices = 300; 
    var vertices = d3.range(numVertices).map(function(i) {
        angle = radius * (i+10);
        return {x: angle*Math.cos(angle)+(w/2), y: angle*Math.sin(angle)+(h/2)};
    });

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
            .style("fill", function(d, i) { return color(0) }) 
            .on("tick", function(d,i) {
                vertices[get_random_int(0,vertices.length)].x = get_random_int(0,w); 
                vertices[get_random_int(0,vertices.length)].y = get_random_int(0,h); 
            }) 
        path.attr("d", function(d) { return "M" + d.join("L") + "Z"; })
            .transition().duration(100).style("fill", function(d, i) { return color(d3.geom.polygon(d).area()) })
        path.exit().remove();

        circle = circle.data(vertices)
        circle.enter().append("circle")
              .attr("r", 0); 
        circle.attr("cx", function(d) { return d.x; })
              .attr("cy", function(d) { return d.y; });

        link = link.data(d3_geom_voronoi.links(vertices))
        link.enter().append("line")
        link.attr("x1", function(d) { return d.source.x; })
            .attr("y1", function(d) { return d.source.y; })
            .attr("x2", function(d) { return d.target.x; })
            .attr("y2", function(d) { return d.target.y; })

        link.exit().remove()

        if(!simulate) {
            force.stop()
        } 
    }
}); 

$(window).resize(function() {
    svg = d3.select("svg")
            .attr("width", window.innerWidth)
            .attr("height", window.innerHeight)
})

