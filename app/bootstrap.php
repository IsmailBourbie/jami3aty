<?php
require_once '../app/config/config.php';


require_once '../app/helper/url_helper.php';
require_once '../app/helper/session_helper.php';


// AutoLoad Core Lib
spl_autoload_register(function ($className) {
    require_once 'lib/' . $className . '.php';
});