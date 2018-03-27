<?php

class FormatSchedule {
   private static $_unused_data = ["day_schedule", "hour_start_schedule", "level", "section", "group"];

   public static function init_week_mold() {
      return [
         "1" => self::init_day_mold(),
         "2" => self::init_day_mold(),
         "3" => self::init_day_mold(),
         "4" => self::init_day_mold(),
         "5" => self::init_day_mold(),
      ];
   }

   private final static function init_module_mold() {
      return [
         "title"    => "",
         "type"     => "",
         "fullName" => "",
         "place"    => "",
      ];

   }

   public static function init_day_mold() {
      return [
         "1" => self::init_module_mold(),
         "2" => self::init_module_mold(),
         "3" => self::init_module_mold(),
         "4" => self::init_module_mold(),
         "5" => self::init_module_mold(),
         "6" => self::init_module_mold(),
         "7" => self::init_module_mold()
      ];
   }


   public static function arrangeSchedule($schedule, $schedule_week_mold) {
      for ($i = 0; $i < count($schedule); $i++) {
         $schedule[$i] = (array)$schedule[$i];
         $day = $schedule[$i]["day_schedule"];
         $hour = $schedule[$i]["hour_start_schedule"];
         $schedule_week_mold[$day][$hour] = $schedule[$i];
         // unset data
         $schedule_week_mold[$day] = FormatData::unsetData(
            $schedule_week_mold[$day], self::$_unused_data
         );
      }
      return $schedule_week_mold;
   }
}