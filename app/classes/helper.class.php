<?php
/**
 * Created by PhpStorm.
 * User: IsMail BoUrbie
 * Date: 28/03/2018
 * Time: 17:05
 */

namespace App\Classes;


class Helper {

// Redirect pages
   public static function redirect($page) {
      header('Location: ' . URL_ROOT . $page);
   }

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

// Change the level from number to something readable
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

// Change the type of module to something readable
   public static function typeToString($type) {
      switch ($type) {
         case "1":
            return "Cours";
            break;
         case "2":
            return "TD";
            break;
         case "3":
            return "TP";
            break;
         default:
            return "";
      }
   }
}