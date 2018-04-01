<?php

/*
 * Base Controller
 * Load Models & Views
*/

abstract class Controller {
   private $_is_ajax = "";
   // Load model
   public function model($model) {
      // Require Model file
      require_once '../app/models/' . $model . '.model.php';
      return new $model();
   }

   // Load View
   public function view($view, $data = []) {
      // check if file(view) exist
      if (!empty($this->_is_ajax)) {
         $view = "api/json";
      }
      if (file_exists('../app/views/' . $view . '.view.php')) {
         // Require View File
         require_once '../app/views/' . $view . '.view.php';
      } else {
         // view doesn't exist more;
         \App\Classes\Helper::redirect("");
      }
   }

   public function setAjax($is_ajax) {
      $this->_is_ajax = $is_ajax;
   }
}