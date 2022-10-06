<?php
session_start();
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";

$conn = new mysqli($hostName, $userName, $pwd , $dbName);


if(isset($_POST['id'])){
	
	$id = $_POST['id'];

	$query = "DELETE FROM CalendarEvents WHERE id = $id;";
	
	
	mysqli_query($conn, $query);
}


?>