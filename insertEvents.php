<?php

session_start();
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";

$conn = new mysqli($hostName, $userName, $pwd , $dbName);

$calendar_id = $_SESSION['calendarID'];

try{
	if(isset($_POST['title'])){

		$title = $_POST['title'];
		$start_event = $_POST['start'];
		$end_event = $_POST['end'];
		$query ="INSERT INTO CalendarEvents (title, start_event, end_event, calendar_id)
					VALUES('$title', '$start_event', '$end_event' , $calendar_id);";

		
		mysqli_query($conn, $query);

	} //end of if statement

} catch(Exception $e){
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}




?>