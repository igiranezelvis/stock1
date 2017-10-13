<?php
	/**
	 *
	 */
	include_once (dirname(__DIR__)."/dao/dao.php");
	class Daostock_report extends Dao {

		function __construct() {
		}


		public function genererAffichageAllstock_report(){
			$sql="SELECT str.initial_balance,str.date,str.total_stock_in,str.total_stock_out,str.total_balance, sousca.description as sous_category_description,cat.description as category_description FROM stock_report as str INNER JOIN sous_category as sousca ON ( str.sous_category_id=sousca.sous_category_id) INNER JOIN category as cat ON ( str.category_id=cat.category_id) ORDER BY stock_report_id ASC ";
			return $sql;
		}

		
	public function genererAffichageAlltotal_stock(){
			$sql="SELECT st.total , sousca.description as sous_category_description,cat.description as category_description FROM total_stock as st INNER JOIN sous_category as sousca ON ( st.sous_category_id=sousca.sous_category_id) INNER JOIN category as cat ON ( st.category_id=cat.category_id) ORDER BY id ASC ";
			return $sql;
		}

		public function get_sum_initial_balance($category_id, $sub_category_id) {
			$sql = "SELECT total as initial_balance from total_stock where category_id=".$category_id." and sous_category_id=".$sub_category_id."";
			return $sql;
		}

		public function is_soub_category_exists($category_id, $sub_category_id) {
			$sql = "SELECT *  from total_stock where category_id=".$category_id." and sous_category_id=".$sub_category_id."";
			return $sql;
		}

		public function update_total_stock($category_id, $sub_category_id, $stock_in, $operation) {
			$sql = "UPDATE total_stock SET  total = total ".($operation == 'in'?" + ":" - ")."".$stock_in." where category_id=".$category_id." and sous_category_id=".$sub_category_id."";
			return $sql;
		}
		



	}


?>
