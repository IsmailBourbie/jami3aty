<?php

/**
 * Created by PhpStorm.
 * User: IsMail BoUrbie
 * Date: 23/04/2018
 * Time: 23:51
 */
class Marks extends Controller {
   private $mark_model;
   private $request;

   public function __construct($request) {
      $this->request = $request;
      $this->mark_model = $this->model('Mark');
      $this->setAjax($this->request->get('ajax'));
   }

   public function index() {

   }

   public function all() {
      $response = [
         "page_title" => "Notes",
         "status"     => OK,
         "data"       => ""
      ];
      $_id_student = filter_var($this->request->get("_id_student"), FILTER_VALIDATE_INT);
      if ($_id_student === false) {
         $_id_student = Session::get('user_id');
         if (empty($_id_student)) {
            $response['status'] = ERR_EMAIL;
            $this->view("Marks/index", $response);
            return;
         }
      }

      $response['data'] = $this->mark_model->getMarks($_id_student);
      $this->view("Marks/index", $response);
   }

}