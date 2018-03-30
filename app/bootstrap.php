<?php
session_start();
require_once '../app/config/config.php';


// Include PhpMailer
require_once 'lib/PHPMailer/src/PHPMailer.php';
require_once 'lib/PHPMailer/src/Exception.php';
require_once 'lib/PHPMailer/src/SMTP.php';
require_once 'lib/PHPMailer/src/OAuth.php';

require_once APP_ROOT . '/classes/helper.class.php';
require_once APP_ROOT . '/classes/schedule.class.php';
require_once APP_ROOT . '/classes/module.class.php';
require_once APP_ROOT . '/classes/mailer.class.php';


// AutoLoad Core Lib
spl_autoload_register('load_lib');

// AutoLoad Core helper
spl_autoload_register('load_helper');

// load files in lib core
function load_lib($className) {
   $file = APP_ROOT . "/lib/" . $className . ".php";
   if (!file_exists($file))
      return false;
   require_once $file;
   return true;

}

// load file in helper directory
function load_helper($className) {
   $file = APP_ROOT . "/helper/" . $className . ".class.php";
   if (!file_exists($file))
      return false;
   require_once $file;
   return true;

}