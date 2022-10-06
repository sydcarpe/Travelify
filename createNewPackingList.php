<?php
session_start();
//require 'dp_connection.php';
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";

$conn = new mysqli($hostName, $userName, $pwd , $dbName);



//ids and things
$currUserID = $_SESSION['user_ID'];
$tripID = $_SESSION['trip_ID'];
$listName = (htmlspecialchars($_POST["listName"]));
$today = date('Y-m-d');

$createList = "INSERT INTO PackingList(trip_ID, user_ID, createdDate, list_name, favorite)
				VALUES ('$tripID', '$currUserID', '$today', '$listName', 0);";

$runQuery = mysqli_query($conn, $createList);

if($runQuery){
	header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

?>
