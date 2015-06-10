<?php
include "connection.php";

//Fetching Values from URL
  $userId=$_POST['userId']; 
  $cartId = $_POST['cartId'];
  
  if ($cartId == 0) {
    # code...
   } else {
    # code...
    $temp =  mysql_query("DELETE FROM cart where user_id = $userId AND id = $cartId");
  }
  
   $result = mysql_query("SELECT * FROM cart where user_id = $userId ORDER BY `cart`.`added_on` DESC");
  
   $num_rows = mysql_num_rows($result);  
  if ($num_rows  > 0) {
    # code...
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
         $result2 = mysql_query("SELECT * FROM books where book_id=".$row["product_id"]."");
         $row_rsexample = mysql_fetch_assoc($result2);
          //print_r($row_rsexample['book_title']);
          echo "<div class='row'>";
          echo "<div class='span1'>";
          echo "<a class='' id='".$row_rsexample["book_id"]."'><img class='listingSizes' alt='' id='' src='images/".$row_rsexample["book_img"]."'></a></div>";    
          echo "<div class='span6' style='margin-left:20px;width:560px'>";
          echo "<a class='' id='".$row_rsexample["book_id"]."'><h5 style='margin-top:-5px'>".$row_rsexample["book_title"]."</h5></a>";
          echo "<p>".mb_strimwidth($row_rsexample["book_desc"], 0, 150, "...")."</p></div>";  
          echo "<div class='span1' style='width:70px'>";
          echo "<p>$".$row_rsexample["price_per_book"]."</p></div>";   
          echo "<div class='span2'>"; 
          echo "<a class='btn btn-primary remove_from_cart' id='".$row["id"]."' role='button' style='float:right'>Remove</a>";
          echo "</div>";
          echo "</div>";
          echo "<hr>";   
        }
      } else {
        echo "<div class='row' style='text-align:center'>No Items in Cart</div>";
      }
?>

<script>

// When your page loads
      $(function(){

       
        // $(".remove_from_cart").confirm({
        //     title:"Delete confirmation",
        //     text:"Are you sure you want to delete this Book?",
        //     confirm: function(button) {
        //         loadAjaxCartView( $(".remove_from_cart").attr('id'));
        //     },
        //     cancel: function(button) {
                
        //     },
        //     confirmButton: "Yes I am",
        //     cancelButton: "No"
        // });
           $(".remove_from_cart").click(function(e){
             e.preventDefault();
              loadAjaxCartView( $(this).attr('id'));
          });

      });
</script>