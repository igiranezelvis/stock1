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
			
	}
	
?>