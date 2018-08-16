<?php

session_start();

require_once( 'includes/dbh.inc.php' );
if ( isset( $_POST ) & !empty( $_POST ) ) {
	$username = mysqli_real_escape_string( $connection, $_POST[ 'username' ] );
	$studentid = mysqli_real_escape_string( $connection, $_POST[ 'studentid' ] );
	$password = md5( $_POST[ 'password' ] );

	$sql = "SELECT * FROM `login` WHERE username = '$username' AND studentid='$studentid' AND password = '$password';";
	$result = mysqli_query( $connection, $sql );
	$count = mysqli_num_rows( $result );
	if ( $count == 1 ) {

		$_SESSION[ 'studentid' ] = $studentid;
		echo $_SESSION[ 'studentid' ];


	} else {
		echo "Invalid Username/Password";

	}


}

if ( isset( $_SESSION[ 'studentid' ] ) ) {
	echo "logged in as " . $_SESSION[ 'studentid' ];
}

?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="assets/css/main.css"/>
	<title>Login</title>
</head>

<body>

	<header id="header">
		<div class="inner">
			<a href="index.html" class="logo"><strong>Projection</strong> by TEMPLATED</a>
			<nav id="nav">
				<a href="register.php"> Register</a>
				<a href="hub.php">Hub</a>
				<a href="test.php">Test</a>
				<a href="index.php">Return Home</a>
			</nav>
			<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
		</div>
	</header>

	<section id="banner">



		<div class="inner">
			<header>
				<h1>Login</h1>
			</header>

			<div class="flex">

				<div class="6u$ 12u$(medium)">
					<div class="form" align="right">
						<form class="login-form" method="POST">
							<input type="text" name="username" class="form-control" placeholder="Username" required/>
							<br>
							<input type="password" name="password" id="input Password" class="form-control" placeholder="Password" required/>
							<br>
							<input type="text" name="studentid" id="" class="form-control" placeholder="Student ID" required/>
							<br>
							<button>login</button>
						</form>
					</div>


				</div>
	</section>
	<br>

	<?php 
  
  ?>
</body>




</html>