<?php
/**
 * Created by PhpStorm.
 * User: IsMail BoUrbie
 * Date: 29/03/2018
 * Time: 20:29
 */

namespace App\Classes;


use PHPMailer\PHPMailer\PHPMailer;

class Mailer {
   private $mailer;

   public function __construct() {
      $this->mailer = new PHPMailer();
      $this->configServer();
   }

   private function configServer() {
      $this->mailer->isSMTP();
      $this->mailer->SMTPAuth = true;
      $this->mailer->SMTPDebug = 0;
      $this->mailer->Host = 'smtp.gmail.com';
      $this->mailer->Username = 'jami3atyapp@gmail.com';
      $this->mailer->Password = 'bourbieyounes';
      $this->mailer->SMTPSecure = "ssl";
      $this->mailer->Port = 465;
      $this->mailer->From = "jami3atyapp@gmail.com";
      $this->mailer->FromName = "Jami3aty";
   }

   public function sendConfirmationEmail($email, $token) {
      $this->mailer->addAddress($email);
      $this->mailer->Subject = "Confirmation";
      $this->mailer->Body = "<p>Please click in the button to complete your register</p>
                                <a href='http://localhost/jami3aty/users/confirm/" . $token . "'>
                                    <input type='button' value='Click Here!'>
                                </a>";
      $this->mailer->AltBody = "Please click in the button to complete your register";
      if ($this->mailer->send()) {
         return true;
      } else {
         return false;
      }
   }

   public function sendResetPassEmail($email, $token) {
      $this->mailer->addAddress($email);
      $this->mailer->Subject = "Reset Password";
      $this->mailer->Body = "You want to Change your password? <a href='http://localhost/jami3aty/users/resetpass/" . $token . "'><input type='button' value='Click here'></a>
                                 <br>
                                  <br>
                                 If you don't change it just ignore this email";
      $this->mailer->AltBody = "Please click in the button to reset your password";
      if ($this->mailer->send()) {
         return true;
      } else {
         return false;
      }
   }

}