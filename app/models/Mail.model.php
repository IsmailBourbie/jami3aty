<?php


class Mail {
   private $db;

   public function __construct() {
      $this->db = new Database;
   }

   public function studentAllMails($_id_student) {
      $this->db->query("SELECT mail._id_mail, mail.message,
                                   mail.subject, mail.date,
                                   mail.sender , mail._id_professor,
                                   mail._id_student,
                                   concat( student.first_name , ' ',
                                                        student.last_name) AS fullNameS,
                                   concat(professor.degree, '. ',                                  professor.first_name , ' ',
                                          professor.last_name) AS fullNameP
                             FROM ((mail INNER JOIN professor 
                                        ON professor._id_professor = mail._id_professor 
                                        AND mail._id_student = :_id_student) inner join student on mail._id_student = student._id_student) ORDER BY mail.date DESC");
      $this->db->bind(':_id_student', $_id_student);
      return $this->db->getAll();
   }

   public function bySender($_id_student, $sender) {
      $this->db->query("SELECT mail._id_mail, mail.message,
                                   mail.subject, mail.date,
                                   mail.sender , concat(professor.degree, '. ',
                                                        professor.first_name , ' ',
                                                        professor.last_name) AS fullNameP
                             FROM (mail INNER JOIN professor 
                                        ON professor._id_professor = mail._id_professor 
                                        AND mail._id_student = :_id_student AND mail.sender = :sender)");
      $this->db->bind(':_id_student', $_id_student);
      $this->db->bind(':sender', $sender);
      return $this->db->getAll();
   }

   public function byId($id_mail) {
      $this->db->query("SELECT mail._id_mail, mail.message,
                                   mail.subject, mail.date, mail.sender,
                                   concat(professor.degree, '. ', professor.first_name,
                                   ' ', professor.last_name) as fullNameP 
                            FROM (mail INNER JOIN professor 
                                       ON professor._id_professor = mail._id_professor 
                                       AND mail._id_mail= :id_mail)");
      $this->db->bind(':id_mail', $id_mail);
      return $this->db->get();
   }

   public function addMail($data) {
      $this->db->query("INSERT INTO mail (_id_mail, _id_professor, _id_student, message, subject, `date`, sender)
                            VALUES(NULL, :_id_professor, :_id_student, :message, :subject, UNIX_TIMESTAMP(), :sender)");
      $this->db->bind(':_id_professor', $data['id_professor']);
      $this->db->bind(':_id_student', $data['_id_student']);
      $this->db->bind(':message', $data['message']);
      $this->db->bind(':subject', $data['subject']);
      $this->db->bind(':sender', $data['sender']);
      if ($this->db->execute())
         return true;
      return false;
   }

   public function removeMail($id_mail) {
      $this->db->query("DELETE FROM mail WHERE mail._id_mail= :id_mail");
      $this->db->bind(':id_mail', $id_mail);
      if ($this->db->execute())
         return true;
      return false;
   }

   public function getProfs($data) {
      $this->db->query("SELECT DISTINCT professor._id_professor,
                                            concat(professor.degree, '. ',
                                            professor.first_name, ' ',
                                            professor.last_name) AS fullName
                            FROM ((subject INNER JOIN assignment
                                  ON (assignment.`group` 
                                  IN (0,:group)) 
                                  AND subject.`_id_subject` = assignment.`_id_subject` 
                                  AND assignment.section = :section AND subject.level = :level)
                            INNER JOIN professor 
                                  ON professor.`_id_professor` = assignment.`_id_professor`)");
      $this->db->bind(':level', $data['level']);
      $this->db->bind(':section', $data['section']);
      $this->db->bind(':group', $data['group']);
      return $this->db->getAll();
   }

}