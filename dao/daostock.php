<?php
	/**
	 * 
	 */
	include_once (dirname(__DIR__)."/dao/dao.php");
	class Daostock extends Dao {
		
		function __construct() {
		}
		
		
		public function genererAffichageAllstock(){
			$sql="SELECT st.initial_balance,st.stock_in,st.stock_out,st.balance, sousca.description as sous_category_description,cat.description as category_description FROM stock as st INNER JOIN sous_category as sousca ON ( st.sous_category_id=sousca.sous_category_id) INNER JOIN category as cat ON ( st.category_id=cat.category_id) ORDER BY stock_id DESC ";
			return $sql;
		}
		
		
	}
	
    
?>