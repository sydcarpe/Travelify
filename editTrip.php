
<?php
session_start();
//require 'dp_connection.php';
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";

$conn = new mysqli($hostName, $userName, $pwd , $dbName);

include_once 'navbar.php';

//current user just in case I need it
$currUserID = $_SESSION['user_ID'];


//getting the trip id
$tripID = $_SESSION['trip_ID'];

$sqlGetTripInfo = "SELECT * FROM Trip
					WHERE trip_ID = $tripID;";

$getTripInfo = mysqli_query($conn, $sqlGetTripInfo);
if ($getTripInfo){
	if ($getTripInfo->num_rows > 0) {          
		while($row = $getTripInfo->fetch_assoc()) {
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
		<title>Editing <?php echo $tripName;?></title>

		<script>

		</script>

		    <link rel="stylesheet" href="css/tripView.css" />
	</head>
	<body>
		<!--What To display
			Packing list button
			itinerary button
			name
			l-->

		<div class= "bodyContainer">
			<div class="tripInfo">
				<h3><?php echo $tripName; ?></h3>
				

				<div class="inputsContainer">
					<p>Current Arrival Date: <?php echo $arrival;?> </p>
					
					<p>Current Departure Date: <?php echo $depature;?> </p>
					

					<p>Current Group: <?php echo $groupName;?> </p>
					
				</div>
			</div>

			<div class="editInfoContainer">
				<form action="finishTripEdit.php" method="post">
					<input type="text" name="newTripName" placeholder="Change Trip Name">
					<p>Select new Arrival date</p>
					<input type='date' name="newArrivalDate">
					<p>Select new Departure date</p>
					<input type='date' name="newDepartDate">
					<p>Select new group</p>
					<?php
						$sql = "SELECT group_Name From Group_Table 
								WHERE user_ID = $currUserID
								GROUP BY group_Name;";

						$result = mysqli_query($conn,$sql);
						if ($result != 0) {
						
							echo '<select name="new_group_Name">';
							echo '<option value="">' . $groupName . '</option>';
							$num_results = mysqli_num_rows($result);

							for ($i=0;$i<$num_results;$i++) {
								$row = mysqli_fetch_array($result);
								$newgroupname = $row['group_Name'];
								echo '<option value="' .$newgroupname. '">' .$newgroupname. '</option>';
							}
			
							echo '</select>';
						
						}
					?>
					</br>
					<button>Update</button>
				</form>

				<form action="viewTrip.php" method="post">
					<button name = 'tripBtn' value= <?php echo $tripID;?> >Finished Editing</button>
				</form>
			</div>

		</div>
	</body>
</html>