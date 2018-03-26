<?php

class Modules extends Controller {

   private $modulesModel;

   public function __construct() {
      if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isLoggedIn()) {
         redirect('users/login');
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
      $sortArray = $this->arrange_rows($object);
      $response['data'] = $this->obj_arr($sortArray);
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
            $sortArray = $this->arrange_rows($object);
            $response['data'] = $this->obj_arr($sortArray);
         } else {
            $response['status'] = ERR_EMAIL;
         }
         header('Content-type: application/json');
         $this->view('api/json', $response);
         return;
      } else {
         die("request specified level");
      }
   }

   private function obj_arr($obj_arr) {
      if (isset($obj_arr[0])) {
         if (gettype($obj_arr) == 'array' && gettype($obj_arr[0]) == "object") {
            for ($i = 0; $i < count($obj_arr); $i++) {
               $obj_arr[$i] = (array)$obj_arr[$i];
            }
         } elseif (gettype($obj_arr) == 'array' && gettype($obj_arr[0]) == "array") {
            for ($i = 0; $i < count($obj_arr); $i++) {
               $obj_arr[$i] = (object)$obj_arr[$i];
            }
         }
      }
      return $obj_arr;
   }

   private function checkProf($object, $next_object) {
      switch ($next_object['type']) {
         case 1:
            $object["course_prof"] = $next_object["fullName"];
            break;
         case 2:
            $object["td_prof"] = $next_object["fullName"];
            break;
         case 3:
            $object["tp_prof"] = $next_object["fullName"];
            break;
      }
      return $object;

   }

   private function arrange_rows($object) {
      $object = (array)$object;
      $object = $this->obj_arr($object);
      $sortArray = array();
      for ($i = 0; $i < count($object); $i++) {
         if ($object[$i]['_id_subject'] == $object[($i + 1) % count($object)]['_id_subject'] && $object[$i]['_id_subject'] == $object[($i + 2) % count($object)]['_id_subject']) {
            $object[$i] = $this->checkProf($object[$i], $object[$i]);
            $object[$i] = $this->checkProf($object[$i], $object[$i + 1]);
            $object[$i] = $this->checkProf($object[$i], $object[$i + 2]);
            $sortArray[count($sortArray)] = $object[$i];
            $i += 2;
         } elseif ($object[$i]['_id_subject'] == $object[($i + 1) % count($object)]['_id_subject']) {
            if ($object[$i]['td'] == 1) {
               $object[$i]['td_prof'] = $object[$i + 1]["fullName"];
            }
            if ($object[$i]['tp'] == 1) {
               $object[$i]['tp_prof'] = $object[$i + 1]["fullName"];
            }
            $object[$i]['course_prof'] = $object[$i]["fullName"];
            $sortArray[count($sortArray)] = $object[$i];
            $i += 1;
         } elseif ($object[$i]["type"] == "1") {
            if ($object[$i]['td'] == 1) {
               $object[$i]['td_prof'] = $object[$i]["fullName"];
            }
            if ($object[$i]['tp'] == 1) {
               $object[$i]['tp_prof'] = $object[$i]["fullName"];
            }
            if ($object[$i]['course'] == 1) {
               $object[$i]['course_prof'] = $object[$i]["fullName"];
            }
            $sortArray[count($sortArray)] = $object[$i];
         }
      }
      $sortArray = unsetData($sortArray, ["fullName", "type", "course", "tp", "td", "_id_subject"]);
      return array_reverse($sortArray);
   }
}