<?php
session_start();

if (!isset($_SESSION['studentid'])) {
	header('Location: login.php');
  exit;
}

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
	
	<h1>You are</h1>
	
	<?php
	echo $_SESSION['studentid'];
	?>
	
</body>
</html>