<?php
	class Dao{
		public function generateInsertquery($table,$param){
			$sql="INSERT INTO ".$table."(";
			$i=1;
			foreach($param as $key=>$param_val){
				if($i<sizeof($param)){
					$sql.=$key.",";
				}else{
					$sql.=$key;
				}
				$i++;
			}
			$sql.=") VALUES(";
			$i=1;
			foreach($param as $key=>$param_val){
				if($i<sizeof($param)){
					$sql.="'".$param_val."',";
				}else{
					$sql.="'".$param_val."'";;
				}
				$i++;
			}
			$sql.=")";
			return $sql;
		}
		public function generateselectLastIdquery($table,$id){
			$sql="SELECT * FROM ".$table." ORDER BY ".$id." ASC";
			return $sql;
		}
	   public function generateSelectQuery($table){
			$sql="SELECT * FROM ".$table."";
			return $sql;
		}
		
		public function generatewherequery($table, $array_condition) {
			$sql = "SELECT * FROM ".$table." WHERE ";
			$i = 0;
			foreach($array_condition as $key=>$value) {
				if($i == 0){
					$sql .= "".$key."='".$value."'";
				}
				else {
					$sql .= " AND ".$key."='".$value."'";
				}
				$i++;
			}
			if($table == 'users') {
				$sql .= " AND profil IS NOT NULL";
			}
			return $sql;
		}
	}
?>
