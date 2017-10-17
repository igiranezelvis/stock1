<?php
	/**
	 *
	 */
	include_once (dirname(__DIR__)."/dao/dao.php");
	class Daostock extends Dao {

		function __construct() {
		}


		public function genererAffichageAllstock(){
			$sql="SELECT SUM(initial_balance) AS initial_balance, st.date, SUM(stock_in) AS stock_in,SUM(stock_out) AS stock_out, total_stock.total balance, sousca.description as sous_category_description,cat.description as category_description FROM stock as st INNER JOIN sous_category as sousca ON ( st.sous_category_id=sousca.sous_category_id) INNER JOIN category as cat ON ( st.category_id=cat.category_id) INNER JOIN total_stock ON(total_stock.category_id=cat.category_id AND total_stock.sous_category_id=sousca.sous_category_id) GROUP BY sousca.sous_category_id ORDER BY stock_id DESC LIMIT 20";
			return $sql;
		}

		public function genererAffichageAlltotal_stock(){
			$sql="SELECT st.total , sousca.description as sous_category_description,cat.description as category_description FROM total_stock as st INNER JOIN sous_category as sousca ON ( st.sous_category_id=sousca.sous_category_id) INNER JOIN category as cat ON ( st.category_id=cat.category_id) ORDER BY id DESC ";
			return $sql;
		}

		public function get_sum_initial_balance($category_id, $sub_category_id) {
			$sql = "SELECT total as initial_balance from total_stock where category_id=".$category_id." and sous_category_id=".$sub_category_id."";
			return $sql;
		}

		public function get_sum_initial_balance_stock($category_id, $sub_category_id) {
			$sql = "SELECT SUM(stock_in) as initial_balance from stock where category_id=".$category_id." and sous_category_id=".$sub_category_id."";
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

      public function get_sum_stock_in($category_id, $sub_category_id) {
			$sql = "UPDATE total_stock SET  total_stock_in = total_stock_in ".($operation == 'in'?" + ":" - ")."".$stock_in." where category_id=".$category_id." and sous_category_id=".$sub_category_id."";
			return $sql;
		}
		public function get_sum_stock_out($category_id, $sub_category_id) {
			$sql = "UPDATE total_stock SET  total_stock_out = total_stock_out".($operation == 'in'?" + ":" - ")."".$stock_out." where category_id=".$category_id." and sous_category_id=".$sub_category_id."";
			return $sql;
		}
	}


?>
