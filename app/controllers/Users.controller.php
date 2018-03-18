<?php

class Users extends Controller {

   public function __construct() {
      $this->userModel = $this->model('User');

   }

   public function index() {
      if (isLoggedIn()) {
         redirect("");
      }
      $response = [
         'status'  => OK,
         'message' => 'Every Thing is Okay',
         'data'    => '',
      ];
      $this->view('users/login', $response);
   }

   public function register() {
      if (isLoggedIn()) {
         redirect("");
      }
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
         $response = validateNumCard($data['number_card'], $response);
         // Validate email
         $response = validateEmail($data["email"], $response, $this->userModel, true);
         // Check if Student Exist
         $response = studentNotExist($data["average"], $data['number_card'], $this->userModel, $response);
         // Validate the Average
         $response = validateAverage($data['average'], $response);
         // Check the password if not empty
         $response = validatePassword($data['password'], $response);

         // Go on if no error
         if ($response['status'] == OK) {
            // no Errors
            $data['token'] = bin2hex(openssl_random_pseudo_bytes(8));
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            if ($this->userModel->addUser($data)) {
               // Send the Token to Email
               $body = "
               <p>Please click in the button to complete your register</p><a href='http://localhost/jami3aty/users/confirm/" . $data['token'] . "'><input type='button' value='Click Here!'></a>
               ";
               $subject = "Complete Registration";
               if (mail_token($data['email'], $body, $subject)) {
                  if (isset($_POST["ajax"])) {
                     header('Content-type: application/json');
                     $this->view('users/ajax', $response);
                  } else {
                     flash('register_success', "Success! you must confirm your email");
                     redirect("users/login");
                  }

               } else {
                  die('Problem in Emailing make sure that you have connection and try');
               }
            } else {
               die("something wrong please try again!");
            }
         } else {
            // there is an errors
            if (isset($_POST["ajax"])) {
               header('Content-type: application/json');
               $this->view('users/ajax', $response);
            } else {
               $this->view('users/login', $response);
            }
         }


      } else {
         // Direct Url Request
         $response = [
            'status'  => "",
            'message' => "",
         ];
         $this->view("users/login", $response);
      }
   }

   public function confirm($token = "") {
      if (!isLoggedIn()) {
         redirect("");
      }
      $token = trim($token);
      if (!empty($token)) {
         // Valid token
         if ($this->userModel->findUserByToken($token)) {
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
            $response = [
               'status'  => OK,
               'message' => "Every thing is Okay",
            ];

            $response = validateEmail($email, $response, $this->userModel);

            if ($response['status'] == OK) {
               $token = bin2hex(openssl_random_pseudo_bytes(8));
               $body = "
               <p>Please click in the button to complete your register</p><a href='http://localhost/jami3aty/users/confirm/" . $token . "'><input type='button' value='Click Here!'></a>
               ";
               $subject = "Complete Registration";
               if (mail_token($email, $body, $subject) && $this->userModel->updateToken($email, $token)) {
                  $_SESSION["isConfirmed"] = 1;

                  flash('confirm_email_send', 'We send you en Email Check it 
                        <br> if you don\'t receive it just try again <br><br>
                        <a href="' . URL_ROOT . '">Home</a>');
                  redirect('users/confirm');
               } else {
                  die('Sorry there is a problem try again please!');
               }
            } else {
               $this->view("users/confirm", $response);
            }

         } else {
            $response = [
               'status'  => OK,
               'message' => "",
            ];
            $this->view('users/confirm', $response);
         }
      }
   }

   public function login() {
      if (isLoggedIn()) {
         redirect("");
      }
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
         $response = validateEmail($data['email'], $response, $this->userModel);
         // Check the password if not empty
         $response = validatePassword($data['password'], $response);
         // Check if the email is Exist
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
                  $this->createSessionUser($loggedInUser);
               }
            } else {
               if (isset($_POST["ajax"])) {
                  $response["status"] = INVALID_PASS;
                  $response["message"] = "The Password is incorrect";
                  header('Content-type: application/json');
                  $this->view('users/ajax', $response);
               } else {
                  $response["status"] = INVALID_PASS;
                  $response["message"] = "The Password is incorrect";
                  $this->view('users/login', $response);
               }
            }

         } else {
            if (isset($_POST["ajax"])) {
               header('Content-type: application/json');
               $this->view('users/ajax', $response);
            } else {
               $this->view('users/login', $response);
            }
         }


      } else {
         // URL Request
         $response = [
            'status'  => "",
            'message' => "",
         ];
         $this->view('users/login', $response);
      }
   }

   public function resetpass($token = '') {
      if (isLoggedIn()) {
         redirect("");
      }
      $token = filter_var(trim($token), FILTER_SANITIZE_STRING);
      if ($this->userModel->findUserByToken($token) && !empty($token)) {
         if (isset($_POST['submit'])) {
            $tokenConfirm = $_POST["token"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirmPassword"];
            $response = [
               'status'  => OK,
               'message' => 'We send a key to your email, check it! ',
            ];

            // VALIDATE the Password
            $response = validatePassword($password, $response, $confirmPassword);
            if ($token == $tokenConfirm && $response['status'] == OK) {
               // update Password and the token
               $password = password_hash($password, PASSWORD_DEFAULT);
               if ($this->userModel->updatePassword($token, $password) && $this->userModel->confirmEmail($token)) {
                  flash('password_updated', "Success! You can login now");
                  redirect("users/login");
               } else {
                  die('Error in updating');
               }
            } else {
               $response["token"] = $token;
               $this->view("users/resetpass", $response);
            }
         } else {
            // Show Inputs
            $response = [
               'token'   => $token,
               'status'  => "",
               'message' => '',
            ];
            $this->view("users/resetpass", $response);
         }

      } else {
         die("URL NOT EXIST !");
      }
   }

   public function forgotpass() {
      if (isLoggedIn()) {
         redirect("");
      }
      if (isset($_POST["submit"])) {
         $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
         $response = [
            'status'  => OK,
            'message' => 'We send a key to your email, check it! ',
         ];
         $response = validateEmail($email, $response, $this->userModel);

         if ($response['status'] == OK) {
            $token = bin2hex(openssl_random_pseudo_bytes(64));
            $subject = "Reset Password";
            $body = "You want to Change your password ? <a href='http://localhost/jami3aty/users/resetpass/" . $token . "'><input type='button' value='Click here'></a>
                    <br>
                    <br>
                    If you don't change it just ignore this email";
            if (mail_token($email, $body, $subject) && $this->userModel->updateToken($email, $token)) {
               if (isset($_POST["ajax"])) {
                  header('Content-type: application/json');
                  $this->view('users/ajax', $response);
               } else {
                  flash('email_send', 'We send you en Email Check it <br> if you don\'t receive it just try again ');
                  redirect('users/forgotpass');

               }
            } else {
               die("Problem Emailing Try Again");
            }
         } else {
            if (isset($_POST["ajax"])) {
               header('Content-type: application/json');
               $this->view('users/ajax', $response);
            } else {
               $this->view("users/forgotpass", $response);
            }
         }

      } else {
         $response = [
            'status'  => OK,
            'message' => '',
         ];
         $this->view("users/forgotpass", $response);
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
      $_SESSION["isConfirmed"] = $user->isConfirmed;
      redirect('');
   }

}
