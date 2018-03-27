<?php

class Schedules extends Controller {
   private $_scheduleMold;

   private $scheduleModel;

   /**
    * Schedules constructor.
    */
   public function __construct() {
      if ($_SERVER["REQUEST_METHOD"] == "GET" && !Session::isLoggedIn()) {
         Directions::redirect("");
      }
      $this->createScheduleMold();
      $this->scheduleModel = $this->model('Schedule');
   }

   public function index() {
      $level = $_SESSION["user_level"];
      $section = $_SESSION["user_section"];
      $group = $_SESSION["user_group"];
      $data = $this->scheduleModel->getSchedule($level, $section, $group);
      $data = $this->arrangSchedule($data);

      $response = [
         "page_title" => "Planning",
         "status"     => OK,
         "data"       => $data
      ];
      $this->view('schedules/index', $response);
   }

   public function all($level = "", $section = "", $group = "") {
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
         // Request from Client side
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_NUMBER_INT);
         $args = [
            "level"   => $_POST['level'],
            "section" => $_POST['section'],
            "group"   => $_POST['group'],
         ];
         $response = [
            'status'  => OK,
            'data'    => "",
            "level"   => $_POST['level'],
            "section" => $_POST['section'],
            "group"   => $_POST['group'],
         ];
         if (strlen($args["level"]) == 0 || strlen($args["section"]) == 0 || strlen($args['group']) == 0) {
            // There is Errors
            $response["status"] = ERR_EMAIL;
         } else {
            $data = $this->scheduleModel->getSchedule($args['level'], $args["section"], $args['group']);
            $response["data"] = $data;
            header('Content-type: application/json');
            $this->view('api/json', $response);
         }
      } else {
         die("you request an other level");
      }

   }

   private function createScheduleMold() {
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
      $this->_scheduleMold = [
         "1" => $dayMold,
         "2" => $dayMold,
         "3" => $dayMold,
         "4" => $dayMold,
         "5" => $dayMold,
      ];
   }

   private
   function arrangSchedule($schedule) {
      for ($i = 0; $i < count($schedule); $i++) {
         $schedule[$i] = (array)$schedule[$i];
         $day = $schedule[$i]["day_schedule"];
         $hour = $schedule[$i]["hour_start_schedule"];
         $this->_scheduleMold[$day][$hour] = $schedule[$i];
         // unset data
         $this->_scheduleMold[$day] = FormatData::unsetData($this->_scheduleMold[$day], ["day_schedule",
                                                                                         "hour_start_schedule",
                                                                                         "level", "section",
                                                                                         "group"]);
      }
      return $this->_scheduleMold;
   }
}
























