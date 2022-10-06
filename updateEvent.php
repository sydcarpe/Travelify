<?php 

session_start();

$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";

$conn = new mysqli($hostName, $userName, $pwd , $dbName);

$calendar_id = $_SESSION['calendarID'];

if(isset($_POST["id"]))
{
		$title = $_POST['title'];
		$start_event = $_POST['start'];
		$end_event = $_POST['end'];
		$id = $_POST['id'];
	$query = "UPDATE CalendarEvents
				SET title='$title', start_event='$start_event', end_event='$end_event'
				WHERE id=$id;";

	mysqli_query($conn, $query);
	
}
?>