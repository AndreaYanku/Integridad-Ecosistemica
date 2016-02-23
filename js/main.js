/*
 * @copyright 2015 commenthol
 * @license MIT
 */

/* globals L */

function init() {
    var formulario=document.getElementById("formulario-mapa");
    var instrucciones=document.getElementById("instrucciones");
    
	$("#r1").ionRangeSlider({
        min: 0,
        max: 100,
        from: 0,
        grid:true,
	});
	
	var minZoom = 4,
		maxZoom = 9,
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
	var geo = new L.tileLayer('./tiles/{z}/{x}/{y}.png', {
		noWrap: true,
		attribution: 'CONABIO',
		tms: true,
	});
	var i = 0;
	var ggl = new L.Google();
    var ggl2 = new L.Google();
	
    map.addLayer(ggl2);
	map.addLayer(geo);
    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);
	map.addLayer(ggl);
    
	
			
	// Set the title to show on the polygon button
    L.drawLocal.draw.toolbar.buttons.polygon = 'Dibujar un polígono';
    
    
    var drawControl = new L.Control.Draw({
			position: 'topright',
			draw: {
				polyline: false,
				polygon: {
					allowIntersection: false,
					showArea: false,
					drawError: {
						color: '#b00b00',
						timeout: 1000
					},
					shapeOptions: {
						color: '#000'
					}
				},
				circle: false,
				marker: false,
				rectangle: false
			},
			edit: {
				featureGroup: drawnItems,
				remove: false
			}
		});
		map.addControl(drawControl);

		map.on('draw:created', function (e) {
			if(i<1){
			var type = e.layerType,
				layer = e.layer;

			drawnItems.addLayer(layer);
            
            instrucciones.style.display="none";
			formulario.style.display="block";
                
            var type = e.layerType;

            var shape = layer.toGeoJSON();
            var shape_for_db = JSON.stringify(shape);
            $('#datos').val(shape_for_db);
                
			}else{
				alert("Ya existe un poligono. Puedes editalo");
			}
			i++;
		});

		map.on('draw:edited', function (e) {
			var layers = e.layers;
			var countOfEditedLayers = 0;
			layers.eachLayer(function(layer) {
                var shape = layer.toGeoJSON()
                var shape_for_db = JSON.stringify(shape);
                $('#datos').val(shape_for_db);                
                
				countOfEditedLayers++;
			});
		});    
	console.log(map._layers);
	var l_parent = map._layers[26]._container,
	l_child = map._layers[23]._container,
       handle = document.getElementById('handle'),
        line = document.getElementById('line'),
      dragging = false;
	  cuadro = $("#map").width();
    console.log(l_parent);
    console.log(l_child);
    
  handle.onmousedown = function() { 
  	dragging = true; 
	return false;
  }
  document.onmouseup = function() { 
  	dragging = false; 
  }
  document.onmousemove = function(e) {
      if (!dragging) return;
      
      var screen = $(document).width();
      screen = ((screen * .6666666667)-900)/2;
      setDivide(e.x-screen);
  }
  map.on( "zoomend", function( e ) {
   l_parent = map._layers[26]._container;
    l_child = map._layers[23]._container;
   setDivide(parseInt(handle.style.left));
  });
  map.on( "moveend", function( e ) {
   l_parent = map._layers[26]._container;
	l_child = map._layers[23]._container;
   setDivide(parseInt(handle.style.left));
  });
    map.on( "drag", function( e ) {
   l_parent = map._layers[26]._container;
	l_child = map._layers[23]._container;
   setDivide(parseInt(handle.style.left));
  });
    
  function setDivide(x) {
      x = Math.max(0, Math.min(x, map.getSize()['x']));
	  //if(x>762)
	  	//x=762;
      handle.style.left = (x) + 'px';
      line.style.left = (x) + 'px';
      var layerX = map.containerPointToLayerPoint(x,0).x;
	  //layerX = layerX-39;
	  
       l_parent.style.clip = 'rect(-99999px ' + x + 'px 999999px -99999px)';
	  l_child.style.clip = 'rect(-99999px 999999px 999999px ' + layerX + 'px)';
      /*console.log("p");
      console.log(l_parent);
      console.log("c");
      console.log(l_child);*/
}
  
  function getLayer(obj) {
    var last;
    var a=0;

    for (var i in obj) {
        if (obj.hasOwnProperty(i) && typeof(i) !== 'function') {
            if(a==2){
                last = obj[i];
            }
            a++;
        }
    }
    return last;
  }
   
  setDivide(450);
}
function cambio() {
  var screen = $(document).width();
    
    if(screen < 900){
        alert("Esta sección no ha sido desarrollada para pantallas menores a 900px");
        window.location.assign("http://integridadecosistemica.info/index.php");
    }
}