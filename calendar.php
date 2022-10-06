<?php
session_start();
$hostName = "db.luddy.indiana.edu";
$userName = "i494f21_team53"; 
$pwd = "my+sql=i494f21_team53";
$dbName = "i494f21_team53";

    
$conn = new mysqli($hostName, $userName, $pwd , $dbName);


$tripID = $_SESSION['trip_ID'];
//Getting the calendarID 
$sqlGetCalendarID = "SELECT * FROM Calendar 
                        WHERE trip_ID = trip_ID;";
$getCalendarID = mysqli_query($conn, $sqlGetCalendarID);

if ($getCalendarID){
	if ($getCalendarID->num_rows > 0) {          
		while($row = $getCalendarID->fetch_assoc()) {
			//defining trip columns with variables 
			$calendar_id = $row['id'];
		}
	} 
}

//getting trip information to display
$sqlTripInfo = "SELECT * FROM Trip
                WHERE trip_ID = $tripID;";

$getTripResults = mysqli_query($conn, $sqlTripInfo);

if($getTripResults){
    if($getTripResults->num_rows > 0){
        while ($row = $getTripResults->fetch_assoc()){
            $tripName = $row['trip_Name'];
            $groupName = $row['group_Name'];
        }
    }
}

$_SESSION['calendarID'] = $calendar_id;

include_once 'navbar.php';
?>

<!DOCTYPE html>
<html>
<head>

    <title>Calendar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="css/calendarPage.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

    <!-- I followed this youtube tutorial for the most part https://www.youtube.com/watch?v=7bg8Yj-MkJw-->

</head>
    
<script>

    $(document).ready(function(){
        var calendar=$("#calendar").fullCalendar({
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            }, //header

           events:'loadEvents.php',        
            selectable:true,
            selectHelper:true,

            select:function(start,end, allDay){
                var title = prompt("Enter Event Title");

                if (title){
                    var startTime = $.fullCalendar.formatDate(start,"Y-MM-DD HH:mm:ss");
                    var endTime = $.fullCalendar.formatDate(end,"Y-MM-DD HH:mm:ss");
                        
                    $.ajax({
                        url: 'insertEvents.php',
                        type:'POST',

                        data:{
                            title:title,
                            start:startTime,
                            end:endTime
                        }, // end of data

                            
                        error: function (jqXHR, exception) {
                            alert("Event not added");
                        },
                            

                        success:function(response){
                            calendar.fullCalendar('refetchEvents');

                            alert("Added Successfully");

                        } //end of success function

                    }) // end of ajax

                } // end of title if


            }, //end of select function

            //deleting section
           
            eventClick:function(event)
            {
                if(confirm("Are you sure you want to remove it?"))
                {
                    var id = event.id;
                                        
                   $.ajax({
                        url: 'deleteEvent.php',
                        type:'POST',

                        data:{
                            id:id
                        }, // end of data

                            
                        error: function (jqXHR, exception) {
                            alert("Event not deleted");
                        },
                            

                        success:function(response){
                            calendar.fullCalendar('refetchEvents');

                            alert("Deleted Successfully");

                        } //end of success function

                    }) // end of ajax
                    
                }
            },
                
            //update function
            eventResize:function(event){
                var startTime = $.fullCalendar.formatDate(start,"Y-MM-DD HH:mm:ss");
                var endTime = $.fullCalendar.formatDate(end,"Y-MM-DD HH:mm:ss");

                var title= event.title;
                var id = event.id;

                $.ajax({
                    url:'updateEvent.php',
                    type: 'POST',
                    data:{
                        id:id,
                        start:startTime,
                        end:endTime,
                        title:title
                    },

                    success:function(data){
                        calendar.fullCalendar("refetchEvents");

                        alert("updated");
                    }
                })
            }, //end of resize


            eventDrop:function(event){
                var startTime = $.fullCalendar.formatDate(event.start,"Y-MM-DD HH:mm:ss");
                var endTime = $.fullCalendar.formatDate(event.end,"Y-MM-DD HH:mm:ss");

                var title= event.title;
                var id = event.id;

                $.ajax({
                    url:'updateEvent.php',
                    type: 'POST',
                    data:{
                        id:id,
                        start:startTime,
                        end:endTime,
                        title:title
                    },

                    success:function(data){
                        calendar.fullCalendar("refetchEvents");

                        alert("updated");
                    }
                })
            } //end drop


        }) //end of .fullCalendar

    }) //end of $document


</script>


<body style="background-color: #e7feff; margin-bottom: 1.0em;">


    <br>
    <h2 align="center">
         <?php echo $tripName;?> Calendar
    </h2>
	<form action='viewTrip.php' method ="post">
			<button class="backToTrip"> Back to Trip </button>
			<input type='hidden' name="tripBtn" value= '<?php echo $tripID; ?>'/>
		</form>

    <br>

    <div class="container">
        <div id="calendar" style="background-color: white; padding: 2.0em; border-radius: 8px;  box-shadow: 0 6px 8px var(--boxShadow); ">
        </div>

        <?php include_once 'footer.php'; ?>
</body>
</html>
