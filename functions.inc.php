<!DOCTYPE html>
<head>
	<title>The database</title>
</head>
<?php
if(!isset($_SESSION["useruid"])){
	header("location:../~2007780/home.php");
    echo "<script>alert('Sessions has expired')</script>";
}
?>
<?php
session_start();
function emptyInputSignup($name,$Sname,$email,$username,$pwd,$pwdRepeat){
	$result;
	if(empty($name)|| empty($Sname)||empty($email) || empty($username)||empty($pwd)||empty($pwdRepeat)){
		$result= true;
	}
	else{
		$result = false;
	}
	return $result;
}
function invalidUid($username){
	$result;
	if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){//search algorithm
		$result= true;
	}
	else{
		$result = false;
	}
	return $result;
}
function invalidEmail($email){
	$result;
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$result= true;
	}
	else{
		$result = false;
	}
	return $result;
}
function pwdMatch($pwd,$pwdRepeat){
	$result;
	if($pwd !== $pwdRepeat){
		$result= true;
	}
	else{
		$result = false;
	}
	return $result;
}
function uidExists($conn,$username,$email){
	$sql = "SELECT * FROM gamehubsignup WHERE mobileNumber = ? OR email = ?;";
	$stmt = mysqli_stmt_init($conn); //initializing a statement
	
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location:../~2007780/home.php?error=stmtfailed");
		exit();
	} 
	
	mysqli_stmt_bind_param($stmt,"ss",$username,$email);
	mysqli_stmt_execute($stmt); //checking if the user in in the databse
	
	$resultData = mysqli_stmt_get_result($stmt);
	
	if($row = mysqli_fetch_assoc($resultData)){
		return $row;
	}
	else{
		$result = false;
		return $result;
	}
	mysqli_stmt_close($stmt);
}


function createUser($conn,$name,$Sname,$email,$pwd,$username){
	
	$sql = "INSERT INTO gamehubsignup(forename, surname, email, usersPwd, mobileNumber) VALUES(?,?,?,?,?);";
	$stmt = mysqli_stmt_init($conn);//initialize a new prepared statement
	
	if(!mysqli_stmt_prepare($stmt,$sql)){ //check if it going to fail
		header("location:../~2007780/home.php?error=stmtsignfailed");
		exit();
	}else{
	$hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);//encrypting password to make it unable to read and more secure
	mysqli_stmt_bind_param($stmt,"sssss",$name,$Sname,$email,$hashedPwd,$username);
	mysqli_stmt_execute($stmt); //checking if the user in in the databse
	mysqli_stmt_close($stmt);
	
	header("location:../~2007780/home.php?error=none");
	exit();
	
}
}
function emptyInputLogin($username,$pwd){
	$result;
	if(empty($username)||empty($pwd)){
		$result= true;
	}
	else{
		$result = false;
	}
	return $result;
}
function loginUser($conn,$username,$pwd){
	$uidExists = uidExists($conn,$username,$username);
	
	if($uidExists === false){
		header("location:../~2007780/home.php?error=wronglogin");
		exit();
	}
	$pwdHashed = $uidExists["usersPwd"];
	$checkPwd = password_verify($pwd,$pwdHashed);
	
	if($checkPwd === false){
		header("location:../~2007780/home.php?error=wronglogin");
		exit();
	}
	else if($checkPwd === true){ //Calling for sessions
		session_start();
		$_SESSION["userid"] = $uidExists["userID"];
		$_SESSION["useruid"] = $uidExists["email"];
		

			// Using User cookies
		/*$usercookie = ['name'=>$username,'password'=> $pwd];
		$usercookie = serialize($usercookie);
		setcookie('user',$user,time()+3600);*/

		header("location:../~2007780/index.php");
		exit();
		
	}
}