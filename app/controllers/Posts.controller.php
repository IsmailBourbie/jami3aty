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

   }
}