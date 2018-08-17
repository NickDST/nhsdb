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
echo $id;
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
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
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
                <a href="#" class="simple-text">
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


        <div class="content">
            <div class="container-fluid">
                <div class="row">
					
                    <div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Pending Requests</h4>
                                <p class="category">Please View Your Active Requests</p>
                            </div>
                            <div class = "" style= "padding-left:15px;">
                               	<?php
				/*Pending requests*/
				$pendingsql = "SELECT * FROM request WHERE datetime_start > NOW() AND studentid = '$id' ORDER BY datetime_start";
				$Presultsql = mysqli_query( $connection, $pendingsql );

				$pendingCheck = mysqli_num_rows($Presultsql);
		
			
				if ($pendingCheck > 0) {
					
					while ( $pendingrequest = $Presultsql->fetch_assoc() ):
					
					?>
					

					<?php echo "Name: ".$pendingrequest['requestee'];?> <br>
								
					<?php echo $pendingrequest['contact'];?> hours - 
					<?php echo nl2br($pendingrequest['subject']."\r\n");?> 
					<hr>



					<!-- End While -->
					<?php endwhile; 
				} else {
					echo "No Pending Requests";
				}
				?>
				

                           
                            </div>
                        </div>
                    </div>
<!--					New section-->
					
					<div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Ongoing Projects</h4>
                                <p class="category">Currently Active are displayed</p>
                            </div>
                            <div class = "" style= "padding-left:15px;">
                               		<?php
				/*Projects where status = ongoing*/
				$studentsql = "SELECT project_list.*, students_in_projects.*, students.* FROM project_list, students_in_projects, students WHERE students.studentid = students_in_projects.studentid AND students_in_projects.projectid = project_list.projectid AND students.studentid = '$id' AND datetime_end > NOW()";
				$resultsql = mysqli_query( $connection, $studentsql );

				$resultCheck = mysqli_num_rows($resultsql);
		
			
				if ($resultCheck > 0) {
					
					while ( $projectinfo = $resultsql->fetch_assoc() ):


					?>

					<?php echo $projectinfo['project_name'];?> <br>
					<?php echo $projectinfo['requestee'];?> <br>
					<?php echo "Role: ".nl2br($projectinfo['role']."\r\n");?> 
					<hr>



					<!-- End While for project ID -->
					<?php endwhile; 
				} else {
					echo "No Projects Entered Yet";
				}
				?>
				
				

                           
                            </div>
                        </div>
                    </div>

<!--New Section-->
					 <div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Finished Projects Here</h4>
                                <p class="category">Service Hours have been accounted for</p>
                            </div>
                            <div class = "" style= "padding-left:15px;">
                            <?php
				/*For all previous service hours and projects*/
				$studentsql = "SELECT project_list.*, students_in_projects.*, students.* FROM project_list, students_in_projects, students WHERE students.studentid = students_in_projects.studentid AND students_in_projects.projectid = project_list.projectid AND students.studentid = '$id'";
				$resultsql = mysqli_query( $connection, $studentsql );

				$resultCheck = mysqli_num_rows($resultsql);
		
			
				if ($resultCheck > 0) {
					
					while ( $projectinfo = $resultsql->fetch_assoc() ):


					?>

					<?php echo $projectinfo['project_name'];?> <br>
					<?php echo $projectinfo['service_hours'];?> hours - 
					<?php echo nl2br($projectinfo['role']."\r\n");?> 
	<br>



					<!-- End While for project ID -->
					<?php endwhile; 
				} else {
					echo "No Projects Entered Yet";
				}
				?>
				
				<hr>
				
				

                           
                            </div>
                        </div>
                    </div>
					
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>

                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> NHS DB
                </p>
            </div>
        </footer>

    </div>
</div>

<?php endwhile ?>
</body>

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
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>


</html>
