<?php

class Pages extends Controller {


   public function __construct() {
   }

   public function index($args = "") {
      if (!isLoggedIn()) {
         redirect('users/login');
      }
      $data = [];
      $this->view("pages/index", $data);
   }

}