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
                                   subject.title 
                            FROM (post INNER JOIN professor 
                                       on professor._id_professor = post._id_professor 
                                       AND post.destination = :destination) 
                            INNER JOIN subject ON post._id_subject = subject._id_subject");
      $this->db->bind(":destination", $destination);
      return $this->db->getAll();
   }

   public function getPost($id_post) {
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

}

