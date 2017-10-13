<?php 
	include_once (dirname(__DIR__)."/model/user_mdl.php");
	class User_ctl{
		public function Insertuser($post){
			$user_mdl=new User_mdl();
			$user_mdl->setname($post['name']);
			$user_mdl->setsurname($post['surname']);
			$user_mdl->setusername($post['username']);
			$user_mdl->setpassword($post['password']);
			$user_mdl->setprofil($post['profil']);
			$user_mdl->insertuser($user_mdl);
		
		}
		public function afficherAlluser(){
			$user_mdl=new User_mdl();
			$Alluser=$user_mdl->afficherAlluser_mdl();
			$alluser=array();
			while($reponse=$Alluser->fetch()){
				$user=new User_mdl();
				$user->setuser_id($reponse['user_id']);
				$user->setname($reponse['name']);
				$user->setsurname($reponse['surname']);
				$user->setusername($reponse['username']);
				$user->setpassword($reponse['password']);
				$user->setprofil($reponse['profil']);
				array_push($alluser,$user);
				
			}
			return $alluser;
		
	    }
		
	}
	
?>