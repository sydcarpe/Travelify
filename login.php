<?php
session_start();

//require 'dp_connection.php';
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";



$conn = new mysqli($hostName, $userName, $pwd , $dbName);
    
        //getting the userID from google
        $googleID = (htmlspecialchars($_POST["googleID"]));
        $email = (htmlspecialchars($_POST["email"]));
        $full_name = (htmlspecialchars($_POST["fullName"]));
        $profile_pic = (htmlspecialchars($_POST["profilePic"]));
        $f_name = (htmlspecialchars($_POST["fName"]));
        $l_name = (htmlspecialchars($_POST["lName"]));
        
        // checking user already exists or not
        $getUserSql = "SELECT user_ID FROM User_Table WHERE google_id = '$email';";

        $get_userRow = mysqli_query($conn, $getUserSql);
        
        if(mysqli_num_rows($get_userRow) > 0){
            
            if($row = $get_userRow->fetch_assoc()) {
                $userID= $row['user_ID']; 
                
                //getting the current user ID to set in the session
                $_SESSION['user_ID'] = $userID;
                
                header('Location: openpage.php');
                
                exit;
            }          
            
        }
        else{
            // if user not exists we will insert the user
            $insertUserSql = "INSERT INTO User_Table(google_id, name, email, profile_image, f_name, l_name)
                              VALUES('$email', '$full_name', '$email', '$profile_pic' , '$f_name', '$l_name');";

            $insert = mysqli_query($conn, $insertUserSql);

            $getUserID = "SELECT user_ID FROM User_Table 
                            WHERE google_ID = '$googleID';";

            
            if($insert){
                if($row = $get_userRow->fetch_assoc()) {
                    $userID= $row['user_ID'];  
                    $_SESSION['user_ID'] = $userID;
                    header('Location: openpage.php');
                    exit;                
                }                 
            }
            else{
                echo ($email . " " . $full_name . " <br/>");
                echo "Sign up failed!(Something went wrong).";
            }

        }

?>

