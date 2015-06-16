<?php
require 'PHPMailer-master/PHPMailerAutoload.php';

$servername = "b10_16334339_ict";
$username = "b10_16334339";
$password = "263502";
$dbname = "b10_16334339_ict";

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	$mac = test_input ( $_POST ["mac"] );
	$content = test_input ( $_POST ["content"] );
	// $timestamp = test_input ( $_POST ["timestamp"] );
	$timestamp = date ( "Y-m-d H:i:s" );
	$alert = detect ( $content );
	
	if ($alert === 1) {
		$var = "MAC: $mac Content: $content Timestamp: $timestamp";
		sendalert ( $var );
	}
	/*
	 * else{
	 * $var = "MAC: $mac/t Content: $content/t Timestamp: $timestamp";
	 * sendalert($var);
	 * }
	 */
	
	try {
		$conn = new PDO ( "mysql:host=$servername;dbname=$dbname", $username, $password );
		// set the PDO error mode to exception
		$conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$sql = "INSERT INTO log (mac, content, timestamp, alert) VALUES ('$mac', '$content', '$timestamp', '$alert')";
		// use exec() because no results are returned
		
		$conn->exec ( $sql );
		// $last_id = $conn->lastInsertId();
		// echo "New record created successfully. Last inserted ID is: " . $last_id;
		echo "New record created successfully";
	} catch ( PDOException $e ) {
		echo $sql . "<br>" . $e->getMessage ();
	}
	
	$conn = null;
} else {
	echo "It's not a post method";
}

// to process data to protect from attach
function test_input($data) {
	$data = trim ( $data );
	$data = stripslashes ( $data );
	$data = htmlspecialchars ( $data );
	return $data;
}

// to detect keyword
function detect($var) {
	$ifFind = 0;
	$vocabulary = array (
			"secret",
			"money",
			"confidencial" 
	);
	$token = strtok ( $var, " " );
	// echo "$token<br>";
	while ( $token !== false ) {
		if (in_array ( $token, $vocabulary )) {
			// echo "find the word<br>";
			$ifFind = 1;
			break;
		}
		// echo "$token<br>";
		$token = strtok ( " " );
	}
	return $ifFind;
}
function sendalert($var) {
	$mail = new PHPMailer ();
	
	// $mail->SMTPDebug = 3; // Enable verbose debug output
	
	$mail->isSMTP (); // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com;smtp.gmail.com'; // Specify main and backup SMTP servers
	$mail->SMTPAuth = true; // Enable SMTP authentication
	$mail->Username = 'hushict@gmail.com'; // SMTP username
	$mail->Password = 'hushicthush'; // SMTP password
	$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587; // TCP port to connect to
	
	$mail->From = 'hushict@gmail.com';
	$mail->FromName = 'HUSH';
	// $mail->addAddress('joe@example.net', 'Joe User'); // Add a recipient
	$mail->addAddress ( 'supermanheng22@gmail.com' ); // Name is optional
	                                                  // $mail->addReplyTo('info@example.com', 'Information');
	                                                  // $mail->addCC('cc@example.com');
	                                                  // $mail->addBCC('bcc@example.com');
	                                                  
	// $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
	                                                  // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name
	$mail->isHTML ( true ); // Set email format to HTML
	
	$mail->Subject = 'HUSH: ALERT';
	$mail->Body = 'Dear sir/madam,<br><br>We are sorry to inform you that your employee has just input some <b>sensitive information</b>.<br><br>The record is following:<br><br><span style="color:red">' . $var . '</span><br><br>Best wishes,<br>HUSH';
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if (! $mail->send ()) {
		echo 'Message could not be sent.<br>';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message has been sent<br>';
	}
}
?>

