<?php
/** Configuration Constants **/

// define ROOT. One level before this directory
define('ROOT', dirname(__DIR__));

// Name of the project. 
define ('PROJECT_NAME','parsealbums');

// This should set some caching/debug, etc to on or off
define ('DEVELOPMENT_ENVIRONMENT',true);


// Smarty stuff
define('SMARTY_COMPILE_DIR', 	ROOT . DS . 'tmp' .DS . 'smarty_compile');
define('SMARTY_CACHE_DIR',		ROOT .DS . 'tmp' .DS . 'smarty_cache');


// Parse stuff
define('PARSE_APP_ID', 'YOUR-PARSE-APP-ID');
define('PARSE_REST_KEY', 'YOUR-PARSE-REST-KEY');
define('PARSE_MASTER_KEY', 'YOUR-PARSE-MASTER-KEY');

