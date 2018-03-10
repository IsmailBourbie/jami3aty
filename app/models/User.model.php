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

   public function getUserByToken($token) {
      $this->db->query('SELECT * FROM jamiaty WHERE token = :token');
      $this->db->bind(':token', $token);
      $row = $this->db->get();

      // Check row
      if ($this->db->rowCount() > 0) {
         return true;
      } else {
         return false;
      }
   }

   public function confirmEmail($token) {
      $this->db->query('UPDATE jamiaty SET isConfirmed = 1, token = " " WHERE token = :token');
      $this->db->bind(':token', $token);
      if ($this->db->execute()) {
         return true;
      } else {
         return false;
      }
   }

   public function getUser($email, $password) {
      $this->db->query('SELECT * FROM jamiaty WHERE email = :email');
      $this->db->bind(':email', $email);
      $row = $this->db->get();
      $hashed_password = $row->password;
      if (password_verify($password, $hashed_password)) {
         return $row;
      } else {
         return false;
      }
   }


   public function addUser($data) {
      $this->db->query('INSERT INTO jamiaty (email, password, token) VALUES (:email, :password, :token)');
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);
      $this->db->bind(':token', $data['token']);
      if ($this->db->execute()) {
         return true;
      } else {
         return false;
      }
   }
}













