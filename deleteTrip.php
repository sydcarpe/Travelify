<?php
session_start();
//database info
//database info
//require 'dp_connection.php';
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";



// Create connection
$conn = new mysqli($hostName, $userName, $pwd , $dbName);
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//escape variables for security sql injection

//getting attraction id to delete
$currTripID = $_SESSION['trip_ID'];


$getCalendarID = "SELECT id FROM Calendar WHERE trip_ID = $currTripID;";

$calendarRow = mysqli_query($conn, $getCalendarID);
if($calendarRow){
    while($row = $calendarRow->fetch_assoc()){
        $calendarID = $row['id'];
    }
}

//current userID
$currUserID = $_SESSION['user_ID'];

$deleteItinerarysql = "DELETE FROM Itinerary
                        WHERE trip_ID = $currTripID;";

$deleteCalendarsql = "DELETE FROM Calendar WHERE trip_ID = $currTripID; ";

$deleteCalendarEvents = "DELETE FROM CalendarEvents WHERE calendar_id = $calendarID;";

$deletePackingsql = "DELETE FROM PackingList WHERE trip_ID = $currTripID;";

$deleteTrip = "DELETE FROM Trip 
                    WHERE trip_ID = $currTripID;";




mysqli_query($conn, $deleteItinerarysql);
mysqli_query($conn, $deletePackingsql);
mysqli_query($conn, $deleteCalendarEvents);
mysqli_query($conn, $deleteCalendarsql);
mysqli_query($conn, $deleteTrip);


header('Location: myTrips.php');



?>

