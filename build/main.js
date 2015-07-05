// Create the initial Map.
function initialize() {
    map = new google.maps.Map(document.getElementById('map-canvas'), {
        zoom: 13,
        center: new google.maps.LatLng(-27.470578, 153.023139),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true
    });
}

// Display the Map.
google.maps.event.addDomListener(window, 'load', initialize);

// Create the Data Structure to store the Map Data.
var mapData = {
    BrisbaneCity: {
        BikeRacks: {displayed: false, data: [], marker: []},
        DrinkingFountains: {displayed: false, data: [], marker: []},
        WiFi: {displayed: false, data: [], marker: []},
        GolfCourse: {displayed: false, data: [], marker: []},
        ParkFacility: {displayed: false, data: [], marker: []},
        Pool: {displayed: false, data: [], marker: []}
    }
};

// Child clicked.
function navToggleChild(category, subcategory) {
    // If there is no data for the requested child category, fetch it and create the marker objects for them.
    if (jQuery.isEmptyObject(mapData[category][subcategory]['data']) === true) {
        // Fetch the Data.
        console.log('Fetching Ajax Data for: '+subcategory);
        fetchAjaxData(category, subcategory);
    } else {
        // Toggle the PIN on/off.
        for (i = 0; i < mapData[category][subcategory]['marker'].length; i++) {
            if (mapData[category][subcategory]['marker'][i].getMap() == null) {
                mapData[category][subcategory]['marker'][i].setMap(map);
            } else {
                mapData[category][subcategory]['marker'][i].setMap(null);
            }
        }
    }  
}

// Fetch Data.
function fetchAjaxData(category, subcategory) {
	$.ajax({
		method: "POST",
		dataType: "json",
		url: "ajax.php",
		data: {category: subcategory},
		success: function(data) {
            for (i = 0; i < data.length; ++i) {
                mapData[category][subcategory]['data'].push([data[i][2], data[i][3], data[i][4]])
            }
            console.log('Fetching Ajax Data Complete!');
            console.log(mapData[category][subcategory]);
            // Build the Markers with the new data.
            buildMarkers(category, subcategory);
            // Update the Heatmap.
        heatmap();
		}
	});
}

// Build Markers.
function buildMarkers(category, subcategory) {
    // Build the Marker objects from the mapData.
    console.log('Building Marker Objects...');
    for (i = 0; i < mapData[category][subcategory]['data'].length; i++) {
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(mapData[category][subcategory]['data'][i][1], mapData[category][subcategory]['data'][i][2]),
            title: mapData[category][subcategory]['data'][i][0]
        });
        mapData[category][subcategory]['marker'].push(marker);
        mapData[category][subcategory]['marker'][i].setMap(map);
    }
    console.log('Marker Objects Created and Displayed!');
    console.log(mapData[category][subcategory]['marker']);
}

// Create and Overlay Heatmap.
function heatmap() {
    // Create the array of Locations for the Heatmap.
    for (i = 0; i < mapData.length; i++) {
        
    }
}