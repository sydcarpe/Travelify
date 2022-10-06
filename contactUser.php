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
$message = (htmlspecialchars($_POST["message"]));

$currUserID = $_SESSION['user_ID'];



$getUserInfoSQL = "SELECT * FROM User_Table WHERE user_ID = $currUserID;";

//getting the row of the current users information from above
$getUserRow = $conn->query($getUserInfoSQL);  

//getting current users information
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

$viewUserID = $_SESSION['viewUserProfile'];

$getEmailsql = "SELECT email FROM User_Table WHERE user_ID = $viewUserID;";
$getEmailee = $conn->query($getEmailsql);  

if ($getEmailee->num_rows > 0) {
    // output data of each row   
    if($row = $getEmailee->fetch_assoc()) {
        $emailedUser= $row["email"];     
    }
} 



$headers = "From:". $email ." \r\n";
$subject = "Message from your friend " . $userName . " on Travelify!";

echo $message;
mail($emailedUser,$subject,$message,$headers);

$_SESSION['viewUserProfile'] = $viewUserID;

//need to send it back to view user page
?>
