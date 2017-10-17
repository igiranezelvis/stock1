<?php
session_start();
	if(!isset($_SESSION['connected']) || $_SESSION['connected'] != TRUE) {
		header("Location:http://localhost/stock1/View/Authentification.php");
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
		$stock->insertstock($_POST);
		header("Location:http://localhost/stock1/View/stock.php");
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
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
	<link href="css/jquery-ui.min.css" rel="stylesheet">
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="C:/wamp/www/travail/css/bootstrap.min.css" rel="stylesheet">
	<link href="C:/wamp/www/travail/css/bootstrap-responsive.min.css" rel="stylesheet">

	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
	<link href="C:/wamp/www/travail/css/font-awesome.css" rel="stylesheet">

	<link href="C:/wamp/www/travail/css/style.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/pages/signin.css" rel="stylesheet" type="text/css">


	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/jquery-ui.js"></script>

	<script src="js/bootstrap.js"></script>
	<script src="js/base.js"></script>


  </head>

<body>
<?php include("header.php");?>
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
	    <li><a href="category2.php"><i class="icon-edit"></i><span>Category</span> </a> </li>
	    <li><a href="sous_category2.php"><i class="icon-folder-open"></i><span>sub-category</span> </a> </li>
	    <li class="dropdown"><a  href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>Stock</span> <b class="caret"></b></a>
	   <ul class="dropdown-menu">
	   	    <li><a href="stock.php">Stock </a></li>
            <li><a href="stock2.php">Stock In</a></li>
            <li><a href="stock3.php">Stock Out</a></li>
            <li><a href="total_stock.php"> Total Stock</a></li>
            <li><a href="stock_report.php">Stock report</a></li>
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
		<form action="" method="post">
		    <p><label>Category</label>
		    	<select name="category_id" type="text" value=" " id="category" >
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
		    	<select name="sous_category_id" type="text" value=" " id="sous_category">
					<option value="<?php echo 0;?>">
						select...
					</option>
				<?php foreach ($all_sous_categorys as $key => $value) {?>
					<option value="<?php echo $value->getsous_category_id();?>">
						<?php echo $value->getdescription();?>
					</option>
				<?php }?></select></p>

		    <p><label>Initial Balance</label><input type="text" name="initial_balance" readonly value=" " id="initial_balance"/></p>
		     <p><label>Date</label><input type="text" id = "date" name="date" value=""/></p>
		    <p><label>Stock In</label><input type="text" name="stock_in" value=" " id="stock_in"/></p>
		    <p><label>Balance</label><input type="text" readonly name="balance" value=" " id="balance"/></p>
			<input type="hidden" name="stock_id" value=""/>
			<input type="submit" value="Save" name="save"/>
			<br/>
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
<script>
	$( "#date" ).datepicker({dateFormat: "dd-mm-yy"});


</script>
  <?php include("footer.php");?>
</body>
<script>
	$("#category").change(function(){
		$.ajax({
		  method: "GET",
		  url: "http://localhost/stock1/controller/stock_ctl.php",
		  data: { category_id: $('#category').val()},
			dataType: "html"
		})
  	.done(function( result ) {
    	$('#sous_category').html(result);
  	});
	});

	$("#sous_category").change(function(){
		$.ajax({
		  method: "GET",
		  url: "http://localhost/stock1/controller/stock_ctl.php",
		  data: { category_id: $('#category').val(), sub_category_id: $('#sous_category').val()},
			dataType: "html"
		})
  	.done(function( result ) {
			result = result == '' ? 0 : result;
    	$('#initial_balance').val(result);
			$('#balance').val(result);
  	});
	});

	$("#stock_in").change(function(){
		var initial_balance = $('#initial_balance').val();
		var stock_in = $(this).val();
		var total = parseInt(initial_balance) + parseInt(stock_in);
		$("#balance").val(total);
	});


</script>

</html>
