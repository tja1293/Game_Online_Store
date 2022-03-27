<?php
if(isset($_POST["submit"])){//check to find if the user entered the prper way
	$name = $_POST["name"];
	$Sname = $_POST["sname"];
	$email = $_POST["email"];
	$username = $_POST["uid"];
	$pwd = $_POST["pwd"];
	$pwdRepeat = $_POST["pwdrepeat"];
	
	require_once('dbh.inc.php');
	require_once('functions.inc.php');
	
	if(emptyInputSignup($name,$Sname,$email,$username,$pwd,$pwdRepeat) !== false){
		header("location:../~2007780/home.php?error=emptyinput");
		exit();//stop the script from running in the program
	}
	if(invalidUid($username) !== false){ 
		header("location:../~2007782/home.php?error=invaliduid");
		exit();//
	}
	if(invalidEmail($email) !== false){
		header("location:../~2007782/home.php?error=invalidemail");
		exit();
	}
	if(pwdMatch($pwd,$pwdRepeat) !== false){
		header("location:../~2007782/home.php?error=passwordsdonotmatch");
		exit();
	}
	if(uidExists($conn,$username,$email) !== false){
		header("location:../~2007782/home.php?error=usernametaken");
		exit();
	}
	createUser($conn,$name,$Sname,$email,$pwd,$username);
}
else{
	header("location:../~2007782/home.php");
	exit();
}
?>