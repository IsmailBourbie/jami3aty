<?php

class Request {
   private $request;

   public function __construct() {
      $this->request = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
   }

   public function get($value) {
      if (isset($this->request[$value])) {
         return $this->request[$value];
      }
      return '';
   }
}