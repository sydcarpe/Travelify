<?php
session_start();

$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";

$conn = new mysqli($hostName, $userName, $pwd , $dbName);


$itemID = (htmlspecialchars($_POST["item_id"]));

$deleteItemsql = "DELETE FROM PackingItems
					WHERE item_ID = $itemID;";


mysqli_query($conn,$deleteItemsql);


header('Location: ' . $_SERVER['HTTP_REFERER']);
 

?>