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

$groupID = $_SESSION['group_ID'];

//escape variables for security sql injection


//getting id of the group to add 
$memberID = ($_POST['deleteMember']);


$deleteUser = "DELETE FROM Group_Table
                WHERE user_ID = $memberID AND group_ID= $groupID;";

mysqli_query($conn,$deleteUser);


header('Location: ' . $_SERVER['HTTP_REFERER']);
 


?>

