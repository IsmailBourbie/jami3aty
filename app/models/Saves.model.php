<?php

class Saves {
   private $db;

   public function __construct() {
      // Connection To DataBase
      $this->db = new Database;
   }

   public function getAll($id) {
      $this->db->query("SELECT type,text_post,path_file,
                                        post._id_post,  
                                        concat( professor.degree , '. ' ,professor.first_name,' ' ,professor.last_name ) 
                                            AS fullName,
                                        subject.title,post.date
                            FROM 
                            (
                               (saved_notification
                                  INNER JOIN post
                                    ON saved_notification.`_id_post` = post.`_id_post`
                                       AND saved_notification.`_id_student` = :_id_student AND saved = 1)
                                  INNER JOIN professor on post.`_id_professor` = professor._id_professor
                                 )
                                 INNER JOIN subject ON post.`_id_subject` = subject.`_id_subject`");
      $this->db->bind(':_id_student', $id);
      return $this->db->getAll();

   }

   public function updateState($action_save, $id_post, $_id_student) {
      if (!preg_match("/^[01]?$/", $action_save)) {
         return false; // Err in url params Action accept just 1 or 0
      }
      $this->db->query("UPDATE  saved_notification SET saved = :action_save
                            where _id_student = :_id_student
                            and _id_post = :id_post");
      $this->db->bind(':action_save', $action_save);
      $this->db->bind(':_id_student', $_id_student);
      $this->db->bind(':id_post', $id_post);
      if ($this->db->execute())
         return true;
      return false;
   }
}