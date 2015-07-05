<?php
// Connect to the Database.
try {
	$dbh = new PDO('mysql:host=localhost:3306;dbname=Knowledge_Maps', 'root', '');
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Oops! I'm Sorry, we were unable to connect to the Database: " . $e->getMessage();
}

// Debugging and Testing
//$_POST['category'] = 'ParkFacility';

// Create an Array to hold the requested Data.
$result = [];

// Retreive Data for Parent category


// Retreive the Data for the Parent or Child Category.
try {
	$stmt = $dbh->prepare("SELECT * FROM `MapData` WHERE `sub_category` = :category");
	$stmt->bindParam(':category', $_POST['category']);
	$stmt->execute();
	// Convert the Result of the Query to JSON.
	$result = $stmt->fetchAll(PDO::FETCH_NUM);
	$result = json_encode($result);
	// Display the JSON Data
	echo $result;
} catch (PDOException $e) {
	echo "Oops! I'm Sorry, we were unable to complete your query: " . $e->getMessage();
}


// INSERT INTO REGISTRY (name, value) VALUES (:name, :value




?>