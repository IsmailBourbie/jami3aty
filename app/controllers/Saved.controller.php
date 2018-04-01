<?php


class Saved extends Controller {
   private $request;
   private $saved_pub;

   public function __construct($request) {
      if ($_SERVER['REQUEST_METHOD'] == "GET" && !Session::isLoggedIn()) {
         \App\Classes\Helper::redirect("");
      }
      $this->request = $request;
      $this->setAjax($this->request->get("ajax"));
      $this->saved_pub = $this->model("Saves");

   }

   public function index() {
      $this->all();
   }

   public function all() {
      $response = [
         'page_title' => "Saved",
         "status"     => OK,
      ];
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
         $id = $this->request->get("_id_student");
         $response['data'] = $this->saved_pub->getAll($id);
         $this->view("pages/saved", $response);
         return;
      }
      $id = $_SESSION['user_id'];
      $response['data'] = $this->saved_pub->getAll($id);
      $this->view("pages/saved", $response);
      return;
   }
}