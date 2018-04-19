<?php


class Mails extends Controller {
   private $mail_model;
   private $request;

   public function __construct($request) {
      $this->request = $request;
      $this->mail_model = $this->model('Mail');
      $this->setAjax($this->request->get('ajax'));
   }

   public function index() {

   }

   public function all() {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') \App\Classes\Helper::redirect("");
      $response = [
         "status" => OK,
         "data"   => ""
      ];
      $_id_student = filter_var($this->request->get("_id_student"), FILTER_VALIDATE_INT);
      if ($_id_student === false) {
         $response['status'] = ERR_EMAIL;
         $this->view("api/json", $response);
         return;
      }

      $response['data'] = $this->mail_model->studentAllMails($_id_student);

      $this->view("api/json", $response);
   }

   public function sent() {
      $response = [
         'page_title' => 'Message envoyée',
         'status'     => OK,
         'data'       => ''
      ];
      $sender = "1";
      $_id_student = Session::get("user_id");
      $this->response['data'] = $this->mail_model->bySender($_id_student, $sender);
      $this->view('mails/sent', $response);
   }

   public function received() {
      $response = [
         'page_title' => 'Message reçu',
         'status'     => OK,
         'data'       => ''
      ];
      $sender = "0";
      $_id_student = Session::get("user_id");
      $this->response['data'] = $this->mail_model->bySender($_id_student, $sender);
      $this->view('mails/received', $response);
   }

   public function id() {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') \App\Classes\Helper::redirect("");
      $response = [
         "status" => OK,
         "data"   => ""
      ];
      $id_mail = filter_var($this->request->get('id_mail'), FILTER_VALIDATE_INT);
      if ($id_mail === false) die('Err id mail');
      $response['data'] = $this->mail_model->byId($id_mail);
      $this->view('api/json', $response);
   }

   public function insert() {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') \App\Classes\Helper::redirect("");
      $response['status'] = ERR_EMAIL;
      $data = [
         'id_professor' => filter_var($this->request->get("id_professor"), FILTER_VALIDATE_INT),
         '_id_student'  => filter_var($this->request->get("_id_student"), FILTER_VALIDATE_INT),
         'message'      => $_POST["message"],
         'subject'      => $_POST["subject"],
         'sender'       => $this->request->get('sender'),
      ];
      // check for valid ids
      if ($data['id_professor'] === false || $data['_id_student'] === false)
         die("error ids");
      if ($this->mail_model->addMail($data))
         $response["status"] = OK;

      $this->view("api/json", $response);

   }

   public function remove() {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') \App\Classes\Helper::redirect("");
      $response['status'] = ERR_EMAIL;
      $id_mail = filter_var($this->request->get('id_mail'), FILTER_VALIDATE_INT);
      if ($id_mail === false) die("Err id mail");

      if ($this->mail_model->removeMail($id_mail))
         $response['status'] = OK;
      $this->view('api/json', $response);
   }

}