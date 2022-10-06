<?php

//require 'dp_connection.php';
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";



$conn = new mysqli($hostName, $userName, $pwd , $dbName);
session_start();

if(isset($_GET["order"])) {
	$order  = explode(",",$_GET["order"]);
	for($i=0; $i < count($order);$i++) {
		$sql = "UPDATE Itinerary SET attraction_order='" . $i . "' WHERE attraction_ID=". $order[$i];		
		mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));	
	}
}
?>