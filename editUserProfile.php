<?php
include_once 'navbar.php';
?>

<?php

//database info
session_start();
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

$getUserInfoSQL = "SELECT * FROM User_Table WHERE user_ID = $currUserID;";

//getting the row of the current users information from above
$getUserRow = $conn->query($getUserInfoSQL);  

if ($getUserRow->num_rows > 0) {
    // output data of each row   
    if($row = $getUserRow->fetch_assoc()) {
        $email= $row["email"];         
        $userName =$row["name"];
        $fName = $row['f_name'];
        $lName = $row['l_name'];
        $profileImg = $row['profile_image'];
        $phoneNum = $row['phone_number'];
        $bio = $row['bio'];
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
            <h1> Hi <?php echo ($fName);?></h1>
            <img src= "<?php echo $profileImg?>"/>
        </div>

        <div class="container">
            <!--Edit Info-->
            <div class="box1">
                <form action="finishProfileEdit.php" method="POST">
                    <h3> Current User Bio </h3>
                    <p class="bioContainer"> <?php echo $bio; ?> </p>

                    <div class="bioHolder">
                        <h3>Update Bio Here</h3>
                        <textarea name = "newBio" class ="bioUpdater" placeholder="Tell us about you..."> </textarea>

                    </div>
                    </br>
                    <button>Update Bio</button> 

                    

                </form>
                <form action="View_UserProfile.php" method="post">
					<button> Finished Editing</button>
				</form>
            </div>

            <div class="currentInfo">
                <form action="finishProfileEdit.php" method="POST">
                    <h3>First Name</h3>
                    <div class="blockInfo"> <p><?php echo $fName;?></p></div>
                    <input type="text" name="newfirstName" placeholder="Update First Name">

                    <h3>Last Name</h3>
                    <div class="blockInfo"> <p> <?php echo $lName;?> </p></div>
                    <input type="text" name="newlastName" placeholder="Update First Name">
                    

                    <h3> Display Name </h3>
                    <div class="blockInfo"> <p><?php echo $userName; ?> </p></div>
                    <input type="text" name="newDisplayName" placeholder="Update Display Name">

                    <h3>Phone Number</h3>
                    <div class="blockInfo"> <p> <?php echo $phoneNum;?> </p></div>
                    <input type="tel" name="newPhoneNum" placeholder="555-465-4565">
                    
                    </br>
                    <button>Update</button>
                    
                </form>

            </div>
        </div>

    </body>

</html>
