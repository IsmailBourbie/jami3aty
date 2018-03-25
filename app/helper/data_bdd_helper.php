<?php

// unset data from arrays;
function unsetData($array, $data) {
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