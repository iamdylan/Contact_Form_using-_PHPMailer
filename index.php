<?php		
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include_once "PHPMailer/PHPMailer.php";
	include_once "PHPMailer/Exception.php";
	include_once "PHPMailer/SMTP.php";

	$msg = "";

	if(isset($_POST['submit'])){

		$subject = $_POST['subject'];
		$email = $_POST['email'];
		$message = $_POST['message'];

		if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != ""){
		
		$file = "attachment/" . basename($_FILES['attachment']['name']);
		move_uploaded_file($_FILES['attachment']['tmp_name'], $file);
	
	} else
		$file = "";
		
	$mail = new PHPMailer();

	$mail->Host = "smtp.gmail.com";
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->Username = "emailfortesting103@gmail.com";
	$mail->Password = "test@123456";
	$mail->SMTPSecure = "ssl";
	$mail->Port = 465;

	$mail->addAddress('dylan.marvel@gmail.com');
	$mail->setFrom($email);
	$mail->Subject = $subject;
	$mail->isHTML(true);
	$mail->Body = $message;
	$mail->addAttachment($file);

	if ($mail->send())
		$msg = '<div class="alert alert-success">
				  <h4 class="alert-heading">Successful!</h4>
				  <p class="mb-0">Your email has been sent, thank you. We\'ll get in touch with you shortly.</p>
				</div>';
	else
		$msg = '<div class="alert alert-warning">
				  <h4 class="alert-heading">Warning!</h4>
				  <p class="mb-0">'.$mail->ErrorInfo.'. Please try again.</p>
				</div>';
	} 
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact Form</title>
	
	<link rel="stylesheet" href="https://bootswatch.com/4/materia/bootstrap.min.css">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
	<div class="container" style="margin-top: 100px">
		<h1 class="conform">CONTACT FORM<hr class="style-one"></h1>
		<div class="row justify-content-center">		


			<div class="col-md-6-offset-3" align="center" data-aos="zoom-in">

				<div class='card card-body  bg-light mt-2 mb-5'>
				<img src="assets/images/email2.svg"><br><br>

				<?php if ($msg != "") echo $msg; ?><br><br>

				<form method="post" action="index.php" enctype="multipart/form-data">
					<input class="form-control" name="subject" placeholder="Subject..."><br>
					<input class="form-control" type="email" name="email" placeholder="Email..."><br>
					<textarea placeholder="Message..." class="form-control" name="message"></textarea><br>
					<input class="form-control-file" type="file" name="attachment"><br>
					<input class="btn btn-primary btn-block" type="submit" name="submit" value="Send">
				</form>
			</div>
		</div>
		</div>
	</div>

	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script>
		AOS.init();
	</script>

</body>
</html>










