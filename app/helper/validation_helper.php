<?php


function validateEmail($email, $response, $object, $found = false) {
   if (empty($email)) {
      $response["status"] = EMPTY_EMAIL;
      $response["message"] = "Empty Email";
   } else {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $response["status"] = INVALID_EMAIL;
         $response["message"] = "Invalid Email";
      } else {
         if ($found) {
            if ($object->findUserByEmail($email)) {
               $response["status"] = EMAIL_N_EXIST;
               $response["message"] = "Email exist <a href='" . URL_ROOT . "users/login'>Login?</a>";
            }
         } else {
            if (!$object->findUserByEmail($email)) {
               $response["status"] = EMAIL_N_EXIST;
               $response["message"] = "Email does not exist <a href='" . URL_ROOT . "users/register'>Sign up?</a>";
            }
         }
      }
   }
   return $response;
}

function validatePassword($password, $response, $confirmPassword = null) {

   if (empty($password)) {
      $response["status"] = EMPTY_PASS;
      $response["message"] = "Empty Password";
   } else {
      if (strlen($password) < 8) {
         $response["status"] = INVALID_PASS;
         $response["message"] = "Invalid Password";
      } else {
         if (!is_null($confirmPassword)) {
            if ($password !== $confirmPassword) {
               $response["status"] = CONFIRM_PASS_ERR;
               $response["message"] = "Invalid Password";
            }
         }
      }
   }
   return $response;
}

function validateAverage($average, $response) {
   if (empty($average)) {
      $response["status"] = EMPTY_AVERAGE;
      $response["message"] = "Empty Average";
   } else {
      if (!filter_var($average, FILTER_VALIDATE_FLOAT)) {
         $response["status"] = INVALID_AVERAGE;
         $response["message"] = "Invalid Average";
      }
   }
   return $response;
}

function validateNumCard($num_card, $response) {
   if (empty($num_card)) {
      $response["status"] = EMPTY_NUM_CARD;
      $response["message"] = "Empty number Card";
   } else {
      if (!filter_var($num_card, FILTER_VALIDATE_INT)
         || strlen($num_card) < 8
      ) {
         $response["status"] = INVALID_NUM_CARD;
         $response["message"] = "Invalid number card";
      }
   }
   return $response;
}

function studentNotExist($average, $number_card, $object, $response) {
   if (!$object->isUserExist($average, $number_card)) {
      $response["status"] = AVERAGE_CARD_ERR;
      $response["message"] = "Average or Card number not exist";
   }
   return $response;
}