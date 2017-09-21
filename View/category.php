<?php
session_start();
	if(!isset($_SESSION['connected']) || $_SESSION['connected'] != TRUE) {
		header("Location:http://localhost/stock1/View/Authentification.php");
	}
	include_once (dirname(__DIR__)."/controller/category_ctl.php");
	$category=new Category_ctl();
	if(isset($_POST["save"])){
		// echo "<pre>";
		// print_r($_POST);
		// exit;
		$category->Insertcategory($_POST);
	}
	if(isset($_GET['deletecategory']) ){

		$category->Deletecategory($_GET);
	}
	if(isset($_POST["update"])){

		$category->updatecategory($_POST);
	}
	if(isset($_GET['updatecategory']) ){
		$infotoupdate=$category->getupdateinfo($_GET['updatecategory']);
		foreach($infotoupdate as $infotoupdatekey=>$infotoupdate_val){
			$category_id=$infotoupdate_val->getcategory_id();
			$description=$infotoupdate_val->getdescription();



		}
	}
	$Allcategory=$category->afficherAllcategory();
	// echo "<pre>";
		// print_r($_POST);
		// exit;
	include_once (dirname(__DIR__)."/controller/category_ctl.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>category</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link href="C:/wamp/htdocs/stock/css/bootstrap.min.css" rel="stylesheet">
    <link href="C:/xampp/htdocs/stock/css/bootstrap-responsive.min.css" rel="stylesheet">

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="C:/xampp/htdocs/stock/css/font-awesome.css" rel="stylesheet">

    <link href="C:/xampp/htdocs/stock/css/style.css" rel="stylesheet">



    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

<body>
<?php include("header.php");?>
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
     <ul class="mainnav">
	    <li><a href="category2.php"><i class="icon-edit"></i><span>Category</span> </a> </li>
	    <li><a href="sous_category2.php"><i class="icon-folder-open"></i><span>sub-category</span> </a> </li>
	    <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>Stock</span> <b class="caret"></b></a>
	   <ul class="dropdown-menu">
	   	    <li><a href="stock.php">Stock </a></li>
            <li><a href="stock2.php">Stock In</a></li>
            <li><a href="stock3.php">Stock Out</a></li>

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
	      				<h3>categories</h3>
	  				</div> <!-- /widget-header -->

					<div class="widget-content">



						<div class="tabbable">
						<ul class="nav nav-tabs">
						 <li>
						    <a href="#formcontrols" data-toggle="tab">Category Entry Form</a>
						  </li>

						</ul>

						<br>

	<div>
		<form action="category2.php" method="post">
		    <p><label>Description</label><input type="text" name="description" value="<?php if(isset($_GET['updatecategory']) ){if($description!=null){echo $description; }else echo ""; }?>"/></p>
			<input type="hidden" name="category_id" value="<?php if(isset($_GET['updatecategory_id']) ){if($category_id!=null){echo $category_id; }else echo ""; }?>"/>
			<input type="submit" value="Save" name="save"/>
			<input type="submit" value="Update" name="update"/>
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
