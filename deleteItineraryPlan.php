<?php
session_start();
//database info
//database info
//require 'dp_connection.php';
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";



// Create connection
$conn = new mysqli($hostName, $userName, $pwd , $dbName);
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//escape variables for security sql injection


//getting attraction id to delete
$attractionID = ($_POST['buttonName']);

//current userID
$currUserID = $_SESSION['user_ID'];

$deleteAttractionsql= "DELETE FROM Itinerary 
                    WHERE attraction_ID = $attractionID;";

mysqli_query($conn, $deleteAttractionsql);


//pretty sure this is what's messing everything up - working on sending it back to other page and still having the same itinerary ID and stuff
header('Location: ' . $_SERVER['HTTP_REFERER']);



?>

