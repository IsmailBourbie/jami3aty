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
            'status'  => 1,
            'message' => "Every thing is Okay",
         ];
         // Validate number card
         if (empty($data["number_card"])) {
            $response["status"] = 0;
            $response["message"] = "Empty number Card";
         } else {
            if (!filter_var($data['number_card'], FILTER_VALIDATE_INT)
               || strlen($data['number_card']) < 8
            ) {
               $response["status"] = 0;
               $response["message"] = "Invalid number card";
            }
         }
         // Validate email
         if (empty($data["email"])) {
            $response["status"] = 2;
            $response["message"] = "Empty Email";
         } else {
            if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
               $response["status"] = 2;
               $response["message"] = "Invalid Email";
            }
         }

         // Check the Email if exist
         if ($this->userModel->findUserByEmail($data["email"])) {
            $response["status"] = 2;
            $response["message"] = "Email exist";
         }
         // Validate the Average
         if (empty($data["average"])) {
            $response["status"] = 3;
            $response["message"] = "Empty Average";
         } else {
            if (!filter_var($data['average'], FILTER_VALIDATE_FLOAT)) {
               $response["status"] = 3;
               $response["message"] = "Invalid Average";
            }
         }
         // Check the password if not empty
         if (empty($data["password"])) {
            $response["status"] = 2;
            $response["message"] = "Empty Password";
         } else {
            if (strlen($data["password"]) < 8) {
               $response["status"] = 2;
               $response["message"] = "Invalid Password";
            }
         }

         // Go on if no error
         if ($response['status'] == 1) {
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
         redirect('users/login');
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
            'status'  => 1,
            'message' => 'Every Thing is Okay',
            'data'    => '',
         ];

         // Check the Email if not empty
         if (empty($data["email"])) {
            $response["status"] = 0;
            $response["message"] = "Empty Email";
         }
         // Check the Email if exist

         if (!$this->userModel->findUserByEmail($data["email"])) {

            $response["status"] = 0;
            $response["message"] = "Email does not exist";
         }
         // Check the password if not empty
         if (empty($data["password"])) {
            $response["status"] = 2;
            $response["message"] = "Empty Password";
         }
         // Check if there's no Problem
         if ($response['status'] == 1) {
            // get The user From database
            $loggedInUser = $this->userModel->getUser($data['email'], $data['password']);
            if ($loggedInUser) {
               if (isset($_POST["ajax"])) {
                  $response['data'] = $loggedInUser;
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
               echo "Yes Loginned";
               $response["status"] = 2;
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
      $_SESSION["user_id"] = $user->id;
      $_SESSION["user_email"] = $user->email;
      $_SESSION["user_name"] = $user->fullname;
      $_SESSION["user_level"] = $user->level;
      $_SESSION["user_section"] = $user->section;
      $_SESSION["user_group"] = $user->group;
      redirect('');
   }


}