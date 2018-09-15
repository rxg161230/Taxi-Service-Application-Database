

<?php
include 'dbinfo.php';
?>
<?php


$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");


if($_GET['value'] != null)  { // ISBN
	$value = $_GET['value'];  
	// store session data
$arr =  trim($value);



	$sqll= "select * from servicerequest where CustomerNo='$arr' ";
  	$result = mysqli_query($link,$sqll);
  	while($row = mysqli_fetch_array($result)){ 
	  $final_result [] = $row;
	}
  
 
	  echo "<table border='1' style='width:100%'><tr><th> DriverNo </th><th>Service Request ID</th><th>Pick up Location</th> <th> Drop Location</th> <th>Start Time</th> <th>End Time</th> <th>Cancel Ride</th></tr>";
  foreach ($final_result as $book_row)
  {
  	
  	
  
  	$driverNo = $book_row['DriverNo'];
  	
  	$sRId = $book_row['SRId'];
	$pickupLocation = $book_row['PickupLocation'];
	$dropLocation = $book_row['DropLocation'];
	$cancelled= $book_row['Cancelled'];
	$startTime= $book_row['StartTime'];
	$endTime = $book_row['EndTime'];
  	
	
  	
  //	echo" <tr> <td><input type='radio' name='ISBN' value='". $ISBN ."' required></td>";
   echo " <td>". $driverNo . "</td>";
  echo " <td>". $sRId . "</td>";
  	    echo "<td>" . $pickupLocation . "</td>";
		 echo "<td>" . $dropLocation . "</td>";
				 echo "<td>" . $startTime . "</td>";
		 echo "  <td> " .$endTime . "</td>";
  	  
  	   
		  if($cancelled == 0)
		  {
			 
 
  echo "<td><button type='button' onclick=cancelRide('$book_row[SRId]');>Cancel Ride</td>";
	//echo " <td> <button type='button'  onclick=paid('$book_row['isbn']$book_row['Loan_id']');> Paid </button> </td>";
		  }
	else
		{
			 
		
			echo "<td><button disabled type='button' onclick=cancelRide('$book_row[SRId]');>Cancel Ride</td>";
		}
		 
  	   echo" </tr>";
	
  	
  	}
  	
 echo "</table>";
 
  echo "<br><br><button type='button' onclick=returnToMainPage();>Go Back to Main Page";
}
 
 if($_GET['reqid'] != null)  { 
 
 
 $value = $_GET['reqid'];  
	// store session data
$serID = trim($value);

$sqll= "select DriverNo from servicerequest where SRId='$serID' ";
  	$result = mysqli_query($link,$sqll);
  	$row = mysqli_fetch_array($result);

	$driverNo = $row['DriverNo'];
	//echo $driverNo;
	$sqll= "update cab set inservice=false where DriverId='$driverNo' ";
  	$result = mysqli_query($link,$sqll);

	$sqll= "delete from payment where SRId='$serID'";

  $isCheckOutQuery = mysqli_query($link,$sqll);
	

$sqll= "delete from servicerequest where SRId='$serID'";

  $isCheckOutQuery = mysqli_query($link,$sqll);
 // $result = mysqli_fetch_array($isCheckOutQuery);

  
  echo " Ride Successfully cancelled";
  
 echo "<br><br><button type='button' onclick=returnToMainPage();>Go Back to Main Page";
 }
 ?>