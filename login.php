<?php

	session_start();

	require_once('includes/dbh.inc.php');
	if(isset($_POST) & !empty($_POST)){
		$username = mysqli_real_escape_string($connection, $_POST['username']);
		$studentid = mysqli_real_escape_string($connection, $_POST['studentid']);
		$password = md5($_POST['password']);

	$sql = "SELECT * FROM `login` WHERE username = '$username' AND studentid='$studentid' AND password = '$password';";
		$result = mysqli_query($connection, $sql);
		$count = mysqli_num_rows($result);
		if ($count == 1) {
			
			$_SESSION['studentid']=$studentid;
			echo $_SESSION['studentid'];
			
			echo '<script>window.location.href = "hub.php";</script>';	

	
		} else  {
			echo "Invalid Username/Password";
			
		}
		
		
	}
				
if (isset($_SESSION['studentid'])) {
	echo "logged in as ".$_SESSION['studentid'];
}			
	
 ?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
</head>

<body>
	
	  <div class="form">
    <form class="login-form" method = "POST">
      <input type="text" name="username" class="form-control" placeholder="Username" required/>
      <input type="password" name="password" id="input Password" class= "form-control" placeholder = "password" required/>
	  <input type="text" name="studentid" id="" class= "form-control" placeholder = "student id" required/>
      <button>login</button>
      <p class="message">Not registered? <a href="register.php">Create an account</a></p>
	
    </form>
		<br>
		<a href="logout.php"><button>logout</button></a>
		
 	 </div>
	<br>
	<a href="hub.php">hub</a>	
	<a href="test.php">test</a>
	<a href="index.php">back</a>	 
	 
<?php 
  
  ?>
</body>
	
	
	
	
</html>