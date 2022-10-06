<?php
include_once 'navbar.php';
?>

<?php
// currently database connected to my own personal one just to test the data but it works <3
// link to see what it currently looks like
//https://cgi.luddy.indiana.edu/~sydcarpe/capstone-individual/Travelify/groupMaintance.php

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
        $phoneNumber = $row['phone_number'];
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

        <script>
            function editProfile(){
                window.location.href='editUserProfile.php';
            }

        </script>
    </head>

    <body>
        <div class="header">
            <h1> Hi <?php echo ($fName);?></h1>
            <img src= "<?php echo $profileImg?>"/>
        </div>

        <div class="container">
            
            <!--Edit Info-->
            <div class="box1">
                <h3>Meet <?php echo $userName; ?>!</h3>
                <p class="bioContainer"> 
                <?php

                if ($bio === NULL){
                    echo "No bio yet! Edit your profile to add one!";
                } else {
                    echo $bio;
                }
                 

                 ?> 
                </p>

                <button onclick = 'editProfile();'> Edit Profile </button>
            </div>

            <div class="currentInfo">
                <h3>First Name</h3>
                <div class="blockInfo"> <p> <?php echo $fName;?> </p></div>
              <br>
                <h3>Last Name</h3>
                <div class="blockInfo"> <p><?php echo $lName;?></p></div>
              <br>
                <h3> Display Name </h3>
                <div class="blockInfo"> <p><?php echo $userName; ?> </p></div>
        <br>
                <h3>Email</h3>
                <div class="blockInfo"><p> <?php echo $email;?></p></div>
              <br>
                <h3>Phone Number</h3>
                <div class="blockInfo"><p> <?php echo $phoneNumber?> </p> </div>

            </div>
        </div>

    </body>

</html>
<br>
<br>
<?php include('footer.html'); ?>
