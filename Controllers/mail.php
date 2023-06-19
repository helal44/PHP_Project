<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
function mailer($email,$name,$token){
    $mail = new PHPMailer(true);
    try {
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;    
        $mail->isSMTP();                             
        $mail->Host       = 'smtp.gmail.com';        
        $mail->SMTPAuth   = true; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = '587';                         
        $mail->Username   = "goo.chrom312@gmail.com";
        $mail->Password   = 'duvxzhkoyvakcqwu';
        $mail->setFrom('goo.chrom312@gmail.com', 'Cafeteria');
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";
        $mail->Subject = 'Verification Code';
        $mail->Body    = '<h3>Verification Code To Reset Your Password Is: ' . $token . '</h3>';
        return $mail ;  
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
