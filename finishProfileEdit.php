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

$newFName = (htmlspecialchars($_POST["newfirstName"]));
$newLName = (htmlspecialchars($_POST["newlastName"]));
$newPNum = (htmlspecialchars($_POST["newPhoneNum"]));
$newDisplayName = (htmlspecialchars($_POST["newDisplayName"]));
$newBio = (htmlspecialchars($_POST["newBio"]));

if(!empty($newFName)){
	$changeFirstNamesql = "UPDATE User_Table 
							SET f_name = '$newFName'
							WHERE user_ID = $currUserID;";
	mysqli_query($conn, $changeFirstNamesql);
}

if(!empty($newLName)){
	$changeLastNamesql = "UPDATE User_Table 
							SET l_name = '$newLName'
							WHERE user_ID = $currUserID;";
	mysqli_query($conn, $changeLastNamesql);
}


if(!empty($newPNum)){
	$changePhonesql = "UPDATE User_Table
						SET phone_number = '$newPNum'
						WHERE user_ID = $currUserID;";

	mysqli_query($conn, $changePhonesql);
}

if (!empty ($newDisplayName)){
	$changeDisplayNamesql = "UPDATE User_Table
								SET name = '$newDisplayName'
								WHERE user_ID = $currUserID ;";
	mysqli_query($conn, $changeDisplayNamesql);
}

if(!empty ($newBio)){
	$changeBio = "UPDATE User_Table
					SET bio = '$newBio'
					WHERE user_ID = $currUserID;";

	mysqli_query($conn, $changeBio);
}
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>