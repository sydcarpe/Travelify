<?php
session_start();
//database info
// link to see what it currently looks like
//https://cgi.luddy.indiana.edu/~sydcarpe/capstone-individual/Travelify/groupMaintance.php

//database info
//require 'dp_connection.php';
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";

try{

    // Create connection
    $conn = new mysqli($hostName, $userName, $pwd , $dbName);
    // Check connection

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    //escape variables for security sql injection


    //getting id of the group to add 
    $id = (htmlspecialchars($_POST["groupID"]));
    $userEmail = (htmlspecialchars($_POST["form_email"]));
    $currUserID = $_SESSION['user_ID'];
  


    $sql = "SELECT user_ID FROM User_Table 
            WHERE email = '$userEmail';";
    $getGroupDate ="SELECT group_Date, group_Name, num_people FROM Group_Table 
                    WHERE group_ID = $id";

    $sendersNamesql = "SELECT name FROM User_Table
                        WHERE user_ID = $currUserID;";

    $sendersNameRow = mysqli_query($conn,$sendersNamesql);

    if ($sendersNameRow->num_rows > 0) {
            // output data of each row           
            if($row = $sendersNameRow->fetch_assoc()) {
                $sendersName= $row["name"];        
            } 
    }

    $messageResponse = " ";
    // creating message, subject and who its from (us)
    // need to, subject, message
    $headers = "From: TravelifyTeam53@gmail.com \r\n";
    $subject = "Join Travelify!";
    $message = "You're Friend " . $sendersName . " wants to add you to a group trip on Travelify! Create your account to be added to the group and start planning your trip! Safe travels!
     - Your Friends at Travelify";
    $to = $userEmail;
    


    //check for error on insert

    if (mysqli_query($conn,$sql)) {

        $usersIDRow = $conn->query($sql);
        $groupDateRow = $conn->query($getGroupDate);
    

         if ($usersIDRow->num_rows > 0) {
            // output data of each row           
            if($row = $usersIDRow->fetch_assoc()) {
                $usersID= $row["user_ID"];        
            } 
        } else {
            mail($to, $subject, $message, $headers);
            
            throw new Exception($messageResponse ="User Doesn't exist yet! We've sent them an Email to join Travelify!");
        }

        if ($groupDateRow->num_rows > 0) {
            // output data of each row           
            if($row = $groupDateRow->fetch_assoc()) {
                $groupDate= $row["group_Date"];   
                $groupName=$row["group_Name"];


                $addUser = "INSERT INTO Group_Table(group_ID, user_ID, group_Date, group_Name) VALUES ($id, $usersID, '$groupDate', '$groupName'); ";
                 mysqli_query($conn,$addUser);
                  header('Location: groupMaintance.php');
                 $messageResponse = ("User added to group!");
            }
        } else {
            throw new Exception("Group Doesn't exist");
        }

    } else { die("SQL Error: " . mysqli_error($conn)); }

    mysqli_close($conn);

} catch (Exception $e){

    $messageResponse = ( $e->getMessage() );
}

  $_SESSION['messageResponse'] = $messageResponse;
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>

