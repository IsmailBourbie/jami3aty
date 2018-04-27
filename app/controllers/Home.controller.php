<?php
use App\Classes\Helper;
use App\Classes\Schedule;

class Home extends Controller {
   private $request;
   private $schedule_model;
   private $_today;


   public function __construct($request) {
      if (!Session::isLoggedIn()) {
         Helper::redirect('auth/login');
      }
      $this->request = $request;
      $this->schedule_model = $this->model("Schedule");
      $this->_today = date("w") + 1;
   }

   public function index($args = "") {
      if (Session::isProf()) {
         $response = [
            "page_title" => __CLASS__
         ];
         $this->view("home/teacher", $response);
      } else {
         $my_day = $this->my_day();
         $response = [
            "page_title" => __CLASS__,
            "my_day"     => $my_day
         ];
         $this->view("home/index", $response);
      }
   }


   private function my_day() {
      $schedule = new Schedule();
      $schedule->_init_day();
      $my_day = $this->schedule_model->getScheduleByDay($this->_today);
      $my_day = $schedule->arrange_schedule_day($my_day);
      return $my_day;
   }


}
