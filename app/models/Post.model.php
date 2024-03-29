<?php

class Post {
   private $db;

   public function __construct() {
      $this->db = new Database;
   }

   public function getAllPosts($destination) {
      $pattern = "/^[1-9]{1,2}[.][0-9][.][0-9]{1,2}$/";
      $_id_student = $destination['_id_student'];
      if (empty($destination["level"])) {
         $destination["level"] = Session::get('user_level');
         $destination["section"] = Session::get('user_section');
         $destination["group"] = Session::get('user_group');
      }
      $destinationTo = $destination['level'] . "." . $destination['section'] . "." . $destination['group'];
      $destinationAll = $destination['level'] . "." . $destination['section'] . ".0";
      if (!preg_match($pattern, $destinationTo)) return false;
      $this->db->query("SELECT DISTINCT post.*, concat(professor.degree, '. ',
                                                  professor.first_name, ' ',
                                                   professor.last_name ) as fullName,
                                   subject.title , saved_notification.saved
                            FROM ((post INNER JOIN professor 
                                       on professor._id_professor = post._id_professor 
                                       AND (post.destination = :destination OR post.destination = :destinationAll)) 
                            INNER JOIN subject ON post._id_subject = subject._id_subject) 
                            INNER JOIN saved_notification ON post._id_post = saved_notification._id_post
                            WHERE saved_notification._id_student = :_id_student
                            ORDER BY post.date DESC");
      $this->db->bind(":destination", $destinationTo);
      $this->db->bind(":destinationAll", $destinationAll);
      $this->db->bind(":_id_student", $_id_student);
      return \App\Classes\Helper::addColumnDateParsed($this->db->getAll());
   }

   public function getAllPostsProf($id_professor) {
      $this->db->query('SELECT DISTINCT post.*, subject.title 
                            FROM post  INNER JOIN subject 
                                           ON post._id_subject = subject._id_subject 
                                              WHERE _id_professor = :id_professor
                                              ORDER BY post.date DESC');
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

   // add post by prof
   public function addNewPost($data) {
      $pattern = "/^[1-9]{1,2}[.][0-9][.][0-9]{1,2}$/";
      if (empty($data["level"])) {
         $data["level"] = Session::get('user_level');
         $data["section"] = Session::get('user_section');
         $data["group"] = Session::get('user_group');
      }
      $destination = $data['level'] . "." . $data['section'] . "." . $data['group'];
      if (!preg_match($pattern, $destination)) return false;
      $this->db->query('INSERT INTO post VALUES (null,:id_professor, :id_subject, :type, :destination,
                                                  :text,:file,UNIX_TIMESTAMP())');
      $this->db->bind(':id_professor', $data['id_professor']);
      $this->db->bind(':id_subject', $data['id_subject']);
      $this->db->bind(':type', $data['type']);
      $this->db->bind(':destination', $destination);
      $this->db->bind(':text', $data['text_post']);
      $this->db->bind(':file', $data['path_file']);

      if ($this->db->execute())
         return $this->db->lastInsertId();
      return false;
   }

   public function insertTrace($id_post) {
      $this->db->query('INSERT INTO trace VALUES(
                            null, :id_post,"ADD", UNIX_TIMESTAMP())');
      $this->db->bind(':id_post', $id_post);
      if ($this->db->execute())
         return true;
      return false;
   }

   public function insertNotification($id_student, $id_post) {
      $this->db->query('INSERT INTO saved_notification VALUES(
                            :id_post, :id_student, 0, 0)');
      $this->db->bind(':id_post', $id_post);
      $this->db->bind(':id_student', $id_student);
      if ($this->db->execute())
         return true;
      return false;
   }

   public function usersInterested($data) {
      $this->db->query('SELECT _id_student FROM student 
                            WHERE `level` = :level AND `section`= :section AND `group` = :group');
      $this->db->bind(':level', $data['level']);
      $this->db->bind(':section', $data['section']);
      $this->db->bind(':group', $data['group']);
      return $this->db->getAll();
   }
   public function usersInterestedAll($data) {
      $this->db->query('SELECT _id_student FROM student 
                            WHERE `level` = :level AND `section`= :section');
      $this->db->bind(':level', $data['level']);
      $this->db->bind(':section', $data['section']);
      return $this->db->getAll();
   }
}
