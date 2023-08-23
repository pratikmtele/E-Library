<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (
    isset($_POST['name']) &&
    isset($_POST['email']) &&
    isset($_POST['subject']) &&
    !empty($_POST['email'])
) {

    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';

    # validation helper function
    include 'func_validation.php';

    $to = "pratiktele123@gmail.com";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    #simple form validation 
    $text = "name";
    $location = "../contact-us.php";
    $ms = "error";
    is_empty($name, $text, $location, $ms, "");

    $text = "email";
    $location = "../contact-us.php";
    $ms = "error";
    is_empty($email, $text, $location, $ms, "");

    $text = "subject";
    $location = "../contact-us.php";
    $ms = "error";
    is_empty($subject, $text, $location, $ms, "");

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();   //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'pratiktele4@gmail.com'; //SMTP username
        $mail->Password = 'aemttgdfwrckjxzc'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('pratiktele4@gmail.com', 'Contact form');
        $mail->addAddress('pratiktele123@gmail.com', 'our Website'); //Add a recipient

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = 'Name: '.$name.'<br>From: '.$email.'<br>Message: '.$message;

        $mail->send();
        $sm = "Message sent.";
        header("Location: ../contact-us.php?success=$sm");
    } catch (Exception $e) {
        $em = "Something went wrong!";
        header("Location: ../contact-us.php?error=$em");
    }
} else {
    $em = "Something went wrong!";
    header("Location: ../contact-Us.php?error=$em");
}

?>