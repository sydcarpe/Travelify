<?php
session_start();

$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";


$conn = new mysqli($hostName, $userName, $pwd , $dbName);


$listID = (htmlspecialchars($_POST["list_id"]));

$deleteItemsql = "DELETE FROM PackingItems
					WHERE list_ID = $listID;";

$deleteListsql= "DELETE FROM PackingList
					WHERE list_ID = $listID;";

mysqli_query($conn,$deleteItemsql);

mysqli_query($conn,$deleteListsql);


header('Location: ' . $_SERVER['HTTP_REFERER']);
 

?>