<?php

namespace App\Classes;


class Module {
   private $_module;

   /**
    * @param mixed $module
    */
   public function setModule($module) {
      $this->_module = Helper::obj_arr($module);
   }


   public function arrange_rows() {
      $sortArray = array();
      for ($i = 0; $i < count($this->_module); $i++) {
         if ($this->_module[$i]['_id_subject'] == $this->_module[($i + 1) % count($this->_module)]['_id_subject'] && $this->_module[$i]['_id_subject'] == $this->_module[($i + 2) % count($this->_module)]['_id_subject']) {
            $this->_module[$i] = $this->checkProf($this->_module[$i], $this->_module[$i]);
            $this->_module[$i] = $this->checkProf($this->_module[$i], $this->_module[$i + 1]);
            $this->_module[$i] = $this->checkProf($this->_module[$i], $this->_module[$i + 2]);
            $sortArray[count($sortArray)] = $this->_module[$i];
            $i += 2;
         } elseif ($this->_module[$i]['_id_subject'] == $this->_module[($i + 1) % count($this->_module)]['_id_subject']) {
            if ($this->_module[$i]['td'] == 1) {
               $this->_module[$i]['td_prof'] = $this->_module[$i + 1]["fullName"];
            }
            if ($this->_module[$i]['tp'] == 1) {
               $this->_module[$i]['tp_prof'] = $this->_module[$i + 1]["fullName"];
            }
            $this->_module[$i]['course_prof'] = $this->_module[$i]["fullName"];
            $sortArray[count($sortArray)] = $this->_module[$i];
            $i += 1;
         } else {
            if ($this->_module[$i]['td'] == 1) {
               $this->_module[$i]['td_prof'] = $this->_module[$i]["fullName"];
            }
            if ($this->_module[$i]['tp'] == 1) {
               $this->_module[$i]['tp_prof'] = $this->_module[$i]["fullName"];
            }
            if ($this->_module[$i]['course'] == 1) {
               $this->_module[$i]['course_prof'] = $this->_module[$i]["fullName"];
            }
            $sortArray[count($sortArray)] = $this->_module[$i];
         }
      }
      $sortArray = Helper::unsetData($sortArray, ["fullName", "type", "course", "tp", "td", "_id_subject"]);
      return array_reverse(Helper::obj_arr($sortArray));
   }


   private function checkProf($object, $next_object) {
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