/*
 * @copyright 2015 commenthol
 * @license MIT
 */

/* globals L */

function iniciar() {
    var datos = document.getElementById("datos");
    var json = datos.innerHTML;
    obj = JSON.parse(json);
    
	var minZoom = 4,
		maxZoom = 7,
		img = [
			3011,  // original width of image
			2029   // original height of image
		];

	var southWest = L.latLng(14.12, -117.88),
    northEast = L.latLng(32.66, -85.88),
    bounds = L.latLngBounds(southWest, northEast);
	
	// create the map
	var map = L.map('map',{
			center: new L.LatLng(23.6266557, -102.5377501), 
			zoom: 4,
			minZoom: minZoom,
			maxZoom: maxZoom,
			maxBounds: bounds,
		});

	// assign map and image dimensions
	var rc = new L.RasterCoords(map, img);
	// set the bounds on map

	// the tile layer containing the image generated with gdal2tiles --leaflet ...
	var geo = new L.tileLayer('../tiles/{z}/{x}/{y}.png', {
		noWrap: true,
		attribution: 'CONABIO',
		tms: true,
	});
	var i = 0;
	var ggl = new L.Google();
    var polygon = new L.geoJson(obj);
	
	map.addLayer(geo);
    map.addLayer(polygon);
	map.addLayer(ggl);
	
	var l_parent = getLayer(map._layers)._container,
	l_child = map._layers[22]._container,
       handle = document.getElementById('handle'),
      dragging = false;
	  cuadro = $("#map").width();
    
  handle.onmousedown = function() { 
  	dragging = true; 
	return false;
  }
  document.onmouseup = function() { 
  	dragging = false; 
  }
  document.onmousemove = function(e) {
      if (!dragging) return;
    
      setDivide(e.x-40);
  }
  map.on( "zoomend", function( e ) {
   l_parent = getLayer(map._layers)._container;
   l_child = map._layers[22]._container;
   setDivide(parseInt(handle.style.left));
  });
  map.on( "moveend", function( e ) {
   l_parent = getLayer(map._layers)._container;
   l_child = map._layers[22]._container;
   setDivide(parseInt(handle.style.left));
  });
    map.on( "drag", function( e ) {
   l_parent = getLayer(map._layers)._container;
   l_child = map._layers[22]._container;
   setDivide(parseInt(handle.style.left));
  });
    
  function setDivide(x) {
      x = Math.max(0, Math.min(x, map.getSize()['x']));
	  //if(x>762)
	  	//x=762;
      handle.style.left = (x) + 'px';
      var layerX = map.containerPointToLayerPoint(x,0).x;
	  //layerX = layerX-39;
	  
       l_parent.style.clip = 'rect(-99999px ' + x + 'px 999999px -99999px)';
	  l_child.style.clip = 'rect(-99999px 999999px 999999px ' + layerX + 'px)';
}
  
  function getLayer(obj) {
    var last;
    for (var i in obj) {
        if (obj.hasOwnProperty(i) && typeof(i) !== 'function') {
            last = obj[i];
        }
    }
    return last;
  }
   
  setDivide(450);
}
function cambia() {
  var screen = $(document).width();
    
    if(screen < 900){
        alert("Esta sección no ha sido desarrollada para pantallas menores a 900px");
        window.location.assign("http://integridadecosistemica.info/index.php");
    }
}