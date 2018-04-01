<?php

class Notifications extends Controller {
   private $notif;
   private $request;

   public function __construct($request) {
      if ($_SERVER['REQUEST_METHOD'] == "GET" && !Session::isLoggedIn()) {
         \App\Classes\Helper::redirect("");
      }
      $this->request = $request;
      $this->setAjax($this->request->get("ajax"));
      $this->notif = $this->model("Notification");

   }

   public function index() {
      $this->all();
   }

   public function all() {
      $response = [
         'page_title' => "Notifications",
         "status"     => OK,
      ];
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
         $id = $this->request->get("_id_student");
         $response['data'] = $this->notif->getAll($id);
         $this->view("pages/notifications", $response);
         return;
      }
      $id = $_SESSION['user_id'];
      $response['data'] = $this->notif->getAll($id);
      $this->view("pages/notifications", $response);
      return;
   }

}