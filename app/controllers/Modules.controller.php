<?php

class Modules extends Controller {
   private $modulesModel;

   public function __construct() {
      if ($_SERVER['REQUEST_METHOD'] == 'GET' && !Session::isLoggedIn()) {
         Directions::redirect('users/login');
      }
      $this->modulesModel = $this->model("Module");
   }

   public function index() {
      $response = [
         "page_title" => __CLASS__,
         'status'     => OK,
         'data'       => null,
      ];
      $object = $this->modulesModel->getModules($_SESSION['user_level'], $_SESSION['user_section'], $_SESSION['user_group']);
      $sortArray = FormatModule::arrange_rows($object);
      $response['data'] = $sortArray;
      $this->view("modules/index", $response);
   }


   public function all($level = "", $section = "", $group = "") {
      $response = [
         "page_title" => __CLASS__,
         'status'     => OK,
         'data'       => null,
      ];
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_NUMBER_INT);
         $level = isset($_POST['level']) ? $_POST['level'] : "";
         $section = isset($_POST['section']) ? $_POST['section'] : "";
         $group = isset($_POST['group']) ? $_POST['group'] : "";
         $object = $this->modulesModel->getModules($level, $section, $group);
         if ($object) {
            $sortArray = FormatModule::arrange_rows($object);
            $response['data'] = $sortArray;
         } else {
            $response['status'] = ERR_EMAIL;
         }
         header('Content-type: application/json');
         $this->view('api/json', $response);
         return;
      } else {
         die("request specified with {$level}/{$section}/{$group}");
      }
   }
}