<?php

trait Valid {
   public function validateEmail($email) {
      if (filter_var($email, FILTER_VALIDATE_EMAIL) == false)
         return "";
      return filter_var($email, FILTER_VALIDATE_EMAIL);
   }

   public function validatePassword($password) {
      return strlen($password) > 8 ? $password : "";
   }

   public function validateNumber($number) {
      $number = filter_var($number, FILTER_VALIDATE_INT);
      return strlen($number) == 8 ? $number : "";
   }

   public function validateAverage($number) {
      $number = filter_var($number, FILTER_VALIDATE_FLOAT);
      return ($number >= 10 and $number <= 20) ? $number : "";
   }
}