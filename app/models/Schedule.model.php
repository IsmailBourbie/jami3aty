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
   public function getScheduleProf($id_professor) {
      $this->db->query("SELECT subject.title, subject.level, assignment.group,
                                   assignment.type ,assignment.section,
                                   concat(professor.degree , '. ',professor.first_name, ' ', professor.last_name) AS fullName,
                                   schedule.day_schedule, schedule.hour_start_schedule, schedule.place 
                            FROM ((schedule INNER JOIN assignment 
                                               ON schedule.`_id_assign` = assignment.`_id_assign` 
                                               AND assignment._id_professor = :id_professor) 
                                            INNER JOIN subject 
                                               ON assignment.`_id_subject` = subject.`_id_subject` ) 
                                            INNER JOIN professor 
                                               ON assignment.`_id_professor` = professor.`_id_professor`
                                               ORDER BY schedule.day_schedule , subject.title ASC");
      $this->db->bind(":id_professor", $id_professor);

      $rows = $this->db->getAll();
      return $rows;
   }

   public function getScheduleByDay($day) {
      $level = $_SESSION["user_level"];
      $section = $_SESSION["user_section"];
      $group = $_SESSION["user_group"];
      $this->db->query("SELECT subject.title, 
                                   assignment.type,
                                   schedule.day_schedule, schedule.hour_start_schedule, 
                                   schedule.place
                            FROM (
                              (schedule 
                              INNER JOIN assignment 
                                ON schedule._id_assign = assignment._id_assign 
                                AND assignment.section = :section
                                AND assignment.group in(0,:group)
                                AND schedule.day_schedule = :day)
                              INNER JOIN subject 
                                ON assignment._id_subject = subject._id_subject 
                                AND subject.level = :level
                            )
                            INNER JOIN professor 
                              ON assignment._id_professor = professor._id_professor 
                              ORDER BY schedule.day_schedule , schedule.hour_start_schedule ASC");
      $this->db->bind(":day", $day);
      $this->db->bind(":level", $level);
      $this->db->bind(":section", $section);
      $this->db->bind(":group", $group);
      $row = $this->db->getAll();
      return $row;
   }
}

