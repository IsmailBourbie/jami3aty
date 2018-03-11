<?php
use PHPMailer\PHPMailer\PHPMailer;

function mail_token($email, $token) {
   // Config Server
   $mail = new PHPMailer();
   $mail->isSMTP();
   $mail->SMTPAuth = true;
   $mail->SMTPDebug = 2;
   $mail->Host = 'smtp.gmail.com';
   $mail->Username = 'jami3atyapp@gmail.com';
   $mail->Password = 'bourbieyounes';
   $mail->SMTPSecure = "ssl";
   $mail->Port = 465;


   $mail->From = "jami3atyapp@gmail.com";
   $mail->FromName = "Jami3aty";
   $mail->addAddress($email);
   $mail->Subject = "Complete your register";
   $mail->Body = "
               <p>Please click in the button to complete your register</p><a href='http://localhost/jami3aty/users/confirm/" . $token . "'><input type='button' value='Click Here!'></a>
               ";
   $mail->AltBody = "Please click in the button to complete your register";
   if ($mail->send()) {
      return true;
   } else {
      return false;
   }


}