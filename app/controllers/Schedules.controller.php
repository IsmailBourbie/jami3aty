<?php

class Schedules extends Controller {

   public function __construct() {
      $this->scheduleModel = $this->model('Schedule');
   }

   public function index() {
      $response = $this->scheduleModel->getSchedule(6, 0, 2);
      $moduleMold = [
         "title"    => "",
         "type"     => "",
         "fullName" => "",
         "place"    => "",
      ];
      $dayMold = [
         "1" => $moduleMold,
         "2" => $moduleMold,
         "3" => $moduleMold,
         "4" => $moduleMold,
         "5" => $moduleMold,
         "6" => $moduleMold,
         "7" => $moduleMold
      ];
      $scheduleMold = [
         "1" => $dayMold,
         "2" => $dayMold,
         "3" => $dayMold,
         "4" => $dayMold,
         "5" => $dayMold,
      ];
      for ($i = 0; $i < count($response); $i++) {
         $response[$i] = (array)$response[$i];
         $day = $response[$i]["day_schedule"];
         $hour = $response[$i]["hour_start_schedule"];
         $scheduleMold[$day][$hour] = $response[$i];
         // unset data
         $scheduleMold[$day] = unsetData($scheduleMold[$day], ["day_schedule",
                                                               "hour_start_schedule",
                                                               "level", "section",
                                                               "group"]);
      }
      die(var_dump($scheduleMold));


      $data = [
         "page_title" => "Planning",
         "status"     => OK,
         "data"       => $response
      ];
      echo json_encode($scheduleMold);
      die();
      $this->view('schedules/index', $data);
   }

}
