<?php 
session_start();
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";
$conn = new mysqli($hostName, $userName, $pwd , $dbName);

$currUserID = $_SESSION['user_ID'];

/*TODO
 - get current user and see if they have any favorited lists
 - display those packing lists
 - include this into the packingList.php
*/

$getFavoritessql = "SELECT * FROM PackingList 
					WHERE user_ID = $currUserID AND favorite = 1;";


$favoritesRow = mysqli_query($conn, $getFavoritessql);

//getting the packingList name to display
if ($favoritesRow){
	if ($favoritesRow->num_rows > 0) {          
		while($row = $favoritesRow->fetch_assoc()) {
			$listName = $row['list_name'];
			$packingListID = $row['list_ID'];
			$favoritesNum = $row['favorite'];

			$heartColor;
			if($favoritesNum == 1){
				$heartColor = "red";
			} else{
				$heartColor= "black";
			}

			if($favoritesNum == 0){
				//do not display anything - they are being displayed above
			} 
			else{
				//display the lists
				//print off title of each packinglist before listing off the list
				echo "<div class='individualListContainer'>";
				echo "<div class='topBtnsPackingList'>";

				echo "<h3>". $listName . "</h3>"; 


				echo"<form action='favoritePackingList.php' method='POST'> 
							<button onclick = 'favorite()' > <span id='heartFav' style=' color: ". $heartColor .";' class='material-icons'>&#xe87d</span> </button>
							<input type='hidden' name='packingListIDFav' value = ". $packingListID .">
						</form> ";
					
				echo "<form action='deletePackingList.php' method='POST'>
							<button class='topDeleteBtn' name = 'list_id' value="  . $packingListID . "  >x</button>
						</form>";
			
				
				
				
				echo "</div>";
				
				

				//getting the packingList items
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
					

						//displaying delete item button (aka the x)
							echo " <form action='deletePackingListItem.php' method='POST'>
									<button name = 'item_id' value="  . $itemID . "  > x </button>
								</form> ";
							
						echo "</div>";
					}

				echo"</ul>";

					echo "<form action='createNewItem.php' method='POST'>
								<input type='text' name='itemName' required>
								<button type='submit'>Add new Item to ". $listName ."</button>
								<input type='hidden' name='packingListID' value = ". $packingListID .">
						</form> </br></br></br>";
					echo "</div>";
					
			}
		}
	}
}



?>