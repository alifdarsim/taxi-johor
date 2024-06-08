<!-- Include Mapbox CSS and JS -->

<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
        Latitude: {{ $getState()->latitude }}
    </div>
    <div>
        Longitude: {{ $getState()->longitude }}
    </div>

    <!-- Map container -->
    <div id="map" style="width: 100%; height: 400px;"></div>
</x-dynamic-component>

@assets
<script src='https://api.mapbox.com/mapbox-gl-js/v3.1.2/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v3.1.2/mapbox-gl.css' rel='stylesheet' />
@endassets

@script
<script>
    setInterval(() => {

    }, 2000)
</script>
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiYWxpZmRhcnNpbSIsImEiOiJjbHd6bWRreHIwYm95MmtxejNlM2Z6OHdvIn0.jwgDVjNegtpKWYNNwJb5Tw';
    const map = new mapboxgl.Map({
        // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
        style: 'mapbox://styles/mapbox/standard',
        center: [103.760355, 1.465040],
        zoom: 15.5,
        bearing: -17.6,
        container: 'map',
        antialias: true
    });

    map.on('style.load', () => {
        // Insert the layer beneath any symbol layer.
        const layers = map.getStyle().layers;
        const labelLayerId = layers.find(
            (layer) => layer.type === 'symbol' && layer.layout['text-field']
        ).id;

        // The 'building' layer in the Mapbox Streets
        // vector tileset contains building height data
        // from OpenStreetMap.
        map.addLayer(
            {
                'id': 'add-3d-buildings',
                'source': 'composite',
                'source-layer': 'building',
                'filter': ['==', 'extrude', 'true'],
                'type': 'fill-extrusion',
                'minzoom': 15,
                'paint': {
                    'fill-extrusion-color': '#aaa',

                    // Use an 'interpolate' expression to
                    // add a smooth transition effect to
                    // the buildings as the user zooms in.
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
            },
            labelLayerId
        );
    });
</script>
@endscript


