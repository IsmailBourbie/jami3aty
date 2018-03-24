<?php

class Schedules extends Controller {

   public function __construct() {
      $this->scheduleModel = $this->model('Schedule');
   }

   public function index() {
      $response = $this->scheduleModel->getSchedule(6, 0, 2);
      $data = [
         "page_title" => "Planning",
         "status" => OK,
         "data" => $response
      ];

      header('Content-type: application/json');
      $this->view('api/json', $response);
   }

}