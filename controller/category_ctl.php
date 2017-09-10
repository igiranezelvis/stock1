<?php 
	include_once (dirname(__DIR__)."/model/category_mdl.php");
	class Category_ctl{
		public function Insertcategory($post){
			$category_mdl=new Category_mdl();
			$category_mdl->setdescription($post['description']);
			$category_mdl->insertcategory($category_mdl);
		
		}
		public function afficherAllcategory(){
			$category_mdl=new category_mdl();
			$Allcategory=$category_mdl->afficherAllcategory_mdl();
			$allcategory=array();
			while($reponse=$Allcategory->fetch()){
				$category=new Category_mdl();
				$category->setcategory_id($reponse['category_id']);
				$category->setdescription($reponse['description']);
				array_push($allcategory,$category);
				
			}
			return $allcategory;
		
	    }
			public function Deletecategory($get){
			//echo "<pre>";print_r($get);exit;
			$category_mdl=new Category_mdl();
			$category_mdl->Deletecategory($get['deletecategory']);
		}
		
		public function getupdateinfo($category){
			$category_mdl=new Category_mdl();
			$categoryToupdate=$category_mdl->getInfotoUpdate($category);
			$allinfocategory=array();
			while($reponse=$categoryToupdate->fetch()){
				$categoryinfoToupdate=new Category_mdl();
				$categoryinfoToupdate->setcategory_id($reponse['category_id']);
				$categoryinfoToupdate->setdescription($reponse['description']);
				
				array_push($allinfocategory,$categoryinfoToupdate);
				
			}
			return $allinfocategory;
		}
		public function updatecategory($post){
		//echo "<pre>";print_r($post);exit;
			$category_mdl=new Category_mdl();
			$category_mdl->setcategory_id($post['category_id']);
			$category_mdl->setdescription($post['description']);
			$category_mdl->updatecategory($category_mdl);
		}
	}
	
?>