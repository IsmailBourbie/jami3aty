<?php

class Module {
   private $db;

   public function __construct() {
      // Connection To DataBase
      $this->db = new Database;
   }

   public function getModules($level, $section, $group) {
      $this->db->query("SELECT DISTINCT subject.*, 
                                   assignment.type, 
                                   concat(professor.degree , '. ' , 
                                   professor.first_name , ' ', 
                                   professor.last_name) 
                            as fullName
                            FROM ((subject
                            INNER JOIN assignment
                                  ON (assignment.group 
                                  IN (0,:group)) AND subject._id_subject = assignment._id_subject 
                                  AND assignment.section = :section and subject.level = :level)
                            INNER JOIN professor 
                                  ON professor._id_professor = assignment._id_professor)
                                  ORDER BY subject.coefficient, subject.title DESC ");
      $this->db->bind(':level', $level);
      $this->db->bind(':section', $section);
      $this->db->bind(':group', $group);
      return $this->db->getAll();
   }

   public function getProfModules($id_professor) {
      $this->db->query("SELECT DISTINCT subject.*, 
                                   assignment.type, 
                                   concat(professor.degree , '. ' , 
                                   professor.first_name , ' ', 
                                   professor.last_name) 
                            as fullName 
                            FROM((
                                    assignment INNER JOIN subject 
                                    ON subject._id_subject = assignment._id_subject
                                    AND (assignment._id_professor = :id_professor) 
                                    AND subject.`_id_subject` = assignment.`_id_subject` )
                                    INNER JOIN professor 
                                    ON professor.`_id_professor` = assignment.`_id_professor`)
                                    ORDER BY subject.coefficient, subject.title DESC ");
      $this->db->bind(':id_professor', $id_professor);
      return $this->db->getAll();
   }
}

