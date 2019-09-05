<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';

    $m = new PHPMailer;
    $m->isSMTP();
    $m->SMTPAuth = true;
    $m->Host     = 'smtp.gmail.com';

    $m->FromName = 'HouseRenting';
    $m->Username = 'SENDER EMAIL GOES HERE';
    $m->From     = 'SENDER EMAIL GOES HERE';
    $m->Password = 'SENDER PASSWORD GOES HERE';

    $m->addAddress($_REQUEST['email']);

    $m->isHTML(true);
 
    $m->Subject = "Houserenting";
    $m->Body = "<h4>Dear Sir,</h4>".$_REQUEST['msg']."<br><br><h5>Regards Muhammad Naveed</h5>";
    
    $m->AltBody = "This is the plain text version of the email content";

    if($m->send()){
        header('location: ../feedbacks.php');
    }
    else {
        echo 'Failed to send email';
    }
?>