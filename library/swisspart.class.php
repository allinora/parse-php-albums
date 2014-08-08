<?php
namespace Allinora;
use \Exception as Exception;
	
include_once(__DIR__ . '/../framework/db.class.php');
class Swisspart {

	function __construct(){
		include_once(__DIR__ . '/../config/db.php');
		$this->db = new DB($db['host'], $db['user'], $db['pass'], $db['db']);
	}

	function getStoriesList(){
		$sql = "select * from Stories";
		$result = $this->db->GetAll($sql);
		return $result;
	}

	function getStory($id){
		$sql = sprintf("select * from Stories where id=%u", intVal($id));
		// print $sql;
		$result = $this->db->GetRow($sql);
		return $result;
	}

	function saveStory($id, $params){
		return;
		
		$sql = sprintf("update Stories set title=%s, body=%s where id=%u",
		 	$this->db->Quote($params['title']),$this->db->Quote($params['body']),  intVal($id));
		$result = $this->db->execute($sql);
		return $result;
	}
	
}
