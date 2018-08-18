<?php
//index.php
	 session_start();
	require_once('includes/dbh.inc.php');
	include 'emailheader.php';
?>
<!DOCTYPE html>
<html>
 <head>
	 <a href="index.php">back</a>
  <title>Biology</title>
	 
	 <?php

if(!isset($_SESSION['tutortime'])) {
	
	
		if(isset($_GET['message'])){
		echo "Your project has been sent in! Thank you!";
		
	} else {
		echo "<br><br>Please choose a date <br>";
	}
	
}else {
	 
if (isset($_SESSION['tutortime'])) {
    echo "Event ID = ";
	$id = $_SESSION['tutortime'];
	echo $id;
	?> 	 <?php	 
} else {
	echo "nothing yet";
}


$sql1 = "SELECT * FROM available_times WHERE id = $id ";
$result = mysqli_query($connection, $sql1);
while ($tutor = $result->fetch_assoc()): ?>

	
	 
			<form method = "POST">
				
				 <?php
   				//$rand=rand();
   			//	$_SESSION['rand']=$rand;
  				?>
				
				<h2 class= "">Send in a tutoring request!</h2>
			
				<input type="text" name="requestee" id="" class= "form-control" placeholder = "Your Name"  required >
				<br>
				<input type="email" name="contact" id="" class= "form-control" placeholder = "Email" required>
				<br>
	
				
				<h5>Time Start: <?= $tutor['datetime_start'] ?></h5>
				<h5>Time End: <?= $tutor['datetime_end'] ?></h5>
				<h5>Student: <?= $tutor['studentid'] ?></h5>
				
				<?php 
		$datetime_start = $tutor['datetime_start'];
		$datetime_end = $tutor['datetime_end'];
		$studentid = $tutor['studentid'];
					
	
	endwhile; ?> 

				
				<br>
				<br>
				<input type="text" name="subject_level" id="" class= "form-control" placeholder = "Subject Difficulty/Level, i.e. Precalculus, 9th Grade Writing"  required >

				<br>

				<button class="btn" type="submit" name = "submitbtn">submit</button>

			</form>

<?php

if(isset($_POST['submitbtn']) & !empty(isset($_POST['submitbtn']))){
	$requestee = mysqli_real_escape_string($connection, $_POST["requestee"]);
	$contact = mysqli_real_escape_string($connection, $_POST["contact"]);
	$subject_level = mysqli_real_escape_string($connection, $_POST["subject_level"]);

	$subject = "biology";
	
	/*
	$datetime_start = mysqli_real_escape_string($connection, $_POST["date_time"]);
	$datetime_end = mysqli_real_escape_string($connection, $_POST["date_time_end"]);
	$subject = mysqli_real_escape_string($connection, $_POST["subject"]);
	$number_of_needed_students = mysqli_real_escape_string($connection, $_POST["number_of_needed_students"]);
	*/
	

	
	
//Inserting the data into the projects...
	$sql = "INSERT INTO request (requestee, contact, datetime_start, datetime_end, subject, tutor_diff, type, studentid) VALUES ('$requestee', '$contact', '$datetime_start' , '$datetime_end' , '$subject', '$subject_level', 'tutor', '$studentid');";
	
	echo $sql;
	
	//INSERT INTO tutor_request (requestee, contact, date_time_start, date_time_end, subject_english, subject_humanities, subject_math, number_of_needed_students, subject_level) VALUES ('nick', 'nick@gmail.com', '2018-08-13T14:22' , '2018-08-14T15:22' , '0' , '1' , '0', '5', 'Precalculus');

		$result = mysqli_query($connection, $sql);
		if ($result) {
			
			
			
			echo "Request successfully sent!";
			
			$sql2 = "UPDATE available_times SET hold = 'hold' WHERE id = '$id'";
			$result2 = mysqli_query($connection, $sql2);
			if ($result) {
			
			echo "updated";
				
				
			
		$sql3 = "SELECT * FROM students WHERE studentid = '$studentid'";
			$resultsql3 = mysqli_query( $connection, $sql3 );
			$resultCheck3 = mysqli_num_rows($resultsql3);
			
				if ($resultCheck3 > 0) {
					
					while ( $row = $resultsql3->fetch_assoc() ):
					
					$studentcontact = $row['contact'];

				
					 endwhile; 
				} else {
					echo "Student has no email";
				}
				
				
				
				
			
			
					
//Automated Email Test. The email variables are in the emailheader.php	

$to = $vpemail;
$subject = "A Project Request has been submitted!!";
$message = "A new Request has been submitted \r\n Requestee name: '$requestee' \r\n They are requesting for the time starting at '$datetime_start'";
				
$headers = 'From: NHS  <NHS@database.com>' . PHP_EOL .
    'Reply-To: NHS <NHS@database.com>' . PHP_EOL .
    'X-Mailer: PHP/' . phpversion() . "Content-type: text/html";
				
//$headers = "Content-type: text/html\r\n";
mail($to, $subject, $message, $headers);
echo "email to Project Manager sent";
			
		} else { 
			echo "Request to Project Manager failed to send";
				}
		
			
			
$to = $studentcontact;
$subject = "";
$message = "<h1> Someone has requested for you to tutor them in $subject </h1> <p> Requestee name: $requestee <br> They are requesting for the time starting at $datetime_start to $datetime_end<p> <h3>Log into the NHS database to verify this request</h3>";
			
$headers = 'From: NHS  <NHS@database.com>' . PHP_EOL .
    'Reply-To: NHS <NHS@database.com>' . PHP_EOL .
    'X-Mailer: PHP/' . phpversion() . "Content-type: text/html";
			
mail($to, $subject, $message, $headers);
echo "email to student tutor sent";
			
		} else { 
			echo "Request failed to send";
				}			
	


unset($_SESSION["tutortime"]);
	echo '<script>window.location.href = "biologytutorrequest.php?message=success";</script>';				
		
	
} 
	
}

?>

	 
	 
	 
	 
	 
	 
	 
	 
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
    events: 'biologyloadtime.php',
    //select a particular cell, dragging events and stuff
    selectable:false,
    selectHelper:false,
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
     if(confirm("Schedule a tutor for this date?"))
     {
      var id = event.id;
	  var title = event.title;
	  var studentid = event.studentid;
      $.ajax({
       url:"dateidtophp.php",
       type:"POST",
       data:{id:id, title:title, studentid:studentid},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Parameters Set");
		document.location.reload(true)
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
  <h2 align="center"><a href="#">NHS Tutor Scheduler: Biology</a></h2>
  <br />
  <div class="container">
   <div id="calendar"></div>
  </div>
 </body>
</html>







	


	
	 
 </body>
</html>
