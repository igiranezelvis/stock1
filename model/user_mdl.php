<?php
    
    include_once (dirname(__DIR__)."/dao/dao.php");
     include_once (dirname(__DIR__)."/dao/daouser.php");
	 include_once (dirname(__DIR__)."/dao/connection.php");
    class User_mdl{
    	protected $user_id;
	
		protected $name;
		protected $surname;
		private $username;
		private $password;
		private $profil;
		protected $status;
        function __construct($user_id=null,$name= NULL,$surname= NULL,$username= NULL,$password=null,$profil=null,$status= NULL) {
          
			$this->user_id=$user_id;
			$this->name=$name;
			$this->surname=$surname;
			$this->username=$username;
			$this->password=$password;
			$this->status=$status;
			$this->profil=$profil;
        }
		public function getuser_id(){
			return $this->user_id;
		}
		
		public function getname(){
			return $this->name;
		}
		public function getsurname(){
			return $this->surname;
		}
		public function getusername(){
			return $this->username;
		}
		public function getpassword(){
			return $this->password;
		}
		
		public function getstatus(){
			return $this->status;
		}
		public function getprofil() {
			return $this->profil;
		}
		public function setuser_id($user_id){
			$this->user_id=$user_id;
		}
		public function setname($name){
			$this->name=$name;
		}
		public function setsurname($surname){
			$this->surname=$surname;
		}
		public function setusername($username){
			$this->username=$username;
		}
		
		public function setpassword($password){
			$this->password=$password;
		}
		public function setstatus($status){
			$this->status=$status;
		}
		
		public function setprofil($profil){
			$this->profil=$profil;
		}
		
		public function insertuser($object){
			$table="users";
			$param=array("name"=>$object->getname(),"surname"=>$object->getsurname(),"username"=>$object->getusername(),"password"=>$object->getpassword(),"profil"=>$object->getprofil());
			$dao=new Dao();
			$request=$dao->generateInsertquery($table,$param);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$connection->exec($request);	
			
		}
		public function afficherAlluser_mdl(){
			$table_users="users";
			$dao=new Daouser();
			$requette=$dao->genererAffichageAlluser($table_users,$table_users);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$result=$connection->query($requette);
			return $result;
		}
		
		public function generatewherequery($table, $array_condition) {
			$table="users";
			$dao=new Dao();
			$request=$dao->generatewherequery($table,$array_condition);
			$dbconnect=new Connection();
			$connection=$dbconnect->connectiondb();
			$result = $connection->query($request);
			$object_array=array();
			while ($reponse=$result->fetch()) {
				$user=new User_mdl();
				$user->setuser_id($reponse['user_id']);
				$user->setname($reponse['name']);
				$user->setsurname($reponse['surname']);
				$user->setusername($reponse['username']);
				$user->setstatus($reponse['status']);
				$user->setpassword($reponse['password']);
				$user->setprofil($reponse['profil']);
				//$user->setstatuts($reponse['statuts']);
				array_push($object_array,$user);
			}
			return $object_array;
		}
    }
    
?>