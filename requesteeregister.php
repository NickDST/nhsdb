<?php

//linking to the file that establishes the connection to the database, in the includes folder
require_once( 'includes/dbh.inc.php' );


//if there is a POST then this statement activates to submit the registered student info
if ( isset( $_POST ) & !empty( $_POST ) ) {
	$username = mysqli_real_escape_string( $connection, $_POST[ "username" ] );
	$email = mysqli_real_escape_string( $connection, $_POST[ "email" ] );
	$parent_or_student = mysqli_real_escape_string( $connection, $_POST[ "parent_or_student" ] );
	$full_name = mysqli_real_escape_string( $connection, $_POST[ "full_name" ] );
	$password = md5( $_POST[ "password" ] );
	$passwordAgain = md5( $_POST[ "passwordAgain" ] );

//first checkking if the password is the same as the password again.	
	if ( $password == $passwordAgain ) {

//Checking if the username already exists
		$usernamesql = "SELECT * FROM `requestlogin` WHERE username = '$username'";
		$usernameres = mysqli_query( $connection, $usernamesql );
		$count = mysqli_num_rows( $usernameres );
		if ( $count == 1 ) {
			$fmsg = "Username Already Exists! ";
			$error = "true";

		}
//checking if the email already exists
		$emailsql = "SELECT * FROM `requestlogin` WHERE contact = '$email'";
		$emailsqlres = mysqli_query( $connection, $emailsql );
		$count = mysqli_num_rows( $emailsqlres );

		if ( $count == 1 ) {
			$fmsg = "Email Already Exists! ";
			$error = "true";

		}





//if any of the errors above, $error will be set to true. If no erros above then it will not be true and thus
//the statement continues
		if ( $error != "true" ) {

			$sql = "INSERT INTO requestlogin (username, contact, full_name, password, parent_or_student) VALUES ('$username', '$email', '$full_name', '$password', '$parent_or_student');";

			//echo $sql;



			$result = mysqli_query( $connection, $sql );
			if ( $result ) {
				$smsg = "User Registration Successful";


			} else {
				$fmsg = "User Registration Failed <br><br> Make sure you are already checked inside the database!";


			}
		}



	} else {
		$fmsg = "Password Does Not Match";
	}


}


?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

<link rel="stylesheet" href="css/loginstyle2.css">



<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Register the User!</title>
</head>

<body>

<!--These are the success and error messages	-->
	<?php if(isset($smsg)){ ?>
	<div class="alert alert-success" role="alert" style="margin-top: 20px;">
		<?php echo $smsg; ?> </div>
	<?php } ?>

	<?php if(isset($csmsg)){ ?>
	<div class="alert alert-success" role="alert" style="margin-top: 20px;">
		<?php echo $csmsg; ?> </div>
	<?php } ?>

	<?php if(isset($fmsg)){ ?>
	<div class="alert alert-danger" role="alert" style="margin-top: 20px;">
		<?php echo $fmsg; ?> </div>
	<?php } ?>




<!--This is the HTML for the form-->
	<div class="login-container">
		<section class="login" id="login">


			<form class="login-form" action="#" method="post">
				<input type="text" name="username" class="login-input" placeholder="Username" maxlength="100" required/>

				<input type="text" name="real_name" class="login-input" placeholder="Full Name" maxlength="100" required/>
				<input type="password" name="password" id="input Password" class="login-input" placeholder="Password" maxlength="100" required/>
				<input type="email" name="email" id="inputEmail" class="login-input" placeholder="Email address" maxlength="100" required/>
				<!-- <input type="text" name="studentid" class="login-input" placeholder="Student ID" maxlength="100" required/> -->


				<input type="password" name="passwordAgain" id="input Password" class="login-input" maxlength="100" placeholder="Password Again" required>


				<select class="login-input" name="parent_or_student">
					<option>Are you a parent or student</option>
					<option value="student">Student</option>
					<option value="parent">Parent</option>
				</select>

				<button class="btn btn-success">create</button>



			</form>
		</section>
	</div>


	<p class="message">Already registered? <a href="requestlogin.php">Sign In</a>
	</p>


	<script src="js/loginindex.js"></script>

</html>