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
$itemID = (htmlspecialchars($_GET["id"]));
echo $itemID;

$myQuery = "SELECT * FROM PackingItems WHERE item_ID = $itemID;";
$runQuery = mysqli_query($conn, $myQuery);



$unpacked = "UPDATE PackingItems 
				SET packed = 0
				WHERE item_ID = $itemID;";
$noLongerPacked = mysqli_query($conn, $unpacked);


if ($runQuery){
	if ($runQuery->num_rows > 0) {          
		while($row = $runQuery->fetch_assoc()) {
			$packed = $row['packed'];

			if ($packed == 0){
				$isPacked = "UPDATE PackingItems 
				SET packed = 1
				WHERE item_ID = $itemID;";
				mysqli_query($conn, $isPacked);
			}

			if ($packed == 1){
				$unpacked = "UPDATE PackingItems 
				SET packed = 0
				WHERE item_ID = $itemID;";
				$noLongerPacked = mysqli_query($conn, $unpacked);
			}
		}
	} 
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>