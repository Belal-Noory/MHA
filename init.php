<?php
require 'app/Helpers/config.php';
spl_autoload_register("autoLoad");
// Auto Load all important libraries
function autoLoad($class)
{
    if (file_exists(APPROOT . "/Helpers/" . $class . ".php")) {
        require(APPROOT . "/Helpers/" . $class . ".php");
    } else if (file_exists(APPROOT . "/Models/" . $class . ".php")) {
        require(APPROOT . "/Models/" . $class . ".php");
    } else if (file_exists(APPROOT . "/Controllers/" . $class . ".php")) {
        require(APPROOT . "/Controllers/" . $class . ".php");
    }
}

$server = helper::is_localhost();
if ($server == "local") {
    // DB Params
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'MHA');
} else {

    define('DB_HOST', 'localhost');
    define('DB_USER', 'u233367471_rohullah');
    define('DB_PASS', '143Mohammadi@12345?');
    define('DB_NAME', 'u233367471_mha');
}
