<?php
session_start();
//require 'dp_connection.php';
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";

$conn = new mysqli($hostName, $userName, $pwd , $dbName);

include_once 'navbar.php';


//ids and things
$currUserID = $_SESSION['user_ID'];
$tripID = $_SESSION['trip_ID'];

$getTripInfo = "SELECT * FROM Trip WHERE trip_ID = $tripID;";


$tripInfoRows = mysqli_query($conn, $getTripInfo);

if ($tripInfoRows){
	if ($tripInfoRows->num_rows > 0) {          
		while($row = $tripInfoRows->fetch_assoc()) {
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

		<script type="text/javascript">
			function createNewList(){
				window.location.href="createNewPackingList.php";
			}


		</script>

		<script type="text/javascript">
			function beenClicked(id){
				window.location.href="updateCheckBox.php?id=" + id;
			}

		</script>

		    <link rel="stylesheet" href="css/packingList.css" />

			<!--Google font icons--> 
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

	</head>

	<body>
		<!--TODO
			show favorites on load up
		-->

		<h1>Get Packing for your trip to <?php echo $location; ?>! </h1>
		<h4>Favorited Lists are saved for all your future trips!</h4>
		
		<center><form method="get" action="weather_inner.php">
   		 <button type="submit">Quick Weather Check</button>
		</form></center>
		
		<form action='viewTrip.php' method ="post">
			<button class="backToTrip"> Back to Trip </button>
			<input type='hidden' name="tripBtn" value= '<?php echo $tripID; ?>'/>
		</form>
		<!--If there is no  packing list associated with trip ID, say "no packing list yet! Create one here"-->
		

		<div class="packingContainer">
			<div class="listContainer">
				<!--Displaying the favorites packingLists-->
				<?php
				include_once 'displayFavLists.php';
				?>



				
				<!--Displaying packing lists that arent favorites-->
				<?php 
					//getting the trip packing list for user
					$sqlGetAllPackingLists = "SELECT * FROM PackingList 
												WHERE trip_ID = $tripID AND user_ID = $currUserID;";
					$packingListRows = mysqli_query($conn, $sqlGetAllPackingLists);

					if ($packingListRows->num_rows > 0) {

				
						//gets each list name and prints of items from the list
						while($row = $packingListRows->fetch_assoc()) {
							$packingListID = $row['list_ID'];
							$packingListName = $row['list_name'];
							$favoritesNum = $row['favorite'];

							//favorites change the heart color
							$heartColor;
							if($favoritesNum == 1){
								$heartColor = "red";
							} else{
								$heartColor= "black";
							}

							if($favoritesNum == 1){
								//do not display anything - they are being displayed above
							} else{
								//display the lists
								//print off title of each packinglist before listing off the list
									echo "<div class='individualListContainer'>";
									echo "<div class='topBtnsPackingList'>";
									echo "<h3>". $packingListName . "</h3>"; 

									echo"<form action='favoritePackingList.php' method='POST'> 
											<button onclick = 'favorite()' > <span id='heartFav' style=' color: ". $heartColor .";' class='material-icons'>&#xe87d</span> </button>
											<input type='hidden' name='packingListIDFav' value = ". $packingListID .">
										</form> ";


									echo "<form action='deletePackingList.php' method='POST'>
																<button class='topDeleteBtn' name = 'list_id' value="  . $packingListID . "  > x </button>
															</form>";


									echo "</div>";
										
									
																

									//using the name to get all items in the current list
									$sqlGetAllItems = "SELECT * FROM PackingItems
														WHERE list_ID = $packingListID;";

									$getAllItemsRow = mysqli_query($conn, $sqlGetAllItems);
									echo "<ul >";
									while($row2 = $getAllItemsRow->fetch_assoc()){
										$item = $row2['item_name'];
										$itemID = $row2['item_ID'];
										$isChecked = $row2['packed'];

										//if checkbox = 1, the box will be checked
										//if checkbox = 0, it will be unchecked

										echo "<div class='listItemsDisplay'>";
										if ($isChecked == 1){
											echo "<li class= 'checkboxLook'> <input type='checkbox' value=". $packingListID ." id= '". $itemID ."' onclick='beenClicked(this.id)' checked > ". $item ."</li>";
										} else {
											echo "<li class= 'checkboxLook'> <input type='checkbox' value=". $packingListID ." id= '". $itemID ."' onclick='beenClicked(this.id)' > ". $item ."</li>";
										} 

										//displaying delete item button need to make this look better
										 echo " <form action='deletePackingListItem.php' method='POST'>
													<button name = 'item_id' value="  . $itemID . "  > x</button>
												</form> ";
										echo "</div>";
									}
									echo"</ul>";

									
									echo "<form action='createNewItem.php' method='POST'>
												<input type='text' name='itemName' required>
												<button type='submit'>Add new Item to ". $packingListName ."</button>
												<input type='hidden' name='packingListID' value = ". $packingListID .">
										</form> </br></br></br>";
										echo "</div>";
								}


							}

						//display name of packing trip, then get all the items with the packinglist ID
				
					}
				?>
			

			<div class="leftSide">
				
				<!--Create new packing list-->
				<form action="createNewPackingList.php" method="post">
					<input type="text" name="listName" required>
					<button type="submit" name = >Create new List</button>
				</form>
			</div>
</div>
		</div>
		
	</body>
</html>

<br><br><br><br><br><br><br><br>
<?php
include('footer.html');
?>
