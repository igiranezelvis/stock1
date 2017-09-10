
<?php

	include_once (dirname(__DIR__)."/controller/authentification_ctl.php");
	$authentification=new Authentification_ctl();
	if(isset($_POST['connection'])){
		$value=$authentification->authentification($_POST);
	}
?>

<!DOCTYPE html>
<html lang="en">
  
<head>
   <meta charset="utf-8">
    <title> stock</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

<link href="css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/pages/signin.css" rel="stylesheet" type="text/css">

<script>
function validateForm() {
    var username = document.forms["loginForm"]["username"].value;
	var password = document.forms["loginForm"]["password"].value;
    if (username == null || username == "" || password == null || password == "" ) {
        alert("Incorrect username and/or password");
        return false;
    }
}
</script>



</head>

<body>
	<div id="Authentification.php">
			<?php
			if(isset($value)){
			?>
				<p style="color: red;"><?php echo $value;?></p>
			<?php 
			}
			?>
	
	<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="">
                   Stock Management			
			</a>		
			
				
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->



<div class="account-container">
	
	<div class="content clearfix">
	
		
		<form action=" " name="loginForm" onsubmit="return validateForm()" method="post">
		
			<h1>Authentification</h1>		
			
			<div class="login-fields">
				
				
				
				<div class="field">
					<label for="username">Username:</label>
					<input type="text" id="username" name="username" value="" placeholder="Username" class="login login-field" />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field"/>
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			<p><input type="submit" value="Connection" name="connection"/></p> 
			
			<!-- <div class="login-actions">
				
				<span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Keep me signed in</label>
				</span>
									
				<button class="button btn btn-success btn-large">Sign In</button>
				
			</div> <!-- .actions -->
			
			
			
		</form>
		
		</div>
	
	
</div> <!-- /account-container -->


<script src="View/js/jquery-1.7.2.min.js"></script>
<script src="View/js/bootstrap.js"></script>

<script src="View/js/signin.js"></script>

</body>

</html>
