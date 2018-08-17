<?php

session_start();
require_once('includes/dbh.inc.php');
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


include 'emailheader.php';
?>



<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<a href="hub.php">Back to Hub</a>
	
	<h1>Activate This Project</h1>

	
	<div class = "article-container">
		<hr>
		<?php
		$name = mysqli_real_escape_string($connection, $_GET['name']);
		$startdate = mysqli_real_escape_string($connection, $_GET['startdate']);
		$requestid = mysqli_real_escape_string($connection, $_GET['id']);
		//echo $projectid;
		$sql = "SELECT * FROM request WHERE datetime_start > NOW() AND studentid = '$id' AND requestid = '$requestid'";
		$result = mysqli_query($connection, $sql);
		$queryResults = mysqli_num_rows($result);
		if ($queryResults > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "
				<div>
					<h3>".$row['requestee']."</h3>
					<p>".$row['contact']."</p>
					<p>".$row['datetime_start']."</p>
					<p>".$row['datetime_end']."</p>
				 
				</div>
				<hr>";
			
		 $requestee = $row['requestee'];
		 $datetime_start = $row['datetime_start'];
		 $datetime_end = $row['datetime_end'];
		 $requestee_email = $row['contact'];
		 $studentid = $row['studentid'];
			}
			
	
		}
		?>
		

<form method="POST">
		<label for=""> Type "I accept" in the designated box to accept this request</label>
		<input type="text" name="confirm" id="" class= "form-control" placeholder = "Type it"  required >
	<button type="submit" name = "accept" >Submit</button>	
</form>		
		
<br>
		
<form method="POST">
		<label for=""> Type "reject" in the designated box to delete this request. </label>
		<input type="text" name="confirm" id="" class= "form-control" placeholder = "Type it"  required >
		<br>
		<label for="">Enter reason for rejecting</label>
		<textarea name="reason" rows="5" cols="40" required></textarea>
	<button type="submit" name = "reject" >Submit</button>	
</form>		

		
<!--if(isset($_POST['submitbtn']) & !empty(isset($_POST['submitbtn']))){-->
		
<?php
if(isset($_POST['accept']) & !empty(isset($_POST['accept']))){
	$confirm = mysqli_real_escape_string($connection, $_POST["confirm"]);
	if ($confirm == "I accept") {
		
		$teacher_contact = 'Jennifer.chapman@concordiashanghai.org';
		$teacher_name = 'Jennifer Chapman';
		$affiliated_group = 'NHS';
		$project_description = 'This is an NHS Tutoring Request';
		
		$addsql = "INSERT INTO project_list (project_name, teacher_name, teacher_contact, datetime_start, datetime_end, affiliated_group, entered_by, project_description, requestee, requestee_email, type) VALUES ('Tutoring Request', '$teacher_name', '$teacher_contact' , '$datetime_start' , '$datetime_end', '$affiliated_group', '$id', '$project_description', '$requestee', '$requestee_email', 'tutor');";
		
		$addresult = mysqli_query($connection, $addsql);
		if ($addresult) {
			echo "Project successfully inserted ";


		} else {
		
			echo "project failed to be added";
		}
		
		//Finding the ID of the project added
		
		$findsql = "SELECT * FROM project_list WHERE datetime_start = '$datetime_start' AND requestee = '$requestee'";
		$findresult = mysqli_query($connection, $findsql);
		$findqueryResults = mysqli_num_rows($findresult);
		if ($findqueryResults > 0) {
			while ($row = mysqli_fetch_assoc($findresult)) {
				$projectid = $row['projectid'];
		
			}
		
		date_default_timezone_set('Asia/Hong_Kong');

		$diff = strtotime($datetime_end) - strtotime($datetime_start);
 		$diff_in_hrs = $diff/3600;
 		
		
		
		$addsql2 = "INSERT INTO students_in_projects (projectid, studentid, service_hours, role) VALUES ('$projectid', '$id', '$diff_in_hrs' , 'Tutorer');";
		
		$addresult2 = mysqli_query($connection, $addsql2);
		if ($addresult2) {
			echo "student in project successfully inserted";


		} else {
		
			echo "studentinproject failed to be added";
		}
		
		
		
		$sql2 = "DELETE FROM request WHERE studentid = '$id' AND requestid = '$requestid'";
		
		$result2 = mysqli_query($connection, $sql2);
		if ($result2) {
			echo "Entry successfully removed";


		} else {
		
			echo "Entry failed to be removed";
		}

			
			
	//querying to look for the student email		
	$sql3 = "SELECT * FROM students WHERE studentid = '$id'";
			$resultsql3 = mysqli_query( $connection, $sql3 );
			$resultCheck3 = mysqli_num_rows($resultsql3);
			
				if ($resultCheck3 > 0) {
					
					while ( $row = $resultsql3->fetch_assoc() ):
					
					$studentcontact = $row['contact'];
					$studentname = $row['name'];

				
					 endwhile; 
				} else {
					echo "Student has no email";
				}
				
							

		
$to = $vpemail;
$subject = "EMAIL TO VP";
$message = "<h1> A new Request has been submitted </h1> <p> Requestee name: '$requestee' <br> They are requesting for the time starting at '$datetime_start' <p>";
$headers = "from: NHS Database Organiser <sender@NHS.com>";
$headers = "Content-type: text/html\r\n";
mail($to, $subject, $message, $headers,"-f Nick@cissnhs.com");
echo "<br>email to Project Manager sent";
	
		
			
			
$to = $studentcontact;
$subject = "EMAIL TO STUDENT CONTACT";
$message = "<h1> You have confirmed the tutor request! Here is an email of the info </h1> <p> Requestee name: $requestee <br> They are requesting for the time starting at $datetime_start to $datetime_end<p> <h3>Log into the NHS database to verify this request</h3>";
$headers = "from: NHS Database Organiser <sender@NHS.com>";
$headers = "Content-type: text/html\r\n";
mail($to, $subject, $message, $headers,"-f Nick@cissnhs.com");
echo "<br>email to student tutor sent";
			

/*			
$to = $requestee_email;
$subject = "EMAIL TO REQUESTEE";
$message = "<h1> Your Request has been received! </h1> <p> tutor name: $studentname <br> You will be starting at for the time starting at $datetime_start to $datetime_end<p> ";
$headers = "from: NHS Database Organiser <sender@NHS.com>";
$headers = "Content-type: text/html\r\n";
mail($to, $subject, $message, $headers,"-f Nick@cissnhs.com");
echo "<br>email to requestee  sent";			
*/			
			
			
	
$to = $chapmanemail;
$subject = "EMAIL TO CHAPMAN";
$message = "<h1> Email to chapman </h1> <p> $studentname has accepted and verified the tutor request to $requestee <p> Requestee name: $requestee <br> They are requesting for the time starting at $datetime_start to $datetime_end<p> <h3>Log into the NHS database to verify this request</h3>";
$headers = "from: NHS Database Organiser <sender@NHS.com>";
$headers = "Content-type: text/html\r\n";
mail($to, $subject, $message, $headers,"-f Nick@cissnhs.com");
echo "<br>email to chapman has been sent";
			
		} else { 
			echo "Emails failed to send";
				}				
			
			
		
	}

}

/* Rejection */
if(isset($_POST['reject']) & !empty(isset($_POST['reject']))){	
	
		$reason = mysqli_real_escape_string($connection, $_POST["reason"]);
	
		$sqlremove = "DELETE FROM request WHERE studentid = '$id' AND requestid = '$requestid'";
		
		$removeresult = mysqli_query($connection, $sqlremove);
		if ($removeresult) {
			echo "Entry successfully removed";


		} else {
		
			echo "Entry failed to be removed";
		}

	
	
	$to = $chapmanemail;
$subject = "EMAIL TO CHAPMAN";
$message = "$studentname has rejected $requestee for tutoring at $datetime_start for the reason of $reason. ";

$headers = 'From: NHS Organizer <NHS@database.com>' . PHP_EOL .
    'Reply-To: NHS <NHS@database.com>' . PHP_EOL .
    'X-Mailer: PHP/' . phpversion() . "Content-type: text/html";
	
mail($to, $subject, $message, $headers);
echo "<br>email to chapman has been sent";
			
}
			
				
	
	
	
	
	

		
?>
		
		