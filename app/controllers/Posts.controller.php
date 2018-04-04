<?php


class Posts extends Controller {
   private $post_model;
   private $request;

   public function __construct($request) {
      $this->request = $request;
      $this->post_model = $this->model("Post");
   }

   public function index() {
      echo "Posts/index";
   }

   public function all() {
      $data = $this->post_model->getAllPosts();
      $response = [
         'status' => OK,
         "data"   => $data
      ];
      header("Content-type: application/json");
      echo json_encode($response);
   }

   public function get() {
      $data = $this->post_model->getPost(2);
      header("Content-type: application/json");
      echo json_encode($data);
   }
}