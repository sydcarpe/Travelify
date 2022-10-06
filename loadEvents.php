<?php

session_start();
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";;

$conn = new mysqli($hostName, $userName, $pwd , $dbName);

//session info
$calendar_id = $_SESSION['calendarID'];
$tripID = $_SESSION['trip_ID'];

$data = array();

$query="SELECT * FROM CalendarEvents 
		WHERE trip_ID =$tripID;";
		//ORDER BY id;";

$query2 = "SELECT * FROM CalendarEvents
			INNER JOIN Calendar
			ON CalendarEvents.calendar_id = Calendar.id
			WHERE Calendar.trip_ID = $tripID;";

		/*"SELECT * FROM CalendarEvents 
		WHERE calendar_id = $calendar_id
		ORDER BY id;";*/

$calenderEventsRows = mysqli_query($conn, $query2);

if ($calenderEventsRows){
	if ($calenderEventsRows->num_rows > 0) {          
		while($row = $calenderEventsRows->fetch_assoc()) {
			$data[] = array(
				'id' => $row['id'],
				'title' => $row['title'],
				'start' => $row["start_event"],
				'end' => $row["end_event"]
			);
		} 
	} 
}

echo json_encode($data);


?>