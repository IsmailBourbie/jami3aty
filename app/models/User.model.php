<?php

class User {
   private $db;

   public function __construct() {
      $this->db = new Database();
   }

   public function findUserByEmail($email) {


      $this->db->query('SELECT * FROM jamiaty WHERE email = :email');
      $this->db->bind(':email', $email);
      $row = $this->db->get();

      // Check row
      if ($this->db->rowCount() > 0) {
         return true;
      } else {
         return false;
      }
   }

   public function getUser($email, $password) {
      $this->db->query('SELECT * FROM jamiaty WHERE email = :email AND password = :password');
      $this->db->bind(':email', $email);
      $this->db->bind(':password', $password);
      $row = $this->db->get();
      return $row;
   }
}













