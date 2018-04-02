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

   public function state($action = "", $id_post = "") {
      // Sanitize Data
      $data = [
         "action"      => $action,
         "id_post"     => filter_var($id_post, FILTER_SANITIZE_NUMBER_INT),
         "_id_student" => $_SESSION["user_id"]
      ];
      $response = [
         'page_title' => "Saved",
         'status'     => OK
      ];
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
         // Check if the request is Post for android
         $data["action"] = $this->request->get('action');
         $data["id_post"] = filter_var($this->request->get('id_post'), FILTER_SANITIZE_NUMBER_INT);
         $data["_id_student"] = filter_var($this->request->get('_id_student'), FILTER_SANITIZE_NUMBER_INT);
      }
      if (!$this->saved_pub->updateState($data["action"], $data["id_post"], $data["_id_student"])) {
         // if there is a problem
         die("Error in params action");
      }
      // if you are here so everything is okay
      if (!empty($this->request->get("ajax")))
         return $this->view("", $response);
      \App\Classes\Helper::redirect("saved");
      return;
   }
}