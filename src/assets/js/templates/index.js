var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v9',
  center: [loc.lon, loc.lat],
  zoom: zoom_level,
});

// Add marker to the map.
if(/* loc.lon != 0 && loc.lon != 0 && */(!override_zoom_level && zoom_level != 0)) {
  new mapboxgl.Marker()
  .setLngLat([loc.lon, loc.lat])
  .addTo(map);
}

// Layer switcher

var layerList = document.getElementById('menu');
var inputs = layerList.getElementsByTagName('input');

function switchLayer(layer) {
  var layerId = layer.target.id;
  map.setStyle('mapbox://styles/mapbox/' + layerId + '-v9');

  if(layerId == "satellite-streets") {
      // Remove active from Streets
      $( "#menu #streets-btn" ).removeClass("active");
      $( "#menu #satellite-streets-btn" ).addClass("active");
  } else if(layerId == "streets") {
      // Remove active class from Satellite Streets
      $( "#menu #satellite-streets-btn" ).removeClass("active");
      $( "#menu #streets-btn" ).addClass("active");
  } else {
      throw "Error: Unknown layer";
  }
}

for (var i = 0; i < inputs.length; i++) {
  inputs[i].onclick = switchLayer;
}