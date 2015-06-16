<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta charset="utf-8">
<title>Input dates</title>
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
</head>
<body>
	<div class="container">

<?php
$servername = "b10_16334339_ict";
$username = "b10_16334339";
$password = "263502";
$dbname = "b10_16334339_ict";
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	try {
		$conn = new PDO ( "mysql:host=$servername;dbname=$dbname", $username, $password );
		$conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$begin = test_input ( $_POST ['begindate'] );
		// echo $begin;
		$beginarray = split ( "-", $begin );
		// echo $beginarray[0].$beginarray[1].$beginarray[2];
		$b = mktime ( 0, 0, 0, $beginarray [1], $beginarray [2], $beginarray [0] );
		$begintime = date ( "Y-m-d H:i:s", $b );
		echo "begintime: $begintime========>";
		
		$end = test_input ( $_POST ['enddate'] );
		$endarray = split ( "-", $end );
		$e = mktime ( 23, 59, 59, $endarray [1], $endarray [2], $endarray [0] );
		$endtime = date ( "Y-m-d H:i:s", $e );
		echo "endtime: $endtime<br>";
		echo "<form action='inputdate.html'><input type='submit' value='Return'></form>";
		$stmt = $conn->prepare ( "SELECT * FROM log where DATE_FORMAT(`timestamp`,'%Y-%m-%d %H:%i:%s')>='$begintime' and DATE_FORMAT(`timestamp`,'%Y-%m-%d %H:%i:%s')<='$endtime'" );
		$stmt->execute ();
		// set the resulting array to associative
		$result = $stmt->setFetchMode ( PDO::FETCH_ASSOC );
		$arr = $stmt->fetchAll ();
		foreach ( $arr as $row ) {
			$id = $row ['id'];
			$_SESSION ["id"] = $id;
			// echo $_SESSION["id"];
			$mac = $row ['mac'];
			$content = $row ['content'];
			$timestamp = $row ['timestamp'];
			$alert = $row ['alert'];
			if ($alert == 1) {
				echo '<span style="color:red">[MAC]:' . $mac . ' [Content]:' . $content . ' [Timestamp]:' . $timestamp . '</span>';
				echo '<br>';
			} else {
				echo '[MAC]:' . $mac . ' [Content]:' . $content . ' [Timestamp]:' . $timestamp;
				echo '<br>';
			}
		}
	} catch ( PDOException $e ) {
		echo "Error: " . $e->getMessage ();
	}
	$conn = null;
	echo "<form action='inputdate.html'><input type='submit' value='Return'></form>";
} else {
	echo "it's not a post method";
}
function test_input($data) {
	$data = trim ( $data );
	$data = stripslashes ( $data );
	$data = htmlspecialchars ( $data );
	return $data;
}
?>
</div>
</body>
</html>