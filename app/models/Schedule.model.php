<?php


class Schedule {
   private $db;

   public function __construct() {
      $this->db = new Database();
   }

   public function getSchedule($level, $section, $group) {
      $this->db->query("SELECT subject.title, subject.level, 
                                   assignment.group, assignment.section, 
                                   assignment.type, 
                                   concat(professor.degree , '. ',professor.first_name, ' ',
                                   professor.last_name) AS fullName,
                                   schedule.day_schedule, schedule.hour_start_schedule, 
                                   schedule.place 
                            FROM (
                              (schedule 
                              INNER JOIN assignment 
                                ON schedule._id_assign = assignment._id_assign 
                                AND assignment.section = :section
                                AND assignment.group in(0,:group)) 
                              INNER JOIN subject 
                                ON assignment._id_subject = subject._id_subject 
                                AND subject.level = :level
                            )
                            INNER JOIN professor 
                              ON assignment._id_professor = professor._id_professor 
                              ORDER BY schedule.day_schedule , schedule.hour_start_schedule ASC");
      $this->db->bind(":level", $level);
      $this->db->bind(":section", $section);
      $this->db->bind(":group", $group);

      $rows = $this->db->getAll();
      return $rows;
   }

}

