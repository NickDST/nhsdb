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
    events: 'loadadmindates.php',
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
                                <h2 class="title">Notes</h2>
<!--                                <p class="category">Click a cell to set a time where you are available</p>-->
                            </div>
                       <div class = "" style= "padding-left:15px; padding-bottom:20px;">
							<!--  Insert other things here				-->
						   <p>Click a cell to set a time where you are available</p>
						   
						   <p>Click "week" to drag the box to the specific time you want to be set to available.</p>
						   
						   <p>Those who look for requests under your subject fields will see these times.</p>
						   
						   <p>Click on the event time to delete it.</p>
						   
						   <p>Student IDs will appear on the dates.</p>
					
			    <br>
				<br>		   
				<a href="changeaccountinfo.php" class ="btn btn-warning">Change these subjects</a>
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
