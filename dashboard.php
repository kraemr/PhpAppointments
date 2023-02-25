<?php session_start();
require_once('mariadb_conf.php');
?>


<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
</head>
<body>
<?php
 require_once('mariadb_conf.php');
 if($_SESSION['newsession_user'] == NULL){
 	die();
 }
 $query = mysqli_query($dbconnect, "Select * from User Where Username=". "'" .$_SESSION['newsession_user']. "'" . "and Password=" . "'" . $_SESSION['newsession_pass'] . "'" );
 $row = mysqli_fetch_assoc($query);
 if($row['User_id'] == NULL){
 	die();
 }
 $user_id = $row['User_id'];
 echo $user_id;
 echo '<link href="styles/dashboard.css" rel="stylesheet"/>';
 echo "<h1> Dashboard </h1>";
 echo "<p>". " Logged in as: ". $_SESSION['newsession_user'] ."</p>";

date_default_timezone_set('Germany/Berlin');
$current_time = date("H:i:s");
$date = date("d-m-y");
echo "<p>" . $current_time. "  ". $date . "</p>";

?>


<h1>Current appointments</h1>
 <table>
  <tr>
    <th>Date</th>
    <th>Time</th>
    <th>EndTime</th>
    <th>Name</th>
    <th>Details</th>
    <th>Who ?</th>
</tr>



<?php
require_once('mariadb_conf.php');
$user_id = 2;

function Create_Appointment($user,$Date,$Time,$EndTime,$Name,$Details,$dbconnect){
	require_once('phpsql_sanitize.php');
	// makes a query and sends it
	$query_str = "Insert Into Appointment(Date,Time,Details,Name,Who,EndTime) Values(" 
	. "'" .$Date. "',".
	"'".$Time. "'," . 
	"'". $Details ."',".
	"'". $Name ."',".
	$user. ",".
	"'". $EndTime. "')";
	// Validate Query Before
	 if ( query_is_safe($query_str) == false){
        	echo "<p> QUERY IS NOT SAFE </p>";
        }
        else{
		$query = mysqli_query($dbconnect,$query_str);
	}
}

if(array_key_exists('Appointment_btn',$_POST)){
	Create_Appointment($user_id,$_POST['Date_Field'],$_POST['Time_Field'],$_POST['EndTime_Field'],$_POST['Name'],$_POST['Details'],$dbconnect);
}

// Delete FROM Appointment Where Name='Test1' and  Who=2;
if(array_key_exists('Delete_btn',$_POST)){
	$querystr = "Delete FROM Appointment Where Name=". "'".$_POST["Delete_ID"]. "' " . "and Who=". $user_id . ";" ;
	require_once('phpsql_sanitize.php');
	if ( query_is_safe($querystr) == false){
	echo "<p> QUERY IS NOT SAFE </p>";
	}
	else{
	$query = mysqli_query($dbconnect, $querystr);
	}
}

$query = mysqli_query($dbconnect,"Select * from Appointment Join User On Appointment.Who = User.user_id Where User.user_id = 2 and Date>=Curdate() Order By Date asc;");
while ($row = mysqli_fetch_array($query)){
echo 
"<tr>".
"<th>". $row['Date'] ."</th>".
"<th>". $row['Time'] ."</th>".
"<th>". $row['EndTime'] ."</th>".
"<th>". $row['Name'] ."</th>".
"<th>". $row['Details'] ."</th>".
"<th>". $row['Username'] ."</th>".
"</tr>";
}
echo "</table>";
echo "</br>";
?>

<form method="post">
        <input type="text" name="Date_Field"><label for="Date_Field"> Date </label>
	</br>
        <input type="text" name="Time_Field"><label for="Time_Field"> Time</label>
        </br>
        <input type="text" name="EndTime_Field"> <label for="EndTime_Field"> EndTime</label>
        </br>
	<input type="text" name="Name"> <label for="Name"> Appointment Name</label>
        </br>
	<input type="text" name="Details"><label for="Details"> Details</label>
        </br>
	<input type="submit" name="Appointment_btn" value="new">
</form>

<form method="post">
	<input type="text" name="Delete_ID" ><label for="Delete_ID"> Appointment To Delete </label>
	<?php echo $_POST['Delete_ID']; ?>
	<input type="submit" name="Delete_btn" value="Delete">
</form>
</body>
</html>
