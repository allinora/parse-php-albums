<?php 
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
include_once(__DIR__ . "/../config/config.php");
include_once(__DIR__ . "/../vendor/autoload.php");
use Parse\ParseClient;
use Parse\ParseQuery;
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseException;

ParseClient::initialize ( PARSE_APP_ID, PARSE_REST_KEY, PARSE_MASTER_KEY );


$username =  substr(md5(rand()), 0, 7);
$password = substr(md5(rand()), 0, 7);
print "Creating user account with : $username\n";


$user = new ParseUser();
$user->setUsername($username);
$user->setPassword($password);
try {
  	$user->signUp();
} catch (ParseException $ex) {
	die("Exception: " . $ex->getMessage());
}


print_r($_SESSION);

$currentUser = ParseUser::getCurrentUser();
