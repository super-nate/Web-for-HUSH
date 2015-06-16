<?php
session_start();
if ($_SESSION["iflog"] == 1){
header("Location: userhome.php"); 
exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- <link rel="icon" href="http://getbootstrap.com/favicon.ico"> -->

<title>Welcome to HUSH</title>

<!-- Bootstrap core CSS -->
<link href="http://getbootstrap.com/dist/css/bootstrap.min.css"
	rel="stylesheet">

<!-- Custom styles for this template -->
<link href="http://getbootstrap.com/examples/jumbotron/jumbotron.css"
	rel="stylesheet">

<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script
	src="http://getbootstrap.com/assets/js/ie-emulation-modes-warning.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<!--  <div class="navbar-header"> -->
			<a class="navbar-brand" href="index.php">HUSH</a>
			<!--	</div>-->
			<div id="navbar" class="navbar-collapse collapse">
				<!--	<p id="alertWord" style="color: red">wrong</p>-->
				<form class="navbar-form navbar-right" role="form"
					action="userhome.php" id="signinForm" method="post">
					<div class="form-group">
						<input type="text" placeholder="Username" class="form-control"
							name="userName" id="userName" required>
					</div>
					<div class="form-group">
						<input type="password" placeholder="Password" class="form-control"
							name="passWord" id="passWord" required>
					</div>
					<!--  <div class="checkbox">
						<label style="color:white"><input type="checkbox"> Remember me</label>
					</div> -->
					<button type="button" class="btn btn-success" formtarget="_self"
						id="signinbutton">Log in</button>
					<!--   <button type="button" class="btn btn-success" href="register.jsp" formtarget="_self">Sign up</button>-->
					<!-- <a class="btn btn-success" href="SignUp.jsp" role="button">Sign
						up</a> -->
				</form>
			</div>
			<!--/.navbar-collapse -->
		</div>
	</nav>

	<!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="jumbotron">
		<div class="container">
			<h1>HUSH!</h1>
			<p>HUSH is very useful for people to detect the message from your
				employees.</p>
		</div>
	</div>
	<div class="container">
		<!-- Example row of columns -->
		<div class="row">
			<div class="col-md-4">
				<h2>Cloud</h2>
				<p>The data are all stored in the cloud that you will never lost
					them.!</p>
				<!-- <p>
					<a class="btn btn-default" href="#" role="button">View details
						&raquo;</a>
				</p> -->
			</div>
			<div class="col-md-4">
				<h2>Free</h2>
				<p>The service is completely free!</p>
				<!-- <p>
					<a class="btn btn-default" href="#" role="button">View details
						&raquo;</a>
				</p> -->
			</div>
			<div class="col-md-4">
				<h2>Real-time</h2>
				<p>The detection is totally realtime.</p>
				<!-- <p>
					<a class="btn btn-default" href="#" role="button">View details
						&raquo;</a>
				</p> -->
			</div>
		</div>

		<hr>

		<footer>
			<p>&copy; HUSH Company 2015</p>
		</footer>
	</div>
	<!-- /container -->
	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script
		src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
	<script>
		$(document).ready(function() {
			$("#signinbutton").click(function() {
				var userName = $("#userName").val();
				var passWord = $("#passWord").val();
 				if ((userName.length !== 0) && (passWord.length !== 0)) {
					$.post("login.php", {
						userName : userName,
						passWord : passWord
					}, function(data, status) {
						//alert("Data: " + data + "\nStatus: " + status);
						//alert(typeof(data))
						if(data == "success")
						{
							//alert("yeah");
							$("#signinForm").submit();
						}
						else{
							alert("your username or password is wrong");
						}
					});
				}
				else{
					alert("please input your username and password");
				} 
			});
			$(document).keypress(function(e) {  
			    // press enter on the keyboard   
			       if(e.which == 13) {  
			   jQuery("#signinbutton").click();  
			       }  
			   }); 

		});
	</script>
	
</body>
</html>
