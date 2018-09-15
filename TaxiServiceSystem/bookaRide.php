<?php
include 'dbinfo.php'; 
?>  

<?php
//session_start(); 
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");//

if( isset($_POST['customerid']) and isset($_POST['startloc']) and isset($_POST['endloc']) and isset($_POST['starttime'])   and isset($_POST['endtime'])  )  {

	$cus=$_POST['customerid'];
	

	$sql_query = "select count(*) from customer where customerid='$cus'";
	$result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link)); 
	
	if($result == false)
	{
		echo 'The query failed.';
		exit();
	}
	
	
	$row = mysqli_fetch_array($result);
	$no_Of_cus = $row['count(*)'];
	
	if($no_Of_cus == 1) {
		
	
	
	
	$sql_query = "select DriverId from cab natural join driver where inservice=false";
	$result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));  
	if($result == false)
	{
		echo 'The query failed.';
		exit();
	}
	
	
	 while($row = mysqli_fetch_array($result)){ 
 	$final_result [] = $row;
	}
	
	  foreach ($final_result  as $driverID)
  {
	  
	  $available = $driverID['DriverId'];
	  
  break;
  }
  
    if(IsNullOrEmptyString($available))
		  {
			  echo "Sorry! All cabs are in service. Please book after sometime.";
			  
			  echo "<html>	<form action='MainPage.html' method='post'> <input type='submit' value='Go to Book Ride'/> </form> </html>";
			  exit();
		  }
  
  
  $sql_query = "SELECT max(SRId) FROM servicerequest";
	$result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));  
	if($result == false)
	{
		echo 'The query failed.';
		exit();
	}
	$row = mysqli_fetch_array($result);
	$MAX_SERVICEID = $row["max(SRId)"];
	$MAX_SERVICEID = $MAX_SERVICEID+1;
	
	$picup =$_POST['startloc'];
	$drop = $_POST['endloc'];
	$startTime=$_POST['starttime'];
	
	$Endtime= $_POST['endtime'];
  
  $sql_query = "insert into servicerequest values ('$cus','$available','$MAX_SERVICEID','$picup','$drop',false,'$startTime','$Endtime')";
	$result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));  
	if($result == false)
	{
		echo 'The query failed.';
		exit();
	}
	
	 $sql_query = " update cab set InService=true where DriverId='$available'";
	 $result = mysqli_query ($link, $sql_query)  or die(mysqli_error($link));  
	if($result == false)
	{
		echo 'The query failed.';
		exit();
	}
  
  echo "Successfully booked";
//  echo "<br><br><button type='button' onclick=MainPage.html >Go Back to Main Page";
  echo "<html>	<form action='MainPage.html ' method='post'> <input type='submit' value='Go Back to Main Page'/> </form> </html>";
	}
	else
	{
		echo "Customer Id not found. Please enter a valid Id";
			echo "<html>	<form action='bookaRide.html' method='post'> <input type='submit' value='Go to Book Ride'/> </form> </html>";

		
	}
} 

function IsNullOrEmptyString($question){
    return (!isset($question) || trim($question)==='');
}
?>

