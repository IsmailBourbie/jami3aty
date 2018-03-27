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
      $this->_scheduleMold = FormatSchedule::init_week_mold();
      $this->scheduleModel = $this->model('Schedule');
   }

   public function index() {
      $level = $_SESSION["user_level"];
      $section = $_SESSION["user_section"];
      $group = $_SESSION["user_group"];
      $data = $this->scheduleModel->getSchedule($level, $section, $group);
      $data = FormatSchedule::arrangeSchedule($data, $this->_scheduleMold);

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
























