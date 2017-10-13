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
	  
	}
?>