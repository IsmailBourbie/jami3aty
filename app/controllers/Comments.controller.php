<?php
use App\Classes\Helper;

class Comments extends Controller {
   private $comment_model;
   private $request;

   public function __construct($request) {
      if ($_SERVER['REQUEST_METHOD'] == 'GET' && !Session::isLoggedIn()) {
         \App\Classes\Helper::redirect('users/login');
      }
      $this->request = $request;
      $this->comment_model = $this->model("Comment");
      $this->setAjax($this->request->get('ajax'));
   }

   public function index() {
      Helper::redirect("");
   }

   public function all() {
      if ($_SERVER['REQUEST_METHOD'] != "POST") Helper::redirect("");
      $response = [
         "status" => OK,
         "data"   => ""
      ];
      $id_post = filter_var($this->request->get("id_post"), FILTER_SANITIZE_NUMBER_INT);
      // check if there is empty data
      if (empty($id_post))
         die('Error in request data');
      $response["data"] = $this->comment_model->getAll($id_post);
      $this->view('api/json', $response);
   }

   public function edit() {
      if ($_SERVER['REQUEST_METHOD'] != "POST") Helper::redirect("");
      $response = [
         "status" => OK,
      ];
      $data = [
         'id_comment'  => filter_var($this->request->get("id_comment"), FILTER_SANITIZE_NUMBER_INT),
         'text_edited' => $_POST["text_edited"]
      ];
      // check if there is empty data
      if (empty($data['id_comment']) || empty($data['text_edited']))
         die('Error in request data');
      if (!$this->comment_model->editComment($data))
         $response['status'] = ERR_EMAIL;
      $this->view('api/json', $response);
   }

   public function add() {
      if ($_SERVER['REQUEST_METHOD'] != "POST") Helper::redirect("");
      $response = [
         "status" => OK,
      ];
      $data = [
         '_id_person' => filter_var($this->request->get("_id_person"), FILTER_SANITIZE_NUMBER_INT),
         'id_post'     => filter_var($this->request->get("id_post"), FILTER_SANITIZE_NUMBER_INT),
         'user_name'   => filter_var($this->request->get("user_name"), FILTER_SANITIZE_STRING),
         'text_added'  => $_POST["text_added"]
      ];
      // check if there is no username student from request
      $data['user_name'] = !empty($data['user_name']) ? $data['user_name'] : Session::get('user_fullname');
      // check if there is empty data
      if (empty($data['_id_person']) || empty($data['id_post']) || empty($data['user_name']) || empty($data['text_added']))
         die('Error in request data');
      if (!$this->comment_model->addComment($data))
         $response['status'] = ERR_EMAIL;
      $this->view('api/json', $response);
   }

   public function remove() {
      if ($_SERVER['REQUEST_METHOD'] != "POST") Helper::redirect("");
      $response = [
         "status" => OK,
      ];
      $id_comment = filter_var($this->request->get("id_comment"), FILTER_SANITIZE_NUMBER_INT);
      // check if there is empty data
      if (empty($id_comment))
         die('Error in request data');
      if (!$this->comment_model->removeComment($id_comment))
         $response['status'] = ERR_EMAIL;
      $this->view('api/json', $response);
   }
}
