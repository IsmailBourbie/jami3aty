<?php

use App\Classes\Helper;
use App\Classes\Mailer;

class Authentication {
   private $db;

   public function __construct() {
      $this->db = new Database();
   }

   public function findUserByEmail($email) {
      $this->db->query('SELECT * FROM professor WHERE email = :email');
      $this->db->bind(':email', $email);
      $row = $this->db->get();
      if ($this->db->rowCount() == 0) {
         $this->db->query('SELECT * FROM student WHERE email = :email');
         $this->db->bind(':email', $email);
         $row = $this->db->get();
      }
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
      $this->db->query('SELECT * FROM professor WHERE email = :email');
      $this->db->bind(':email', $email);
      $row = $this->db->get();
      if ($this->db->rowCount() == 0) {
         $this->db->query('SELECT * FROM student WHERE email = :email');
         $this->db->bind(':email', $email);
         $row = $this->db->get();
      }
      $hashed_password = isset($row->password) ? $row->password : "";
      if (password_verify($password, $hashed_password)) {
         unset($row->password, $row->token);
         return $row;
      } else {
         return false;
      }
   }


   public function addUser($data) {
      $data['token'] = Helper::generateToken(8);
      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
      $this->db->query('UPDATE student SET email = :email, password = :password, token = :token, student_active = 1 WHERE _id_student = :_id_student');
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);
      $this->db->bind(':_id_student', $data['card_num']);
      $this->db->bind(':token', $data['token']);
      if ($this->db->execute()) {
         return (new Mailer())->sendConfirmationEmail($data['email'], $data['token']);
      }
      return "";
   }


   public function updateToken($email) {
      $token = Helper::generateToken(8);
      $this->db->query('UPDATE student SET token = :token WHERE email = :email');
      $this->db->bind(':token', $token);
      $this->db->bind(':email', $email);
      if ($this->db->execute()) {
         return (new Mailer())->sendConfirmationEmail($email, $token);
      }
      return false;
   }

   public function findUserByToken($token) {
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

   public function confirmEmail($token) {
      $this->db->query('UPDATE student SET isConfirmed = 1, token = " " WHERE token = :token');
      $this->db->bind(':token', $token);
      if ($this->db->execute()) {
         return true;
      } else {
         return false;
      }
   }
}