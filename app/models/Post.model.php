<?php
 class Post {
     private $db;

     public function __construct() {
         // Connection To DataBase
         $this->db = new Database;
     }

     public function getUser() {
         $this->db->query("SELECT * FROM users");
         return $this->db->getAll();
     }

 }