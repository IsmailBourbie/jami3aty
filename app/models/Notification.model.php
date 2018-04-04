<?php

/**
 * Created by PhpStorm.
 * User: IsMail BoUrbie
 * Date: 01/04/2018
 * Time: 16:58
 */
class Notification {
   private $db;

   public function __construct() {
      $this->db = new Database;
   }

   public function getAll($id) {
      $this->db->query("SELECT type, post._id_post,  
                                        concat( professor.degree , '. ' ,professor.first_name,' ' ,professor.last_name ) 
                                            AS fullName,
                                        saved_notification.seen,
                                        subject.title,post.date_post
                            FROM 
                            (
                               (saved_notification
                                  INNER JOIN post
                                    ON saved_notification.`_id_post` = post.`_id_post`
                                       AND saved_notification.`_id_student` = :_id_student)
                                  INNER JOIN professor on post.`_id_professor` = professor._id_professor
                                 )
                                 INNER JOIN subject ON post.`_id_subject` = subject.`_id_subject`
                                 ORDER BY post.date_post DESC ");
      $this->db->bind(':_id_student', $id);
      return \App\Classes\Helper::addColumnDateParsed($this->db->getAll());

   }
}