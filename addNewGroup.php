<?php 

session_start();
//database info

//require 'dp_connection.php';
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";


$conn = new mysqli($hostName, $userName, $pwd , $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$currUserID = $_SESSION['user_ID'];
$today = date("Y/m/d");

$sqlCount = "SELECT group_ID, COUNT(*) FROM Group_Table
                GROUP BY group_ID;";

$countRow = mysqli_query($conn,$sqlCount);

if($countRow){
    while($row = $countRow->fetch_assoc()) {
        $nextCount = $row["group_ID"];
    }
    $nextCount++;
}

$groupName = (htmlspecialchars($_POST["form_groupName"]));

$sqlInsertInto = "INSERT INTO Group_Table (group_ID, user_ID, group_Date, group_Name)
                    VALUES ($nextCount, $currUserID, '$today', '$groupName');";
$insertGroup = mysqli_query($conn, $sqlInsertInto);
if($insertGroup){
    header('Location:groupMaintance.php');
}else{
    echo "problem";
}
?>