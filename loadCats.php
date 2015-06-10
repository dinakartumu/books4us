<?php
include "connection.php";
?>
<table class="table table-hover table-bordered" style="margin:10px auto">
        <tr>
            <th>Id.No</th> 
            <th>Category Name</th> 
            <th>Added On</th>
            <th>Action</th>
        </tr>
        	<?php 

          //Fetching Values from URL
            $rowId = $_POST['rowId'];
            
            if ($rowId == 0) {
              # code...
             } else {
              # code...
              $temp =  mysql_query("DELETE FROM categories where category_id = $rowId");
            }
            
          //echo "SELECT * FROM user order by user_date DESC";
            	$result = mysql_query("SELECT * FROM categories order by added_on DESC");
             	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            	    echo "<tr>
                       <td>".$row["category_id"]."</td>
                        <td>".$row["category_name"]."</td>
                        <td>".$row["added_on"]."</td>
                        <td><a class='btn btn-primary remove_from_table'  role='button' id='".$row["category_id"]."'>Delete</a></td>
                      </tr>";
            	}
            	?>
     </table>
     <script>
     // When your page loads
      $(function(){

        
        // $(".remove_from_table").confirm({
        //     title:"Delete confirmation",
        //     text:"Are you sure you want to delete this Category?",
        //     confirm: function(button) {
        //         loadAjaxCats( $(".remove_from_table").attr('id'));
        //     },
        //     cancel: function(button) {
                
        //     },
        //     confirmButton: "Yes I am",
        //     cancelButton: "No"
        // });
          //  $(".remove_from_cart").click(function(e){
          //    e.preventDefault();
             
          // });
       $(".remove_from_table").click(function(e){
             e.preventDefault();
              //alert($(this).attr('id'));
              loadAjaxCats($(this).attr('id'));
          });
      });
     </script>