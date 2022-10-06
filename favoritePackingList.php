<?php
session_start();
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";

$conn = new mysqli($hostName, $userName, $pwd , $dbName);

//TODO 
//Get packing list ids
//Change heart color from black to red 
//update 'favorite' coloum to 1 

//getting list id
$listID = (htmlspecialchars($_POST["packingListIDFav"]));

//getting the favorite number
$sqlGetFav = "SELECT favorite FROM PackingList
			WHERE list_ID = $listID;";

$favRowResult = mysqli_query($conn, $sqlGetFav);

//getting the row results from sql
if ($favRowResult){
	if ($favRowResult->num_rows > 0) {          
		while($row = $favRowResult->fetch_assoc()) {
			$favoriteNum = $row['favorite'];
		}
	}
}



$favoritesql = "UPDATE PackingList 
				SET favorite = 1
				WHERE list_ID = $listID;";

$unfavoritesql = "UPDATE PackingList 
				SET favorite = 0
				WHERE list_ID = $listID;";

if ($favoriteNum == 1){
	mysqli_query($conn, $unfavoritesql);
} elseif ($favoriteNum == 0) {
	mysqli_query($conn, $favoritesql);
}


header('Location: ' . $_SERVER['HTTP_REFERER']);


?>