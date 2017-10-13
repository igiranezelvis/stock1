<?php
    /**
     *
     */
    //include_once (dirname(__DIR__)."/model/personne_mdl.php");
    include_once (dirname(__DIR__)."/dao/daostock_report.php");
    include_once (dirname(__DIR__)."/dao/dao.php");
	include_once (dirname(__DIR__)."/dao/connection.php");
    class Stock_report_mdl{
    	protected $stock_report_id;
        protected $category_id;
        protected $category_description;
        protected $sous_category_id;
        protected $sous_category_description;
        protected $initial_balance;
        protected $date;
        protected $total_stock_in;
        protected $total_stock_out;
        protected $total_balance;
        protected $total;

        function __construct($category_id= NULL,$sous_category_id= NULL,$initial_balance= NULL,$date= NULL,$total_stock_in= NULL,$total_stock_out= NULL,$total_balance= NULL,$total= NULL) {
            $this->category_id=$category_id;
            $this->sous_category_id=$sous_category_id;
            $this->initial_balance=$initial_balance;
            $this->date=$date;
            $this->total_stock_in=$total_stock_in;
            $this->total_stock_out=$total_stock_out;
            $this->total_balance=$total_balance;
            $this->total=$total;
           }  

		public function getstock_report_id(){
			return $this->stock_report_id;
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
		public function gettotal_stock_in(){
			return $this->total_stock_in;
		}
		public function gettotal_stock_out(){
			return $this->total_stock_out;
		}
		public function gettotal_balance(){
			return $this->total_balance;
		}
		public function gettotal(){
			return $this->total;
		}
		public function setstock_report_id($stock_report_id){
			$this->stock_report_id=$stock_report_id;
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
		public function settotal_stock_in($total_stock_in){
			$this->total_stock_in=$total_stock_in;
		}
		public function settotal_stock_out($total_stock_out){
			$this->total_stock_out=$total_stock_out;
		}
		public function settotal_balance($total_balance){
			$this->total_balance=$total_balance;
		}
		public function settotal($total){
			$this->total=$total;
		}
		
    public function insertstock_report($object){
			$table="stock_report";
			$param=array("category_id"=>$object->getcategory_id(),"sous_category_id"=>$object->getsous_category_id(),"initial_balance"=>$object->getinitial_balance(),"date"=>$object->getdate(),"total_stock_out"=>$object->gettotal_stock_out(),"total_stock_in"=>$object->gettotal_stock_in(),"total_balance"=>$object->gettotal_balance());
			$dao=new Dao();
            $dao_stock = new Daostock_report();
            $is_total_sql = $dao_stock->is_soub_category_exists($object->getcategory_id(), $object->getsous_category_id());
			$request=$dao->generateInsertquery($table,$param);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
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

		public function afficherAllstock_report_mdl(){
			$table_stock_report="stock_report";
			$table_sous_category="sous_category";
			$table_category="category";
			$dao=new Daostock_report();
			$requette=$dao->genererAffichageAllstock_report();
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

    }

?>
