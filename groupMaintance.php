<?php
session_start();
// currently database connected to my own personal one just to test the data but it works <3
// link to see what it currently looks like
//https://cgi.luddy.indiana.edu/~sydcarpe/capstone-individual/Travelify/groupMaintance.php

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
//echo "Connected successfully";

//echo($_SESSION["user_ID"]); die;

$currUserID = $_SESSION['user_ID'];

$sql = "SELECT group_ID FROM Group_Table
            WHERE user_ID = $currUserID;"; 



// sql syntax to get the users group names
$sqlGetUserGroups = "SELECT group_ID, group_Name FROM Group_Table
          WHERE user_ID = $currUserID;"; 

$getUserGroups = $conn->query($sqlGetUserGroups);




?>
<?php
include_once 'navbar.php';
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>My Groups</title>

    <!--Stylesheets-->
    <link rel="stylesheet" href="css/groupMaintance_Css.css" />
    <link rel="stylesheet" href="css/navbarCss.css" />

    <!--java script-->

    
    <script type="text/javascript">   
        function displayGroup(id) {
            window.location.href = "displayGroup.php?id=" + id;
        }


    </script>

</head>
    <body>
        <!--WHAT I NEED
               User ID
               Groups that have the users ID-->
                
        <!--Getting the group names for the current user and displaying them in a list 
            will make them a button prob-->
            
            <div class="buttonContainer">
                <div class="rightSide">
                    <h1> Your Groups!</h1>
                    <button class='createBtn' style="background-color: #e7feff;" id="createGroup" onclick="window.location.href = 'create_newGroup.php';" >Create New Group</button>
                </div>
                <div class="displayGroups">
                    <?php 
                    if ($getUserGroups->num_rows > 0) {
                      // output data of each row
 
                      echo "<ul>";
          
                      while($row = $getUserGroups->fetch_assoc()) {
                        echo "<button  style='background-color: #e7feff;' id='" . $row["group_ID"]. "'  onclick = 'displayGroup(this.id)' >" . $row["group_Name"]. " "."</button>  <br/> <br/>";
                        
                      }
 
                      echo "</ul>";
                    } else {
                        echo ("No Groups created yet!");
                    }
                    ?>
                </div>
            </div>

                
        
    </body>
</html>

