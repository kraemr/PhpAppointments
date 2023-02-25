<?php
$hostname = "localhost";
$username = 'user';
$password = 'lla1061:;.231GTTg';
$db = "Phpcrud";
$dbconnect = mysqli_connect($hostname,$username,$password,$db);
if ($dbconnect->connect_error) {
  die("Database connection failed: " . $dbconnect->connect_error);
}

?>
