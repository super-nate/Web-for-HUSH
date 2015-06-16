<?php
session_start ();
if ($_SESSION ["iflog"] != 1) {
	header ( "Location: index.php" );
	exit ();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- <link rel="icon" href="http://getbootstrap.com/favicon.ico"> -->

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
<style>
html, body {
	height: 100%;
	width: 100%;
}

#footer {
	position: absolute;
	bottom: 0;
	width: 100%;
	height: 60px;
	/* background: #6cf;  */
	clear: both;
}
</style>

</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="userhome.php">HUSH</a>
			</div>

			<div class="collapse navbar-collapse"
				id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#realtime" id="realtime-tab"
						role="tab" data-toggle="tab" aria-controls="realtime"
						aria-expanded="true">Realtime</a></li>

					<li><a href="#records" role="tab" id="records-tab"
						data-toggle="tab" aria-controls="records">Records</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a role="button" id="logout-button" href="logout.php">Logout</a></li>
				</ul>
			</div>

		</div>
	</nav>

	<div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade in active" id="realtime"
			aria-labelledBy="realtime-tab">
			<div class="container">
				<h3>Getting server updates</h3>
				<div id="result">
					<p id="base"></p>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="records"
			aria-labelledBy="records-tab">
			<div id="searchdiv" class="container">
			<h3>Search records</h3>
				<iframe id="iframe_id" src="inputdate.html" class="container" height="450"></iframe>
			</div>
		</div>
	</div>
	<div class="container" id="footer">
		<hr>
		<footer>
			<p>&copy; HUSH Company 2015</p>
		</footer>
	</div>
	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script
		src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
	<script>
		var i = 0;
		$(document).ready(function() {
			setInterval(function() {
				$.post("checkupdate.php", {
					i : i
				}, function(data, status) {
					//alert("Data: " + data + "\nStatus: " + status);
					$("#base").append(data);
				});
				i++;
			}, "30000");

		});
	</script>
</body>
</html>
