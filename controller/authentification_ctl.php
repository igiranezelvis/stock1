<?php
     /**
     *
     */

    session_start();
	//$_SESSION["aut"] = false;
	//$_SESSION["id"]="";

			if(empty($_SESSION["id"]))

	include_once (dirname(__DIR__)."/model/user_mdl.php");
    class Authentification_ctl{

        function __construct() {

        }
		public function authentification($post){
			$ok=0;
			$user=new User_mdl();
			$checkIfUserExist=$user->generatewherequery('users', array('username'=>$post['username'],'password'=>$post['password']));
			if(!empty($checkIfUserExist) && sizeof($checkIfUserExist) == 1){
			$username=$_POST['username'];
				$user=new User_mdl();
				//$infoUser=$personnel_cabinet->getInfoAuthentication($idpersonne);
				//$_SESSION['nom']=$infoUser->getNom();
				//$_SESSION['prenom']=$infoUser->getPrenom();
					$_SESSION['name']=$checkIfUserExist[0]->getName();
					$_SESSION['surname']=$checkIfUserExist[0]->getSurname();
					$_SESSION['user_id']=$checkIfUserExist[0]->getuser_id();
					$_SESSION['profil'] = $checkIfUserExist[0]->getProfil();
				            if($checkIfUserExist[0]->getprofil() == "admin"){
							$_SESSION["aut"] = "admin";
							$_SESSION['connected'] = TRUE;
							header("Location:http://localhost/stock1/View/users2.php");
						    }
				            if($checkIfUserExist[0]->getprofil() == "user"){
							$_SESSION["aut"] = "user";
							$_SESSION['connected'] = TRUE;
							header("Location:http://localhost/stock1/View/category2.php");
						    }





			}
			else
			{

			echo "<script language=\"JavaScript\">\n";
            echo "alert('Username or Password was incorrect!');\n";
            echo "window.location='Authentification_frm.php'";
            echo "</script>";
			}
		}
    }


?>
