<?php
include 'dbinfo.php'; 
?> 


<?php

 


//session_start(); 
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");//

if(isset($_POST['username']) and isset($_POST['password']))  { //check null
	$username = $_POST['username']; // text field for username 
	$password = $_POST['password']; // text field for password
	
// store session data



$insertStatement = "select password from customer where email='$username'";
	
	$result = mysqli_query ($link, $insertStatement)  or die(mysqli_error($link)); 
	
	if($result == false) {
		echo 'The query failed.';
		exit();
		
	}
	
	$row = mysqli_fetch_array($result);
	$existing_pwd = $row["password"];
	
	
	
	
	
	if (strcmp($password,$existing_pwd) =='0')
	{
	header('Location: MainPage.html');
	}
	else
	{
	echo 'Either Username or password is incorrect :(';	
	echo "<html>	<form action='LoginPage.html' method='post'> <input type='submit' value='Go to LoginPage'/> </form> </html>";
	}

}


?>