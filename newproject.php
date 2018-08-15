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





//When the person submits the form
if(isset($_POST) & !empty($_POST)){
	$project_name = mysqli_real_escape_string($connection, $_POST["project_name"]);
	$student_rep = mysqli_real_escape_string($connection, $_POST["student_rep"]);
	$teacher_name = mysqli_real_escape_string($connection, $_POST["teacher_name"]);
	$teacher_contact = mysqli_real_escape_string($connection, $_POST["teacher_contact"]);
	$project_description = mysqli_real_escape_string($connection, $_POST["project_description"]);
	$datetime_start = mysqli_real_escape_string($connection, $_POST["datetime_start"]);
	$datetime_end = mysqli_real_escape_string($connection, $_POST["datetime_end"]);
	$status = mysqli_real_escape_string($connection, $_POST["status"]);
	$affiliated_group = mysqli_real_escape_string($connection, $_POST["affiliated_group"]);
	

	if ($request_id == ""){
		$request_id = '0';
	}

	if ($date_end == ""){
		$date_end = 'Ongoing';
	}

	if ($status == ""){
		$status = 'Incomplete';
	}


	$sql = "INSERT INTO project_list (project_name, student_rep, teacher_name, teacher_contact, datetime_start, datetime_end, status, affiliated_group, entered_by, project_description) VALUES ('$project_name', '$student_rep', '$teacher_name', '$teacher_contact' , '$datetime_start' , '$datetime_end', '$status', '$affiliated_group', '$id', '$project_description');";

	echo $sql;

		$result = mysqli_query($connection, $sql);
		if ($result) {
			$smsg = "Entry successfully added";


		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			$fmsg .= "Entry failed to be added";
		}




}




?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">




<title>Submit a new project</title>
	
</head>

<body>

<a href="hub.php">back to hub</a>
	<div class="movedown">
	<div class="student-specify">
	<div class="">
		<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
		<form class="" method = "POST">
			<h2 class= "">Enter the new project</h2>
			<br>

			<label for="">Name of Project</label>
			<br>
			<input type="text" name="project_name" class="form-control" placeholder="Name of Project" required>

			<br>
			<label for="">Name of Student Representative for this</label>
			<br>
			<input type="text" name="student_rep" id="" class= "form-control" placeholder = "ID of Student Rep" required >
			
			<br>
			
			<br>
			<label for="">Name of Responsible Teacher</label> 
			<br>
			<input type="text" name="teacher_name" id="" class= "form-control" placeholder = "ie. Darren Jones" required >
			<br>
			<label for="">Email of Responsible Teacher</label> 
			<br>
			<input type="email" name="teacher_contact" id="" class= "form-control" placeholder = "" required >
			
			<br>
			<br>
			<br>
			<div class="form-group">
    			<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="project_description" placeholder = "A Detailed Description" required></textarea>
  			</div>
			<br>
			<label for="">Enter in the Start date</label>
			<br>
			<input type="datetime-local" name="datetime_start" id="" class= "form-control" placeholder = "Start Date" required>
			<br>
			<label for="">Enter in the end date (if completed)</label>
			<br>
			<input type="datetime-local" name="datetime_end" id="" class= "form-control" placeholder = "End Date" >

			<br>
			
			
			<label for="">Affiliated Group</label>
			<br>
			<input type="text" name="affiliated_group" id="" class= "form-control" placeholder = "i.e SMS, NHS, SNHS" >

			<br>
			
			<label for="">Status?</label>
			<br>
			<select name="status" id="">
				<option value="completed">completed</option>
				<option value="ongoing">ongoing</option>
			</select>



			<br>


			<button class="" type="submit">submit</button>


		</form>


	</div>
</div>
</div>