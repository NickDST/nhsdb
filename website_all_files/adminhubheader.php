<?php

session_start();
if ( !isset( $_SESSION[ 'studentid' ] ) ) {
	header( 'Location: login.php' );
	exit;
}





if ( !isset( $_SESSION[ 'admin_rights' ] ) ) {
	if ( !isset( $_SESSION[ 'nhs_officer_rights' ] ) ) {
		if ( !isset( $_SESSION[ 'snhs_officer_rights' ] ) ) {
			header( 'Location: hub.php' );
			exit;
		}
	}

}





if ( isset( $_SESSION[ 'studentid' ] ) ) {
	$id = $_SESSION[ 'studentid' ];

	?>
	<?php
} else {
	//echo "nothing yet";
}

require_once( 'includes/dbh.inc.php' );
$sql = "SELECT * FROM students WHERE studentid = '$id'";
//echo $id;
$result = mysqli_query( $connection, $sql );
while ( $student = $result->fetch_assoc() ):
	$color = $student[ 'sidecolor' ];
?>

<?php
/*
if (isset($_SESSION['admin_rights'])) {
echo "I have admin_rights";
	
} 

if (isset($_SESSION['nhs_officer_rights'])) {
echo "I have nhs officer rights";
	
} 
	
if (isset($_SESSION['snhs_officer_rights'])) {
echo "I have snhs officer rights";
	
} 
*/
?>




<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<!--	upper icon change later
<link rel="icon" type="image/png" href="assets/img/favicon.ico">-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

	<title>Hub</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
	<meta name="viewport" content="width=device-width"/>


	<!-- Bootstrap core CSS     -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet"/>

	<!-- Animation library for notifications   -->
	<link href="assets/css/animate.min.css" rel="stylesheet"/>

	<!--  Light Bootstrap Table core CSS    -->
	<link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>

	<!--     Fonts and icons     -->
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
	<link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet"/>

</head>

<body>






	<div class="wrapper">
		
		<div class='sidebar' data-color='azure' data-image='assets/img/sidebar-5.jpg'>
		
		
<!--		<div class='sidebar' <?php// echo "data-color='$color'"?> data-image='assets/img/sidebar-5.jpg'>-->

		<?php 
		//echo "<div class='sidebar' data-color='$color' data-image='assets/img/sidebar-5.jpg'>";
	?>

		<!--    <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-5.jpg">-->

		<!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

		<div class="sidebar-wrapper">
			<div class="logo">
				<a href="adminhub.php" class="simple-text">
                    ADMIN HUB
                </a>
			
			</div>
			<ul class="nav">
				<li class="active">
					<a href="adminhub.php">
                        <i class="pe-7s-global"></i>
                        <p>Admin Hub Home</p>
                    </a>
				
				</li>

				<ul class="nav">
					<li class="active">
						<a href="adminsearchstudent.php">
                        <i class="pe-7s-user"></i>
                        <p>Search Student</p>
                    </a>
					
					</li>
					<br>
					<li class="active">
						<a href="adminrequirements.php">
                        <i class="pe-7s-comment"></i>
                        <p>Search Requirements</p>
                    </a>
					
					</li>
					<br>
					<li class="active">
						<a href="adminviewdates.php">
                        <i class="pe-7s-date"></i>
                        <p>View All Student Dates</p>
                    </a>
					
					</li>
					<br>
					<li class="active">
						<a href="admingroupprojects.php">
                        <i class="pe-7s-rocket"></i>
                        <p>Group Tutor Sessions</p>
                    </a>
					
					</li>
					<br>
					<li class="active">
						<a href="viewrequestee.php">
                        <i class="pe-7s-magic-wand"></i>
                        <p>View Requestees</p>
                    </a>
					
					</li>
					<br>
					<?php
					if ( isset( $_SESSION[ 'admin_rights' ] ) ) {
						?>

					<li class="active">
						<a href="lookuprequestee.php">
                        <i class="pe-7s-compass"></i>
                        <p>Look Up Requestee</p>
                    </a>
					
					</li>
					<br>
					<li class="active">
						<a href="adminmodifyproject.php">
                        <i class="pe-7s-edit"></i>
                        <p>Modify Project Info</p>
                    </a>
					
					</li>
					
					<br>
					
					<li class="active">
						<a href="emailshooter.php">
                        <i class="pe-7s-edit"></i>
                        <p>Send an email</p>
                    </a>
					
					</li>
					<br>
					<li class="active">
						<a href="searchstudentfields.php">
                        <i class="pe-7s-anchor"></i>
                        <p>students in Subjects</p>
                    </a>
					
					</li>
					<br>
					<li class="active">
						<a href="didpeoplesetdates.php">
                        <i class="pe-7s-anchor"></i>
                        <p>Check number of dates</p>
                    </a>
					
					</li>
					<?php	 }  ?>

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
							<a href="hub.php">
                                <i class="fa fa-dashboard"></i>
								<p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
						
						</li>
						<li>
							<a href="searchproject.php">
                                <i class="fa fa-search"></i>
								<p class="hidden-lg hidden-md">Search</p>
                            </a>
						
						</li>
					</ul>

					<ul class="nav navbar-nav navbar-right">


						<li>
							<a href="hub.php">
								<p>Back to Student</p>
							</a>
						</li>
						<?php  
					
						?>


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
								<li><a href="myprojects.php">My Projects</a>
								</li>
								<li><a href="aboutme.php">About Me</a>
								</li>
								<li><a href="changeaccountinfo.php">Change Account Info</a>
								</li>
								<li><a href="availability.php">Change Availability</a>
								</li>
								<li><a href="removeself.php">Remove Self from Project</a>
								</li>
								<li class="divider"></li>
								<li><a href="http://www.concordiashanghai.org">Concordia's Main Page</a>
								</li>
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


		<div class="col-md-12" style = "padding-bottom:20px;">
			

				<h1> Admin/Officer Hub</h1>
			
			<hr>
			<h2>Currently logged in as: <?= $student['officer_log'];?> Officer</h2>
			<?php
			if ( isset( $_SESSION[ 'admin_rights' ] ) ) {
				?> <a href="changeloggedofficer.php" class="btn">Change Logged in Officer</a>
			<?php
			}
			?>

		</div>


		<?php 
$view_society =	$student['officer_log'];
		
endwhile; ?>

		<?php 	if ( isset( $_GET[ 'error' ] ) ) {
			$fmsg = $_GET[ 'error' ]; } ?>
		<?php 	if ( isset( $_GET[ 'success' ] ) ) {
			$smsg = $_GET[ 'success' ]; } ?>

		<?php if(isset($smsg)){ ?>
		<div class="alert alert-success" role="alert" style="margin-top: 20px;">
			<?php echo $smsg; ?> </div>
		<?php } ?>
		<?php if(isset($fmsg)){ ?>
		<div class="alert alert-danger" role="alert" style="margin-top: 20px;">
			<?php echo $fmsg; ?> </div>
		<?php } ?>
		<!--		echo '<script>window.location.href = "tutorrequest.php?message=success";</script>';-->
		
		
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
<!--	<script src="assets/js/demo.js"></script>-->
		
		
		