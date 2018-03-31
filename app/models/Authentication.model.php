<?php

class Authentication {
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
         return $row->email;
      }
      return "";
   }

   public function isUserExistByAverage($average, $num_card) {

      $this->db->query('SELECT * FROM student WHERE bac_average LIKE :bac_average AND _id_student = :_id_student');
      $this->db->bind(':bac_average', $average);
      $this->db->bind(':_id_student', $num_card);
      $row = $this->db->get();
      // Check row
      if ($this->db->rowCount() > 0) {
         return $row->bac_average;
      }
      return "";
   }

   public function isUserExistByNumCard($card_number) {
      $this->db->query('SELECT * FROM student WHERE _id_student =  :_id_student AND student_active = 0');
      $this->db->bind(':_id_student', $card_number);
      $row = $this->db->get();
      // Check row
      if ($this->db->rowCount() > 0) {
         return $row->_id_student;
      }
      return '';
   }

   public function getUser($email, $password) {
      $this->db->query('SELECT * FROM student WHERE email = :email');
      $this->db->bind(':email', $email);
      $row = $this->db->get();
      $hashed_password = isset($row->password) ? $row->password : "";
      if (password_verify($password, $hashed_password)) {
         return $row;
      } else {
         return false;
      }
   }


   public function addUser($data) {
      $this->db->query('UPDATE student SET email = :email, password = :password, token = :token, student_active = 1 WHERE _id_student = :_id_student');
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













