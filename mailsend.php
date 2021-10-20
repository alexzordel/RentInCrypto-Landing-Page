<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include("phpmailer/Exception.php");
include("phpmailer/PHPMailer.php");
include("phpmailer/SMTP.php");



$mail = new PHPMailer(true);
$sub = "A Subscription Request from Rentdex";
$msg = "";
$ismailok = true;


if (isset($_POST) === true && !empty($_POST)) {

    $email = trim($_POST['email']);
    $msg = "Email id: " . $email;

		if (!strlen($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			echo json_encode('Invalid email format');
			$ismailok = false;
		}

}


try {                    // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = '';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '';                     // SMTP username
    $mail->Password   = '';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('');
    $mail->addAddress('');    
    
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $sub;
    $mail->Body    = $msg;
    $mail->AltBody = $msg;
    if($ismailok){
    	$mail->send();
    echo json_encode("You are successfully added to our subscription list."); 
    }
    
} catch (Exception $e) {
}

 ?>