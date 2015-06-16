<?php
session_start ();
$servername = "b10_16334339_ict";
$username = "b10_16334339";
$password = "263502";
$dbname = "b10_16334339_ict";
// echo "i $_POST[i]";
try {
	$conn = new PDO ( "mysql:host=$servername;dbname=$dbname", $username, $password );
	$conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	
	if ($_POST [i] == 0) {
		$stmt = $conn->prepare ( "SELECT * FROM log where id =(select max(id) from log)" );
		$stmt->execute ();
		// set the resulting array to associative
		$result = $stmt->setFetchMode ( PDO::FETCH_ASSOC );
		$arr = $stmt->fetchAll ();
		// echo "i $_POST[i]";
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
				echo '[MAC]: ' . $mac . ' [Content]:' . $content . ' [Timestamp]:' . $timestamp;
				echo '<br>';
			}
		}
	} else {
		$base = $_SESSION ["id"];
		$stmt = $conn->prepare ( "SELECT * FROM log where id >'$base'" );
		$stmt->execute ();
		
		// set the resulting array to associative
		$result = $stmt->setFetchMode ( PDO::FETCH_ASSOC );
		$arr = $stmt->fetchAll ();
		
		foreach ( $arr as $row ) {
			$id = $row ['id'];
			$_SESSION ["id"] = $id;
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
		// echo "empty";
	}
} catch ( PDOException $e ) {
	echo "Error: " . $e->getMessage ();
}
$conn = null;
?>
