<?php
include 'dbinfo.php'; 
?>  

<?php
//session_start(); 
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");//

if(isset($_POST['firstname']) and isset($_POST['lastname']) and isset($_POST['email'])   and isset($_POST['DOB'])  and isset($_POST['phonenumber'])  and isset($_POST['Password'])     and isset($_POST['Password1'])       )  {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$name = "$firstname $lastname";
	$email = $_POST['email'];
	$DOB = $_POST['DOB'];
	$phonenumber = $_POST['phonenumber'];
	$Password = $_POST['Password'];
	$Password1 = $_POST['Password1'];
	
	
	
	if (strcmp($Password,$Password1) =='0')
	{
		$insertStatement = "INSERT INTO PERSON values ('$email',$phonenumber,'$firstname','$lastname','$DOB')";
	
	$result = mysqli_query ($link, $insertStatement)  or die(mysqli_error($link)); 
	if($result == false) {
		echo 'The query failed.';
		
		
	} else {
		
		
		
		$sql_query = "SELECT max(CustomerId) FROM CUSTOMER";
	$result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));  
	if($result == false)
	{
		echo 'The query failed.';
		exit();
	}
	$row = mysqli_fetch_array($result);
	$MAX_CUSTOMERID = $row["max(CustomerId)"];
	$MAX_CUSTOMERID = $MAX_CUSTOMERID+1;
		
		
		$insertStatement = "INSERT INTO CUSTOMER values ($phonenumber,'$email',$MAX_CUSTOMERID,'$Password')";
		$result = mysqli_query ($link, $insertStatement)  or die(mysqli_error($link)); 
		
		if($result == false) {
		echo 'The query failed.';
		exit();
		}
		
		
		
		
		echo 'User added successfully ';
		echo "\n";
		echo " Your unique customer id is ";
		echo $MAX_CUSTOMERID;
	echo "<html>	<form action='LoginPage.html' method='post'> <input type='submit' value='Go to LoginPage'/> </form> </html>";
	exit();
	}
	}
	else{
		echo 'Password does not match';
	echo "<html>	<form action='NewUserRegistration.php' method='post'> <input type='submit' value='Retry again'/> </form> </html>";
	exit();
	}
	
	
	
	
	
	
} 


?>

<html>
<body>
<h1>Create Profile</h1>

<form action="" method="post">
<table>
<tr>
    <td>First Name</td>
    <td><input type="text" name="firstname" required/></td>
</tr>
<tr>
    <td>Last Name</td>
    <td><input type="text" name="lastname" required/></td>
</tr>

<tr>
    <td>D.O.B</td>
    <td><input type="text" name="DOB" required/></td>
</tr>

<tr>
    <td>Email</td>
    <td><input type="text" name="email" required/></td>
</tr>

<tr>
    <td>Phone number</td>
    <td><input type="text" name="phonenumber" required/></td>
</tr>

<tr>
    <td>Password</td>
    <td><input type="password" name="Password" required/></td>
</tr>

<tr>
    <td>Confirm Password</td>
    <td><input type="password" name="Password1" required/></td>
</tr>


</table>











<input type="submit" value="submit"/>
</form>

<form action='LoginPage.html' method='post'> <input type='submit' value='Go back to LoginPage'/> </form>

</body>
</html>