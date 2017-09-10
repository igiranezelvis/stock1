<?php 
	include_once (dirname(__DIR__)."/model/sous_category_mdl.php");
	class Sous_category_ctl{
		public function Insertsous_category($post){
			$sous_category_mdl=new Sous_category_mdl();
			$sous_category_mdl->setcategory_id($post['category_id']);
			$sous_category_mdl->setdescription($post['description']);
			$sous_category_mdl->insertsous_category($sous_category_mdl);
		}
		public function afficherAllsous_category( ){
			$sous_category_mdl=new Sous_category_mdl();
			$Allsous_category=$sous_category_mdl->afficherAllsous_category_mdl();
			$allsous_category=array();
			while($reponse=$Allsous_category->fetch()){
				$sous_category=new Sous_category_mdl();
				$sous_category->setdescription($reponse['description']);
				//$sous_category->setcategory_id($reponse['category_id']);
				$sous_category->setcategory_description($reponse['category_description']);
				array_push($allsous_category,$sous_category);
				
			}
			return $allsous_category;
		
	    }
	    	public function Deletesous_category($get){
			//echo "<pre>";print_r($get);exit;
			$sous_category_mdl=new Sous_category_mdl();
			$sous_category_mdl->Deletesous_category($get['deletesous_category']);
		}
		public function getupdateinfo($sous_category){
			$sous_category_mdl=new Sous_category_mdl();
			$sous_categoryToupdate=$sous_category_mdl->getInfotoUpdate($sous_category);
			$allinfosous_category=array();
			while($reponse=$sous_categoryToupdate->fetch()){
				$sous_categoryinfoToupdate=new Sous_category_mdl();
				$sous_categoryinfoToupdate->setsous_category_id($reponse['sous_category_id']);
				$sous_categoryinfoToupdate->setdescription($reponse['description']);
				
				array_push($allinfosous_category,$sous_categoryinfoToupdate);
				
			}
			return $allinfosous_category;
		}
		public function updatesous_category($post){
			$sous_category_mdl=new Sous_category_mdl();
			$sous_category_mdl->setsous_category_id($post['sous_category_id']);
			$sous_category_mdl->setdescription($post['description']);
			$sous_category_mdl->updatecategory($category_mdl);
		}
	}
?>