(function() {

// Chart design based on the recommendations of Stephen Few. Implementation
// based on the work of Clint Ivy, Jamie Love, and Jason Davies.
// http://projects.instantcognition.com/protovis/bulletchart/
d3.bullet = function() {
  var orient = "left",
      reverse = false,
      vertical = false,
      ranges = function(d){return d.ranges},
      markers = function(d){return d.markers},
      measures = function(d){return d.measures},
      width = 380,
      height = 30,
      xAxis = d3.svg.axis();

  // For each small multiple…
  function bullet(g) {
    g.each(function(d, i) {
      var rangez = typeof ranges === "function" ? ranges.call(this, d, i) : ranges,
          markerz = typeof markers === "function" ? markers.call(this, d, i) : markers,
          measurez = typeof measures === "function" ? measures.call(this, d, i) : measures,
          g = d3.select(this),
          extentX,
          extentY;

      rangez = rangez.slice().sort(d3.descending);
      markerz = markerz.slice();
      measurez = measurez.slice();

      var wrap = g.select("g.wrap");
      if (wrap.empty()) wrap = g.append("g").attr("class", "wrap");

      if (vertical) {
        extentX = height, extentY = width;
        wrap.attr("transform", "rotate(90)translate(0," + -width + ")");
      } else {
        extentX = width, extentY = height;
        wrap.attr("transform",null);
      }

      // Compute the new x-scale.
      var x1 = d3.scale.linear()
          .domain([0, Math.max(rangez[0], d3.max(markerz), measurez[0])])
          .range(reverse ? [extentX, 0] : [0, extentX]);

      // Retrieve the old x-scale, if this is an update.
      var x0 = this.__chart__ || d3.scale.linear()
          .domain([0, Infinity])
          .range(x1.range());

      // Stash the new scale.
      this.__chart__ = x1;

      // Derive width-scales from the x-scales.
      var w0 = bulletWidth(x0),
          w1 = bulletWidth(x1);

      // Update the range rects.
      var range = wrap.selectAll("rect.range")
          .data(rangez);

      range.enter().append("rect")
          .attr("class", function(d, i) { return "range s"+i+" t"+range.size(); })
          .attr("width", w0)
          .attr("height", extentY)
          .attr("x", reverse ? x0 : 0)

      d3.transition(range)
          .attr("x", reverse ? x1 : 0)
          .attr("width", w1)
          .attr("height", extentY);

      // Update the marker lines.
      var marker = wrap.selectAll("line.marker")
          .data(markerz);

      marker.enter().append("line")
          .attr("class", function(d, i) { return "marker s"+i; })
          .attr("x1", x0)
          .attr("x2", x0)
          .attr("y1", extentY / 6)
          .attr("y2", extentY * 5 / 6);

      d3.transition(marker)
          .attr("x1", x1)
          .attr("x2", x1)
          .attr("y1", extentY / 6)
          .attr("y2", extentY * 5 / 6);

      // Update the measure rects.
      var measure = wrap.selectAll("rect.measure")
          .data(measurez);

      measure.enter().append("rect")
          .attr("class", function(d, i) { return "measure s"+i; })
          .sort(d3.descending)
          .attr("width", w0)
          .attr("height", extentY / 3)
          .attr("x", reverse ? x0 : 0)
          .attr("y", extentY / 3);

      d3.transition(measure)
          .attr("width", w1)
          .attr("height", extentY / 3)
          .attr("x", reverse ? x1 : 0)
          .attr("y", extentY / 3);

      var axis = g.selectAll("g.axis").data([0]);
      axis.enter().append("g").attr("class", "axis");
      if (!vertical) axis.attr("transform", "translate(0,"+extentY+")")
      axis.call(xAxis.scale(x1));
    });
    d3.timer.flush();
  }

  // left, right, top, bottom
  bullet.orient = function(_) {
    if (!arguments.length) return orient;
    orient = _ + "";
    reverse = orient == "right" || orient == "bottom";
    xAxis.orient((vertical = orient == "top" || orient == "bottom") ? "left" : "bottom");
    return bullet;
  };

  // ranges (bad, satisfactory, good)
  bullet.ranges = function(_) {
    if (!arguments.length) return ranges;
    ranges = _;
    return bullet;
  };

  // markers (previous, goal)
  bullet.markers = function(_) {
    if (!arguments.length) return markers;
    markers = _;
    return bullet;
  };

  // measures (actual, forecast)
  bullet.measures = function(_) {
    if (!arguments.length) return measures;
    measures = _;
    return bullet;
  };

  bullet.width = function(_) {
    if (!arguments.length) return width;
    width = +_;
    return bullet;
  };

  bullet.height = function(_) {
    if (!arguments.length) return height;
    height = +_;
    return bullet;
  };

  return d3.rebind(bullet, xAxis, "tickFormat");
};

function bulletWidth(x) {
  var x0 = x(0);
  return function(d) {
    return Math.abs(x(d) - x0);
  };
}

})();
