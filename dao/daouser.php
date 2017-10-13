<?php
	
	include_once (dirname(__DIR__)."/dao/dao.php");
	class Daouser extends Dao {
		
		function __construct() {
		}
		public function getLastid($table){
			$sql="SELECT * FROM ".$table." ORDER BY user_id DESC LIMIT 0,1";
			return $sql;
		}
		
		public function genererAffichageAlluser($table,$user){
			$sql="SELECT * FROM users ORDER BY user_id";
			return $sql;
		}
		
		
		
		
	}
	
    
?>