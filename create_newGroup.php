<?php
include_once 'navbar.php';



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
//WHAT I NEED Count of groups, current user, group Date, group name


$currUserID = $_SESSION['user_ID'];
$today = date("Y/m/d");

$sqlCount = "Select group_ID, COUNT(*) FROM Group_Table
                GROUP BY group_ID;";

$countRow = mysqli_query($conn,$sqlCount);

if($countRow){
    while($row = $countRow->fetch_assoc()) {
        $nextCount = $row["group_ID"];
    }
    $nextCount++;
}




?>

<html>
    <head>
        <!--Stylesheets-->
        <link rel="stylesheet" href="css/createNewGroup.css" />
        <link rel="stylesheet" href="css/navbarCss.css" />
    </head>

    <body>

        <div class="container">
            <form action="addNewGroup.php" method = "post">
                <p>What would you like to name the group?</p>
                <input type="text" name= "form_groupName" hint="Users Email" required>
                <br/>
                <button type="submit"> Create New Group </button>
            </form>
        </div>

    </body>

</html>
