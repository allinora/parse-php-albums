<?php
namespace ParseApp;

use Parse\ParseClient;
use Parse\ParseQuery;
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseException;
use Parse\ParseFile;
use Cocur\Slugify\Slugify;


class Albums {
	
	function __construct(){
		ParseClient::initialize(
		      PARSE_APP_ID,
		      PARSE_REST_KEY,
		      PARSE_MASTER_KEY
		    );
	}
	
	public function createUser($params){
		$user = new ParseUser();
		$user->setUsername($params['login']);
		$user->setPassword($params['passwd']);
		try {
		  	$user->signUp();
		} catch (ParseException $ex) {
			die("Exception: " . $ex->getMessage());
		}
		return $user;
	}

	public function loginUser($params){
		try {
			$user = ParseUser::Login($params['login'], $params['passwd']);
			return $user;
		} catch (ParseException $ex) {
			die("Exception: " . $ex->getMessage());
		}
	}

	public function logoutUser($params){
		ParseUser::logOut();
	}
	
	public function createAlbum($name){
		if ($this->albumExists($name)){
			throw new \Exception("An album with this name already exists. Please choose another");
		}
		
		$user = ParseUser::getCurrentUser();
		// Make a new album
		$album = new ParseObject("Albums");
		$album->set("name", $name);
		$album->set("user", $user);
		$album->save();
		unset($_SESSION['albums']);
		return $album;
	}
	public function getAlbums(){
		if (!empty($_SESSION['albums'])){
			return $_SESSION['albums'];
		}
		$user = ParseUser::getCurrentUser();
		
		// Find all albums by the current user
		$query = new ParseQuery("Albums");
		$query->equalTo("user", $user);
		$albums = $query->find();
		$_SESSION['albums'] = $albums;
		return $albums;
		
	}
	
	function addPicture($album_id, $path){
		$query = new ParseQuery("Albums");
	  	$album = $query->get($album_id);
		$filedata = $this->addFile($path);
		
		$pictures = $album->get("pictures");
		if (!empty($pictures)){
			$aPictures = json_decode($pictures);
		}
		$aPictures[] = $filedata;
		$pictures = json_encode($aPictures);
		
		$album->set("pictures", $pictures);
		
		$album->save();
		
		print "<pre>" . print_r($album, true) . "</pre>";
	}
	
	public function addFile($path){
		// Get the filename and slugify it (remove all characters that may cause problems)
		$pathinfo = pathinfo($path);
		$slugger = new Slugify();
		$filename = $slugger->slugify($pathinfo['filename']) . '.' . strtolower($pathinfo['extension']);
		$file = ParseFile::createFromFile($path, $filename);
		$file->save();
		
		// Put the file in the bucket and return just some metaData
		$bucket = new ParseObject("Buckets");
		$bucket->set("name", base64_encode($file->getName()));
		$bucket->set("filename", $filename);
		$bucket->set("url", $file->getURL());
		$bucket->set("file", $file);
		$bucket->save();
		
		$metaData = []; // 
		$metaData['bucket_id'] = $bucket->getObjectId();
		$metaData['name'] = $bucket->get("filename");
		$metaData['url'] = $bucket->get("url");
		
		return $metaData;
		
	}
	
	private function albumExists($name){
		$user = ParseUser::getCurrentUser();

		$query = new ParseQuery("Albums");
		$query->equalTo("user", $user);
		$query->equalTo("name", $name);
		
		$object = $query->first();
		if (is_object($object)){
			return true;
		}
		return false;
		
	}
	
}