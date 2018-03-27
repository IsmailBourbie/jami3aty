<?php

class Home extends Controller {


   public function __construct() {
      if (!Session::isLoggedIn()) {
         Directions::redirect('users/login');
      }
   }

   public function index($args = "") {
      $data = [
         "page_title" => __CLASS__,
      ];
      $this->view("pages/index", $data);
   }


}
