<?php
include 'hubheader.php';

include 'emailheader.php';
?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Confirm Pending</title>
</head>

<body>
<!--<a href="hub.php">Back to Hub</a>-->
	
<!--	<h1>Activate This Project</h1>-->
	
		 <div class="content">
            <div class="container-fluid">
                <div class="row">
					
                    <div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h2 class="title">Activate This Tutor Request</h2>
                                <p class="category">Enter the correct information to activate the request</p>
                            </div>
                            <div class = "" style= "padding-left:15px;">
               
	
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
	<br>
	<button type="submit" name = "accept" class = "btn btn-success">Submit</button>	
</form>		
		
<br>
		
<form method="POST">
		<label for=""> Type "reject" in the designated box to delete this request. </label>
		<input type="text" name="deny" id="" class= "form-control" placeholder = "Type it"  required >
		<br>
		<label for="">Enter reason for rejecting</label>
	<br>
		<textarea name="reason" rows="5" cols="40" required></textarea>
	<br>
	<button type="submit" name = "reject" class = "btn btn-danger">Reject</button>	
</form>		
      </div>
                        </div>
                    </div>
						      </div>
                        </div>
                    </div>
		 </div>
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
			
			
			
			
			
			$sql5 = "DELETE FROM available_times WHERE studentid = '$id' AND datetime_start = '$datetime_start' AND datetime_end = '$datetime_end'";
		
		$result5 = mysqli_query($connection, $sql5);
		if ($result5) {
			echo "date successfully removed";


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
$message = "A new Request has been submitted \r\nRequestee name: '$requestee' \r\nThey are requesting for the time starting at '$datetime_start'";

$headers = 'From: NHS Database <NHS@database.com>' . PHP_EOL .
    'Reply-To: NHS <NHS@database.com>' . PHP_EOL .
    'X-Mailer: PHP/' . phpversion() . "Content-type: text/html";
			
			
mail($to, $subject, $message, $headers);
echo "<br>email to Project Manager sent";
	
		
			
			
$to = $studentcontact;
$subject = "EMAIL TO STUDENT CONTACT";
$message = "You have confirmed the tutor request! Here is an email of the info \r\nRequestee name: $requestee \r\n\r\nThey are requesting for the time starting at $datetime_start to $datetime_end \r\nLog into the NHS database to verify this request";
$headers = 'From: NHS Database <NHS@database.com>' . PHP_EOL .
    'Reply-To: NHS <NHS@database.com>' . PHP_EOL .
    'X-Mailer: PHP/' . phpversion() . "Content-type: text/html";
mail($to, $subject, $message, $headers);
echo "<br>email to student tutor sent";
			

		
$to = $requestee_email;
$subject = "EMAIL TO REQUESTEE";
$message = "Your Request has been received! \r\ntutor name: $studentname \r\n\r\nYou will be starting at for the time starting at $datetime_start to $datetime_end<p> ";

$headers = 'From: NHS Database <NHS@database.com>' . PHP_EOL .
    'Reply-To: NHS <NHS@database.com>' . PHP_EOL .
    'X-Mailer: PHP/' . phpversion() . "Content-type: text/html";
			
mail($to, $subject, $message, $headers);
echo "<br>email to requestee  sent";			
		
			
			
	
$to = $chapmanemail;
$subject = "EMAIL TO CHAPMAN";
$message = "Email to chapman \r\n$studentname has accepted and verified the tutor request to $requestee \r\n\r\nRequestee name: $requestee \r\n\r\nThey are requesting for the time starting at $datetime_start to $datetime_end";


$headers = 'From: NHS Database <NHS@database.com>' . PHP_EOL .
    'Reply-To: NHS <NHS@database.com>' . PHP_EOL .
    'X-Mailer: PHP/' . phpversion() . "Content-type: text/html";
			
mail($to, $subject, $message, $headers);
echo "<br>email to chapman has been sent";
			
		} else { 
			echo "Emails failed to send";
				}				
			
			
		
	}

}

/* Rejection */
if(isset($_POST['reject']) & !empty(isset($_POST['reject']))){
	$deny = mysqli_real_escape_string($connection, $_POST["deny"]);
	if ($deny == "reject") {
	
		$reason = mysqli_real_escape_string($connection, $_POST["reason"]);
	
		$sqlremove = "DELETE FROM request WHERE studentid = '$id' AND requestid = '$requestid'";
		
		$removeresult = mysqli_query($connection, $sqlremove);
		if ($removeresult) {
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
	
	
	$to = $chapmanemail;
$subject = "EMAIL TO CHAPMAN";
$message = "$studentname has rejected $requestee for tutoring at $datetime_start for the reason of '$reason'. ";

$headers = 'From: NHS Organizer <NHS@database.com>' . PHP_EOL .
    'Reply-To: NHS <NHS@database.com>' . PHP_EOL .
    'X-Mailer: PHP/' . phpversion() . "Content-type: text/html";
	
mail($to, $subject, $message, $headers);
echo "<br>email to chapman has been sent";
			
} 
}
			
				
	
	
	
	
	

		
?>
		
		