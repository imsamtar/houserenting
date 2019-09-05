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
    $m->Body = "
  
    <h4>Dear Customer,</h4>
  
    <p>Thank you! <br> you have visit our website. you will get our more and best services very soon. we are trying to provide you our best services. you can receive your deal within 48 hours and next we are trying to receive within 10 to 12 hours.<br>Please leave your suggestions for more better results in our services</p><br><br>
  
    <h5> Houserenting (TEAM)</h5>";
    
    $m->AltBody = "This is the plain text version of the email content";

    if($m->send()){
        header('location: ../');
    }
    else {
        echo 'Failed to send email';
    }
?>