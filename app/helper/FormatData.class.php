<?php

class FormatData {


// unset data from arrays;
   public static function unsetData($array, $data) {
      for ($i = 0; $i < count($array); $i++) {
         if (gettype($data) == "array") {
            foreach ($data as $d) {
               if (isset($array[$i][$d])) {
                  unset($array[$i][$d]);
               }
            }
         } else {
            unset($array[$i][$data]);
         }
      }
      return $array;
   }

   public static function levelToString($level, $branch = "Informatique") {
      switch ($level) {
         case 1:
         case 2:
            return "L1 {$branch}";
         case 3:
         case 4:
            return "L2 {$branch}";
         case 5:
         case 6:
            return "L3 {$branch}";
         case 7:
         case 8:
            return "M1 GL {$branch}";
         case 9:
         case 10:
            return "M1 RT {$branch}";
         case 11:
         case 12:
            return "M1 GI {$branch}";
         case 13:
         case 14:
            return "M2 GL {$branch}";
         case 15:
         case 16:
            return "M2 RT {$branch}";
         case 17:
         case 18:
            return "M2 GI {$branch}";
         default:
            "------------";
      }
   }
}