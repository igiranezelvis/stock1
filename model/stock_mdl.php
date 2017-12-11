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
        protected $date;
        protected $stock_in;
        protected $stock_out;
        protected $balance;
        protected $total;

        function __construct($category_id= NULL,$sous_category_id= NULL,$initial_balance= NULL,$date= NULL,$stock_in= NULL,$stock_out= NULL,$balance= NULL,$total= NULL) {
            $this->category_id=$category_id;
            $this->sous_category_id=$sous_category_id;
            $this->initial_balance=$initial_balance;
            $this->date=$date;
            $this->stock_in=$stock_in;
            $this->stock_out=$stock_out;
            $this->balance=$balance;
           $this->total=$total;
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
		public function getdate(){
			return $this->date;
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
		public function gettotal(){
			return $this->total;
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
		public function setdate($date){
			$this->date=$date;
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
		public function settotal($total){
			$this->total=$total;
		}
	  public function insertstock($object){
			$table="stock";
			$param=array("category_id"=>$object->getcategory_id(),"sous_category_id"=>$object->getsous_category_id(),"initial_balance"=>$object->getinitial_balance(),"date"=>$object->getdate(),"stock_in"=>$object->getstock_in(),"stock_out"=>$object->getstock_out(),"balance"=>$object->getbalance());
			$dao=new Dao();
            $dao_stock = new Daostock();
            $is_total_sql = $dao_stock->is_soub_category_exists($object->getcategory_id(), $object->getsous_category_id());
			$request=$dao->generateInsertquery($table,$param);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
            $connection->exec($request);
            $result=$connection->query($is_total_sql);
            $total_sql = $dao_stock->get_sum_initial_balance_stock($object->getcategory_id(), $object->getsous_category_id());
            $total = $connection->query($total_sql)->fetch(PDO::FETCH_ASSOC);
            if($result->rowCount() == 0){
            $this->insert_total_stock($object->getcategory_id(), $object->getsous_category_id(), $total['initial_balance']);
            }elseif($result->rowCount() > 0) {
            $this->update_total_stock($object->getcategory_id(), $object->getsous_category_id(), $object->getstock_in(), 'in');
             }
		    }
    public function insertstock_out($object){
			$table="stock";
			$param=array("category_id"=>$object->getcategory_id(),"sous_category_id"=>$object->getsous_category_id(),"initial_balance"=>$object->getinitial_balance(),"date"=>$object->getdate(),"stock_out"=>$object->getstock_out(),"balance"=>$object->getbalance());
			$dao=new Dao();
            $dao_stock = new Daostock();
            $is_total_sql = $dao_stock->is_soub_category_exists($object->getcategory_id(), $object->getsous_category_id());
			$request=$dao->generateInsertquery($table,$param);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
            $result=$connection->query($is_total_sql);
            $total_sql = $dao_stock->get_sum_initial_balance_stock($object->getcategory_id(), $object->getsous_category_id());
            $total = $connection->query($total_sql)->fetch(PDO::FETCH_ASSOC);
            if($result->rowCount() == 0){
            $this->insert_total_stock($object->getcategory_id(), $object->getsous_category_id(), $total['initial_balance']);
            }elseif($result->rowCount() > 0) {
            $this->update_total_stock($object->getcategory_id(), $object->getsous_category_id(), $object->getstock_out(), 'out');
            }
			$connection->exec($request);

		     }

    public function insert_total_stock($category_id, $sous_category_id, $total) {
      $table="total_stock";
			$param=array("category_id"=>$category_id,"sous_category_id"=>$sous_category_id,"total"=>$total);
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

    public function afficherAllstock_mdl_per_cat_sub($cat, $sub_cat){
			$table_stock="stock";
			$table_sous_category="sous_category";
			$table_category="category";
			$dao=new Daostock();
			$requette=$dao->genererAffichageAllstock_cat_sub($cat, $sub_cat);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$result=$connection->query($requette);
			return $result;
		}


    public function afficherAllstock_mdl_per_date($cat, $sub_cat, $date_debut, $date_fin){
			$table_stock="stock";
			$table_sous_category="sous_category";
			$table_category="category";
			$dao=new Daostock();
			$requette=$dao->genererAffichageAllstock_per_date($cat, $sub_cat, $date_debut, $date_fin);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$result=$connection->query($requette);
			return $result;
		}
		public function afficherAlltotal_stock_mdl(){
			$table_stock="total_stock";
			$table_sous_category="sous_category";
			$table_category="category";
			$dao=new Daostock();
			$requette=$dao->genererAffichageAlltotal_stock();
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$result=$connection->query($requette);
			return $result;
		}
    public function update_total_stock($category_id, $sub_category_id, $stock_in, $operation) {
            $dao_stock = new Daostock();
			$requette=$dao_stock->update_total_stock($category_id, $sub_category_id, $stock_in, $operation);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$connection->exec($requette);
    }
    public function is_soub_category_exists($category_id, $sub_category_id) {
			$dao=new Daostock();
			$requette=$dao->is_soub_category_exists($category_id, $sub_category_id);
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
    public function get_sum_stock_in($category_id, $sub_category_id) {
			$dao=new Daostock();
			$requette=$dao->get_sum_stock_in($category_id, $sub_category_id);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$result=$connection->query($requette);
			return $result;
    }
      public function get_sum_stock_out($category_id, $sub_category_id) {
			$dao=new Daostock();
			$requette=$dao->get_sum_stock_out($category_id, $sub_category_id);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$result=$connection->query($requette);
			return $result;
    }

    }

?>
