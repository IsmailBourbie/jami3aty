<?php

class Post {
   private $db;

   public function __construct() {
      $this->db = new Database;
   }

   public function getAllPosts($destination) {
      $pattern = "/^[1-9]{1,2}[.][0-9][.][0-9]{1,2}$/";
      if (empty($destination["level"])) {
         $destination["level"] = Session::get('user_level');
         $destination["section"] = Session::get('user_section');
         $destination["group"] = Session::get('user_group');
      }
      $destination = $destination['level'] . "." . $destination['section'] . "." . $destination['group'];
      if (!preg_match($pattern, $destination)) return false;
      $this->db->query("SELECT post.*, concat(professor.degree, '. ',
                                                  professor.first_name, ' ',
                                                   professor.last_name ) as fullName,
                                   subject.title , saved_notification.saved
                            FROM ((post INNER JOIN professor 
                                       on professor._id_professor = post._id_professor 
                                       AND post.destination = :destination) 
                            INNER JOIN subject ON post._id_subject = subject._id_subject) 
                            INNER JOIN saved_notification ON post._id_post = saved_notification._id_post");
      $this->db->bind(":destination", $destination);
      return \App\Classes\Helper::addColumnDateParsed($this->db->getAll());
   }

   public function getAllPostsProf($id_professor) {
      $this->db->query('SELECT post.*, subject.title 
                            FROM post  INNER JOIN subject 
                                           ON post._id_subject = subject._id_subject 
                                              WHERE _id_professor = :id_professor');
      $this->db->bind(':id_professor', $id_professor);
      return \App\Classes\Helper::addColumnDateParsed($this->db->getAll());
   }

   public function getPost($id_post, $id_student) {
      $this->setSeen($id_post, $id_student);
      $this->db->query("SELECT post.*, concat(professor.degree, '. ',
                                                  professor.first_name, ' ',
                                                   professor.last_name ) as fullName,
                                   subject.title 
                            FROM (post INNER JOIN professor 
                                       on professor._id_professor = post._id_professor 
                                       AND post._id_post= :id_post) 
                            INNER JOIN subject ON post._id_subject = subject._id_subject");
      $this->db->bind(":id_post", $id_post);
      return $this->db->get();
   }

   private function setSeen($id_post, $id_student) {
      $this->db->query("UPDATE saved_notification SET seen = 1 
                            WHERE _id_student = :_id_student AND _id_post = :id_post");

      $this->db->bind(":id_post", $id_post);
      $this->db->bind(":_id_student", $id_student);
      $this->db->execute();
   }

   // get prof info

   public function getprofInfo($id_professor) {
      $this->db->query('SELECT DISTINCT `group`, `section`, subject._id_subject,
                                                    subject.title, subject.level 
                            FROM assignment INNER JOIN subject 
                                            ON subject._id_subject = assignment._id_subject 
                            WHERE _id_professor = :id_professor ORDER BY subject._id_subject');
      $this->db->bind(':id_professor', $id_professor);
      return $this->db->getAll();
   }
}
