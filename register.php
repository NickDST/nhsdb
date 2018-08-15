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
			$fmsg .= "Username Already Exists! ";
		}

		$emailsql = "SELECT * FROM `login` WHERE contact = '$email'";
		$emailsqlres = mysqli_query($connection, $emailsql);
		$count = mysqli_num_rows($emailsqlres);

		if ($count == 1) {
			$fmsg .= "Email Already Exists! ";
		}

		$sql = "INSERT INTO login (username, contact, password, studentid) VALUES ('$username', '$email', '$password', '$studentid');";
		
		echo $sql;

		$result = mysqli_query($connection, $sql);
		if ($result) {
			$smsg = "User Registration Successful";
			

		} else {
			$fmsg .= "User Registration Failed";
		}
	} else {
		$fmsg = "Password Does Not Match";
	}


}
 ?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>
<body>
	
	<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert" style = "margin-top: 100px;"> <?php echo $smsg; ?> </div><?php } ?>
    <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert" style = "margin-top: 100px;"> <?php echo $fmsg; ?> </div><?php } ?>
	
<div class="login-page">
  <div class="form" >
    <form class="login-form" method = "POST">
      <input type="text" name="username" class="form-control" placeholder="Username" required/>
      <input type="password" name="password" id="input Password" class= "form-control" placeholder = "Password" required/>
      <input type="email" name="email" id="inputEmail" class= "form-control" placeholder = "Email address"  required />
		<input type="text" name="studentid" class= "form-control" placeholder = "Student ID" required/>
		
	<input type="password" name="passwordAgain" id="input Password" class= "form-control" placeholder = "Password Again" required>
      <button>create</button>
	  
      <p class="message">Already registered? <a href="login.php">Sign In</a></p>
    </form>
		</div>
	
</div>
</html>