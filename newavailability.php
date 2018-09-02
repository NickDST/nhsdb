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
//echo $id;
$result = mysqli_query($connection, $sql);
while ($student = $result->fetch_assoc()): ?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
<!--	upper icon change later
<link rel="icon" type="image/png" href="assets/img/favicon.ico">-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Hub</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>

    <!--     Fonts and icons     -->
<!--    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">-->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="black" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index.htm" class="simple-text">
                    NHS HUB
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="myprojects.php">
                        <i class="pe-7s-graph"></i>
                        <p>My Projects/Service</p>
                    </a>
                </li>
				<br>
				<li class="active">
                    <a href="availability.php">
                        <i class="pe-7s-network"></i>
                        <p>Tutoring Availability</p>
                    </a>
                </li>
				<br>
				<li class="active">
                    <a href="activatepending.php">
                        <i class="pe-7s-users"></i>
                        <p>Activate Requests</p>
                    </a>
                </li>
				<br>
				<li class="active">
                    <a href="addservicemain.php">
                        <i class="pe-7s-users"></i>
                        <p>Add Service Hours</p>
                    </a>
                </li>

            </ul>
    	</div>
    </div>

    <div class="main-panel">
              <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
						
                    </button>
                    <a class="navbar-brand" href="#">Welcome <?= $student['name'] ?></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
								<p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
								<p class="hidden-lg hidden-md">Search</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="aboutme.php">
                               <p>Account</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
										User Preferences
										<b class="caret"></b>
									</p>

                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="myprojects.php">My Projects</a></li>
                                <li><a href="aboutme.php">About Me</a></li>
                                <li><a href="addservicemain.php">Add Service/Project</a></li>
                                <li><a href="availability.php">Change Availability</a></li>
                                <li><a href="removeself.php">Remove Self from Project</a></li>
                                <li class="divider"></li>
                                <li><a href="http://www.concordiashanghai.org">Concordia's Main Page</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href="logout.php">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>

		<?php endwhile ?>
		
		
		
<!--		
		 <div class="content">
            <div class="container-fluid">
                <div class="row">
					
                    <div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Title</h4>
                                <p class="category">subtitle</p>
                            </div>
                            <div class = "" style= "padding-left:15px;">
               

                           
                            </div>
                        </div>
                    </div>
-->
		
		
		
		
		
		
		
		
		
		
		
		
	
		
		
    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
   <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<!--	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>-->

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<!--	<script src="assets/js/demo.js"></script>-->
		
		
<!DOCTYPE html>
<html>
 <head>
  <title>Availability Times </title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
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
    events: 'load.php',
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

<!--	 
  <h2 align="center"><a href="#"><?php
	echo $_SESSION['studentid'];
	?></a></h2>
-->

	 
 <div class="content">
            <div class="container-fluid">
                <div class="row">
					
                    <div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Title</h4>
                                <p class="category">subtitle</p>
                            </div>
                       <div class = "" style= "padding-left:15px;">
  						<div class="container">
   						<div id="calendar"></div>
	  
  						</div>
						</div> 
					</div>
                </div>
          </div>
		</div>
   </div>
				
 </body>
</html>
