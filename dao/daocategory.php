<?php
	
	include_once (dirname(__DIR__)."/dao/dao.php");
	class Daocategory extends Dao {
		
		function __construct() {
		}
		public function getLastid($table){
			$sql="SELECT * FROM ".$table." ORDER BY category_id DESC LIMIT 0,1";
			return $sql;
		}
		
		public function genererAffichageAllcategory($table,$category){
			$sql="SELECT * FROM ".$table." ORDER BY category_id ";
			return $sql;
		}
		public function getcategoryToupdate($tablecategory,$category_id){
			$sql="SELECT * FROM ".$tablecategory."  WHERE category_id=".$category_id." ";
			return $sql;
		}
		
		
		
	}
	
    
?>