<?php

session_start();
//require 'dp_connection.php';
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";




$conn = new mysqli($hostName, $userName, $pwd , $dbName);

//current user just in case I need it
$currUserID = $_SESSION['user_ID'];
echo "user ID: " . $currUserID . " </br> " ;
$itineraryID = $_SESSION['myItinerary_ID'];
echo "Itinerary ID: " . $itineraryID . "</br>";
$attractionID = ($_POST['type']);
echo "attraction: " . $attractionID. "</br> " ;
//getting the trip id
$currTripID = ($_POST['tripIDHide']);
echo "Trip ID: " . $currTripID . "</br> ";




//I need itinerary_ID, trip_ID, attraction_ID, attraction_order

$sqlGetCount = "SELECT COUNT(itinerary_ID)
				FROM Itinerary
				WHERE itinerary_ID = $itineraryID;";

$getCountRow = mysqli_query($conn,$sqlGetCount);

// finds the count of attractions from the current itinerary 
if ($getCountRow->num_rows > 0){
	while($row = $getCountRow->fetch_assoc()) {
		$currCount= $row['COUNT(itinerary_ID)'];
	}
} else{
	$currCount= 0;
}

$currCount++;
echo "Count: " . $currCount . "</br> ";


$sqlInsertItinerary = "INSERT INTO Itinerary(itinerary_ID, trip_ID, attraction_ID, attraction_order)
						VALUES ($itineraryID, $currTripID, $attractionID, $currCount);";


if(mysqli_query($conn, $sqlInsertItinerary)){
	echo "inserted";
	//this needs to send back to the itinerary page
	// needs to send back itineraryID, tripID
	$_SESSION['trip_ID2'] = $currTripID;
	$_SESSION['itinerary_ID2'] = $itineraryID;

	header('Location: ' . $_SERVER['HTTP_REFERER']);
} else{
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}


?>
