<?php
//include "connection.php";
// Create connection
$conn = mysqli_connect('localhost', 'root', '', 'tumudina_books4us');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Fetching Values from URL
$catName=$_POST['catName'];  


	  		   $sql = "INSERT INTO categories (category_name)
						VALUES ('$catName')";
						if (mysqli_query($conn, $sql)) {
						     $message =  "Category added successfully";
						} else {
						     $message =  "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
              
            echo $message;
?>