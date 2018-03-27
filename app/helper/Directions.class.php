<?php

class Directions {

   public static function redirect($page) {
      header('Location: ' . URL_ROOT . $page);
   }

}
