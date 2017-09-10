<?php
	/**
	 * 
	 */
	include_once (dirname(__DIR__)."/dao/dao.php");
	class Daosous_category extends Dao {
		
		function __construct() {
		}
		public function getLastid($table){
			$sql="SELECT * FROM ".$table." ORDER BY sous_categoryid DESC LIMIT 0,1";
			return $sql;
		}
		
		public function genererAffichageAllsous_category(){
			$sql="SELECT sousca.description,cat.description as category_description FROM sous_category as sousca INNER JOIN category as cat ON ( sousca.category_id=cat.category_id) ORDER BY sous_category_id DESC";
			return $sql;
		}
		
		
		
	}
	
    
?>