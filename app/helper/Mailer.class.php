<?php
use PHPMailer\PHPMailer\PHPMailer;

class Mailer {


   public static function mail_token($email, $body, $subject = "") {
      // Config Server
      $mail = new PHPMailer();
      $mail->isSMTP();
      $mail->SMTPAuth = true;
      $mail->SMTPDebug = 0;
      $mail->Host = 'smtp.gmail.com';
      $mail->Username = 'jami3atyapp@gmail.com';
      $mail->Password = 'bourbieyounes';
      $mail->SMTPSecure = "ssl";
      $mail->Port = 465;


      $mail->From = "jami3atyapp@gmail.com";
      $mail->FromName = "Jami3aty";
      $mail->addAddress($email);
      $mail->Subject = $subject;
      $mail->Body = $body;
      $mail->AltBody = "Please click in the button to complete your register";
      if ($mail->send()) {
         return true;
      } else {
         return false;
      }
   }
}