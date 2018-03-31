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
      if ($_SERVER['REQUEST_METHOD'] != "POST") {
         Helper::redirect("");
      }
      $data = [
         "email"    => $this->validateEmail($this->request->get("email")),
         "password" => $this->validatePassword($this->request->get("password")),
      ];
      $response = ['status' => OK];
      $identity = $this->authentication->findUserByEmail($data["email"]);
      if (empty($identity)) {
         $response = [
            'status'  => INVALID_EMAIL,
            'message' => "err email"
         ];
         $this->view("users/login", $response);
         return;
      }
      $user = $this->authentication->getUser($identity, $data["password"]);
      if (!$user) {
         $response = [
            'status'  => INVALID_EMAIL,
            'message' => "err password"
         ];
         $this->view("users/login", $response);
         return;
      }
      $this->createSessionUser($user);
      $this->view("", $response);
      return;
   }

   public function register() {
      if ($_SERVER["REQUEST_METHOD"] != 'POST') {
         Helper::redirect("");
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
         'status' => OK
      ];
      $data['card_num'] = $this->authentication->isUserExistByNumCard($data["card_num"]);
      if (empty($data['card_num'])) {
         // student's id doesn't exist
         $response["status"] = NUM_CARD_N_EXIST;
         $response["message"] = "this not user exist or already activated";
         $this->view("users/login", $response);
         return;
      }
      $data['average'] = $this->authentication->isUserExistByAverage($data['average'], $data['card_num']);
      if (empty($data['average'])) {
         // student's average doesn't exist
         $response["status"] = AVERAGE_N_EXIST;
         $response["message"] = "this average not exist";
         $this->view("users/login", $response);
         return;
      }
      $email = $this->authentication->findUserByEmail($data['email']);
      if (!empty($email)) {
         // student's email exist exist
         $response["status"] = EMAIL_N_EXIST;
         $response["message"] = "This Email exist try another one";
         $this->view("users/login", $response);
         return;
      }
      var_dump($data);
//      echo json_encode($response);
      die();
      return;
   }


   private function createSessionUser($user) {
      if (empty($this->request->get("ajax"))) {
         $_SESSION["user_id"] = $user->_id_student;
         $_SESSION["user_email"] = $user->email;
         $_SESSION["user_firstname"] = $user->first_name;
         $_SESSION["user_lastname"] = $user->last_name;
         $_SESSION["user_branch"] = Helper::levelToString($user->level);
         $_SESSION["user_level"] = $user->level;
         $_SESSION["user_section"] = $user->section;
         $_SESSION["user_group"] = $user->group;
         $_SESSION["isConfirmed"] = $user->isConfirmed;
      }
   }
}