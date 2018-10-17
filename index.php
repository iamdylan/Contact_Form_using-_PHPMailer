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
		$msg = "Your email has been sent, thank you.";
	else
		$msg = "Please try again.
		echo $mail->ErrorInfo;﻿";
	} 
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<div class="container" style="margin-top: 100px">
		<div class="row justify-content-center">
			<div class="col-md-6-offset-3" align="center">
				<img src=""><br><br>

				<?php if ($msg != "") echo "$msg<br><br>"; ?>

				<form method="post" action="index.php" enctype="multipart/form-data">
					<input class="form-control" name="subject" placeholder="Subject..."><br>
					<input class="form-control" type="email" name="email" placeholder="Email..."><br>
					<textarea placeholder="Message..." class="form-control" name="message"></textarea><br>
					<input class="form-control-file" type="file" name="attachment"><br>
					<input class="btn btn-primary" type="submit" name="submit" value="Send">
				</form>
			</div>
		</div>
	</div>
</body>
</html>










