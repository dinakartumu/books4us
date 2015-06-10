<?php
include "connection.php";
?>
<table class="table table-hover table-bordered" style="margin:10px auto">
        <tr>
            <th>Id.No</th> 
            <th>First Name</th> 
            <th>Last Name</th>
            <th>Student ID</th>
            <th>Email Address</th>
            <th>Action</th>
        </tr>
        	<?php 

          //Fetching Values from URL
            $rowId = $_POST['rowId'];
            
            if ($rowId == 0) {
              # code...
             } else {
              # code...
              $temp =  mysql_query("DELETE FROM user where user_id = $rowId");
            }
            
          //echo "SELECT * FROM user order by user_date DESC";
            	$result = mysql_query("SELECT * FROM user where is_admin = 0 order by user_date DESC");
             	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            	    echo "<tr>
                       <td>".$row["user_id"]."</td>
                        <td>".$row["user_fname"]."</td>
                        <td>".$row["user_lname"]."</td>
                        <td>".$row["user_studentid"]."</td>
                        <td>".$row["user_email"]."</td>
                        <td><a class='btn btn-primary remove_from_table'  role='button' id='".$row["user_id"]."'>Delete</a></td>
                      </tr>";
            	}
            	?>
     </table>
     <script>
     // When your page loads
      $(function(){

        
        // $(".remove_from_table").confirm({
        //     title:"Delete confirmation",
        //     text:"Are you sure you want to delete this User?",
        //     confirm: function(button) {
        //         loadAjaxUsers( $(".remove_from_table").attr('id'));
        //     },
        //     cancel: function(button) {
                
        //     },
        //     confirmButton: "Yes I am",
        //     cancelButton: "No"
        // });
          //  $(".remove_from_cart").click(function(e){
          //    e.preventDefault();
             
          // });
       $(".remove_book_table").click(function(e){
             e.preventDefault();
              //alert($(this).attr('id'));
              loadAjaxUsers($(this).attr('id'));
          });
      });
     </script>