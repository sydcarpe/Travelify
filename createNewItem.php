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
$packListID = (htmlspecialchars($_POST["packingListID"]));
$newItem = (htmlspecialchars($_POST["itemName"]));

echo $newItem . " " . $packListID;

$insertNewItemsql = "INSERT INTO PackingItems(item_name, list_ID, packed)
						VALUES ('$newItem', $packListID, 0);";

mysqli_query($conn, $insertNewItemsql);
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>