<?php


class Users extends Controller {

   public function __construct() {
      if (isLoggedIn()) {
         redirect('');
      }
      $this->userModel = $this->model('User');

   }

   public function login() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         // Post Request
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         $data = [
            'email' => $_POST['email'],
            'password' => $_POST['password'],
         ];
         $response = [
            'status' => 1,
            'message' => 'Every Thing is Okay',
            'data' => '',
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
                  $this->createSessionUser($loggedInUser);
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