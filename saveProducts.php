<?php
//include "connection.php";
// Create connection
$conn = mysqli_connect('localhost', 'root', '', '');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Start the session
session_start(); 

//Fetching Values from URL
$bookname=$_POST['bookname']; 
$bookdesc = $_POST['bookdesc'];
$categoryModal=$_POST['category']; 
$ISBNNumber=$_POST['ISBNNumber']; 
$price=$_POST['price']; 
$bookImage = $_FILES['file-0']['name'] ;
$userID = $_SESSION["user_id"];

	  		$target_path = "images/";    
	        $validextensions = array("jpeg", "jpg", "png");    
            $ext = explode('.', basename($_FILES['file-0']['name']));   
            $file_extension = end($ext); 
            $target_file = $target_path . basename($bookImage);
            $tempName = $_FILES['file-0']['tmp_name'];
            if (($_FILES["file-0"]["size"] < 10000000)     // Approx. 100kb files can be uploaded.
            && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($tempName, $target_file)) {
                // If file moved to uploads folder.
                $sql = "INSERT INTO books (user_id  , book_title, book_desc, cat_id, isbn, price_per_book, book_img)
						VALUES ('$userID', '$bookname', '$bookdesc','$categoryModal', '$ISBNNumber', '$price', '$bookImage')";
						if (mysqli_query($conn, $sql)) {
						     $message =  "Book Posted successfully";
						} else {
						     $message =  "Error: " . $sql . "<br>" . mysqli_error($conn);
						}
                } else {     //  If File Was Not Moved.
                	  $message =  "Something went wrong please try again!!!.";
                }
            } else {     //   If File Size And File Type Was Incorrect.
            	  $message =  "Something went wrong please try again!.";
            }
   //     echo json_encode(array(
   //  		'message' => sprintf('Welcome %s', $message),
			// ));
            echo $message;
?>