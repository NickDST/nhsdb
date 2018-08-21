<?php

session_start();

if (!isset($_SESSION['studentid'])) {
	header('Location: login.php');
  exit;
}

if (isset($_SESSION['studentid'])) {
	$id = $_SESSION['studentid'];
	
	?> 	 <?php	 
} else {
	echo "nothing yet";
}

require_once('includes/dbh.inc.php');

$sql = "SELECT * FROM students WHERE studentid = '$id'";
//echo $sql;
$result = mysqli_query($connection, $sql);
while ($student = $result->fetch_assoc()): 

$studentname = $student['name'];
$view_society = $student['officer_log'];
endwhile;
//include 'hubheader.php'
?>

<!DOCTYPE html>
<html>
 <head>
  <title>Availability Times </title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <link rel="stylesheet" href="calendar.css"> 
	 
	    <!-- Bootstrap core CSS     -->
<!--   <link href="assets/css/bootstrap.min.css" rel="stylesheet" /> -->
	 
	 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>
	

  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: 'loadadmindatesgroup.php',
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
       url:"admininsert.php",
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
    //You are allowed to edi the table....
    editable:true,
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
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete.php",
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
<!--	
  <h2 align="center"><a href="hub.php"><?php
//	echo $studentname;
	?></a></h2>
  <br />
-->
		 
 <div class="content">
            <div class="container-fluid">
                <div class="row">
					
                    <div class="col-md-8">
                        <div class="card">

                            <div class="header" style = "margin-left:20px; margin-top:10px;">
                                <h2 class="title"><?php echo $studentname;?></h2>
								 <h2 class="title"><?php echo $view_society;?></h2>
                                <h4 class="category">Officer View Availability</h4>
                            </div>
                       <div class = "" style= "padding-left:15px;">
  						<div class="container">
   						<div id="calendar"></div>
	  
  						</div>
						</div> 
					</div>
                </div>
					
					 <div class="col-md-4">
                        <div class="card">

                            <div class="header" style = "margin-left:20px; margin-top:10px;">
                                <h2 class="title">Create a Group Session</h2>
                                <p class="category">Click a cell to set a time where you want the group project available</p>
                            </div>
                       <div class = "" style= "padding-left:15px; padding-bottom:20px;">
						   
						   <form method="POST">
							   
							 <select name="group_subject" id="">
									<option>Choose a Subject</option>
									<option value="Biology">Biology</option>
									<option value="Physics">Physics</option>
									<option value="Chemistry">Chemistry</option>
									<option value="English">English</option>
									<option value="Reading">Reading</option>
									<option value="World History">World History</option>
									<option value="Writing">Writing</option>
									<option value="Precalculus">Precalculus</option>
									<option value="Algebra 2">Algebra 2</option>
									<option value="Geometry or Lower">Geometry or Lower</option>
							</select>
							   
						   <br>
						   <br>	   
							   
						 	    <label for="">Enter a description of what will be the focus of the group session</label>
											<div class="form-group">
												<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="group_description" placeholder="i.e. Group Study Session on Meiosis and Mitosis" required maxlength=500 style = "resize:none;" ></textarea>
											</div>
							   <button class="btn btn-success" type="submit" name = "groupinfo">This is the information to Set</button>
						   
						
						   </form>
						   
						   <?php 
						   
						   if(isset($_POST['groupinfo']) & !empty(isset($_POST['groupinfo']))){
							   $group_subject = mysqli_real_escape_string($connection, $_POST["group_subject"]);
							   $group_desc = mysqli_real_escape_string($connection, $_POST["group_description"]);
							   
							   
							   
							   //echo $group_subject;
							   $_SESSION[ 'group_subject'] = $group_subject;
							   //echo "<br>";
							   //echo $group_desc;
							   $_SESSION[ 'group_desc'] = $group_desc;
							   //echo "<br>";
							   echo '<script>window.location.href = "admingroupprojects.php";</script>';

						   }
						   
						   
						   if (isset($_SESSION['group_subject'])){
							echo "Group subject: ". $_SESSION['group_subject'];
						   		}
						    echo "<br>";

						   	if (isset($_SESSION['group_desc'])){
								echo "Current Description: ". $_SESSION['group_desc'];
								echo "<br>";
							echo "Now you can click on a date to set a group session!";
								}
						   
						   
		
					?>
			    <br>
				<br>		   

			    <br>
				<br>		   
				<a href="adminhub.php" class ="btn btn-info">Back to Officer Hub</a>

						   
	  
  						</div>
						</div> 
					</div>
                </div>
          </div>
		</div>
   </div>
				
 </body>
</html>
