<?php
include "connection.php";
?>
<table class="table table-hover table-bordered" style="margin:10px auto">
        <tr>
            <th>Id.No</th> 
            <th>Book Title</th> 
            <th>Book Desc</th>
            <th>Posted by</th>
            <th>ISBN</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        	<?php 

          //Fetching Values from URL
           $rowId = $_POST['rowId'];
            
            if ($rowId == 0) {
              # code...
             } else {
              # code...
              $temp =  mysql_query("DELETE FROM books where book_id = $rowId");
            }
            
          //echo "SELECT * FROM user order by user_date DESC";
            	$result = mysql_query("SELECT * FROM user, books where user.user_id = books.user_id order by published_on DESC");
             	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            	    echo "<tr>
                       <td>".$row["book_id"]."</td>
                        <td>".$row["book_title"]."</td>
                        <td>".$row["book_desc"]."</td>
                        <td>".$row["user_fname"]."</td>
                        <td>".$row["isbn"]."</td>
                        <td>".$row["price_per_book"]."</td>
                        <td><a class='btn btn-primary remove_book_table'  role='button' id='".$row["book_id"]."'>Delete</a></td>
                      </tr>";
            	}
            	?>
     </table>
     <script>
     // When your page loads
      $(function(){

        
        // $(".remove_book_table").confirm({
        //     title:"Delete confirmation",
        //     text:"Are you sure you want to delete this Book?",
        //     confirm: function(button) {
        //        var contentPanelId = jQuery(this).attr("id");
        //         alert(contentPanelId);
        //         loadAjaxBooks($(this).attr('id'));
        //     },
        //     cancel: function(button) {
                
        //     },
        //     confirmButton: "Yes I am",
        //     cancelButton: "No"
        // });

         $(".remove_book_table").click(function(e){
             e.preventDefault();
              //alert($(this).attr('id'));
              loadAjaxBooks($(this).attr('id'));
          });
      });
     </script>