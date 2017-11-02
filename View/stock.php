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
  if(isset($_POST["select"])){
   //echo "<pre>";
   // print_r($_POST);
   // exit;
    $stock->afficherAllstock_date($_POST);
    header("Location:http://localhost/stock1/View/stock.php");
  }
   
      $Allstock=$stock->afficherAllstock_date();
       
   
  
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
            <li><a href="stock_report.php">  Stock Report</a></li>
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
                <i class="icon-list-ol"></i>
                <h3>stock</h3>
            </div> <!-- /widget-header -->

          <div class="widget-content">



            <div class="tabbable">
            <ul class="nav nav-tabs">
             <li>
                <a href="#formcontrols" data-toggle="tab">stock table select</a>
              </li>

            </ul>

            <br>

  <div>
    <form action="stock.php" method="post">
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
         <p><label>Date1</label><input type="text" id = "date1" name="date1" value=""/></p>
        <p><label>Date2</label><input type="text" name="date2" value=" " id="date2"/></p>
      <input type="hidden" name="stock_id" value=""/>
      <input type="submit" value="select" name="select"/>
       <input type="submit" value="Show" name="show"/>
      <br/>
    </form>

            <br>
        <form>    
      <fieldset>


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
                    <th> Date </th>
                    <th> Initial balance </th>
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
                    <td ><?php echo $data->getdate();?></td>
                    <td ><?php echo $data->getinitial_balance();?></td>
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
  $( "#date1" ).datepicker({dateFormat: "dd-mm-yy"});

 $( "#date2" ).datepicker({dateFormat: "dd-mm-yy"});
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
