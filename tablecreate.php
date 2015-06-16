<?php
$servername = "b10_16334339_ict";
$username = "b10_16334339";
$password = "263502";
$dbname = "b10_16334339_ict";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table
    $sql = "CREATE TABLE log (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    mac VARCHAR(100) NOT NULL,
    content VARCHAR(100) NOT NULL,
    timestamp TIMESTAMP,
    alert INT(6) NOT NULL
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table log created successfully<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>
<?php
$servername = "b10_16334339_ict";
$username = "b10_16334339";
$password = "263502";
$dbname = "b10_16334339_ict";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table
    $sql = "create table user(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(30) NOT NULL
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table user created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>