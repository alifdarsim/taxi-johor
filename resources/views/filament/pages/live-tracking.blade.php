<x-filament-panels::page>

    <script src='https://api.mapbox.com/mapbox-gl-js/v3.1.2/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.1.2/mapbox-gl.css' rel='stylesheet' />

    <div style=' height:calc(100vh - 200px);'>
        <div id='map' class="h-full rounded-xl"></div>
    </div>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiYWxpZmRhcnNpbSIsImEiOiJjbHd6bWRreHIwYm95MmtxejNlM2Z6OHdvIn0.jwgDVjNegtpKWYNNwJb5Tw';
        const map = new mapboxgl.Map({
            // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
            style: 'mapbox://styles/mapbox/standard',
            customAttribution: 'PAJ Taxi Tracker',
            center: [103.760355, 1.465040],
            zoom: 15.5,
            pitch: 55,
            container: 'map',
            antialias: true
        });
        map.addControl(new mapboxgl.NavigationControl());

        // Function to get the current light preset based on the time
        function getCurrentLightPreset() {
            // return 'day';
            const hour = new Date().getHours();
            if (hour >= 5 && hour < 8) {
                return 'dawn';
            } else if (hour >= 8 && hour < 18) {
                return 'day';
            } else if (hour >= 18 && hour < 20) {
                return 'dusk';
            } else {
                return 'night';
            }
        }

        // Initialize the source and layer
        map.on('load', function() {
            const lightPreset = getCurrentLightPreset();
            map.setConfigProperty('basemap', 'lightPreset', lightPreset);

            map.addSource('taxis', {
                type: 'geojson',
                data: {
                    type: 'FeatureCollection',
                    features: []
                }
            });

            map.loadImage(
                'http://myproject.test/custom_marker.png',
                (error, image) => {
                    if (error) throw error;
                    map.addImage('custom-marker', image);

                    map.addLayer({
                        id: 'taxis',
                        type: 'symbol',
                        source: 'taxis',
                        layout: {
                            'icon-image': 'custom-marker',
                            'icon-allow-overlap': true,
                            'icon-size': 0.9,
                            'text-field': ['get', 'id'],
                            'text-offset': [0, -1],
                            'text-anchor': 'bottom',
                            'text-size': 12,
                            'text-allow-overlap': true,
                            'text-ignore-placement': true,
                            'text-font': ['Arial Unicode MS Bold'],
                        }
                    });

                    // Fetch data initially
                    fetchData();
                }
            );
        });

        // Function to update the data source
        function updateMarkers(data) {
            const features = data.map(item => ({
                type: 'Feature',
                geometry: {
                    type: 'Point',
                    coordinates: [item.longitude, item.latitude]
                },
                properties: {
                    id: item.id
                }
            }));

            map.getSource('taxis').setData({
                type: 'FeatureCollection',
                features: features
            });
        }

        // Fetch new data and update markers every 5 seconds
        function fetchData() {
            fetch('http://myproject.test/api/taxi-locations')
                .then(response => response.json())
                .then(data => {
                    updateMarkers(data);
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        setInterval(fetchData, 5000);

        // Optionally, update the map style at regular intervals to handle time changes without refreshing the page
        setInterval(() => {
            const newPreset = getCurrentLightPreset();
            map.setConfigProperty('basemap', 'lightPreset', newPreset);
        }, 60000); // Check every minute

    </script>

</x-filament-panels::page>
