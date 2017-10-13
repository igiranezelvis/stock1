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
    <title>Category</title>

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
						<ul class="nav nav-tabs pull-right">
						 <li>
						    <a href="category.php" >
							<button class="btn btn-warning"><i class="icon-plus">Add</i></button></a>


						  </li>

						</ul>

						<br>
<fieldset>


		<div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>categories </h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
			 <?php if(!empty($Allcategory)){?>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> Description </th>
					
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
					<?php foreach($Allcategory as $key=>$data){?>
                  <tr>
                    <td ><?php echo $data->getdescription();?></td>
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



	   <?php include("footer.php");?>
</body>

</html>
