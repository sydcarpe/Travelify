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
$dbName = "i494f21_team53";;

$conn = new mysqli($hostName, $userName, $pwd , $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


//this is the current group ID
$id = (htmlspecialchars($_GET["id"]));

$_SESSION['group_ID'] = $id;
$messageResponse = $_SESSION['messageResponse'];



?>

<!DOCTYPE html>

<html>
<head>
    <!--Stylesheets-->
    <link rel="stylesheet" href="css/groupMaintance_Css.css" />
    <link rel="stylesheet" href="css/navbarCss.css" />


    <script>

        function sendEmail() {
                //debugger;
                window.location.href = "addMember.php?id=" <?php $id?>;
            }

        
        function deleteGroup(){
            window.location.href = "deleteGroup.php";
        }

    </script>

</head>
<body>

    <!--This Page needs
        Add member
        Remove self from group
        -->

    <div class="displayGroupContainer">
        <div class="displayMembers"> 
            

                <!--displaying all the group members names as a list -->
                <?php 
                   $sqlGetMembers = "SELECT User_Table.name, User_Table.email, User_Table.user_ID, User_Table.profile_image
                                        FROM Group_Table
                                        INNER JOIN User_Table
                                        ON User_Table.user_ID=Group_Table.user_ID
                                        WHERE Group_Table.group_ID = $id;"; 
                        //running the SQL to get the members
                        $getMembers = $conn->query($sqlGetMembers);                  
            

                    if ($getMembers->num_rows > 0) {
                        // output data of each row
                        echo "<ul>";
          
                        while($row = $getMembers->fetch_assoc()) {
                            //shows profile pictures of users
                            echo "<div class='individualGroup'>";
                            echo ' <img src=" ' . $row['profile_image'] . '" alt = "' . $row["name"] . '" />';

                            echo "<li> " . $row["name"]. " "."</li>
                            <input type='hidden' name = 'pressed' value = "  . $row["name"]. " >

                            <form action='viewUser.php' method='POST'>
                            <button name='viewUserProfile' value = "  . $row["user_ID"]. " > View " . $row["name"]."'s Profile </button> </br>
                            </form> 

                            <form action='deleteMember.php' method='POST'>
                            <button name = 'deleteMember' value="  . $row["user_ID"]. "  > Delete</button>
                            </form> ";  
                            echo "</div>";
                        }
 
                        echo "</ul>";
                    } else {
                        //change this to better thingy
                        echo "No Group Members";
                    }
                ?>
            
        </div>
    

            <div class="addDeleteButtons">
                <form action="addMember.php" method="post">
                    <input type="text" name= "form_email" placeholder="Enter Users Email" required>
                    <!--button to add user to group--> 
                    <br>
                    <button type="submit">Add</button>
                    <!--hidden from user but still sends-->
                    <input type="hidden" name="groupID" value= <?php echo($id); ?> >
                    <p><?php echo $messageResponse; ?></p>
                </form>

                <form action = "deleteGroup.php">
                    <button type="submit" name='deleteGroupBtn' value = <?php echo $id; ?> >Delete Group</button>
                </form>
            </div>
            
    </div>
         
  <?php include_once 'footer.php';?>
</body>

</html>
