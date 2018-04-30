<?php


class Time {
   private static $date;

   public static function formatTime($timestamp) {
      date_default_timezone_set('UTC');
      $difference = time() - $timestamp;
      $sem = intval($difference / 604800);
      $remain = $difference % 604800;
      $days = intval($remain / 86400);
      $remain = $remain % 86400;
      $hours = intval($remain / 3600);
      $remain = $remain % 3600;
      $mins = intval($remain / 60);
      $secs = $remain % 60;

      if ($secs >= 0) $timestring = "À l'instant";
      if ($mins > 0) $timestring = $mins . " min";
      if ($hours > 0) $timestring = $hours . " h";
      if ($days > 0) $timestring = date('D H:i', $timestamp);
      if ($sem > 0) $timestring = date('j M H:i', $timestamp);
      return $timestring;
   }
}