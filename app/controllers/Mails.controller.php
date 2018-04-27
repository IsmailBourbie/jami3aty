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
      if ($_SERVER['REQUEST_METHOD'] != 'GET') \App\Classes\Helper::redirect("");
      $this->all();
   }

   public function all() {
      $response = [
         "page_title" => "Mails",
         "status"     => OK,
         "data"       => ""
      ];
      $_id_student = filter_var($this->request->get("_id_student"), FILTER_VALIDATE_INT);
      if ($_id_student === false) {
         $_id_student = Session::get('user_id');
         if (empty($_id_student)) {
            $response['status'] = ERR_EMAIL;
            $this->view("api/json", $response);
            return;
         }
      }
      $response['data'] = $this->mail_model->studentAllMails($_id_student);

      $this->view("mails/index", $response);
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

   public function profs() {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') \App\Classes\Helper::redirect("");
      $response = [
         "status" => OK,
         "data"   => ""
      ];
      $data = [
         'level'   => $this->request->get('level'),
         'section' => $this->request->get('section'),
         'group'   => $this->request->get('group'),
      ];
      if (empty($data['level']) || strlen($data['section']) == 0 || empty($data['group'])) {
         if (empty(Session::get('user_level'))) {
            die("empty data");
         } else {
            $data['level'] = Session::get('user_level');
            $data['section'] = Session::get('user_section');
            $data['group'] = Session::get('user_group');
         }
      }


      $response['data'] = $this->mail_model->getProfs($data);
      $this->view('api/json', $response);

   }

}