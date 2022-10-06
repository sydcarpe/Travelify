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
$tripID = $_SESSION['trip_ID'];

$newTripName = (htmlspecialchars($_POST["newTripName"]));
$newArrivalDate = (htmlspecialchars($_POST["newArrivalDate"]));
$newDepartDate = (htmlspecialchars($_POST["newDepartDate"]));
$newGroup = (htmlspecialchars($_POST["new_group_Name"]));


if (!empty($newTripName)){
	$changeTripName =  "UPDATE Trip SET trip_Name = '$newTripName' WHERE trip_ID = $tripID;";
	mysqli_query($conn, $changeTripName);
} 

if (!empty($newArrivalDate)){
	$changeArrivalDate =  "UPDATE Trip SET arrival_date = '$newArrivalDate' WHERE trip_ID = $tripID;";
	mysqli_query($conn, $changeArrivalDate);	
} 

if (!empty($newDepartDate)){
	$changeDepartDate =  "UPDATE Trip SET depart_date = '$newDepartDate' WHERE trip_ID = $tripID;";
	mysqli_query($conn, $changeDepartDate);	
} 


if (!empty($newGroup)){
	$changeGroup =  "UPDATE Trip SET group_Name = '$newGroup' WHERE trip_ID = $tripID;";
	mysqli_query($conn, $changeGroup);
} 


header('Location: ' . $_SERVER['HTTP_REFERER']);


?>