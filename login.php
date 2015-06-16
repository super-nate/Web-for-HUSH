<?php
session_start();
$servername = "b10_16334339_ict";
$username = "b10_16334339";
$password = "263502";
$dbname = "b10_16334339_ict";
$uname = test_input ( $_POST ['userName'] );
$pword = test_input ( $_POST ['passWord'] );
// echo "username: $uname password: $pword";
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	try {
		$conn = new PDO ( "mysql:host=$servername;dbname=$dbname", $username, $password );
		$conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$stmt = $conn->prepare ( "SELECT password FROM user WHERE username = '$uname'" );
		$stmt->execute ();
		
		// set the resulting array to associative
		$result = $stmt->setFetchMode ( PDO::FETCH_ASSOC );
		$arr = $stmt->fetchAll ();
		foreach ( $arr as $row ) {
			$pworddb = $row ['password'];
			if ($pworddb == $pword) {
				echo "success";
				$_SESSION["iflog"]=1;
			}
		}
	} catch ( PDOException $e ) {
		echo "Error: " . $e->getMessage ();
	}
	$conn = null;
} else {
	echo "it's not post method";
}
function test_input($data) {
	$data = trim ( $data );
	$data = stripslashes ( $data );
	$data = htmlspecialchars ( $data );
	return $data;
}
?>