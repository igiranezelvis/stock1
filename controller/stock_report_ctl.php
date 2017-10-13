<?php
	include_once (dirname(__DIR__)."/model/stock_report_mdl.php");
	include_once (dirname(__DIR__)."/model/sous_category_mdl.php");
	class Stock_report_ctl{
		public function insertstock_report($post){
			$stock_report_mdl=new Stock_report_mdl();
			$stock_report_mdl->setcategory_id($post['category_id']);
			$stock_report_mdl->setsous_category_id($post['sous_category_id']);
			$stock_report_mdl->setdate($post['date']);
			$stock_report_mdl->insertstock_report($stock_report_mdl);
		}
	
		public function afficherAllstock_report(){
			$stock_report_mdl=new Stock_report_mdl();
			$Allstock_report=$stock_report_mdl->afficherAllstock_report_mdl();
			$allstock_report=array();
			while($reponse=$Allstock_report->fetch()){
				$stock_report=new Stock_report_mdl();
				$stock_report->setcategory_description($reponse['category_description']);
				$stock_report->setsous_category_description($reponse['sous_category_description']);
				$stock_report->setinitial_balance($reponse['initial_balance']);
				$stock_report->setdate($reponse['date']);
				$stock_report->settotal_stock_in($reponse['total_stock_in']);
				$stock_report->settotal_stock_out($reponse['total_stock_out']);
				$stock_report->settotal_balance($reponse['total_balance']);
				array_push($allstock_report,$stock_report);

			}
			return $allstock_report;

	    }
        

		public function get_sub_category($get) {
			$sous_category_mdl=new Sous_category_mdl();
			$sous_category = $sous_category_mdl->get_sub_categories($get['category_id']);
			$sous_category_temp = array();
			$html = "<select name='sous_category_id' type='text' value='' id='sous_category'>
								<option value='0'>Select...</option>";
			while($reponse = $sous_category->fetch()){
				$html .= "<option value=".$reponse[0].">".$reponse[1]."</option>";
			}
			$html .= "</select>";
			echo $html;
		}

		public function get_initial_balance($get) {
			$stock_mdl=new Stock_mdl();
			$sum_initial_balance = $stock_mdl->get_sum_initial_balance($get['category_id'], $get['sub_category_id']);
			while($reponse = $sum_initial_balance->fetch()){
				$html = $reponse['initial_balance'];
			}
			echo $html;
		}

	}
	if(isset($_GET['category_id']) && !isset($_GET['sub_category_id'])) {
		$stock = new Stock_ctl();
		$stock->get_sub_category($_GET);
	}

	if(isset($_GET['sub_category_id'])) {
		$stock = new Stock_ctl();
		$stock->get_initial_balance($_GET);
	}
?>
