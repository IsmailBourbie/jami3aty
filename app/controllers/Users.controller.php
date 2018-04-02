<?php
use App\Classes\Mailer;
use App\Classes\Helper;

class Users extends Controller {

   public function __construct() {
      $this->userModel = $this->model('User');

   }

   public function index() {
      if (Session::isLoggedIn()) {
         Helper::redirect("");
      }
      Helper::redirect("auth/login");
   }

   public function resetpass($token = '') {
      if (Session::isLoggedIn()) {
         Helper::redirect("");
      }
      $token = filter_var(trim($token), FILTER_SANITIZE_STRING);
      if ($this->userModel->findUserByToken($token) && !empty($token)) {
         if (isset($_POST['submit'])) {
            $tokenConfirm = isset($_POST["token"]) ? $_POST["token"] : "";
            $password = isset($_POST["password"]) ? $_POST["password"] : "";
            $confirmPassword = isset($_POST["confirmPassword"]) ? $_POST["confirmPassword"] : "";
            $response = [
               'status'  => OK,
               'message' => 'We send a key to your email, check it! ',
            ];

            // Validation_helper::VALIDATE the Password
            $response = Validation::validatePassword($password, $response, $confirmPassword);
            if ($token == $tokenConfirm && $response['status'] == OK) {
               // update Password and the token
               $password = password_hash($password, PASSWORD_DEFAULT);
               if ($this->userModel->updatePassword($token, $password) && $this->userModel->confirmEmail($token)) {
                  Session::flash('password_updated', "Success! You can login now");
                  Helper::redirect("users/login");
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
               "page_title" => "Reset Password",
               'token'      => $token,
               'status'     => "",
               'message'    => '',
            ];
            $this->view("users/resetpass", $response);
         }

      } else {
         die("URL NOT EXIST !");
      }
   }

   public function forgotpass() {
      if (Session::isLoggedIn()) {
         Helper::redirect("");
      }
      if (isset($_POST["submit"]) || isset($_POST["ajax"])) {
         $email = isset($_POST['email']) ? $_POST['email'] : "";
         $email = filter_var($email, FILTER_SANITIZE_EMAIL);
         $response = [
            'status'  => OK,
            'message' => 'We send a key to your email, check it! ',
         ];
         $response = Validation::validateEmail($email, $response, $this->userModel);

         if ($response['status'] == OK) {
            $token = Helper::generateToken(64);
            if ((new Mailer())->sendResetPassEmail($email, $token) && $this->userModel->updateToken($email, $token)) {
               if (isset($_POST["ajax"])) {
                  header('Content-type: application/json');
                  $this->view('api/json', $response);
                  return;
               }
               Session::flash('email_send', 'We send you en Email Check it <br> if you don\'t receive it just try again ');
               Helper::redirect('users/forgotpass');
            } else {
               if (isset($_POST["ajax"])) {
                  $response['status'] = ERR_EMAIL;
                  $response['message'] = "Problem in emailing";
                  header('Content-type: application/json');
                  $this->view('api/json', $response);
                  return;
               }
               die("Problem Emailing Try Again");
            }
         } else {
            if (isset($_POST["ajax"])) {
               header('Content-type: application/json');
               $this->view('api/json', $response);
            } else {
               $response['page_title'] = 'Forgot password';
               $this->view("users/forgotpass", $response);
            }
         }

      } else {
         $response = [
            'page_title' => 'Forgot password',
            'status'     => OK,
            'message'    => '',
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
      // Redirect_helper::redirect to the login page
      Helper::redirect('auth/login');
   }
}
