<?php
    /**
     * 
     */
   
    include_once (dirname(__DIR__)."/dao/daocategory.php");
    include_once (dirname(__DIR__)."/dao/dao.php");
	 include_once (dirname(__DIR__)."/dao/connection.php");
    class Category_mdl{
    	protected $category_id;
		protected $description;
        function __construct($description= NULL) {
            $this->description=$description;
        }
		public function getcategory_id(){
			return $this->category_id;
		}
		public function getdescription(){
			return $this->description;
		}
		public function setcategory_id($category_id){
			$this->category_id=$category_id;
		}
		public function setdescription($description){
			$this->description=$description;
		}
		public function insertcategory($object){
			$table="category";
			$param=array("description"=>$object->getdescription());
			$dao=new Dao();
			$request=$dao->generateInsertquery($table,$param);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$connection->exec($request);	
			
		}
		
		public function afficherAllcategory_mdl(){
			$table_category="category";
			$dao=new Daocategory();
			$requette=$dao->genererAffichageAllcategory($table_category,$table_category);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$result=$connection->query($requette);
			return $result;
		}

		
    }
    
?>