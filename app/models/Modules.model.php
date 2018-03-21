<?php

class Modules {
   private $db;

   public function __construct() {
      // Connection To DataBase
      $this->db = new Database;
   }

   public function getModules() {
      $this->db->query("SELECT subject.*, 
                                   assignment.type, 
                                   concat(professor.degree , ' ' , 
                                   professor.first_name , ' ', 
                                   professor.last_name) 
                            as fullName
                            FROM ((subject
                            INNER JOIN assignment
                                  ON (assignment.group 
                                  IN (0,1)) AND subject._id_subject = assignment._id_subject 
                                  AND assignment.section = :section and subject.level = :level)
                            INNER JOIN professor 
                                  ON professor._id_professor = assignment._id_professor)");
      $this->db->bind(':level', $_SESSION["user_level"]);
      $this->db->bind(':section', $_SESSION["user_section"]);
      return $this->db->getAll();
   }
}