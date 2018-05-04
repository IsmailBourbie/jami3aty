<?php

use App\Classes\Helper;
use App\Classes\Schedule;

class Schedules extends Controller {
   private $_schedule;
   private $scheduleModel;

   /**
    * Schedules constructor.
    */
   public function __construct() {
      if ($_SERVER["REQUEST_METHOD"] == "GET" && !Session::isLoggedIn()) {
         Helper::redirect("");
      }
      $this->_schedule = new Schedule();
      $this->scheduleModel = $this->model('Schedule');
   }

   public function index() {
      $level = Session::get("user_level");
      $section = Session::get("user_section");
      $group = Session::get("user_group");
      $this->_schedule->_init_week();
      if (Session::isProf()) {
         $data = $this->scheduleModel->getScheduleProf(Session::get('user_id'));
      } else {
         $data = $this->scheduleModel->getSchedule($level, $section, $group);
      }

      $data = $this->_schedule->arrange_schedule_week($data);
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

}
























