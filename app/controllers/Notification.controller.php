<?php

class Notification extends Controller {


   public function index() {
      $this->testModel = $this->model("Saves");
      $data = $this->testModel->getAll();
      $response = [
         "status" => OK,
         'data'   => $data
      ];
      echo json_encode($response);
   }

}