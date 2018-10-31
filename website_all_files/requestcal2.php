<?php
//index.php
	 session_start();
	require_once('includes/dbh.inc.php');
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Load All</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>

  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:false,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: 'requestloadall.php',
    //select a particular cell, dragging events and stuff
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
     var title = prompt("Enter Event Title");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"insert.php",
       type:"POST",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       }
      })
     }
    },
    //You are allowed to edit the table....
    editable:false,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

     eventClick:function(event)
    {
     if(confirm("Are you sure you want to add it?"))
     {
      var id = event.id;
      $.ajax({
       url:"dateidtophp.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     }
    },
   });
  });
	  
	 
  </script>
	 

	 

	
	
 </head>
 <body>
  <br />
  <h2 align="center"><a href="#">NHS Fullcalendar</a></h2>
  <br />
  <div class="container">
   <div id="calendar"></div>
  </div>
 </body>
</html>




<?php

if(isset($_POST) & !empty($_POST)){
	$requestee = mysqli_real_escape_string($connection, $_POST["requestee"]);
	$contact = mysqli_real_escape_string($connection, $_POST["contact"]);
	$subject_level = mysqli_real_escape_string($connection, $_POST["subject_level"]);
	
	
	/*
	$datetime_start = mysqli_real_escape_string($connection, $_POST["date_time"]);
	$datetime_end = mysqli_real_escape_string($connection, $_POST["date_time_end"]);
	$subject = mysqli_real_escape_string($connection, $_POST["subject"]);
	$number_of_needed_students = mysqli_real_escape_string($connection, $_POST["number_of_needed_students"]);
	*/
	

	
	
//Inserting the data into the projects...
	$sql = "INSERT INTO request (requestee, contact, datetime_start, datetime_end, subject, subject_level, assigned) VALUES ('$requestee', '$contact', '$datetime_start' , '$datetime_end' , '$subject', '$subject_level', 'no');";
	
	echo $sql;
	
	//INSERT INTO tutor_request (requestee, contact, date_time_start, date_time_end, subject_english, subject_humanities, subject_math, number_of_needed_students, subject_level) VALUES ('nick', 'nick@gmail.com', '2018-08-13T14:22' , '2018-08-14T15:22' , '0' , '1' , '0', '5', 'Precalculus');

		$result = mysqli_query($connection, $sql);
		if ($result) {
			$smsg = "Request successfully sent!";
			
//Automated Email test. The email variables are in the header.php		
$to = $vpemail;

$subject = "A Project Request has been submitted!!";

$message = "<h1> A new Request has been submitted </h1> <p> Requestee name: '$requestee'<p>";

$headers = "From: NHS Database Organiser <sender@NHS.com>";

$headers = "Content-type: text/html\r\n";

mail($to, $subject, $message, $headers);

echo "mailing test";

		} else { $fmsg = "Request failed to send";}
	
	
} 
?>



	

<?php
	 
if (isset($_SESSION['tutortime'])) {
    echo "Event ID = ";
	$id = $_SESSION['tutortime'];
	echo $id;
	?> 	 <?php	 
} else {
	echo "nothing yet";
}

	?>
	 
			<form class="" method = "POST">
				
				<h2 class= "">Send in a tutoring request!</h2>
			
				<input type="text" name="requestee" id="" class= "form-control" placeholder = "Your Name"  required >
				<br>
				<input type="email" name="contact" id="" class= "form-control" placeholder = "Email" required>
				<br>
				
	
				<select name="subject">
					<option value="">Select Subject</option>
					<option value="English">English</option>
					<option value="Math">Math</option>
					<option value="Humanities">Humanities</option>
					<option value="Biology">Biology</option>
		    	</select>
				
				<br>
				<br>
				<input type="text" name="subject_level" id="" class= "form-control" placeholder = "Subject Difficulty/Level, i.e. Precalculus, 9th Grade Writing"  required >

				<br>

				<button class="btn" type="submit">submit</button>

			</form>

	 
	 
 </body>
</html>
