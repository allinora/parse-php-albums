<?php
include_once(__DIR__ . '/BaseController.php');
class IndexController extends BaseController {
	
	function beforeAction(){
		parent::beforeAction();
		$this->set("tab", 'index');


		$albums = $this->backend->getAlbums();
		$this->set("albums", $albums);


	}

	
	function indexAction() {
	}

	function afterAction() {

	}

	function newAlbumAction(){
		$this->render=0;
		$name = $this->getParam("name");
		$album = $this->backend->createAlbum($this->getParam("name"));
		$this->redirect("index", "index");
	}

	function getAlbumsAction(){
		$this->render=0;
		$albums = $this->backend->getAlbums();
		foreach ($albums as $album){
			$name = $album->get("name");
			print "Name: $name<br>";
			print "ID: " . $album->getObjectId() . "<br>";
			print "<br>";
		}
	}
	
	function showAlbumAction($id = null){
		$this->set("currentAlbum", $id);
 		$album = $_SESSION['albums'][$id];
		$pictures_json = $album->get("pictures");
		if (!empty($pictures_json)){
			$aPictures = json_decode($pictures_json);
		}
		$this->set('aPictures', $aPictures);
	}
	
	function testFileAction(){
		$this->render=0;
		$this->backend->addPicture('0chVWGqNhB', "/Users/aghaffar/www.gallery.atiftest.info/albums/Arno/HPIM0937.jpg");
		$this->backend->addPicture('0chVWGqNhB', "/Users/aghaffar/www.gallery.atiftest.info/albums/Arno/atif_arno6.jpg");
	}

}
