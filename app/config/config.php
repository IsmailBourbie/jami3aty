<?php
/**
 *
 */
// Database Params:
define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_NAME', "university");

// App Root
define("APP_ROOT", str_replace('\\', '/', dirname(dirname(__FILE__))));
// URL Root

define("URL_ROOT", 'http://' . $_SERVER['HTTP_HOST'] . str_replace(
      $_SERVER["DOCUMENT_ROOT"], "", str_replace('\\', '/', dirname(dirname(__DIR__)) . "/")));
define("SITE_NAME", 'Jami3aty');

// Status For Error
define('OK', 200);
define('EMPTY_EMAIL', 400);
define('EMAIL_N_EXIST', 401);
define('EMPTY_PASS', 402);
define('INVALID_PASS', 403);
define('EMPTY_NUM_CARD', 404);
define('INVALID_NUM_CARD', 405);
define('INVALID_EMAIL', 406);
define('AVERAGE_N_EXIST', 407);
define('NUM_CARD_N_EXIST', 412);
define('EMPTY_AVERAGE', 408);
define('INVALID_AVERAGE', 409);
define('CONFIRM_PASS_ERR', 410);
define('ERR_EMAIL', 411);
define('STUDENT_EXIST', 413);
