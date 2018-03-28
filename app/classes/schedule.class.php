<?php

namespace App\Classes;

use App\Classes\Helper;

class Schedule {
   private $_unused_data = ["day_schedule", "hour_start_schedule", "level", "section", "group"];
   private $_week;
   private $_day;
   private $_hour;

   /**
    * Schedule constructor.
    */
   public function __construct() {
   }

   public function _init_week() {
      $this->_init_day();
      $this->_week = [
         "1" => $this->_day,
         "2" => $this->_day,
         "3" => $this->_day,
         "4" => $this->_day,
         "5" => $this->_day,
      ];;
   }

   public function _init_day() {
      $this->_init_hour();
      $this->_day = [
         "1" => $this->_hour,
         "2" => $this->_hour,
         "3" => $this->_hour,
         "4" => $this->_hour,
         "5" => $this->_hour,
         "6" => $this->_hour,
      ];;
   }

   private function _init_hour() {
      $this->_hour = [
         "title"    => "",
         "type"     => "",
         "fullName" => "",
         "place"    => "",
      ];;
   }

   public function arrange_schedule_week($schedule) {
      for ($i = 0; $i < count($schedule); $i++) {
         $schedule[$i] = (array)$schedule[$i];
         $day = $schedule[$i]["day_schedule"];
         $hour = $schedule[$i]["hour_start_schedule"];
         $this->_week[$day][$hour] = $schedule[$i];
         // unset data
         $this->_week[$day] = Helper::unsetData(
            $this->_week[$day], $this->_unused_data
         );
      }
      return $this->_week;
   }

   public function arrange_schedule_day($schedule) {
      for ($i = 0; $i < count($schedule); $i++) {
         $schedule[$i] = (array)$schedule[$i];
         $hour = $schedule[$i]['hour_start_schedule'];
         $this->_day[$hour] = $schedule[$i];
      }
      return $this->_day;
   }

}