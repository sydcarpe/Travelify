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
// current trip 


//getting the trip id
$currTripID = ($_POST['tripIDHide']);


//current group name 
$currGroupID = $_SESSION['group_ID'];


$currTripID = $_SESSION['trip_ID'];
$itineraryID = $_SESSION['itinerary_ID'];


//getting the group name for current group
$getGroupNamesql = "SELECT group_name FROM Group_Table
                    WHERE group_ID = $currGroupID 
                    AND user_ID = $currUserID;";

 $getGroupName = $conn->query($getGroupNamesql);


//getting the group name and setting it equal to value to use
if ($getGroupName->num_rows > 0) {
    while($row = $getGroupName->fetch_assoc()) {
        $groupName = $row["group_name"];
    }
}

//getting the trip location to display
$getTripNamesql = "SELECT * FROM Trip        
                    WHERE trip_ID = $currTripID;";

$getTripName = $conn->query($getTripNamesql);

if ($getTripName->num_rows > 0) {
    while($row = $getTripName->fetch_assoc()) {
        $tripLocation = $row["location"];
    }
}
        

//getting the itinerary_ID
$getItineraryIDsql = "SELECT itinerary_ID FROM Itinerary        
                    WHERE trip_ID = $currTripID;";


$getItineraryID = $conn->query($getItineraryIDsql);


if ($getItineraryID->num_rows > 0) {
    while($row = $getItineraryID->fetch_assoc()) {
        $itineraryID = $row["itinerary_ID"];
    }
}

$_SESSION['myItinerary_ID'] = $itineraryID;

include_once 'navbar.php';



?>

<html>
    <head>
        <title>Itinerary</title>

        <!--Style sheets-->
	    <link rel="stylesheet" href="css/itineraryCss.css" />

        <!--Google fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">


        <script>
            function createNew(){
                window.location.href="Attractions/admin_newAtt.php";
            }
		
		//function destionationPage(){
			//window.location.href="destinations.php";
		//}

        </script>

        <!--Functions to drag and drop itinerary to change order-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script type="text/javascript" src="javascript/reorder.js"></script>
        



    </head>

    <body>
    <?php 
    ?>

        
    <!--display the itineray for the current trip its on-->
    <!--to display I need ...
        itinerary_ID, trip_id, group_ID/group_name, attraction_ID/attraction_name
    -->

    <h1> Ready for your trip to <?php echo $tripLocation?>? </h1>
    <h2>Here's your current plan</h2>
    <form action='viewTrip.php' method ="post">
		<button class="backToTrip"> Back to Trip </button>
		<input type='hidden' name="tripBtn" value= '<?php echo $currTripID; ?>'/>
	</form>

    <!--displaying all the attraction names as a row -->
    
    <div class="itineraryList">
        <form action="deleteItineraryPlan.php" method="post">
            <!--getting tripID to send to addItinerary page-->
            <input type="hidden" name='tripIDHide' value = <?php echo $currTripID; ?> >
            
            <?php 
            //ordering all the attractions on the page
            //getting all the attractions from Itinerary
                $sqlGetAttractionsItinerary = "SELECT * FROM Itinerary WHERE itinerary_ID = $itineraryID;";
                if ($getAttractions->num_rows > 0) {
                    echo("<ul class='reorder-list' 'itineraryList'>");
                    while($row = $getAttractions->fetch_assoc()) {
                        echo ("<li id= " . $row["attractions_id"] . " class='ui-sortable-handle'> "); //creating the element within list
                        echo("<img src=" . $row["attraction_image"] . " style='height: 200px; width: 150px;'>"); // image that is above the text
                        echo ("<p>".  $row["attraction_name"] . "</p> 
                              <button type='submit' name = 'buttonName' value = " . $row["attractions_id"] . " > Delete </button>"); //creating name below image and button below that
                        echo ("</li>");
                    }
                    echo "</ul>";
                }


                $sqlGetAttractions = "SELECT attractions.attraction_name, attractions.attractions_id, attractions.attraction_image, Itinerary.attraction_order, Itinerary.itinerary_ID FROM Itinerary
                                        INNER JOIN attractions ON Itinerary.attraction_ID = attractions.attractions_id
                                        WHERE Itinerary.itinerary_ID = $itineraryID
                                        GROUP BY Itinerary.attraction_order ASC;";

                                        

                                        
                    //running the SQL
                    $getAttractions = $conn->query($sqlGetAttractions);
                    
                    //need to get current itinerary
            
                //click and drag to change the order of the itinerary 
                if ($getAttractions->num_rows > 0) {
                    echo("<ul class='reorder-list' 'itineraryList'>");
                    while($row = $getAttractions->fetch_assoc()) {
                        echo ("<li id= " . $row["attractions_id"] . " class='ui-sortable-handle'> "); //creating the element within list
                        echo("<img src=" . $row["attraction_image"] . " style='height: 200px; width: 150px;'>"); // image that is above the text
                        echo ("<p>".  $row["attraction_name"] . "</p> 
                              <button type='submit' name = 'buttonName' value = " . $row["attractions_id"] . " > Delete </button>"); //creating name below image and button below that
                        echo ("</li>");
                    }
                    echo "</ul>";
                }

            ?>
        </form>

        
            
        <!--Adding attractions below-->
            

            <div class="bottomBtns">
                <div class="addBtn">
                
    
                  <form action="./addtoItinerary.php" method="post">
                    
                        <!--getting tripID to send to addItinerary page -->
                        <input type="hidden" name='tripIDHide' value =  <?php echo $currTripID; ?> >

                            <?php
                               
                                $query="SELECT attraction_name, attractions_id FROM attractions;";
                                        //WHERE user_ID = $currUserID;";
                                $result = mysqli_query($conn, $query);
                                 if ($result){
                                     echo '<select name="type">';

                                     while($row = mysqli_fetch_array($result)){
		                            $attractionName = $row['attraction_name'];
                                            $attractionID = $row['attractions_id'];
					     
                                            echo '<option value=' . $attractionID .'>'. $attractionName . '</option>';
		                             }
                                    echo'</select>';

                                    echo ("<br/> <button type='submit'> Add </button>");
                                 } else{
                                     echo "No Attractions yet! Click below to Create some!";
                                 }
                             ?>
                            
                    </form>
                </div>
                
                <br/>

                <button onclick="createNew()"> Create New attraction to Add </button> 
                <input type="hidden" name="itinerary_ID" value= <?php echo($itineraryID); ?> >
                <input type="hidden" name='tripIDHide' value = <?php echo $currTripID; ?> >
		    <!--<button> onclick = "destinationPage();"> View Recommended Attractions</a></button> -->
            </div>
        </div>

        <?php include_once 'footer.php';?>
    </body>
</html>
