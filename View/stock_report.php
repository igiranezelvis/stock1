<?php
session_start();
	if(!isset($_SESSION['connected']) || $_SESSION['connected'] != TRUE) {
		header("Location:http://localhost/stock1/View/Authentification.php");
	}
	include_once (dirname(__DIR__)."/controller/stock_report_ctl.php");
	include_once (dirname(__DIR__)."/controller/category_ctl.php");
	include_once (dirname(__DIR__)."/controller/sous_category_ctl.php");
	$category = new Category_ctl();
	$all_categorys = $category->afficherAllcategory();
	$sous_category = new Sous_category_ctl();
	$all_sous_categorys = $sous_category->afficherAllsous_category();
	$stock_report=new Stock_report_ctl();
	if(isset($_POST["save"])){
		// echo "<pre>";
		// print_r($_POST);
		// exit;
		$stock_report->insertstock_report($_POST);
		header("Location:http://localhost/stock1/View/stock_report.php");
	}
	
	$Allstock_report=$stock_report->afficherAllstock_report();
	// echo "<pre>";
		// print_r($_POST);
		// exit;

	include_once (dirname(__DIR__)."/controller/stock_report_ctl.php");
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
	<script>
	$( "#date" ).datepicker({dateFormat: "dd-mm-yy"});


</script>

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
	      				<h3> Stock Report</h3>
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
		<form action="stock_report.php" method="post">
		     <p><label>Category</label>
		    	<select name="category_id" type="text" value=" " id="category">
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
					<option value="<?php echo $value->getcategory_id();?>">
						<?php echo $value->getdescription();?>
					</option>
				<?php }?></select></p>
			<p><label>Initial balance</label><input type="text" id ="initial_balance" name="initial_balance" value=" "/></p>
			<p><label>Date</label><input type="text" id ="date" name="date" value=" "/></p>
			<p><label>Total Stock In</label><input type="text" id ="total_stock_in" name="total_stock_in" value=" "/></p>
			<p><label>Total Stock Out</label><input type="text" id ="total_stock_out" name="total_stock_out" value=" "/></p>
			<p><label>Total Balance</label><input type="text" id ="total_balance" name="total_balance" value=" "/></p>
			<input type="hidden" name="stock_report_id" value=""/>
			<input type="submit" value="Save" name="save"/>
		
		</form>
			<div class="tabbable">



						<br>
			<form>
			<fieldset>


		<div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>stock report</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
			 <?php if(!empty($Allstock_report)){?>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> Category </th>
                    <th> Sub_category</th>
                    <th> Initial balance </th>
                     <th> Date </th>
                    <th>Total Stock In </th>
                    <th>Total Stock Out</th>
                    <th>Total Balance </th>
					
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
					<?php foreach($Allstock_report as $key=>$data){?>
                  <tr>
                    <td ><?php echo $data->getcategory_description();?></td>
                    <td ><?php echo $data->getsous_category_description();?></td>
                    <td ><?php echo $data->getinitial_balance();?></td>
                    <td ><?php echo $data->getdate();?></td>
                    <td ><?php echo $data->gettotal_stock_in();?></td>
                    <td ><?php echo $data->gettotal_stock_out();?></td>
                    <td ><?php echo $data->gettotal_balance();?></td>
                    
                  </tr>

                <?php }?>
                </tbody>
              </table>
			  <?php }?>
            </div>
            <!-- /widget-content -->
          </div>


	  <center><br/>






											<br />


										</fieldset>
					</form>



						 </div>
		
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

	$("#stock_out").change(function(){
		var initial_balance = $('#initial_balance').val();
		var stock_out = $(this).val();
		var total = parseInt(initial_balance) - parseInt(stock_out);
		$("#balance").val(total);
	});
	
</script>
</html>
