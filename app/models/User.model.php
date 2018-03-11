<?php

class User {
   private $db;

   public function __construct() {
      $this->db = new Database();
   }

   public function findUserByEmail($email) {


      $this->db->query('SELECT * FROM student WHERE email = :email');
      $this->db->bind(':email', $email);
      $row = $this->db->get();

      // Check row
      if ($this->db->rowCount() > 0) {
         return true;
      } else {
         return false;
      }
   }

   public function isUserExist($average, $card_number) {

      $this->db->query('SELECT * FROM student WHERE bac_average LIKE :bac_average AND _id_student =  :_id_student');
      $this->db->bind(':bac_average', $average);
      $this->db->bind(':_id_student', $card_number);
      $row = $this->db->get();
      // Check row
      if ($this->db->rowCount() > 0) {
         return true;
      } else {
         return false;
      }
   }

   public function getUserByToken($token) {
      $this->db->query('SELECT * FROM student WHERE token = :token');
      $this->db->bind(':token', $token);
      $row = $this->db->get();

      // Check row
      if ($this->db->rowCount() > 0) {
         return true;
      } else {
         return false;
      }
   }

   public function getUserByEmailAndToken($email, $token) {
      $this->db->query('SELECT * FROM student WHERE email = :email AND token = :token AND isConfirmed = 1');
      $this->db->bind(':email', $email);
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
      $this->db->query('UPDATE student SET isConfirmed = 1, token = " " WHERE token = :token');
      $this->db->bind(':token', $token);
      if ($this->db->execute()) {
         return true;
      } else {
         return false;
      }
   }

   public function getUser($email, $password) {
      $this->db->query('SELECT * FROM student WHERE email = :email');
      $this->db->bind(':email', $email);
      $row = $this->db->get();
      $hashed_password = $row->password;
//      password_verify($password, $hashed_password)
      if (true) {
         return $row;
      } else {
         return false;
      }
   }


   public function addUser($data) {
      $this->db->query('UPDATE student SET email = :email, password = :password, token = :token WHERE _id_student = :_id_student');
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);
      $this->db->bind(':_id_student', $data['number_card']);
      $this->db->bind(':token', $data['token']);
      if ($this->db->execute()) {
         return true;
      } else {
         return false;
      }
   }
}













