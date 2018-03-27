<?php


class FormatModule {

   private final static function obj_arr($obj_arr) {
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


   public static function arrange_rows($object) {
      $object = self::obj_arr($object);
      $sortArray = array();
      for ($i = 0; $i < count($object); $i++) {
         if ($object[$i]['_id_subject'] == $object[($i + 1) % count($object)]['_id_subject'] && $object[$i]['_id_subject'] == $object[($i + 2) % count($object)]['_id_subject']) {
            $object[$i] = self::checkProf($object[$i], $object[$i]);
            $object[$i] = self::checkProf($object[$i], $object[$i + 1]);
            $object[$i] = self::checkProf($object[$i], $object[$i + 2]);
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
      $sortArray = FormatData::unsetData($sortArray, ["fullName", "type", "course", "tp", "td", "_id_subject"]);
      return array_reverse(self::obj_arr($sortArray));
   }

   private final static function checkProf($object, $next_object) {
      switch ($next_object['type']) {
         case 1:
            $object["course_prof"] = $next_object["fullName"];
            break;
         case 2:
            $object["td_prof"] = $next_object["fullName"];
            break;
         case 3:
            $object["tp_prof"] = $next_object["fullName"];
            break;
      }
      return $object;

   }

}