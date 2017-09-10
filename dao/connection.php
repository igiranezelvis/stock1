<?php
	class Connection{
		private $chaineConnection;
		public function __construct(){
			$this->chaineConnection=new PDO("mysql:host=localhost;dbname=stock","root","");
		}
		public function connectiondb(){
			return $this->chaineConnection;
			
		}
		
	}
?>