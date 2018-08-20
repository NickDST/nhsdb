<?php 


	require_once('includes/dbh.inc.php');


	//print_r($_POST);
	if(isset($_POST) & !empty($_POST)){
	$username = mysqli_real_escape_string($connection, $_POST["username"]);
	$email = mysqli_real_escape_string($connection, $_POST["email"]);
	$studentid = mysqli_real_escape_string($connection, $_POST["studentid"]);
	$password = md5($_POST["password"]);
	$passwordAgain = md5($_POST["passwordAgain"]);

	if($password == $passwordAgain){
		

		$usernamesql = "SELECT * FROM `login` WHERE username = '$username'";
		$usernameres = mysqli_query($connection, $usernamesql);
		$count = mysqli_num_rows($usernameres);
		if ($count == 1) {
			$fmsg = "Username Already Exists! ";
			$error = "true";
			
		} 

		$emailsql = "SELECT * FROM `login` WHERE contact = '$email'";
		$emailsqlres = mysqli_query($connection, $emailsql);
		$count = mysqli_num_rows($emailsqlres);

		if ($count == 1) {
			$fmsg = "Email Already Exists! ";
			$error = "true";
			
		}
		
		$studentidsql = "SELECT * FROM `login` WHERE studentid = '$studentid'";
		$studentidsqlres = mysqli_query($connection, $studentidsql);
		$count = mysqli_num_rows($studentidsqlres);

		if ($count == 1) {
			$fmsg .= "Student ID Already Exists";
			$error = "true";
			
		}
		
			$studentidsql = "SELECT * FROM `students` WHERE studentid = '$studentid'";
		$studentidsqlres = mysqli_query($connection, $studentidsql);
		$count = mysqli_num_rows($studentidsqlres);

		if ($count == 1) {
			$csmsg .= "Connection established to a student account!";
			$studentexists = "true";
			
		}
		
		if ($error != "true" and $studentexists = "true") {

		$sql = "INSERT INTO login (username, contact, password, studentid) VALUES ('$username', '$email', '$password', '$studentid');";
		
		//echo $sql;
			
		

		$result = mysqli_query($connection, $sql);
		if ($result) {
			$smsg = "User Registration Successful";
			

		} else {
			$fmsg = "User Registration Failed <br><br> Make sure you are already checked inside the database!";
			

		} }
		
		
		
	} else {
		$fmsg = "Password Does Not Match";
	}


}
		

 ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel="stylesheet" href="css/loginstyle.css">
	
	

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>
<body>
	
	<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert" style = "margin-top: 20px;"> <?php echo $smsg; ?> </div><?php } ?>
	
		<?php if(isset($csmsg)){ ?><div class="alert alert-success" role="alert" style = "margin-top: 20px;"> <?php echo $csmsg; ?> </div><?php } ?>
	
    <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert" style = "margin-top: 20px;"> <?php echo $fmsg; ?> </div><?php } ?>
	

	
		 

	 <div class="login-container">
  <section class="login" id="login">
	

    <form class="login-form" action="#" method="post">
      <input type="text" name="username" class="login-input" placeholder="Username" maxlength="100" required/>
      <input type="password" name="password" id="input Password" class= "login-input" placeholder = "Password" maxlength="100" required/>
      <input type="email" name="email" id="inputEmail" class= "login-input" placeholder = "Email address" maxlength="100"  required />
		<input type="text" name="studentid" class= "login-input" placeholder = "Student ID" maxlength="100" required/>
		
	<input type="password" name="passwordAgain" id="input Password" class= "login-input" maxlength="100" placeholder = "Password Again" required>
      <button class = "btn btn-success">create</button>
		
		  </form>
  </section>
	</div>	
		
	  
      <p class="message">Already registered? <a href="login.php">Sign In</a></p>
  
		
	 <script  src="js/loginindex.js"></script>

</html>