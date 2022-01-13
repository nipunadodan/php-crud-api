<?php
define("DOC_ROOT", dirname(realpath(__FILE__))."/");
define("API_PATH", DOC_ROOT."api/");
define("MODULE_PATH", DOC_ROOT."modules/");

define('PRODUCTION', false);
/* Display PHP error */
if(!PRODUCTION){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}