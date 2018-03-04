<?php
// ini_set("log_errors", 1);
// ini_set("error_log", "php-error.log");
// error_log( "Hello, errors!" );
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);   

$email_recepients = explode(', ', $_POST['forward_to']);
$job_title = $_POST['job_title'];
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$location = $_POST['location'];
$cover_letter = $_POST['cover_letter'];
$attachment_path = $_POST['resume'];
                          
try {

    //Recipients
    $mail->setFrom('mristic@brandconnections.com', 'Harvest Hill');
    foreach ($email_recepients as $er) {
        $mail->addAddress($er);
    }
    // $mail->addAddress($email_recepients);     // Add a recipient
    $mail->addReplyTo($email, 'Job Application for '.$job_title);

    //Attachments
    $mail->addAttachment($attachment_path);         // Add attachments    

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Job Application for '.$job_title;
    $mail->Body    = 'Name: '.$full_name.'<br>'.'Email: '.$email.'<br>'.'Location: '.$location.'<br>'.$cover_letter;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $data['success'] = 'Message has been sent';
} catch (Exception $e) {
    $data['success'] = 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
}

echo json_encode($data);