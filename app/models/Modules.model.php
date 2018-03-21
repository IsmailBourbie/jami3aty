<?php

class Modules {
   private $db;

   public function __construct() {
      // Connection To DataBase
      $this->db = new Database;
   }

   public function getModules($id) {
      $this->db->query("SELECT  subject.*,
                                   professor.first_name,
                                   professor.last_name,
                                   professor.degree,
                                   assignment.type
                            FROM (((student
                            INNER JOIN subject ON student.level = subject.level 
                                               AND _id_student = :_id_student)
                            INNER JOIN assignment ON (assignment.group IN (0, student.group)) 
                                                  AND subject._id_subject = assignment._id_subject 
                                                  AND student.section = assignment.section)
                            INNER JOIN professor ON professor._id_professor = assignment._id_professor)");
      $this->db->bind(':_id_student', $id);
      return $this->db->getAll();
   }

}