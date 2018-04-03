<?php

class Post {
   private $db;

   public function __construct() {
      $this->db = new Database;
   }

   public function getAllPosts() {
      $this->db->query("");

   }

   public function getPost() {

   }

}

