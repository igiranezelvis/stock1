<?php 
	include_once (dirname(__DIR__)."/model/stock_mdl.php");
	class Stock_ctl{
		public function Insertstock($post){
			$stock_mdl=new Stock_mdl();
			$stock_mdl->setcategory_id($post['category_id']);
			$stock_mdl->setsous_category_id($post['sous_category_id']);
			$stock_mdl->setinitial_balance($post['initial_balance']);
			$stock_mdl->setstock_in($post['stock_in']);
			//$stock_mdl->setstock_out($post['stock_out']);
			$stock_mdl->setbalance($post['balance']);
			$stock_mdl->insertstock($stock_mdl);
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
				$stock->setstock_in($reponse['stock_in']);
				$stock->setstock_out($reponse['stock_out']);
				$stock->setbalance($reponse['balance']);
				array_push($allstock,$stock);
				
			}
			return $allstock;
		
	    }
			
	}
?>