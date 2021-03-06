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
   public static function typeOfCourseToString($type) {
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

// Change The type of post to something readable
   public function typeOfPostToString($type) {
      switch ($type) {
         case 1:
            return 'Consultation';
            break;
         case 2:
            return 'Affichage';
            break;
         case 3:
            return "Notes";
         default:
            return "Affichage";

      }
   }

   public static function obj_arr($obj_arr) {
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

// add column to row
   public static function addColumnDateParsed($object) {
      for ($i = 0; $i < count($object); $i++) {
         $object[$i] = (array)$object[$i];
         if (isset($object[$i]["type"])) {
            $type_post = $object[$i]["type"];
            $object[$i]["type_parsed"] = self::typeOfPostToString($type_post);
         }
         $date = $object[$i]["date"];
         $object[$i]["date_parsed"] = \Time::formatTime($date);
         $object[$i] = (object)$object[$i];
      }
      return ($object);
   }

   public static function generateToken($length) {
      return bin2hex(openssl_random_pseudo_bytes($length));
   }

   public static function arrangePInfo($object) {
      $arrange_obj = [];
      for ($i = 0; $i < count($object); $i++) {
         if (empty($arrange_obj)) {
            array_push($arrange_obj, [
               '_id_subject' => $object[$i]['_id_subject'],
               'title'       => $object[$i]['title'],
               'level'       => $object[$i]['level'],
               'section'     => [
                  $object[$i]['section'] => [$object[$i]['group'],]
               ],

            ]);
         } else {
            $last_subject_index = count($arrange_obj) - 1;
            $section = ($arrange_obj[$last_subject_index]['section']);
            $last_sec_index = key($section);
//            $last_sec_index = count($arrange_obj[$last_subject_index]['section']) - 1;
            // if there is subject in my Array
            if (in_array($object[$i]['_id_subject'], end($arrange_obj))) {
               // Check for section

               if ($object[$i]['section'] == key(end($arrange_obj)['section'])) {
                  array_push($arrange_obj[$last_subject_index]['section'][$last_sec_index], $object[$i]['group']);
               } else {
                    
                  $arrange_obj[$last_subject_index]['section'][$object[$i]['section']] = [$object[$i]['group'],];
               }
            } else {
               // no id in my array
               array_push($arrange_obj, [
                  '_id_subject' => $object[$i]['_id_subject'],
                  'title'       => $object[$i]['title'],
                  'level'       => $object[$i]['level'],
                  'section'     => [
                     $object[$i]['section'] => [$object[$i]['group'],]
                  ],

               ]);

            }
         }
      }
      return self::obj_arr($arrange_obj);
   }
}
