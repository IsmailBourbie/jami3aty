<?php


class Mails extends Controller {
   private $mail_model;
   private $request;

   public function __construct($request) {
      if ($_SERVER['REQUEST_METHOD'] == 'GET' && !Session::isLoggedIn()) {
         \App\Classes\Helper::redirect('users/login');
      }
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
         "page_title" => "Messages",
         "status"     => OK,
         "data"       => ""
      ];
      $id = filter_var($this->request->get("id"), FILTER_VALIDATE_INT);
      $type = filter_var($this->request->get("type"), FILTER_VALIDATE_INT);
      if ($id === false || $type === false) {
         $type = 1;
         $id = Session::get('user_id');
         if (empty($id)) {
            $response['status'] = ERR_EMAIL;
            $this->view("api/json", $response);
            return;
         }
      }
      if (!Session::isProf())
         $type = 2;
      $response['data'] = $this->mail_model->allMails($id, $type);

      $this->view("mails/index", $response);
   }

   public function id($id = null) {
      if ($_SERVER['REQUEST_METHOD'] == 'GET' && is_null($id))
         \App\Classes\Helper::redirect("");
      $response = [
         "page_title" => 'Message',
         "status" => OK,
         "data"   => ""
      ];
      $id_mail = filter_var($this->request->get('id_mail'), FILTER_VALIDATE_INT);
      if ($id_mail === false) {
         $id_mail = filter_var($id, FILTER_VALIDATE_INT);
         if ($id === false) die('invalid id');
      }

      $response['data'] = $this->mail_model->byId($id_mail);
      $this->view('mails/byid', $response);
   }

   public function insert() {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') \App\Classes\Helper::redirect("");
      $response['status'] = ERR_EMAIL;
      $data = [
         'id_professor' => filter_var($this->request->get("id_professor"), FILTER_VALIDATE_INT),
         '_id_student'  => filter_var($this->request->get("_id_student"), FILTER_VALIDATE_INT),
         'message'      => $_POST["message"],
         'subject'      => $_POST["subject"],
         'sender'       => filter_var($this->request->get('sender'), FILTER_VALIDATE_INT),
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