<?php

class Post {
   private $db;

   public function __construct() {
      $this->db = new Database;
   }

   public function getAllPosts() {
      $destination = '6.0.3';
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

