<?php include 'includes/html.inc' ?>
<html>
    <head>
        <?php include 'includes/head.inc' ?>
        <?php include 'functions/display_date.php'?>
        <title>QBM: Home</title> 
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=false&libraries=visualization"></script>
<script>
function initialize() {
    // Static Dataset for test Locations
    var locations = [
        new google.maps.LatLng(-27.498263, 153.010488),
        new google.maps.LatLng(-27.500014, 153.002591),
        new google.maps.LatLng(-27.495865, 153.004007),
        new google.maps.LatLng(-27.497692, 153.018084),
        new google.maps.LatLng(-27.493923, 153.013620),
        new google.maps.LatLng(-27.493657, 153.006797),
        new google.maps.LatLng(-27.496055, 153.004780),
        new google.maps.LatLng(-27.494037, 153.005381),
        new google.maps.LatLng(-27.500509, 153.007398),
        new google.maps.LatLng(-27.500737, 153.013964)
    ];

    // Create the initial Map
    map = new google.maps.Map(document.getElementById('map-canvas'), {
        zoom: 15,
        center: new google.maps.LatLng(-27.493923, 153.013620),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true
    });

    // Create the Marker at each location
    for (i = 0; i < locations.length; i++) { 
        var marker = new google.maps.Marker({
            position: locations[i],
            map: map,
            title: 'Hello World!'
        });
    };

    // Create the Heatmap points for the overlay
    var pointArray = new google.maps.MVCArray(locations);
    var heatmap = new google.maps.visualization.HeatmapLayer({
        data: pointArray
    });
    
    // Add the overlay to the Map
    heatmap.setMap(map);
}

// Display the Map
google.maps.event.addDomListener(window, 'load', initialize);
</script>
    </head>
    
    <body>
        <?php include 'includes/header.inc'?>
        <?php include 'includes/leftbar.inc'?>
        <!--MIDDLE CONTENTS-->
        <div class="middle">
            <div class="content" style="background-color: transparent; padding-right: 0;">
                <div id="map-canvas" style=></div>
            </div>
        </div>
    </body>
</html>