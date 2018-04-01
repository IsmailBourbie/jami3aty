<?php
use App\Classes\Helper;
use App\Classes\Schedule;

class Home extends Controller {
   private $_scheduleModel;
   private $_today;

   public function __construct() {
      if (!Session::isLoggedIn()) {
         Helper::redirect('auth/login');
      }
      $this->_today = date("w") + 1;
   }

   public function index($args = "") {
      $this->my_day();
   }


   private function my_day() {
      $this->_scheduleModel = $this->model("Schedule");
      $schedule = new Schedule();
      $schedule->_init_day();
      $data = $this->_scheduleModel->getScheduleByDay($this->_today);
      $data = $schedule->arrange_schedule_day($data);
      $response = [
         "page_title" => __CLASS__,
         "data"       => $data
      ];
      $this->view("home/index", $response);

   }


}
