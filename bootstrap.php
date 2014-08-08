<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
ini_set("zlib.output_compression", "Off");
ini_set("session.auto_start", "Off");
ini_set("display_errors", "On");
error_reporting(E_ALL);
ini_set("session.save_path", ROOT . DS . "tmp" . DS . "sessions");


date_default_timezone_set("Europe/Zurich");


require_once (ROOT . DS . 'vendor' . 	DS . 'autoload.php');


/** Autoload any framework controllers when they are needed **/

function _framework_class_loader($className) {
	print "Trying to load $className<br>";
	if (class_exists($className)){
		return;
	}

	if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
		require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
	} else {
		/* Error Generation Code Here */
	}
	return false;
}


spl_autoload_register('_framework_class_loader');

session_start();

require_once (ROOT . DS . 'config' . 	DS . 'config.php');
require_once (ROOT . DS . 'framework' . DS . 'framework.class.php');


