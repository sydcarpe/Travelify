<?php
session_start();
//require 'dp_connection.php';
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";

$conn = new mysqli($hostName, $userName, $pwd , $dbName);
//including the navigation bar 
include_once 'navbar.php';

//current ids for logged in user and trip 
$currUserID = $_SESSION['user_ID'];
$tripID = ($_POST['tripBtn']);

//current trip being vieweed 
$_SESSION['trip_ID'] = $tripID;
//current itinerary being viewed
$itineraryID = $_SESSION['itinerary_ID'];

//getting trip information
$sqlGetTripInfo = "SELECT * FROM Trip WHERE trip_ID = $tripID;";

$getTripInfo = mysqli_query($conn, $sqlGetTripInfo);
if ($getTripInfo){
	if ($getTripInfo->num_rows > 0) {          
		while($row = $getTripInfo->fetch_assoc()) {
			//defining trip columns with variables 
			$location = $row['location'];
			$arrival = $row['arrival_date'];
			$depature = $row['depart_date'];
			$tripName = $row['trip_Name'];
			$groupName = $row['group_Name'];
		}
	} 
}

?>
 
<html>
	<head>
		<title><?php echo $tripName;?></title>

		<script>
			function goToPacking(){ //link for packing list function 
				 window.location.href = 'packingList.php';
			}

			function goToItinerary(){	//link for itinerary function
				window.location.href = 'itinerary.php';
			}

			function goToCalendar(){
				window.location.href = 'calendar.php';
			}
		</script>

		    <link rel="stylesheet" href="css/tripView.css" />
	</head>
	<body>
		<!--What To display
			Packing list button
			itinerary button
			name
			l-->

		<div class= "bodyContainer"> <!--user input information --> 
			<div class="tripInfo">
				<h1>Trip to <?php echo $location; ?>!</h1>
				<h3><?php echo $tripName; ?></h3>

				<div class="inputsContainer">
					<p>Arrival: <?php echo $arrival;?> </p>
					<p>Departure: <?php echo $depature;?> </p>
					<p>Group: <?php echo $groupName;?> </p>
				</div>
			</div>

			<div class="buttonContainer">
				<form action="itinerary.php" method = "post">
					<button type='submit'  name = 'tripIDHide' value = <?php echo ($tripID); ?> > View your Itinerary! </button>
				</form>
				<button onclick = 'goToPacking()'>View your Packing list!</button>
				<!--If calendar is included in the file (like below) it messes with CSS so ill work on that later-->
				</br>
				<button onclick = 'goToCalendar()'  name = 'tripIDHide' value = <?php echo ($tripID); ?> >View your Group Calendar!</button>


				<form action="editTrip.php" method="post"> 
					<button type="submit" name='tripIDBtn' >Edit Trip</button>
				</form>

				<form action="deleteTrip.php" method="post">
					<button type="submit" name='tripIDBtn' >Delete Trip</button>
				</form>

				
			</div>

			

		</div>
	
		


	</body>
</html>
