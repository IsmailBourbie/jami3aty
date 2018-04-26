<?php

class Mark {
   private $db;

   public function __construct() {
      $this->db = new Database;
   }

   public function getMarks($_id_student) {
      $this->db->query("SELECT DISTINCT marks.*, subject.title, subject.short_title 
                            FROM `marks` INNER JOIN subject 
                                         ON subject._id_subject = marks._id_subject 
                            WHERE marks._id_student =:_id_student");

      $this->db->bind(":_id_student", $_id_student);
      return $this->db->getAll();
   }
}