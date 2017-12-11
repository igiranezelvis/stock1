<?php
	include_once (dirname(__DIR__)."/model/stock_mdl.php");
	include_once (dirname(__DIR__)."/model/sous_category_mdl.php");
	class Stock_ctl{
			public function insertstock($post){
			$stock_mdl=new Stock_mdl();
			$stock_mdl->setcategory_id($post['category_id']);
			$stock_mdl->setsous_category_id($post['sous_category_id']);
			$stock_mdl->setinitial_balance($post['initial_balance']);
			$stock_mdl->setdate($post['date']);
			$stock_mdl->setstock_in($post['stock_in']);
			$stock_mdl->setbalance($post['balance']);
			$stock_mdl->insertstock($stock_mdl);
		}
		public function insertstock_out($post){
			$stock_mdl=new Stock_mdl();
			$stock_mdl->setcategory_id($post['category_id']);
			$stock_mdl->setsous_category_id($post['sous_category_id']);
			$stock_mdl->setinitial_balance($post['initial_balance']);
			$stock_mdl->setdate($post['date']);
			$stock_mdl->setstock_out($post['stock_out']);
			$stock_mdl->setbalance($post['balance']);
			$stock_mdl->insertstock_out($stock_mdl);
		}

		public function afficherAllstock(){
			$stock_mdl=new Stock_mdl();
			$Allstock=$stock_mdl->afficherAllstock_mdl();
			$allstock=array();
			while($reponse=$Allstock->fetch()){
				$stock=new Stock_mdl();
				$stock->setcategory_description($reponse['category_description']);
				$stock->setsous_category_description($reponse['sous_category_description']);
				$stock->setinitial_balance($reponse['initial_balance']);
				$stock->setdate($reponse['date']);
				$stock->setstock_in($reponse['stock_in']);
				$stock->setstock_out($reponse['stock_out']);
				$stock->setbalance($reponse['balance']);
				array_push($allstock,$stock);

			}
			return $allstock;

	    }
        public function afficherAlltotal_stock(){
			$total_stock_mdl=new Stock_mdl();
			$Alltotal_stock=$total_stock_mdl->afficherAlltotal_stock_mdl();
			$alltotal_stock=array();
			while($reponse=$Alltotal_stock->fetch()){
				$total_stock=new Stock_mdl();
				$total_stock->setcategory_description($reponse['category_description']);
				$total_stock->setsous_category_description($reponse['sous_category_description']);
				$total_stock->settotal($reponse['total']);
				array_push($alltotal_stock,$total_stock);

			}
			return $alltotal_stock;

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
			if($sum_initial_balance->rowCount() > 0) {
				while($reponse = $sum_initial_balance->fetch()){
					$html = $reponse['initial_balance'];
				}
			}else
			{
				$html = 0;
			}
			echo $html;
		}

		public function search($get) {
			$stock_mdl=new Stock_mdl();
			$Allstock=$stock_mdl->afficherAllstock_mdl_per_cat_sub($get['category'],$get['sous_category']);
			$allstock=array();
			$html = "";
			while($reponse=$Allstock->fetch()){
				$html .= "<tr>
									<td>".$reponse['category_description']."</td>
									<td>".$reponse['sous_category_description']."</td>
									<td>".$reponse['initial_balance']."</td>
									<td>".$reponse['date']."</td>
									<td>".$reponse['stock_in']."</td>
									<td>".$reponse['stock_out']."</td>
									<td>".$reponse['balance']."</td>
									<td></td>
								 </tr>";

			}
			echo $html;

		}

		public function search_by_date($get) {
			$stock_mdl=new Stock_mdl();
			$Allstock=$stock_mdl->afficherAllstock_mdl_per_date($get['category'],$get['sous_category'], $get['date_debut'],$get['date_fin']);
			$allstock=array();
			$html = "";
			while($reponse=$Allstock->fetch()){
				$html .= "<tr>
									<td>".$reponse['category_description']."</td>
									<td>".$reponse['sous_category_description']."</td>
									<td>".$reponse['initial_balance']."</td>
									<td>".$reponse['date']."</td>
									<td>".$reponse['stock_in']."</td>
									<td>".$reponse['stock_out']."</td>
									<td>".$reponse['balance']."</td>
									<td></td>
								 </tr>";

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

	if(isset($_GET['category']) && isset($_GET['sous_category']) && isset($_GET['type'])) {
		$stock = new Stock_ctl();
		$stock->search($_GET);
	}

	if(isset($_GET['category']) && isset($_GET['sous_category']) && isset($_GET['date_debut']) && isset($_GET['date_fin'])) {
		$stock = new Stock_ctl();
		$stock->search_by_date($_GET);
	}
?>
