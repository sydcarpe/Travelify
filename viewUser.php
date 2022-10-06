<?php
include_once 'navbar.php';
?>

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

$viewUserID = (htmlspecialchars($_POST["viewUserProfile"]));
$_SESSION['viewUserProfile'] = $viewUserID;


$currUserID = $_SESSION['user_ID'];

$getUserInfoSQL = "SELECT * FROM User_Table WHERE user_ID = $viewUserID;";


$getUserRow = $conn->query($getUserInfoSQL);  

//who current user is VIEWING information
if ($getUserRow->num_rows > 0) {
    // output data of each row   
    if($row = $getUserRow->fetch_assoc()) {
        $email= $row["email"];         
        $userName =$row["name"];
        $fName = $row['f_name'];
        $lName = $row['l_name'];
        $profileImg = $row['profile_image'];
        $phoneNumber = $row['phone_number'];
        $bio = $row['bio'];
    }
} 

$getCurrUserInfosql = "SELECT * FROM User_Table WHERE user_ID = $currUserID;";
$getCurrUserRow = $conn->query($getCurrUserInfosql);

if ($getCurrUserRow->num_rows > 0) {
    // output data of each row   
    if($row = $getCurrUserRow->fetch_assoc()) {
        $currUserEmail= $row["email"]; 
    }
} 

?>

<!DOCTYPE html>
<html>
    <head>
        <!--Stylesheets-->
        <link rel="stylesheet" href="css/profilePage.css" />


         <!--Google fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">

    </head>

    <body>
        <div class="header">
            <h1> Welcome to <?php echo $userName; ?>'s Profile! </h1>
            <img src= "<?php echo $profileImg?>"/>
        </div>

        <div class="container">
            
            <!--Edit Info-->
            <div class="box1">
                <h3>Meet <?php echo $userName; ?>!</h3>
                <p class="bioContainer"> 
                <?php

                if ($bio === NULL){
                    echo $name . "doesn't have a bio yet!";
                } else {
                    echo $bio;
                }
                 

                 ?> 
                </p>
            </div>

            <div class="currentInfo">
                <h3> Want to contact <?php echo $userName; ?>? </br> Send them an email here!</h3>

                <div class="emailUser">
                    <form action="contactUser.php" method="POST">
                        <h3>Write Here!</h3>
                        <textarea name="message" placeholder="Write something.." style="width:100%;"></textarea></br>

                        <button>Send!</button>
                    </form>
                </div>

            </div>
        </div>

    </body>

</html>


