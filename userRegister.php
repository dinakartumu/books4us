<?php
//include "connection.php";
// Create connection
$conn = mysqli_connect('localhost', 'root', '', 'books4us');

// Start the session
session_start();

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Fetching Values from URL
$firstname=$_POST['firstname']; 
$lastname = $_POST['lastname'];
$sid=$_POST['sid']; 
$email=$_POST['email']; 
$password=$_POST['password'];
$md5Password = md5($password);

 // If file moved to uploads folder.
$sql = "INSERT INTO user (user_fname, user_lname, 	user_studentid, user_email, user_password)
		VALUES ('$firstname', '$lastname', '$sid', '$email', '$md5Password')";
		if (mysqli_query($conn, $sql)) {
			// Set session variables
			$_SESSION["user_id"] = mysqli_insert_id($conn);
			$_SESSION["user_name"] = $firstname." ".$lastname;
			 $_SESSION["isadmin"] = '0';
			$message =  "Registration successful";
		} else {
		     $message =  "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
            echo $message;
?>