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


	function showAlbumAction($id = null){
		$this->set("currentAlbum", $id);
		$_SESSION['currentAlbum'] = $id;
		
 		$album = $_SESSION['albums'][$id];
		$pictures_json = $album->get("pictures");
		if (!empty($pictures_json)){
			$aPictures = json_decode($pictures_json);
		}
		$this->set('aPictures', $aPictures);
	}
	
	function testFileAction(){
		$this->render=0;
		$this->backend->addPicture('0chVWGqNhB', "/tmp/Arno+Lila.png");
	}

}
