<?php 
include 'adminhubheader.php';

?>

<div class="content">
	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12">
				<div class="card">

					<div class="header">
						<h4 class="title"><strong>Send an email using the database</strong></h4>
						<p class="category">Strictly for testing purposes</p>
					</div>
					<div class="" style="padding-left:15px; padding-bottom:20px;">
						
						<form method="POST">
		<label for="">Type address</label>
		<input type="email" name="contact" id="" class= "form-control" placeholder = "Type it"  required maxlength = 1000>
	<br>
		<label for="">Type Content</label>
	<br>
		<textarea name="content" rows="3" cols="40" required placeholder = "i.e. HS Library" maxlength=300></textarea>
	<br>
	<button type="submit" name = "accept" class = "btn btn-success">Submit</button>	
</form>		


						
						<?php
if(isset($_POST['accept']) & !empty(isset($_POST['accept']))){
	$contact = mysqli_real_escape_string($connection, $_POST["contact"]);
	$content = mysqli_real_escape_string($connection, $_POST["content"]);
	
	$to = $contact;
$subject = "Email from HonorHelp test";
$message = "$content";

$headers = 'From: HonorHelp <HonorHelp@database.com>' . PHP_EOL .
    'Reply-To: HonorHelp <HonorHelp@database.com>' . PHP_EOL .
    'X-Mailer: PHP/' . phpversion() . "Content-type: text/html";
			
			
mail($to, $subject, $message, $headers);
echo "<br>email to Project Manager sent";
	
		
		
		
		
		
	}	?>
						
						


					</div>
				</div>
			</div>

		</div>
	</div>
</div>


</body>
</html>