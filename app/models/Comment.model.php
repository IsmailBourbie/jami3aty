<?php

/**
 * Created by PhpStorm.
 * User: IsMail BoUrbie
 * Date: 13/04/2018
 * Time: 17:23
 */
class Comment {
   private $db;

   public function __construct() {
      $this->db = new Database;
   }

   public function getAll($id_post) {
      $this->db->query("SELECT * FROM comments WHERE comments._id_post = :id_post");
      $this->db->bind(':id_post', $id_post);
      return \App\Classes\Helper::addColumnDateParsed($this->db->getAll());
   }

   public function editComment($data) {
      $this->db->query("UPDATE comments SET comments.text_comment= :text_edited,
                                                comments.date = UNIX_TIMESTAMP() 
                            WHERE comments._id_comments = :id_comment");
      $this->db->bind(':id_comment', $data['id_comment']);
      $this->db->bind(':text_edited', $data['text_edited']);
      if ($this->db->execute())
         return true;
      return false;
   }

   public function addComment($data) {
      $this->db->query("INSERT INTO comments 
                                   VALUES(NULL, :id_post, :_id_person, UNIX_TIMESTAMP(),
                                          :text_added, :user_name);
                     ");
      $this->db->bind(':id_post', $data['id_post']);
      $this->db->bind(':_id_person', $data['_id_person']);
      $this->db->bind(':text_added', $data['text_added']);
      $this->db->bind(':user_name', $data['user_name']);
      if ($this->db->execute())
         return true;
      return false;
   }

   public function removeComment($id_comment) {
      $this->db->query("DELETE FROM comments WHERE comments._id_comments = :id_comment");
      $this->db->bind(':id_comment', $id_comment);
      if ($this->db->execute())
         return true;
      return false;
   }
}
