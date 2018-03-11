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
define("APP_ROOT", str_replace('\\','/', dirname(dirname(__FILE__))));
// URL Root
define("URL_ROOT", 'http://localhost/jami3aty/');
// Site Name
define("SITE_NAME", 'Jami3aty');

// Status For Error
define('OK',200);
define('EMPTY_EMAIL',400);
define('EMAIL_N_EXIST',401);
define('EMPTY_PASS',402);
define('INVALID_PASS',403);
define('EMPTY_NUM_CARD',404);
define('INVALID_NUM_CARD',405);
define('INVALID_EMAIL',406);
define('AVERAGE_CARD_ERR',407);
define('EMPTY_AVERAGE',408);
define('INVALID_AVERAGE',409);