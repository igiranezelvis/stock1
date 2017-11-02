<?php
session_start();
	if(!isset($_SESSION['connected']) || $_SESSION['connected'] != TRUE) {
		header("Location:http://localhost/stock1/View/Authentification.php");
	}
	include_once (dirname(__DIR__)."/controller/user_ctl.php");
	$user=new User_ctl();
	if(isset($_POST["save"])){
		// echo "<pre>";
		// print_r($_POST);
		// exit;
		$user->Insertuser($_POST);
	}
	
	$Alluser=$user->afficherAlluser();
	// echo "<pre>";
		// print_r($_POST);
		// exit;
	include_once (dirname(__DIR__)."/controller/user_ctl.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>users</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link href="C:/wamp/htdocs/stock/css/bootstrap.min.css" rel="stylesheet">
    <link href="C:/xampp/htdocs/stock/css/bootstrap-responsive.min.css" rel="stylesheet">

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="C:/xampp/htdocs/stock/css/font-awesome.css" rel="stylesheet">

    <link href="C:/xampp/htdocs/stock/css/style.css" rel="stylesheet">



    <script>
 function validatecategory() {
var values = [];

    values.push(checkDescription());
   
	if(values.indexOf(false) >= 0){
	   return false;
	}
	
	return true;
}

function checkDescription(){ 
    var description = document.forms["categoryForm"]["description"].value;
    if (description == null || description == "" ) {
        alert("You must specify category description");
		return false;
    }else{
	return true;
	}
} 




</script>

  </head>

<body>
<?php include("header.php");?>
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
     <ul class="mainnav">
     	<li><a href="users2.php"><i class="icon-user"></i><span>Users</span> </a> </li>
	    <li><a href="category2.php"><i class="icon-edit"></i><span>Category</span> </a> </li>
	    <li><a href="sous_category2.php"><i class="icon-folder-open"></i><span>sub-category</span> </a> </li>
	    <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>Stock</span> <b class="caret"></b></a>
	   <ul class="dropdown-menu">
	   	   
	   	    <li><a href="stock.php">Stock </a></li>
            <li><a href="stock2.php">Stock In</a></li>
            <li><a href="stock3.php">Stock Out</a></li>
            <li><a href="total_stock.php"> Total Stock</a></li>
            <li><a href="stock_report.php">  Stock Report</a></li>
          </ul>
        </li>
      </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
  <div class="main-inner">

	    <div class="container">

	      <div class="row">

	      	<div class="span12">

	      		<div class="widget ">

	      			<div class="widget-header">
	      				<i class="icon-list-ol"></i>
	      				<h3>users</h3>
	  				</div> <!-- /widget-header -->

					<div class="widget-content">



						<div class="tabbable">
						<ul class="nav nav-tabs">
						 <li>
						    <a href="#formcontrols" data-toggle="tab">Users Entry Form</a>
						  </li>

						</ul>

						<br>

	<div>
		<form action="users2.php" method="post">
		    <p><label>Name</label><input type="text" name="name" value="" id="name" /></p>
		    <p><label>Surname</label><input type="text" name="surname" value="" id="surname" /></p>
		    <p><label>Username</label><input type="text" name="username" value="" id="username" /></p>
		    <p><label>Password</label><input type="text" name="password" value="" id="password" /></p>
		    <p><label>Profil</label><input type="text" name="profil" value="" id="profil" /></p>
			<input type="hidden" name="user_id" value=""/>
			<input type="submit" value="Save" name="save"/>
		</form>
		<br>
		<br>
		<br>
		<br>
	</div>
	  </div>


					</div>




					</div> <!-- /widget-content -->

				</div> <!-- /widget -->

		    </div> <!-- /span8 -->




	      </div> <!-- /row -->

	    </div> <!-- /container -->

	</div> <!-- /main-inner -->

</div> <!-- /main -->
  <?php include("footer.php");?>
</body>

</html>
