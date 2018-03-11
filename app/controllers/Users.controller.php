<?php

class Users extends Controller {

   public function __construct() {
      if (isLoggedIn()) {
         redirect('');
      }
      $this->userModel = $this->model('User');

   }

   public function index() {
      $data = [];
      $this->view('users/login', $data);
   }

   public function register() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         // SANITIZE the Inputs of POST
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         $data = [
            'number_card' => $_POST['number_card'],
            'email'       => $_POST['email'],
            'average'     => $_POST['average'],
            'password'    => $_POST['password'],
         ];
         $response = [
            'status'  => OK,
            'message' => "Every thing is Okay",
         ];
         // Validate number card
         if (empty($data["number_card"])) {
            $response["status"] = EMPTY_NUM_CARD;
            $response["message"] = "Empty number Card";
         } else {
            if (!filter_var($data['number_card'], FILTER_VALIDATE_INT)
               || strlen($data['number_card']) < 8
            ) {
               $response["status"] = INVALID_NUM_CARD;
               $response["message"] = "Invalid number card";
            }
         }
         // Validate email
         if (empty($data["email"])) {
            $response["status"] = EMPTY_EMAIL;
            $response["message"] = "Empty Email";
         } else {
            if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
               $response["status"] = INVALID_EMAIL;
               $response["message"] = "Invalid Email";
            }
         }

         // Check the Email if exist

         if ($this->userModel->findUserByEmail($data["email"])) {
            $response["status"] = EMAIL_N_EXIST;
            $response["message"] = "Email exist";
         }
         // Check if Student Exist
         if (!$this->userModel->isUserExist($data['average'], $data['number_card'])) {
            $response["status"] = AVERAGE_CARD_ERR;
            $response["message"] = "Average or Card number not exist";
         }
         // Validate the Average
         if (empty($data["average"])) {
            $response["status"] = EMPTY_AVERAGE;
            $response["message"] = "Empty Average";
         } else {
            if (!filter_var($data['average'], FILTER_VALIDATE_FLOAT)) {
               $response["status"] = INVALID_AVERAGE;
               $response["message"] = "Invalid Average";
            }
         }
         // Check the password if not empty
         if (empty($data["password"])) {
            $response["status"] = EMPTY_PASS;
            $response["message"] = "Empty Password";
         } else {
            if (strlen($data["password"]) < 8) {
               $response["status"] = INVALID_PASS;
               $response["message"] = "Invalid Password";
            }
         }

         // Go on if no error
         if ($response['status'] == OK) {
            // no Errors
            $data['token'] = bin2hex(openssl_random_pseudo_bytes(8));
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            if ($this->userModel->addUser($data)) {
               // Send the Token to Email
               if (mail_token($data['email'], $data['token'])) {
                  redirect("users/login");
               } else {
                  die('Problem in Emailing');
               }
            } else {
               die("something wrong");
            }
         } else {
            die(var_dump($response));
            // there is an errors
         }


      } else {
         // Direct Url Request
         $this->view("users/login");
      }
   }

   public function confirm($token = "") {
      $token = trim($token);
      if (!empty($token)) {
         // Valid token
         if ($this->userModel->getUserByToken($token)) {
            // Token exist so Confirm the email
            if ($this->userModel->confirmEmail($token)) {
               redirect("users/login");
            } else {
               die('Error update');
            }
         } else {
            // Token not exist
            die('token not exist');
         }

      } else {
         // inValid token
         if (isset($_POST['submit'])) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $email = $_POST['email'];
            $token = bin2hex(openssl_random_pseudo_bytes(8));
            if (mail_token($email, $token)) {
               redirect("users/login");
            } else {
               die('Sorry there is a problem try again please!');
            }
         } else {
            $this->view('users/confirm');
         }
      }
   }

   public function login() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         // Post Request
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         $data = [
            'email'    => $_POST['email'],
            'password' => $_POST['password'],
         ];
         $response = [
            'status'  => OK,
            'message' => 'Every Thing is Okay',
            'data'    => '',
         ];
         // Check the Email if not empty
         if (empty($data["email"])) {
            $response["status"] = EMPTY_EMAIL;
            $response["message"] = "Empty Email";
         }
         // Check the Email if exist
         if (!$this->userModel->findUserByEmail($data["email"])) {

            $response["status"] = EMAIL_N_EXIST;
            $response["message"] = "Email does not exist";
         }
         // Check the password if not empty
         if (empty($data["password"])) {
            $response["status"] = EMPTY_PASS;
            $response["message"] = "Empty Password";
         }
         // Check if there's no Problem
         if ($response['status'] == OK) {
            // get The user From database
            $loggedInUser = $this->userModel->getUser($data['email'], $data['password']);
            if ($loggedInUser) {
               if (isset($_POST["ajax"])) {
                  $response['data'] = $loggedInUser;
                  unset($response['data']->password);
                  header('Content-type: application/json');
                  $this->view('users/ajax', $response);
               } else {
                  if ($loggedInUser->isConfirmed == 0) {
                     redirect("users/login");
                  } else {
                     $this->createSessionUser($loggedInUser);
                  }
               }
            } else {
               $response["status"] = INVALID_PASS;
               $response["message"] = "The Password is incorrect";
            }

         } else {
            die("Error");
         }


      } else {
         // URL Request
         $data = [];
         $this->view('users/login', $data);
      }
   }

   public function forgetpassword($token = '', $email = '') {
      $token = filter_var(trim($token), FILTER_SANITIZE_STRING);
      $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
      $isEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
      if (!empty($token) && !empty($email) && $isEmail ) {
         // Valid token
         if ($this->userModel->getUserByEmailAndToken($email, $token)) {
            die("User exist");
            // Token exist so Confirm the email
           // Process Email
         } else {
            // Token not exist
            die('token not exist');
         }

      } else {
         // inValid token
         if (isset($_POST['submit'])) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $email = $_POST['email'];
            $token = bin2hex(openssl_random_pseudo_bytes(8));
            if (mail_token($email, $token)) {
               redirect("users/forgetpassword");
            } else {
               die('Sorry there is a problem try again please!');
            }
         } else {
            die('Show the View');
//            $this->view('users/for');
         }
      }
   }


   public function logout() {
      // unset all Data from Session
      unset($_SESSION["user_id"]);
      unset($_SESSION["user_email"]);
      unset($_SESSION["user_name"]);
      unset($_SESSION["user_level"]);
      unset($_SESSION["user_section"]);
      unset($_SESSION["user_group"]);
      // destroy Session
      session_destroy();
      // redirect to the login page
      redirect('users/login');
   }

   private function createSessionUser($user) {

      $_SESSION["user_id"] = $user->_id_student;
      $_SESSION["user_email"] = $user->email;
      $_SESSION["user_firstname"] = $user->first_name;
      $_SESSION["user_lastname"] = $user->last_name;
      $_SESSION["user_level"] = $user->level;
      $_SESSION["user_section"] = $user->section;
      $_SESSION["user_group"] = $user->group;
      redirect('');
   }


}