<?php
include "connection.php";
// Start the session
session_start();

//Fetching Values from URL
$search=$_POST['search']; 
$categoryId = $_POST['category'];
$sortBy=$_POST['sortBy']; 

		if ($sortBy == 1 ) {
			# publsihed on latest to old means DESC...
			$orderBY = "published_on DESC";
		} else if ($sortBy == 2 ) {
			# publsihed on old to latest means ASC...
			$orderBY = "published_on ASC";
		}else if ($sortBy == 3 ) {
			# Price  High  to Low means DESC...
			$orderBY = "price_per_book DESC";
		}elseif ($sortBy == 4 ) {
			# Price  Low  to high means ASC...
			$orderBY = "price_per_book ASC";
		} 
		if ($categoryId != 0 ) {
			# code...
			$result = mysql_query("SELECT * FROM `books` WHERE 
				(`cat_id` LIKE '%".$categoryId."%') 
				AND (`is_instock` LIKE  '%1%') ORDER BY ".$orderBY."");
		} else {
			# code...
				$result = mysql_query("SELECT * FROM `books` WHERE (book_title LIKE    '%".$search."%') 
				OR (`book_desc` LIKE '%".$search."%') 
				OR (`isbn` LIKE '%".$search."%') 
				OR (`cat_id` LIKE '%".$categoryId."%') 
				OR (`price_per_book` LIKE  '%".$search."%')  ORDER BY ".$orderBY."");
		}
		// $result = mysql_query("SELECT * FROM books");
   $num_rows = mysql_num_rows($result);  
	if ($num_rows  > 0) {
    # code...
          while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
           // printf("ID: %s  Name: %s", $row["book_id"], $row["book_title"]);
              echo "<div class='row'>";
              echo "<div class='span1'>";
              echo "<a class='product_details' id='".$row["book_id"]."'><img class='listingSizes' alt='' id='' src='images/".$row["book_img"]."'></a></div>";    
              echo "<div class='span6' style='margin-left:20px;width:540px'>";
              echo "<a class='product_details' id='".$row["book_id"]."'><h5 style='margin-top:-5px'>".$row["book_title"]."</h5></a>";
              echo "<p>".mb_strimwidth($row["book_desc"], 0, 100, "...")."</p></div>";  
              echo "<div class='span1' style='width:50px'>";
              echo "<p>$".$row["price_per_book"]."</p></div>";   
              echo "<div class='span2'>"; 
              echo "<a class='btn btn-primary add_to_cart' id='".$row["book_id"]."' role='button' style='float:right'>Add to cart</a>";
              echo "</div>";
              echo "</div>";
              echo "<hr>";    
        } 
  } else {
    # code...
      echo "<div class='row' style='text-align:center'>No records found... Please change the search criteria</div>";
  }
 

	
?>

<script> 
// When your page loads
      $(function(){
           
        var ProductId = 0;
        
          $(".product_details").click(function(e){
             e.preventDefault();
             ProductId = $(this).attr('id');
             //alert(ClickImageId)
             loadAjaxProductDetails(ProductId);
          });
          
      });
      $(".add_to_cart").click(function(e){
             e.preventDefault();
             //alert($(this).attr('id'))
             loadAjaxUpdateCart($(this).attr('id'));
          });

      function loadAjaxProductDetails(bookId) {
      	//alert(ProductId);
        $.ajax({
          method: "POST",
          url: "productDetails.php",
          data: {  productId: bookId }
        })
          .done(function( msg ) { 
        //    alert(msg);
        	 $( ".breadcrumb").hide();
             $( "#body_container" ).empty(); 
             $( "#body_container" ).append( msg );
          });
      }
       function loadAjaxUpdateCart(CartProductId) {
      	//alert(catId);
        $.ajax({
          method: "POST",
          url: "cartUpdate.php",
          data: {  productId: CartProductId , userId : '<?php  echo $_SESSION["user_id"]; ?>'}
        })
          .done(function( msg ) { 
            //alert(msg);
        	  $( "#cart-total").text(msg);
            $("html, body").animate({ scrollTop: 0 }, "slow");
          });
      }

</script>
