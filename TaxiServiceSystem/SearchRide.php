<?php
include 'dbinfo.php';
?>
<?php



$link = new mysqli($host,$user,$pass);
// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
} 
echo "Connected successfully";
 // or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");




if($_GET['value'] != null)  { // ISBN
	$value = $_GET['value'];  
	// store session data
$arr =  explode(" ", $value);
}
//print all the value which are in the array
  foreach($arr as $v){
  //	echo $v;
    $v = trim($v); 
  	$SRId=$v;

  	
 
	$sqll = "UPDATE servicerequest SET Cancelled='1' where SRId ='$SRId'";
  	//$sqll= "update servicerequest set Cancelled=1 where SRId='$SRId'";
	$SRId_rs0 = mysqli_query($link,$sqll);
  }
  //	while($row = mysqli_fetch_array($SRId_rs0)){ 
	//  $final_result [] = $row;
	//}
	
  	$sqll= "select * from servicerequest where SRId ='$SRId' GROUP BY SRId";
  	$SRId_rs0 = mysqli_query($link,$sqll);
  	while($row = mysqli_fetch_array($SRId_rs0)){ 
	  $final_result [] = $row;
	}

 
  function remove_duplicateKeys($key,$data){
  
  	$_data = array();
  
  	foreach ($data as $v) {
  		if (isset($_data[$v[$key]])) {
  			// found duplicate
  			continue;
  		}
  		// remember unique item
  		$_data[$v[$key]] = $v;
  	}
  	// if you need a zero-based array, otheriwse work with $_data
  	$data = array_values($_data);
  	return $data;
  }
  
  $uniqueSRId = remove_duplicateKeys("SRId",$final_result);
  

  
//  echo count($uniqueIsbn);
  if(count($uniqueSRId)>0)
  {
	
	  
	  echo "<table border='1' style='width:100%'><tr><th>Request Number</th><th>Customer ID</th><th>Driver ID</th><th>PickUp</th><th>Drop Location</th><th>Cancelled</th> <th>Start Time</th> <th>End Time</th></tr>";
  foreach ($uniqueSRId as $ride_row)
  {
  	
  	
  
  	$SRId = $ride_row['SRId'];
  	$CustomerNo = $ride_row['CustomerNo'];
  	$DriverNo = $ride_row['DriverNo'];
	$PickUp = $ride_row['PickupLocation'];
	$DropLocation = $ride_row['DropLocation'];
	$Cancelled = $ride_row['Cancelled'];
  	$Start = $ride_row['StartTime'];
	$End = $ride_row['EndTime'];
  
 
  	  echo "  <td>" .$SRId. "</td>";
  	   echo " <td>". $CustomerNo . "</td>";
  	    echo "<td>" . $DriverNo . "</td>";
		echo "<td>" . $PickUp . "</td>";
		echo "<td>" . $DropLocation . "</td>";
		echo "<td>" . $Cancelled . "</td>";
		echo "<td>" . $Start . "</td>";
		echo "<td>" . $End . "</td>:'
  	   // </tr>";
	
  	
  	}
  	
 echo "</table>";
 //echo "<input type='Submit' onclick=borrow('$t$row[isbn]') value='Checkout'/>";
 echo "<br><br><button type='button' onclick=returnToMainPage();>Go Back to Cab Service";
  }
  else
  {
	  echo " Sorry! No results matches with your search query.. ";
	 echo "<br><br><button type='button' onclick=returnToMainPage();>Go Back to Cab Service";
	  
  }
?>