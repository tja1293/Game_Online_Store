<!DOCTYPE html>
<head>
	<title>The database</title>
</head>
<?php
	session_start();
?>
<?php
if(!isset($_SESSION["useruid"])){
	header("location:../~2007780/home.php");
    echo "<script>alert('Sessions has expired')</script>";
}
?>
<?php
//contains n inputing data into the database and also retrieving data from the database
$servername = "localhost";
$dbusername = "2007780";
$dbpassword = "Aishaarif.123";
$dbname = "db2007780";

$conn = mysqli_connect($servername,$dbusername,$dbpassword,$dbname);

if(!$conn){
	die("Connection Failed Not working at all: ".mysqli_connect_error());
}

//mysqli_close($conn);
?>