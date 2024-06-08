<link href="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.js"></script>
<style>
    body { margin: 0; padding: 0; }
    #map { position: absolute; top: 0; bottom: 0; width: 100%; }
</style>

<div id="map"></div>

<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiYWxpZmRhcnNpbSIsImEiOiJjbHd6bTg2ZHowYm45MmtxenFja2FvZms2In0.1RFLUmJyVyUSpMau2aZIDg';
    const map = new mapboxgl.Map({
        container: 'map',
        // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
        style: 'mapbox://styles/mapbox/light-v11',
        center: [-87.62712, 41.89033],
        zoom: 15.5,
        pitch: 45
    });

    function rotateCamera(timestamp) {
        // clamp the rotation between 0 -360 degrees
        // Divide timestamp by 100 to slow rotation to ~10 degrees / sec
        map.rotateTo((timestamp / 100) % 360, { duration: 0 });
        // Request the next frame of the animation.
        requestAnimationFrame(rotateCamera);
    }

    map.on('load', () => {
        // Start the animation.
        rotateCamera(0);

        // Add 3D buildings and remove label layers to enhance the map
        const layers = map.getStyle().layers;
        for (const layer of layers) {
            if (layer.type === 'symbol' && layer.layout['text-field']) {
                // remove text labels
                map.removeLayer(layer.id);
            }
        }

        map.addLayer({
            'id': '3d-buildings
            'source': 'composite',
            'source-layer': 'building',
            'filter': ['==', 'extrude', 'true'],
            'type': 'fill-extrusion',
            'minzoom': 15,
            'paint': {
                'fill-extrusion-color': '#aaa',

                // use an 'interpolate' expression to add a smooth transition effect to the
                // buildings as the user zooms in
                'fill-extrusion-height': [
                    'interpolate',
                    ['linear'],
                    ['zoom'],
                    15,
                    0,
                    15.05,
                    ['get', 'height']
                ],
                'fill-extrusion-base': [
                    'interpolate',
                    ['linear'],
                    ['zoom'],
                    15,
                    0,
                    15.05,
                    ['get', 'min_height']
                ],
                'fill-extrusion-opacity': 0.6
            }
        });
    });
</script>

