<?php


class Posts extends Controller {
   private $post_model;
   private $request;

   public function __construct($request) {
      $this->request = $request;
      $this->post_model = $this->model("Post");
      $this->setAjax($this->request->get('ajax'));
   }

   public function index() {
      echo "Posts/index";
   }

   public function all() {
      // if direct access redirect to main page
      if ($_SERVER["REQUEST_METHOD"] != "POST") \App\Classes\Helper::redirect("");
      // init response
      $response = [
         'status' => OK,
         "data"   => ""
      ];
      // sanitize data from post request
      $post_data = [
         "level"   => filter_var($this->request->get('level'), FILTER_SANITIZE_NUMBER_INT),
         "section" => filter_var($this->request->get("section"), FILTER_SANITIZE_NUMBER_INT),
         "group"   => filter_var($this->request->get('group'), FILTER_SANITIZE_NUMBER_INT),
      ];
      // check the response from model
      if (!$this->post_model->getAllPosts($post_data)) {
         $response["status"] = 300;
      } else {
         $response["data"] = $this->post_model->getAllPosts($post_data);
      }
      $this->view("api/json", $response);
   }

   public function get($id_post = "") {
      //init response
      $response = [
         'page_title' => __CLASS__,
         'status' => OK,
         "data"   => ""
      ];
      // get the id from the url
      $id_post = filter_var($id_post, FILTER_SANITIZE_NUMBER_INT);
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // change
         $id_post = filter_var($this->request->get('id_post'), FILTER_SANITIZE_NUMBER_INT);
      }
      if (!$this->post_model->getPost($id_post)) {
         $response["status"] = 300;
         $this->view("", $response);
         return;
      }
      $response["data"] = $this->post_model->getPost($id_post);
      $this->view("pages/post", $response);
   }
}