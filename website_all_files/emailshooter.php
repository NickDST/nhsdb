<?php 
include 'adminhubheader.php';
require_once( 'includes/dbh.inc.php' );
include 'emailheader.php';
//include 'phpmailer_header.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';


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
		<input type="email" name="address" id="" class= "form-control" placeholder = "Type it"  required maxlength = 1000>
	<br>
		<label for="">Type Content</label>
	<br>
		<textarea name="content" rows="3" cols="40" required placeholder = "i.e. HS Library" maxlength=300></textarea>
	<br>
	<button type="submit" name = "accept" class = "btn btn-success">Submit</button>	
</form>		


						
<?php
if(isset($_POST['accept']) & !empty(isset($_POST['accept']))){
	$address = mysqli_real_escape_string($connection, $_POST["address"]);
	
	$content = mysqli_real_escape_string($connection, $_POST["content"]);

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
   // $mail->SMTPDebug = 1;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $very_secure_email_username;                 // SMTP username
    $mail->Password = $very_secure_email_password;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    //Recipients
    $mail->setFrom('sms@concordiashanghai.org', 'Nick');
    $mail->addAddress($address, 'Joe User');     // Add a recipient
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'This is a test email';
    $mail->Body    = $content;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
	
	
	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
   // $mail->SMTPDebug = 1;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $very_secure_email_username;                 // SMTP username
    $mail->Password = $very_secure_email_password;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    //Recipients
    $mail->setFrom('sms@concordiashanghai.org', 'Nick');
    $mail->addAddress($address, 'Joe User');     // Add a recipient
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'This is a test email';
    $mail->Body    = 'This is a second email for the test';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

		
	}	?>
						
						


					</div>
				</div>
			</div>

		</div>
	</div>
</div>


</body>
</html>