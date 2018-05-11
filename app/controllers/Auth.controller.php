<?php

use App\Classes\Helper;

class Auth extends Controller {
   use Valid;
   private $request;
   private $authentication;


   public function __construct($request) {
      $this->request = $request;
      $this->setAjax($this->request->get("ajax"));
      $this->authentication = $this->model("Authentication");

   }

   public function index() {
      Helper::redirect("auth/login");
   }

   public function login() {
      if (Session::isLoggedIn()) Helper::redirect("");
      if ($_SERVER['REQUEST_METHOD'] != "POST") {
         // URL Request
         $response = [
            'page_title' => ucfirst(__FUNCTION__),
            'status'     => OK,
            'message'    => "",
         ];
         $this->view('auth/login', $response);
      }
      $data = [
         "email"    => $this->validateEmail($this->request->get("email")),
         "password" => $this->validatePassword($this->request->get("password")),
      ];
      $response = [
         'page_title' => "Authentication",
         'status'     => OK
      ];
      $identity = $this->authentication->findUserByEmail($data["email"]);
      if (empty($identity)) {
         $response['status'] = INVALID_EMAIL;
         $response['message'] = "L’e-mail entré ne correspond à aucun compte.";
         $this->view("auth/login", $response);
         return;
      }
      $user = $this->authentication->getUser($identity, $data["password"]);
      if (!$user) {
         $response['status'] = INVALID_PASS;
         $response['message'] = "Le mot de passe entré est incorrect.";
         $this->view("auth/login", $response);
         return;
      }
      if (isset($user->bac_average)) {
         $this->createSessionStudent($user);
      } else {
         $this->createSessionProf($user);
      }
      $response["data"] = $user;
      $this->view("", $response);
      return;
   }

   public function register() {
      if (Session::isLoggedIn()) Helper::redirect("");
      if ($_SERVER["REQUEST_METHOD"] != 'POST') {
         // Direct Url Request
         $response = [
            'page_title' => ucfirst(__FUNCTION__),
            'status'     => OK,
            'message'    => "",
         ];
         $this->view("auth/login", $response);
      }
//      var_dump("hel");
      $data = [
         "card_num" => $this->validateNumber($this->request->get("number_card")),
         "average"  => $this->validateAverage($this->request->get("average")),
         "email"    => $this->validateEmail($this->request->get("email")),
         "password" => $this->validatePassword($this->request->get("password")),
      ];
      $response = [
         'page_title' => "Registration",
         'status'     => OK
      ];
      $data['card_num'] = $this->authentication->isUserExistByNumCard($data["card_num"]);
      if (empty($data['card_num'])) {
         // student's id doesn't exist
         $response["status"] = NUM_CARD_N_EXIST;
         $response["message"] = "Cet utilisateur n'existe pas ou déjà activé";
         $this->view("auth/login", $response);
         return;
      }
      $data['average'] = $this->authentication->isUserExistByAverage($data['average'], $data['card_num']);
      if (empty($data['average'])) {
         // student's average doesn't exist
         $response["status"] = AVERAGE_N_EXIST;
         $response["message"] = "Cette moyenne est incorrect";
         $this->view("auth/login", $response);
         return;
      }
      $email = $this->authentication->findUserByEmail($data['email']);
      if (!empty($email)) {
         // student's email exist exist
         $response["status"] = EMAIL_N_EXIST;
         $response["message"] = "Cet e-mail deja existe, essayez-en un autre";
         $this->view("auth/login", $response);
         return;
      }

      // Every thing is okay here
      if (empty($this->authentication->addUser($data)))
         die("something wrong with add user");
      if (!$this->authentication->addUser($data))
         die("something wrong with Mailing the token");
      Session::flash('register_success', "Succès! vous devez confirmer votre email");
      $this->view("", $response);
   }

   public function confirm($token = null) {
      if (!Session::isLoggedIn()) Helper::redirect("");
      if (!isset($token)) {
         Helper::redirect("auth/login");
         return;
      }
      // process data to model and confirm email
      $token = filter_var($token, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      if (!$this->authentication->findUserByToken($token)) Helper::redirect("");
      if (!$this->authentication->confirmEmail($token)) die('There is an Error try again');
      Helper::redirect("auth/login");
   }

   public function confirmation() {
      if (!Session::isLoggedIn()) Helper::redirect("");
      $response = [
         'page_title' => "Confirm email",
         "status"     => OK,
      ];
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         // send the email and update token in bdd
         $email = $this->validateEmail($this->request->get("email")) ? $this->request->get("email") : "";
         $email = $this->authentication->findUserByEmail($email);
         if (empty($email)) {
            // this email not exist or invalid
            $response['status'] = EMAIL_N_EXIST;
            $response['message'] = "Cet e-mail invalide ou n'existe pas";
            $this->view("users/confirm", $response);
            return;
         }
         if (!$this->authentication->updateToken($email)) die("Emailing Error try later");
         $_SESSION['isConfirmed'] = 1;
         Session::flash('confirm_email_send', 'Verifier votre email');
         Helper::redirect('auth/confirmation');
         return;
      }
      // Show view
      $this->view("auth/confirmation", $response);


   }

   private function createSessionStudent($user) {
      if (empty($this->request->get("ajax"))) {
         $_SESSION["user_id"] = $user->_id_student;
         $_SESSION["user_email"] = $user->email;
         $_SESSION["user_firstname"] = $user->first_name;
         $_SESSION["user_lastname"] = $user->last_name;
         $_SESSION["user_fullname"] = $user->last_name . ' ' . $user->first_name;
         $_SESSION["user_branch"] = Helper::levelToString($user->level);
         $_SESSION["user_level"] = $user->level;
         $_SESSION["user_section"] = $user->section;
         $_SESSION["user_group"] = $user->group;
         $_SESSION["isConfirmed"] = $user->isConfirmed;
      }
   }
   private function createSessionProf($user) {
      if (empty($this->request->get("ajax"))) {
         $_SESSION["user_id"] = $user->_id_professor;
         $_SESSION["user_email"] = $user->email;
         $_SESSION["user_degree"] = $user->degree;
         $_SESSION["user_firstname"] = $user->first_name;
         $_SESSION["user_lastname"] = $user->last_name;
         $_SESSION["user_fullname"] = $user->last_name . ' ' . $user->first_name;
      }
   }
}