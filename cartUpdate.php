<?php
include "connection.php";
// Create connection
$conn = mysqli_connect('localhost', 'krishnam_books4u', '5Gxda16B5g', 'krishnam_books4us');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//Fetching Values from URL
$productId = $_POST['productId']; 
$userId = $_POST['userId'];
  	if ($productId == 0 ) {
  		# For first time to show ...
 		$result = mysql_query("SELECT count(product_id) as count FROM cart where user_id=".$userId."");
	     $row_rsexample = mysql_fetch_assoc($result);
	     echo  $row_rsexample['count'];
  	} else {
  		# insert the code and then show...
  			$sql = "INSERT INTO cart (product_id, user_id )
	VALUES ('$productId', '$userId' )";
	if (mysqli_query($conn, $sql)) {
	     //echo "New record created successfully";
		//echo "SELECT count(user_id) as count FROM cart where user_id=".$userId."";exit;
	     $result = mysql_query("SELECT count(product_id) as count FROM cart where user_id=".$userId."");
	     $row_rsexample = mysql_fetch_assoc($result);
	     echo  $row_rsexample['count'];
	     
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

  	}
  	
		 
?>