<?php


class Schedule {
   private $db;

   public function __construct() {
      $this->db = new Database();
   }

   public function getSchedule($level, $section, $group) {
      $this->db->query("SELECT subject.title,
                                   CONCAT(professor.degree, '. ',
                                          professor.first_name,
                                          professor.last_name) AS fullName,
                                   SCHEDULE.day_schedule,
                                   SCHEDULE.hour_start_schedule,
                                   SCHEDULE.place
                            FROM (
                               ( SCHEDULE
                               INNER JOIN assignment 
                                 ON SCHEDULE._id_assign = assignment._id_assign 
                                 AND assignment.section = :section 
                                 AND assignment.group IN(0, :group)
                               )
                               INNER JOIN SUBJECT 
                                 ON assignment._id_subject = SUBJECT._id_subject 
                                 AND SUBJECT.level = :level
                            )
                            INNER JOIN professor 
                            ON assignment._id_professor = professor._id_professor");
      $this->db->bind(":level", $level);
      $this->db->bind(":section", $section);
      $this->db->bind(":group", $group);

      $rows = $this->db->getAll();
      return $rows;
   }

}



















