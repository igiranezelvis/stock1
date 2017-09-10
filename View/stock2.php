<?php 
session_start();
	if(!isset($_SESSION['connected']) || $_SESSION['connected'] != TRUE) {
		header("Location:http://localhost:8080/stock/View/Authentification.php");
	}
	include_once (dirname(__DIR__)."/controller/stock_ctl.php");
	include_once (dirname(__DIR__)."/controller/category_ctl.php");
	include_once (dirname(__DIR__)."/controller/sous_category_ctl.php");
	$category = new Category_ctl();
	$all_categorys = $category->afficherAllcategory();
	$sous_category = new Sous_category_ctl();
	$all_sous_categorys = $sous_category->afficherAllsous_category();
	$stock=new Stock_ctl();
	if(isset($_POST["save"])){
		// echo "<pre>";
		// print_r($_POST);
		// exit;
		$stock->Insertstock($_POST);
	}
	if(isset($_GET['deletestock'])){
		// echo "<pre>";
		// print_r($_POST);
		// exit;
		$stock->Deletestock($_GET);
	}
if(isset($_POST["update"])){
		// echo "<pre>";
		// print_r($_POST);
		// exit;
		$stock->updatestock($_POST);
	}
	if(isset($_GET['updatestock']) ){
		$infotoupdate=$stock->getupdateinfo($_GET['updatestock']);
		//echo "<pre>";print_r($infotoupdate);exit;
		foreach($infotoupdate as $infotoupdatekey=>$infotoupdate_val){
			$stock_id=$infotoupdate_val->getstock_id();
			$nom_domaine=$infotoupdate_val->getNom_domaine();
			
			
					
		}
	}
	$Allstock=$stock->afficherAllstock();
	// echo "<pre>";
		// print_r($_POST);
		// exit;
	
	include_once (dirname(__DIR__)."/controller/stock_ctl.php");
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Stock </title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">    
    
    <link href="C:/wamp/www/travail/css/bootstrap.min.css" rel="stylesheet">
    <link href="C:/wamp/www/travail/css/bootstrap-responsive.min.css" rel="stylesheet">
    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="C:/wamp/www/travail/css/font-awesome.css" rel="stylesheet">
    
    <link href="C:/wamp/www/travail/css/style.css" rel="stylesheet">
   


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
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
  <div class="main-inner">

	    <div class="container">
	
	      <div class="row">
	      	
	      	<div class="span12">      		
	      		
	      		<div class="widget ">
	      			
	      			<div class="widget-header">
	      				<i class="icon-list"></i>
	      				<h3> Stock In</h3>
	  				</div> <!-- /widget-header -->
					
					<div class="widget-content">
						
						
						
						<div class="tabbable">
						<ul class="nav nav-tabs">
						 <li>
						    <a href="#formcontrols" data-toggle="tab">Stock form</a>
						  </li>
						  
						</ul>
						
						<br>
  
	<div>
		<form action="stock.php" method="post">
		    <p><label>Category</label>
		    	<select name="category_id" type="text" value=" " >
					<option value="<?php echo 0;?>">
						select...
					</option>
				<?php foreach ($all_categorys as $key => $value) {?>
					<option value="<?php echo $value->getcategory_id();?>">
						<?php echo $value->getdescription();?>
					</option>
				<?php }?></select>
                </p>

		    <p><label>Sub-category</label>
		    	<select name="sous_category_id" type="text" value=" " >
					<option value="<?php echo 0;?>">
						select...
					</option>
				<?php foreach ($all_sous_categorys as $key => $value) {?>
					<option value="<?php echo $value->getsous_category_id();?>">
						<?php echo $value->getdescription();?>
					</option>
				<?php }?></select></p>

		    <p><label>Initial Balance</label><input type="text" name="initial_balance" value=" "/></p>
		    <p><label>Stock In</label><input type="text" name="stock_in" value=" "/></p>
		    <!--<p><label>Stock Out</label><input type="text" name="stock_out" value=" "/></p>-->
		    <p><label>Balance</label><input type="text" name="balance" value=" "/></p>
			<input type="hidden" name="stock_id" value=""/>
			<input type="submit" value="Save" name="save"/>
			<input type="submit" value="Update" name="update"/><br/>
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
