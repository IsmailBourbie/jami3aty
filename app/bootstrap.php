<?php
require_once '../app/config/config.php';


require_once '../app/helper/url_helper.php';
require_once '../app/helper/session_helper.php';
require_once '../app/helper/validation_helper.php';
require_once '../app/helper/mailer_helper.php';
require_once '../app/helper/data_bdd_helper.php';

// Include PhpMailer
require_once 'lib/PHPMailer/src/PHPMailer.php';
require_once 'lib/PHPMailer/src/Exception.php';
require_once 'lib/PHPMailer/src/SMTP.php';
require_once 'lib/PHPMailer/src/OAuth.php';

// AutoLoad Core Lib
spl_autoload_register(function ($className) {
   require_once 'lib/' . $className . '.php';
});