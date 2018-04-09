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
      $response = [
         'page_title' => "Notifications",
         "status"     => OK,
      ];
      $this->view("pages/notifications", $response);
   }

   public function all() {
      if ($_SERVER['REQUEST_METHOD'] != "POST") \App\Classes\Helper::redirect("");
      $response = [
         'page_title' => "Notifications",
         "status"     => OK,
      ];
      $id = !empty($this->request->get("_id_student")) ? $this->request->get("_id_student") : Session::get("user_id");
      $response['data'] = $this->notif->getAll($id);
      $this->view("pages/notifications", $response);
      return;
   }
}