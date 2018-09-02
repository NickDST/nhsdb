<?php
include 'adminhubheader.php';

require_once('includes/dbh.inc.php');  


?>

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


<form method="get">
Type in the Project ID: <input type="text" name="updateid" class="form-control" required><br>
<br>	
<button class="btn btn-secondary" type="submit">submit</button>
</form>

<?php
if (isset($_GET['updateid'])) {
$updateid = mysqli_real_escape_string($connection, $_GET['updateid']);
	
$sql2 = "SELECT * FROM project_list WHERE projectid= $updateid";
		$result2 = mysqli_query($connection, $sql2);
		$count2 = mysqli_num_rows($result2);
}
				
				
?>
<hr>	
<?php

if ($count2 == 1) {		?>
<div>
<h1>Current Project Info:</h1>
<br>
<?php
	$projectid = mysqli_real_escape_string($connection, $_GET["updateid"]);	
//Establishing a connection to the Projects Table
$result = $connection->query 
        ("SELECT * FROM project_list WHERE projectid = '$projectid'") 
        or die($connection->error); ?>
	
<?php while ($Projects = $result->fetch_assoc()): ?> 
	<div class=''>

            <h2><?= $Projects['project_name'] ?></h2>
            <span class=''> Project ID: ( <?= $Projects['projectid'] ?> )</span>
		<br>
		<br>
			<h4>Start Date:</h4> <span><?= $Projects['datetime_start'] ?></span>
		<br>
		<br>
			<h4>End Date:</h4><span> <?= $Projects['datetime_end'] ?></span>
		<br>
			<p>Description: <?= $Projects['project_description'] ?></p>
		<br>
		<br>
			<h3> Students involved : </h3>
		

				<?php
				/*Selecting service hours and a project id from students_in_projects with currently looping student ID*/
				$studentidsql = "SELECT studentid, service_hours, role FROM students_in_projects WHERE projectid = {$Projects['projectid']}";
				$result3 = mysqli_query( $connection, $studentidsql );
				
				while ( $studentid = $result3->fetch_assoc() ):
					$studentnamesql = "SELECT name FROM students WHERE studentid = {$studentid['studentid']}";
				
					/*While a project ID is being fetched, a name is fetched */
					$studentnameresult = mysqli_query( $connection, $studentnamesql );
					while ( $studentname2 = $studentnameresult->fetch_assoc() ):
							echo $studentname2[ 'name' ];
					endwhile;?> |
				
				<!--display service hour after the name has been looped for that project-->
				
				<?php echo $studentid['service_hours'];?> hours - 
				<?php echo nl2br($studentid['role']."\r\n");?> 
				<!-- End While for project ID -->
				<?php endwhile; ?>		
		<!--End initial while loop-->
		<?php endwhile; ?> 
		</div>
</div>
<br>
<div>
<hr>
	<h4 style = "text-align:center;"> Make Changes to this Project </h4>
<form method="post">
	<input type="text" name="name" class="form-control" placeholder="Change Name of Project" maxlength = 200>	
	<br>	
	<input type="text" name="requestee" class="form-control" placeholder="change requestee" maxlength = 200 >
	<br>	
	<input type="text" name="requestee_email" class="form-control" placeholder="Change requestee email" maxlength = 200 >
	<br>	
	<input type="date" name="date_start" class="form-control" placeholder="Change Start Date" >	
	<br>
	<input type="date" name="date_end" class="form-control" placeholder="Change End Date" >	
	<br>	
	<input type="text" name="status" class="form-control" placeholder="Change Status" maxlength = 200 >
	<br>	
	<input type="text" name="description" class="form-control" placeholder="Description" maxlength = 500 >

	<br>
	<button class="btn btn-secondary" type="submit">Make Changes to Project</button>
	<br>
	
	
</form>
	
	

<?php	
if(isset($_POST) & !empty($_POST)){

$updateid = mysqli_real_escape_string($connection, $_GET["updateid"]);
$name = mysqli_real_escape_string($connection, $_POST["name"]);
$requestee = mysqli_real_escape_string($connection, $_POST["requestee"]);
$requestee_email = mysqli_real_escape_string($connection, $_POST["requestee_email"]);
$date_start = mysqli_real_escape_string($connection, $_POST["date_start"]);
$date_end = mysqli_real_escape_string($connection, $_POST["date_end"]);
$status = mysqli_real_escape_string($connection, $_POST["status"]);
$description = mysqli_real_escape_string($connection, $_POST["description"]);
	
//Generating the SQL statement to pass in as a string

//Trying to piece together the string based on whether or not a variable is entered

//If a name is entered, alter the name
	if (!empty($name)) { 
		$sqlName = "project_name = "."'".$name."',";
		} else {
		$sqlName = "";}
	//echo $sqlName;
	
//If a request ID is entered, update the request ID
	if (!empty($requestee)) { 
		$sqlrequestee = "requestee = "."'".$requestee."',";
		} else {
		$sqlrequestee = "";}
	//echo $sqlrequest_id;

	
//If a student ID is entered, update the student ID
	if (!empty($requestee_email)) { 
		$sqlrequestee_email = "requestee_email = "."'".$requestee_email."',";
		} else {
		$sqlrequestee_email = "";}
	//echo $sqlstudent_request_id;


//If a start date is entered, update the start date
	if (!empty($date_start)) { 
		$sqldate_start = "datetime_start = "."'".$date_start."',";
		} else {
		$sqldate_start = "";}
	//echo $sqldate_start;
	
	
//If an end date is entered, update the end date
	if (!empty($date_end)) { 
		$sqldate_end = "datetime_end = "."'".$date_end."',";
		} else {
		$sqldate_end = "";}
	//echo $sqldate_end;
	
	
//If a status is entered, update the status
	if (!empty($status)) { 
		$sqlstatus = "status = "."'".$status."',";
		} else {
		$sqlstatus = "";}
	//echo $sqlstatus;
	
	
//If a review is entered, update the review
	if (!empty($description)) { 
		$sqldescription = "project_description = "."'".$description."',";
		} else {
		$sqldescription = "";}
	//echo $sqlreq_satisfaction;

$sqlend = "end = '1' ";
	
//Actual String	
$sql = "UPDATE project_list 
		SET $sqlName $sqlrequestee $sqlrequestee_email $sqldate_start $sqldate_end $sqlstatus $sqldescription $sqlend
		
		WHERE projectid = '$updateid'";

$result = mysqli_query($connection, $sql);
		if ($result) {
			$smsg=  "Entry successfully added";
			//echo '<script>window.location.href = "adminmodifyproject.php?success=Success!";</script>';	
			

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			$fmsg =  "Entry failed to be added";
			//echo '<script>window.location.href = "adminmodifyproject.php?error=Something went wrong!";</script>';	
			//echo $sql;
		}
//Ending the if statement if the Post has been submitted	
}	
//Ending bracket of the inner form
?>
<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert" style = "margin-top: 100px;"> <?php echo $smsg; ?> </div><?php } ?>
	<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert" style = "margin-top: 100px;"> <?php echo $fmsg; ?> </div><?php } ?>
</div>
<hr>

<div>
<h4 style = "text-align:center;"> Add a student to this project </h4>
<form method="post">
	<input type="number" name="student_id" class="form-control" placeholder="Student ID" required >	
	<br>	
	<input type="number" name="service_hours" class="form-control" placeholder="Number of Service Hours" required>
	<br>
	<input type="text" name="role" class="form-control" placeholder="Role" required maxlength = 200>
	<br>
	<button class="btn btn-success" name='add' type="submit" value='add'>Add the student</button>
</form>

<!--Adding a student to the project-->
<?php
	
if(isset($_POST['add'])=='add' & !empty($_POST['add'])){
	$project_id = mysqli_real_escape_string($connection, $_GET["updateid"]);
	$student_id = mysqli_real_escape_string($connection, $_POST["student_id"]);
	$service_hours = mysqli_real_escape_string($connection, $_POST["service_hours"]);
	$role = mysqli_real_escape_string($connection, $_POST["role"]);
	
	
$addstudentsql = "INSERT INTO students_in_projects (projectid, studentid, service_hours, role) VALUES ('$project_id', '$student_id', '$service_hours' , '$role');";
	


		$addstudentresult = mysqli_query($connection, $addstudentsql);
		if ($addstudentresult) {
			echo "Entry successfully added";
			//echo '<script>window.location.href = "adminmodifyproject.php?success=successfully added!";</script>';	
			
			

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Entry failed to be added";
			
		}
	
}?>
</div> 
<hr>
	
<div>
<h4 style = "text-align:center;"> Remove a student from this project </h4>
<form name = 'delete' method="post">
	<input type="INT" name="student_id" class="form-control" placeholder="student ID" >	
	<br>
	<button class="btn btn-danger" name = 'delete' type="submit" value="delete">Remove this Student</button>
</form>

<!--Remove a student to the project-->
<?php
	
if(isset($_POST['delete'])=='delete' & !empty($_POST['delete'])){
	$project_id = mysqli_real_escape_string($connection, $_GET["updateid"]);
	$student_id = mysqli_real_escape_string($connection, $_POST["student_id"]);
	
	
$removestudentsql = "DELETE FROM students_in_projects WHERE studentid = $student_id AND projectid = $project_id
;";
	


		$removestudentsresult = mysqli_query($connection, $removestudentsql);
		if ($removestudentsresult) {
			echo "Entry successfully Removed";
			//echo '<script>window.location.href = "adminmodifyproject.php?success=Successfully Removed!";</script>';	
			

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Entry failed to be removed";
		}
	
}?>
	
</div> 	
	
<div style = "margin-bottom:60px;" >
	<hr>
	<br>
	<h2>Permanently Delete This Project</h2>
	<br>
	<div class="alert alert-danger" role="alert">
  WARNING: This will erase all records of this project.
</div>
	<br>
	<form name = 'fulldelete' method="post">
	<button class="btn btn-danger btn-lg" name = 'fulldelete' type="submit" value="fulldelete">DELETE THIS PROJECT</button>
</form>
	<?php
	
if(isset($_POST['fulldelete'])=='fulldelete' & !empty($_POST['fulldelete'])){
	$project_id = mysqli_real_escape_string($connection, $_GET["updateid"]);
	
$deletepeopleprojectsql = "DELETE FROM students_in_projects WHERE projectid = $project_id
;";
$deleteprojectsql = "DELETE FROM Projects WHERE projectid = $project_id
;";
	
		$removestudentprojectresult = mysqli_query($connection, $deleteprojectsql);
		$removeprojectresult = mysqli_query($connection, $deleteprojectsql);
		if ($removeprojectresult && $removestudentprojectresult) {
			echo "Entry successfully Removed";
			//echo '<script>window.location.href = "adminmodifyproject.php?success=Successfully Removed!";</script>';	
			

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Entry failed to be removed";
		}
	
}?>
	
</div>	
								<br>
	
	
<!--Largest close bracket-->
<?php } else { $fmsg = "Project does not exist";	?>
	
	<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert" style = "margin-top: 100px;"> <?php echo $fmsg; ?> </div><?php } ?> <?php
}
	?>	
	
	
	</div>
	</div>
</div>
					</div>
				</div>
	 </div>
	
	
</body>
</html>