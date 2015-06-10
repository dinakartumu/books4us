<?php
include "connection.php";
// Start the session
session_start();

//Fetching Values from URL
  $login_username = $_POST['login_username']; 
  $login_password = $_POST['login_password'];
  $md5Password = md5($login_password);

  $result = mysql_query("SELECT * FROM user where user_email = '$login_username' and user_password = '$md5Password'");
  $num_rows = mysql_num_rows($result);  
  if ($num_rows > 0) {
    # code...
      while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
          // Set session variables
          $_SESSION["user_id"] = $row["user_id"];
          $_SESSION["user_name"] = $row["user_fname"]." ".$row["user_lname"];  
          $message =  "Login successful";
          $status = 0;
          $isAdmin = $row["is_admin"];
          // header("Location: home.php");
          // die();
        }
  } else {
    # code...
    $status = 1;
    $message = "Sorry !!! No records found"; 
  }
  $obj = array();
  $obj['status']= $status; //
  $obj['message'] =  $message;  // .
  $obj['isAdmin'] = $isAdmin;
  echo json_encode($obj);

?>
