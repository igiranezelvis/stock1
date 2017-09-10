<?php
    /**
     * 
     */
    //include_once (dirname(__DIR__)."/model/personne_mdl.php");
    include_once (dirname(__DIR__)."/dao/daosous_category.php");
    include_once (dirname(__DIR__)."/dao/dao.php");
	include_once (dirname(__DIR__)."/dao/connection.php");
    class Sous_category_mdl{
    	protected $sous_category_id;
        protected $category_id;
        protected $category_description;
        protected $description;
		
        function __construct($category_id= NULL,$description= NULL) {
            $this->category_id=$category_id;
            $this->description=$description;
        }
		public function getsous_category_id(){
			return $this->sous_category_id;
		}
		public function getcategory_id(){
			return $this->category_id;
		}
		public function getcategory_description(){
			return $this->category_description;
		}
		public function getdescription(){
			return $this->description;
		}
		public function setsous_category_id($sous_category_id){
			$this->sous_category_id=$sous_category_id;
		}
		public function setcategory_id($category_id){
			$this->category_id=$category_id;
		}
		public function setcategory_description($category_description){
			$this->category_description=$category_description;
		}
		public function setdescription($description){
			$this->description=$description;
		}
		public function insertsous_category($object){
			$table="sous_category";
			$param=array("category_id"=>$object->getcategory_id(),"description"=>$object->getdescription() );
			$dao=new Dao();
			$request=$dao->generateInsertquery($table,$param);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$connection->exec($request);	
			
		}
		
		
		
		public function afficherAllsous_category_mdl(){
			$table_sous_category="sous_category";
			$table_category="category";
			$dao=new Daosous_category();
			$requette=$dao->genererAffichageAllsous_category();
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$result=$connection->query($requette);
			return $result;
		}
	public function Deletesous_category($sous_category_id){
		$table="sous_category";
			$dao=new Dao();
			$request=$dao->generateDeletequerysous_category($table,$sous_category_id);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$connection->exec($request);	
		}
    }
    
?>