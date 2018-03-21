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
      $object = $this->modulesModel->getModules(10101012);
      $sortArray = $this->arrange_rows($object);
      $response = [
         'status' => OK,
         'data'   => $this->object_to_array($sortArray),
      ];
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         header('Content-type: application/json');
         $this->view('users/ajax', $response);
         return;
      }
      $this->view("pages/modules", $response);

   }

   private function object_to_array($obj) {
      if (gettype($obj) == 'array' && gettype($obj[0]) == "object") {
         for ($i = 0; $i < count($obj); $i++) {
            $obj[$i] = (array)$obj[$i];
         }
      } elseif (gettype($obj) == 'array' && gettype($obj[0]) == "array") {
         for ($i = 0; $i < count($obj); $i++) {
            $obj[$i] = (object)$obj[$i];
         }
      }
      return $obj;
   }

   private function arrange_rows($object) {
      $object = (array)$object;
      $object = $this->object_to_array($object);
      $sortArray = array();
      for ($i = 0; $i < count($object); $i++) {
         if ($object[$i]['_id_subject'] == $object[($i + 1) % count($object)]['_id_subject'] && $object[$i]['_id_subject'] == $object[($i + 2) % count($object)]['_id_subject']) {
            $object[$i]['td_prof'] = $object[$i + 1]["first_name"] . " " . $object[$i + 1]["last_name"];
            $object[$i]['tp_prof'] = $object[$i + 2]["first_name"] . " " . $object[$i + 2]["last_name"];
            $sortArray[count($sortArray)] = $object[$i];
            $i += 2;
         } elseif ($object[$i]['_id_subject'] == $object[($i + 1) % count($object)]['_id_subject']) {
            $object[$i]['td_prof'] = $object[$i + 1]["first_name"] . " " . $object[$i + 1]["last_name"];
            $object[$i]['tp_prof'] = '';
            $sortArray[count($sortArray)] = $object[$i];
            $i += 1;
         } else {
            if ($object[$i]["type"] == "1") {
               $sortArray[count($sortArray)] = $object[$i];
            }
         }
      }
      return $sortArray;
   }
}
