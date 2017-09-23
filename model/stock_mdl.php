<?php
    /**
     *
     */
    //include_once (dirname(__DIR__)."/model/personne_mdl.php");
    include_once (dirname(__DIR__)."/dao/daostock.php");
    include_once (dirname(__DIR__)."/dao/dao.php");
	include_once (dirname(__DIR__)."/dao/connection.php");
    class Stock_mdl{
    	protected $stock_id;
        protected $category_id;
        protected $category_description;
        protected $sous_category_id;
        protected $sous_category_description;
        protected $initial_balance;
        protected $stock_in;
        protected $stock_out;
        protected $balance;

        function __construct($category_id= NULL,$sous_category_id= NULL,$initial_balance= NULL,$stock_in= NULL,$stock_out= NULL,$balance= NULL) {
            $this->category_id=$category_id;
            $this->sous_category_id=$sous_category_id;
            $this->initial_balance=$initial_balance;
            $this->stock_in=$stock_in;
            $this->stock_out=$stock_out;
            $this->balance=$balance;
        }
		public function getstock_id(){
			return $this->stock_id;
		}
		public function getcategory_id(){
			return $this->category_id;
		}
		public function getcategory_description(){
			return $this->category_description;
		}
		public function getsous_category_id(){
			return $this->sous_category_id;
		}
		public function getsous_category_description(){
			return $this->sous_category_description;
		}
		public function getinitial_balance(){
			return $this->initial_balance;
		}
		public function getstock_in(){
			return $this->stock_in;
		}
		public function getstock_out(){
			return $this->stock_out;
		}
		public function getbalance(){
			return $this->balance;
		}
		public function setstock_id($stock_id){
			$this->stock_id=$stock_id;
		}
		public function setcategory_id($category_id){
			$this->category_id=$category_id;
		}
		public function setcategory_description($category_description){
			$this->category_description=$category_description;
		}
		public function setsous_category_id($sous_category_id){
			$this->sous_category_id=$sous_category_id;
		}
		public function setsous_category_description($sous_category_description){
			$this->sous_category_description=$sous_category_description;
		}
		public function setinitial_balance($initial_balance){
			$this->initial_balance=$initial_balance;
		}
		public function setstock_in($stock_in){
			$this->stock_in=$stock_in;
		}
		public function setstock_out($stock_out){
			$this->stock_out=$stock_out;
		}
		public function setbalance($balance){
			$this->balance=$balance;
		}
		public function insertstock($object){
			$table="stock";
			$param=array("category_id"=>$object->getcategory_id(),"sous_category_id"=>$object->getsous_category_id(),"initial_balance"=>$object->getinitial_balance(),"stock_in"=>$object->getstock_in(),"stock_out"=>$object->getstock_out(),"balance"=>$object->getbalance());
			$dao=new Dao();
			$request=$dao->generateInsertquery($table,$param);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$connection->exec($request);

		}


		public function afficherAllstock_mdl(){
			$table_stock="stock";
			$table_sous_category="sous_category";
			$table_category="category";
			$dao=new Daostock();
			$requette=$dao->genererAffichageAllstock();
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$result=$connection->query($requette);
			return $result;
		}

    public function get_sum_initial_balance($category_id, $sub_category_id) {
			$dao=new Daostock();
			$requette=$dao->get_sum_initial_balance($category_id, $sub_category_id);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$result=$connection->query($requette);
			return $result;
    }

    }

?>
