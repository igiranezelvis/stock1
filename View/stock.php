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
    if(isset($_POST["stock"])){
		$stock->insertstock($_POST);
		}
		else{
		$stock->insertstock_out($_POST);
	}
	}

	$Allstock=$stock->afficherAllstock();

	include_once (dirname(__DIR__)."/controller/stock_ctl.php");
	include_once (dirname(__DIR__)."/controller/sous_category_ctl.php");
	include_once (dirname(__DIR__)."/controller/category_ctl.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Stock</title>

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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="C:/wamp/www/travail/css/style.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link href="css/pages/signin.css" rel="stylesheet" type="text/css">


		<script src="js/jquery-1.7.2.min.js"></script>
		<script src="js/jquery-ui.js"></script>

		<script src="js/bootstrap.js"></script>
		<script src="js/base.js"></script>



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
<!-- /subnavbar -->
  <div class="main">

	<div class="main-inner">

	    <div class="container">

	      <div class="row">

	      	<div class="span12">

	      		<div class="widget ">

	      			<div class="widget-header">
	  				</div> <!-- /widget-header -->

					<div class="widget-content">



						<div class="tabbable">



						<br>
			<fieldset>
				<form class="form-inline">
					<div class="form-group">
					<label>Category</label>
			    	<select name="category_id" class="form-control" type="text" value=" " id="category" >
						<option value="<?php echo 0;?>">
							select...
						</option>
					<?php foreach ($all_categorys as $key => $value) {?>
						<option value="<?php echo $value->getcategory_id();?>">
							<?php echo $value->getdescription();?>
						</option>
					<?php }?></select>
	        </div>
					<div class="form-group">
						<label>Sub-category</label>
			    	<select name="sous_category_id"  class="form-control" type="text" value=" " id="sous_category">
						<option value="<?php echo 0;?>">
							select...
						</option>
					<?php foreach ($all_sous_categorys as $key => $value) {?>
						<option value="<?php echo $value->getsous_category_id();?>">
							<?php echo $value->getdescription();?>
						</option>
					<?php }?></select></div>
					<button type="button" id="buton" class="btn btn-primary">Select</button>
				</form>
				<div class="container">
  <table class="table table-striped" id="tabl1" style="display:none">
    <thead>
      <tr>
        <th>Category</th>
        <th>Sub_category</th>
        <th>Initial balance</th>
				<th>Date</th>
				<th>Stock In</th>
				<th>Stock Out</th>
				<th>Balance</th>
      </tr>
    </thead>
    <tbody id="tbody1">

    </tbody>
  </table>
</div>
<br>
<br>
<form class="form-inline">
	<div class="form-group">
	<label>Category</label>
		<select name="category_id" class="form-control" type="text" value=" " id="category2" >
		<option value="<?php echo 0;?>">
			select...
		</option>
	<?php foreach ($all_categorys as $key => $value) {?>
		<option value="<?php echo $value->getcategory_id();?>">
			<?php echo $value->getdescription();?>
		</option>
	<?php }?></select>
	</div>
	<div class="form-group">
		<label>Sub-category</label>
		<select name="sous_category_id"  class="form-control" type="text" value=" " id="sous_category2">
		<option value="<?php echo 0;?>">
			select...
		</option>
	<?php foreach ($all_sous_categorys as $key => $value) {?>
		<option value="<?php echo $value->getsous_category_id();?>">
			<?php echo $value->getdescription();?>
		</option>
	<?php }?></select></div>
	<div class="form-group">
	<label>Date debut</label><input type="text" class="form-control" id = "date_debut" name="date" value=""/>
	</div>
	<div class="form-group">
	<label>Date fin</label><input type="text" class="form-control" id = "date_fin" name="date" value=""/>
</div>
	<button type="button" id="show" class="btn btn-primary">Show</button>
</form>
<div class="container">
<table class="table table-striped" id="tabl2" style="display:none">
<thead>
<tr>
<th>Category</th>
<th>Sub_category</th>
<th>Initial balance</th>
<th>Date</th>
<th>Stock In</th>
<th>Stock Out</th>
<th>Balance</th>
</tr>
</thead>
<tbody id="tbody2">

</tbody>
</table>
</div>
		<br>
		<br>
		<div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>stock </h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
			 <?php if(!empty($Allstock)){?>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> Category </th>
                    <th> Sub_category</th>
                    <th> Initial balance </th>
                     <th> Date </th>
                    <th> Stock In </th>
                    <th> Stock Out</th>
                    <th> Balance </th>

                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
					<?php foreach($Allstock as $key=>$data){?>
                  <tr>
                    <td ><?php echo $data->getcategory_description();?></td>
                    <td ><?php echo $data->getsous_category_description();?></td>
                    <td ><?php echo $data->getinitial_balance();?></td>
                    <td ><?php echo $data->getdate();?></td>
                    <td ><?php echo $data->getstock_in();?></td>
                    <td ><?php echo $data->getstock_out();?></td>
                    <td ><?php echo $data->getbalance();?></td>

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




					</div> <!-- /widget-content -->

				</div> <!-- /widget -->

		    </div> <!-- /span8 -->




	      </div> <!-- /row -->

	    </div> <!-- /container -->

	</div> <!-- /main-inner -->

</div> <!-- /main -->


<script>
	$( "#date_debut" ).datepicker({dateFormat: "yy-mm-dd"});
	$( "#date_fin" ).datepicker({dateFormat: "yy-mm-dd"});

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

	$("#category2").change(function(){
		$.ajax({
		  method: "GET",
		  url: "http://localhost/stock1/controller/stock_ctl.php",
		  data: { category_id: $('#category2').val()},
			dataType: "html"
		})
  	.done(function( result ) {
    	$('#sous_category2').html(result);
  	});
	});

	$("#buton").click(function(){
		var type = "search1";
		var cat = $("#category").val();
		var sous_cat = $("#sous_category").val();
		$.ajax({
		  method: "GET",
		  url: "http://localhost/stock1/controller/stock_ctl.php",
		  data: { category: cat, sous_category: sous_cat, type: type},
			dataType: "html"
		})
  	.done(function( result ) {
			$("#tabl1").css("display","");
			if(result != "") {
				$('#tbody1').html(result);
			}else{
				$('#tbody1').html("No datas");
			}

  	});

	});

	$("#show").click(function(){
		var cat = $("#category2").val();
		var sous_cat = $("#sous_category2").val();
		var date_debut = $("#date_debut").val();
		var date_fin = $("#date_fin").val();
		$.ajax({
		  method: "GET",
		  url: "http://localhost/stock1/controller/stock_ctl.php",
		  data: { category: cat, sous_category: sous_cat, date_debut: date_debut, date_fin: date_fin},
			dataType: "html"
		})
  	.done(function( result ) {
			$("#tabl2").css("display","");
			if(result != "") {
				$('#tbody2').html(result);
			}else{
				$('#tbody2').html("No datas");
			}

  	});

	})
</script>
</html>
