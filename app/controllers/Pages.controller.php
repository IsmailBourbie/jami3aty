<?php

class Pages extends Controller {


   public function __construct() {
      if (!isLoggedIn()) {
         redirect('users/login');
      }
   }

   public function index($args = "") {

      $data = [];
      $this->view("pages/index", $data);
   }

   public function modules($args = "") {
      $this->modulesModel = $this->model("Modules");
      $object = $this->modulesModel->getModules();
      $sortArray = $this->arrange_rows($object);

      $response = [
         'status' => OK,
         'data'   => $this->obj_arr($sortArray),
      ];
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         header('Content-type: application/json');
         $this->view('users/ajax', $response);
         return;
      }
      $this->view("pages/modules", $response);

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

   private function unsetData($array, $data) {
      for ($i = 0; $i < count($array); $i++) {
         if (gettype($data) == "array") {
            foreach ($data as $d) {
               unset($array[$i][$d]);
            }
         } else {
            unset($array[$i][$data]);
         }
      }
      return $array;
   }


   private function arrange_rows($object) {
      $object = (array)$object;
      $object = $this->obj_arr($object);
      $sortArray = array();
      for ($i = 0; $i < count($object); $i++) {
         if ($object[$i]['_id_subject'] == $object[($i + 1) % count($object)]['_id_subject'] && $object[$i]['_id_subject'] == $object[($i + 2) % count($object)]['_id_subject']) {
            $object[$i]['course_prof'] = $object[$i]["fullName"];
            $object[$i]['tp_prof'] = $object[$i + 2]["fullName"];
            $object[$i]['tp_prof'] = $object[$i + 2]["fullName"];
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
      $sortArray = $this->unsetData($sortArray, ["fullName", "type", "course", "tp", "td", "_id_subject"]);
      return $sortArray;
   }
}
