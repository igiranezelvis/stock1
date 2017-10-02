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
