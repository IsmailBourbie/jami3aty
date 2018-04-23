<?php

class Mark {
   private $db;

   public function __construct() {
      $this->db = new Database;
   }

   public function getMarks($_id_student) {
      $this->db->query("SELECT marks.*, subject.title, subject.short_title, subject.level 
                            FROM marks INNER JOIN subject 
                            WHERE marks._id_student = :_id_student");
      $this->db->bind(":_id_student", $_id_student);
      return $this->db->getAll();
   }
}