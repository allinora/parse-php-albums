<?php 
include_once(__DIR__ . "/../config/config.php"); // The config just defines the constants for PARSE_APP_ID, etc
include_once(__DIR__ . "/../vendor/autoload.php"); // This is to load the parse SDK via composer


use Parse\ParseClient;
use Parse\ParseQuery;
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseException;

ParseClient::initialize ( PARSE_APP_ID, PARSE_REST_KEY, PARSE_MASTER_KEY );

$folder = new ParseObject("Folders");
$folder->set("name", "tmp");
$folder->save();


$file1 = new ParseObject("Files");
$file1->set("name", "file1");
$file1->save();

$folder->add("files", $file1);
$folder->save();

$file2 = new ParseObject("Files");
$file2->set("name", "file2");
$file2->save();

$folder->add("files", $file2);
$folder->save();

