var formPass = true;

/*Validate Date of Birth*/
function validateDOB(){
    var datepass = true;
    //Get object data in dates settings
    var dayOPT = document.getElementById("day");
    var monOPT = document.getElementById("month");
    var yrOPT = document.getElementById("year");
    
    //Get selected option in dates settings
    var dayTXT = dayOPT.options[dayOPT.selectedIndex].text;
    var monTXT = monOPT.options[monOPT.selectedIndex].text;
    var yrTXT = yrOPT.options[yrOPT.selectedIndex].text;
    
    //Makes sure all areas are set
    if((dayTXT==="0")||(monTXT==="0")||(yrTXT==="0")){
        formPass = formPass&&false;
        document.getElementById("dateError").style.visibility = "visible";
        return false;
    }
    
    //Ensures correct formating for variable to date conversion
    if(dayTXT.length===1){
        dayTXT = "0"+dayTXT;
    }
    if(monTXT.length===1){
        monTXT = "0"+monTXT;
    }
    
    //Create date object
    var dateobj = new Date(yrTXT, monTXT-1, dayTXT);
    
    //Check if days months and years are aligned correctly
    if ((dateobj.getMonth()+1!=(Number(monTXT)))
        ||(dateobj.getDate()!=(Number(dayTXT)))
        ||(dateobj.getFullYear()!=(Number(yrTXT)))){
        datepass=false;
    } else{
        formPass = formPass&&true;
        document.getElementById("dateError").style.visibility = "hidden";
    }
}

/*Validate Email*/
function validateEmail(){
    var textIn = document.getElementById("email").value; 
    
    //Allow only common email format to pass through 
    var allow = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!allow.test(textIn)){
        document.getElementById("emailError").style.visibility = "visible";
        formPass = formPass&&false;
        return false;
    } else {
        document.getElementById("emailError").style.visibility = "hidden";
        return true;
    }
}

/*Validate User ID*/
function validateUserID(){
    var textIn = document.getElementById("userID").value; 
    
    //Allow only alpha-numeric characters and underscores for user ID
    var allow = /^[A-Za-z0-9_]+$/;
    if(!allow.test(textIn)){
        document.getElementById("idError").style.visibility = "visible";
        formPass = formPass&&false;
        return false;
    } else {
        document.getElementById("idError").style.visibility = "hidden";
        return true;
    }

}

/*Validate Password*/
function validatePassword(){
    var firstPW = document.getElementById("password").value;     
    //Allow only alpha-numeric characters and underscores for password
    var allow = /^[A-Za-z0-9_]+$/;
    
    //Comparing first password to second password
    
    if(!allow.test(firstPW)){
        document.getElementById("passwordError").style.visibility = "visible";
        formPass = formPass&&false;
        return false;
    } else {
        document.getElementById("passwordError").style.visibility = "hidden";
        return true;
    }
}

function validateMatch(){
    var firstPW = document.getElementById("password").value; 
    var secondPW = document.getElementById("rePW").value; 
    if(firstPW===secondPW){
        document.getElementById("noMatch").style.visibility = "hidden";        
    } else {
        document.getElementById("noMatch").style.visibility = "visible";
        formPass = formPass&&false;
    }
}

/*Validate Gender*/
function validateGender(){
    if((document.getElementById('male').checked)
        ||(document.getElementById('female').checked)) {
        alert("checked");
    } else {
        formPass = formPass&&false;
    }
}

/*Validate Form*/
function validateForm(){    
    validateUserID();   
    validatePassword();
	validateEmail();
	validateDOB();
    validateGender();
}

/*Used for filling days in form for DOB*/
function fillDays(){
    for(var i=1; i<=31; i++){
        document.write('<option>'+i+'</option>');
    }
}

/*Used for filling months in form for DOB*/
function fillMonths(){
    for(var i=1; i<=12; i++){
        document.write('<option>'+i+'</option>');
    }
}

/*Used for filling years in form for DOB*/
function fillYears(){
    for(var i=2015; i>=1900; i--){
        document.write('<option>'+i+'</option>');
    }
}

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