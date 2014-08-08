<?php	
ini_set("display_errors", "On");

// Do something before the framework is called
function _app_preHook(){
	// For example check the request via an IDS
}

// Do something with the content just before its being printed.
function _app_contentHook($_content){
	//For example pass it via tidy or do translations
	return $_content;
}

require_once (dirname(__FILE__) . '/../bootstrap.php');

// Cleanup the URL and handle special cases that should be handled outside.

@list($url, $params) = explode('?', $_SERVER["REQUEST_URI"], 2);   // Just get everything before t
// Special handling for "cache"; 
if (substr($url, 1, 5) == "cache"){
	$url = substr($url, 6);
	$_SERVER["REQUEST_URI"] = $url;
}
if (in_array(substr($url, 1), array("favicon.ico", "robots.txt", "sitemap.xml")) ){
	die("This url should not be handled here");
}

$framework = new Allinora\Simple\Framework($url);

