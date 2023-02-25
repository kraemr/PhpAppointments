<?php
session_start(); // HAS TO BE THE FIRST THING 
//$_SESSION['Hello'] = "Hello";
//print_r($_SESSION);
require_once('crypto.php');


$passhash = get_salted_SHA512($_POST['password']);
$login = true;
if( $_POST['register'] != NULL){$login = false;}
else{$login = true;}

// NOW connect to db
require_once('mariadb_conf.php'); // connects us to DB

if($login == true){ // we want to login
 $query = mysqli_query($dbconnect, "Select * from User Where Username=". "'" .$_POST['username'] . "'");
 $row = mysqli_fetch_assoc($query);

	if( $row['Password'] != $passhash){echo "LOGIN UNSUCCESSFUL";}
	else{
        $_SESSION['newsession_user'] =  $_POST['username'];
        $_SESSION['newsession_pass'] = $passhash;
	}

//	print_r($_SESSION);
//	echo "pass: ". $passhash;
	header('Location: dashboard.php');
	die();
}
else{ // we are trying to register
 echo $passhash;
 $query = mysqli_query($dbconnect, "INSERT INTO User(Username,Password) Values(". "'" .$_POST['username'] . "', '" . $passhash . "')" );
 $_SESSION['newsession_user'] = $_POST['username'];
 $_SESSION['newsession_pass'] = $passhash;
 header('Location: dashboard.php');
 die(); // ):
}

?>

