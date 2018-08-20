<?php include 'hubheader.php';?>
<?php

//echo $id;
//Checking whether this student is in NHS
$NHSchecksql = "SELECT students_in_societies.*, students.* from students, students_in_societies WHERE students.studentid = students_in_societies.studentid AND students_in_societies.honor_society = 'NHS' AND students.studentid = '$id'";

$result = mysqli_query( $connection, $NHSchecksql );


	$resultCheck = mysqli_num_rows( $result );
		if ( $resultCheck > 0 ) {
			$in_NHS = "true";
			
		} 


//Checking whether or not this student is in SNHS
$SNHSchecksql = "SELECT students_in_societies.*, students.* from students, students_in_societies WHERE students.studentid = students_in_societies.studentid AND students_in_societies.honor_society = 'SNHS' AND students.studentid = '$id'";

$SNHSresult = mysqli_query( $connection, $SNHSchecksql );


	$SNHSresultCheck = mysqli_num_rows( $SNHSresult );
		if ( $SNHSresultCheck > 0 ) {
			$in_SNHS = "true";
			
		} 


//echo $in_SNHS;
//echo $in_NHS;

?>



<div class="content">
            <div class="container-fluid">
                <div class="row">
					
                    <div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Change Logged Honor Society</h4>
                                <p class="category">Select the Honor Society you want to be logged in as</p>
                            </div>
                            <div class = "" style= "padding-left:15px; padding-bottom:15px;">
								
								<form method="POST">
									<select name="logged_honor_society" id="">
										
										<?php
										if($in_NHS == "true") {
											echo "<option value='NHS'>NHS</option>";
										}
										
										?>
										
										<?php
										
										if($in_SNHS == "true") {
											echo "<option value='SNHS'>SNHS</option>";
										}
										
										?>
<!--										  <option value="NHS">NHS</option>-->
<!--										  <option value="SNHS">SNHS</option>-->

										 
									</select>
									<br>
									<br>
								 <button type="submit" name = "change_society" class = "btn btn">Set my logged in society as this</button>
								
								</form>
				
                           
                            </div>
                        </div>
                    </div>

      			</div>
         </div>
    
<?php
	if(isset($_POST['change_society']) & !empty(isset($_POST['change_society']))){		
			$logged_honor_society = $_POST["logged_honor_society"];	
		
			$changehonorsql = "UPDATE students SET logged_honor_society='$logged_honor_society' WHERE studentid = '$id'";
			$changehonorresult = mysqli_query( $connection, $changehonorsql );	
		
		if ($changehonorresult) {
			echo "everything worked successfully";

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Entry failed to be absidlkfj";
		}
				
	
	
	}
	
	
	
	
?>




            <div class="container-fluid">
                <div class="row">
					
                    <div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Change Tutoring Fields</h4>
                                <p class="category">Select what fields you are willing to tutor</p>
                            </div>
                            <div class = "" style= "padding-left:15px;">
								
								<br>
               		
								<form method="POST">
									<h3>Select the fields you are willing to tutor in</h3>
									  <input type="checkbox" name="Biology" value="Biology">Biology<br>
  									  <input type="checkbox" name="Chemistry" value="Chemistry">Chemistry<br>
									  <input type="checkbox" name="Physics" value="Physics">Physics<br>
  									  <input type="checkbox" name="English" value="English">English<br>
									  <input type="checkbox" name="Writing" value="Writing">Writing<br>
  									  <input type="checkbox" name="Worldhistory" value="World History">World History<br>	
									  <input type="checkbox" name="Reading" value="Reading">Reading<br>
  									  <input type="checkbox" name="Precalculus" value="Precalculus">Precalculus<br>
									
									  <input type="checkbox" name="alg2" value="Algebra 2">Algebra 2<br>
  									  <input type="checkbox" name="geo" value="Geometry or Lower" required>Geometry or Lower<b></b><br><br>
									  <button type="submit" name = "updatefields" class = "btn btn">Update My Tutoring Fields</button>
									  
									
									
									

								</form>
								
								<br>
								
<?php 
if(isset($_POST['updatefields']) & !empty(isset($_POST['updatefields']))){			

	
	$deletefields = "DELETE FROM students_in_subjects WHERE studentid = '$id'";
	$deleteresult = mysqli_query( $connection, $deletefields );	
		if ($deleteresult) {
			echo "everything deleted successfully";

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Entry failed to be DELETED";
		}
				
		
	
	
	
//Precalculus
	if (isset($_POST["Precalculus"])){;
			$field = $_POST["Precalculus"];						  
								  
			$updatefieldsql = "SELECT * FROM students_in_subjects WHERE studentid = '$id' AND subject = '$field'";
				$updatesql = mysqli_query( $connection, $updatefieldsql );

				$updateCheck = mysqli_num_rows($updatesql);

				if ($updateCheck > 0) {
					echo "Already in $field"; 
					
				} else {
						$sql = "INSERT INTO students_in_subjects (studentid, subject) VALUES ('$id', '$field');";
					echo $sql;

						$result = mysqli_query($connection, $sql);
		if ($result) {
			echo "$field successfully added";

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Entry failed to be added";
		}
				
		}
	
}
//Precalculus	
	

//Writing
	if (isset($_POST["Writing"])){;
			$field = $_POST["Writing"];						  
								  
			$updatefieldsql = "SELECT * FROM students_in_subjects WHERE studentid = '$id' AND subject = '$field'";
				$updatesql = mysqli_query( $connection, $updatefieldsql );

				$updateCheck = mysqli_num_rows($updatesql);

				if ($updateCheck > 0) {
					echo "Already in $field"; 
					
				} else {
						$sql = "INSERT INTO students_in_subjects (studentid, subject) VALUES ('$id', '$field');";
					echo $sql;

						$result = mysqli_query($connection, $sql);
		if ($result) {
			echo "$field successfully added";

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Entry failed to be added";
		}
				
		}
	
}
//Writing		
	
//Biology
	if (isset($_POST["Biology"])){;
			$field = $_POST["Biology"];						  
								  
			$updatefieldsql = "SELECT * FROM students_in_subjects WHERE studentid = '$id' AND subject = '$field'";
				$updatesql = mysqli_query( $connection, $updatefieldsql );

				$updateCheck = mysqli_num_rows($updatesql);

				if ($updateCheck > 0) {
					echo "Already in $field"; 
					
				} else {
						$sql = "INSERT INTO students_in_subjects (studentid, subject) VALUES ('$id', '$field');";
					echo $sql;

						$result = mysqli_query($connection, $sql);
		if ($result) {
			echo "$field successfully added";

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Entry failed to be added";
		}
				
		}
	
}
//Biology		

	
//Geo or lower
	if (isset($_POST["geo"])){;
			$field = $_POST["geo"];						  
								  
			$updatefieldsql = "SELECT * FROM students_in_subjects WHERE studentid = '$id' AND subject = '$field'";
				$updatesql = mysqli_query( $connection, $updatefieldsql );

				$updateCheck = mysqli_num_rows($updatesql);

				if ($updateCheck > 0) {
					echo "Already in $field"; 
					
				} else {
						$sql = "INSERT INTO students_in_subjects (studentid, subject) VALUES ('$id', '$field');";
					echo $sql;

						$result = mysqli_query($connection, $sql);
		if ($result) {
			echo "$field successfully added";

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Entry failed to be added";
		}
				
		}
	
}
//geo or lower	
	
	
//Chemistry
	if (isset($_POST["Chemistry"])){;
			$field = $_POST["Chemistry"];						  
								  
			$updatefieldsql = "SELECT * FROM students_in_subjects WHERE studentid = '$id' AND subject = '$field'";
				$updatesql = mysqli_query( $connection, $updatefieldsql );

				$updateCheck = mysqli_num_rows($updatesql);

				if ($updateCheck > 0) {
					echo "Already in $field"; 
					
				} else {
						$sql = "INSERT INTO students_in_subjects (studentid, subject) VALUES ('$id', '$field');";
					echo $sql;

						$result = mysqli_query($connection, $sql);
		if ($result) {
			echo "$field successfully added";

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Entry failed to be added";
		}
				
		}
	
}
//Chemistry		
	
	
//Physics
	if (isset($_POST["Physics"])){;
			$field = $_POST["Physics"];						  
								  
			$updatefieldsql = "SELECT * FROM students_in_subjects WHERE studentid = '$id' AND subject = '$field'";
				$updatesql = mysqli_query( $connection, $updatefieldsql );

				$updateCheck = mysqli_num_rows($updatesql);

				if ($updateCheck > 0) {
					echo "Already in $field"; 
					
				} else {
						$sql = "INSERT INTO students_in_subjects (studentid, subject) VALUES ('$id', '$field');";
					echo $sql;

						$result = mysqli_query($connection, $sql);
		if ($result) {
			echo "$field successfully added";

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Entry failed to be added";
		}
				
		}
	
}
//Physics		
	
//English
	if (isset($_POST["English"])){;
			$field = $_POST["English"];						  
								  
			$updatefieldsql = "SELECT * FROM students_in_subjects WHERE studentid = '$id' AND subject = '$field'";
				$updatesql = mysqli_query( $connection, $updatefieldsql );

				$updateCheck = mysqli_num_rows($updatesql);

				if ($updateCheck > 0) {
					echo "Already in $field"; 
					
				} else {
						$sql = "INSERT INTO students_in_subjects (studentid, subject) VALUES ('$id', '$field');";
					echo $sql;

						$result = mysqli_query($connection, $sql);
		if ($result) {
			echo "$field successfully added";

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Entry failed to be added";
		}
				
		}
	
}
//English		
	
//worldhistory
	if (isset($_POST["Worldhistory"])){;
			$field = $_POST["Worldhistory"];						  
								  
			$updatefieldsql = "SELECT * FROM students_in_subjects WHERE studentid = '$id' AND subject = '$field'";
				$updatesql = mysqli_query( $connection, $updatefieldsql );

				$updateCheck = mysqli_num_rows($updatesql);

				if ($updateCheck > 0) {
					echo "Already in $field"; 
					
				} else {
						$sql = "INSERT INTO students_in_subjects (studentid, subject) VALUES ('$id', '$field');";
					echo $sql;

						$result = mysqli_query($connection, $sql);
		if ($result) {
			echo "$field successfully added";

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Entry failed to be added";
		}
				
		}
	
}
//World History		
	
//Reading
	if (isset($_POST["Reading"])){;
			$field = $_POST["Reading"];						  
								  
			$updatefieldsql = "SELECT * FROM students_in_subjects WHERE studentid = '$id' AND subject = '$field'";
				$updatesql = mysqli_query( $connection, $updatefieldsql );

				$updateCheck = mysqli_num_rows($updatesql);

				if ($updateCheck > 0) {
					echo "Already in $field"; 
					
				} else {
						$sql = "INSERT INTO students_in_subjects (studentid, subject) VALUES ('$id', '$field');";
					echo $sql;

						$result = mysqli_query($connection, $sql);
		if ($result) {
			echo "$field successfully added";

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Entry failed to be added";
		}
				
		}
	
}
//Reading	
	
//algebra 2
	if (isset($_POST["alg2"])){;
			$field = $_POST["alg2"];						  
								  
			$updatefieldsql = "SELECT * FROM students_in_subjects WHERE studentid = '$id' AND subject = '$field'";
				$updatesql = mysqli_query( $connection, $updatefieldsql );

				$updateCheck = mysqli_num_rows($updatesql);

				if ($updateCheck > 0) {
					echo "Already in $field"; 
					
				} else {
						$sql = "INSERT INTO students_in_subjects (studentid, subject) VALUES ('$id', '$field');";
					echo $sql;

						$result = mysqli_query($connection, $sql);
		if ($result) {
			echo "$field successfully added";

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Entry failed to be added";
		}
				
		}
	
}
//algebra 2		
	

	
	
	
}
?>								
								
								

                           
                            </div>
                        </div>
                    </div>

      			</div>
       </div>
	
           <div class="container-fluid">
                <div class="row">
					
                    <div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Change Sidebar Color</h4>
                                <p class="category">Nick actually programmed this feature in. Appreciate it.</p>
                            </div>
                            <div class = "" style= "padding-left:15px; padding-bottom:15px;">
								
								<form method="POST">
									<select name="sidecolor" id="">
										  <option value="blue">Blue</option>
										  <option value="black">Black</option>
										  <option value="green">Green</option>
										  <option value="red">Red</option>
										  <option value="orange">Orange</option>
										  <option value="purple">Purple</option>

										 
									</select>
									<br>
									<br>
								 <button type="submit" name = "changecolor" class = "btn btn">Set this as my sidebar color</button>
								
								</form>
				
                           
                            </div>
                        </div>
                    </div>

      			</div>
         </div>
    
<?php
	if(isset($_POST['changecolor']) & !empty(isset($_POST['changecolor']))){		
			$sidecolor = $_POST["sidecolor"];	
		
			$changecolorsql = "UPDATE students SET sidecolor='$sidecolor' WHERE studentid = '$id'";
		
			$changecolorresult = mysqli_query( $connection, $changecolorsql );	
		
		if ($changecolorresult) {
			//echo "everything worked successfully";
			echo '<script>window.location.href = "changeaccountinfo.php";</script>';		

		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "Entry failed to be absidlkfj";
		}
				
	
	
	}
	
	
	
	
?>	
	
	
	
	
    </div>



