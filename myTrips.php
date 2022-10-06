<?php
session_start();
//require 'dp_connection.php';
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";



$conn = new mysqli($hostName, $userName, $pwd , $dbName);


//current user just in case I need it
$currUserID = $_SESSION['user_ID'];

//what i need
// trip ids and trip names? 
// get all groups that the user is apart of 

$sqlgetTrip = "SELECT Trip.trip_Name, Trip.trip_ID FROM Trip
                INNER JOIN Group_Table
                ON Trip.group_ID = Group_Table.group_ID
                WHERE user_ID = $currUserID;";



//getting trip names and ids for current user
$sql = "SELECT trip_Name, trip_ID FROM Trip
            WHERE user_ID = $currUserID;"; 

$getTripInfoRow = mysqli_query($conn, $sqlgetTrip);

include_once 'navbar.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="css/myTrips.css" />
        <script> 
            function planTrip(){
                window.location.href = 'trip_plan.php';
            }

            function viewTrip(id){
                window.location.href = 'viewTrip.php';
            }
        </script>
    </head>

    <body>
         <div class='container'>
         <!--Left side of the screen - your trips and create new trip button-->
             <div class="leftSide">
                <h1>Your Trips!</h1><br/>
                <button onclick = "planTrip()">Create New Trip</button>
             </div>

             <!--Users trips -->
             <form action="viewTrip.php" method="post">
                    <div class="yourTrips">
                        <?php 
                        if ($getTripInfoRow->num_rows > 0) {
                          // output data of each row
                          echo "<ul>";
          
                          while($row = $getTripInfoRow->fetch_assoc()) {
                            echo "<button name = 'tripBtn' value="  . $row["trip_ID"]. "  > "  . $row["trip_Name"]. " </button>";
                          }
 
                          echo "</ul>";
                        } 
                        ?>
                    </div>
                </form>
            </div>
        
        
    </body>
</html>
<br><br>
<br><br>
<br><br>
<?php include('footer.html'); ?>
