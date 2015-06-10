<?php
include "connection.php";
// Start the session
session_start();
//Fetching Values from URL
$productId=$_POST['productId']; 

			# code...
			$result = mysql_query("SELECT * FROM `books` WHERE 
				(`book_id` = '".$productId."') 
				AND (`is_instock` =  '1')");
		
		// $result = mysql_query("SELECT * FROM books");

	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	   // printf("ID: %s  Name: %s", $row["book_id"], $row["book_title"]);
    if ($row["is_instock"] == 1) {
      # code...
      $inStock = "In Stock";
    } else {
      # code...
      $inStock = "Out Of Stock";
    }
    
    echo "<div class='span9'>
    <div class='row'>
       <div class='span9'>
          <h1 style='margin-top:-20px'> ".$row["book_title"]." </h1>
       </div>
    </div>
    <hr>
  
    <div class='row'>
       <div class='span3'>
        <img alt='' src='images/".$row["book_img"]."'>
       </div>   
    
    <div class='span6' style='margin-left:20px'>
    
      <div class='span6'>
        <address>
          <strong>ISBN Code:</strong> <span>".$row["isbn"]."</span><br>
          <strong>Availability:</strong> <span>".$inStock."</span><br>
        </address>
      </div>  
          
      <div class='span6'>
        <h2>
          <strong>Price: $".$row["price_per_book"]."</strong><br><br>
        </h2>
      </div>  
      <div class='span6'>
        <form class='form-inline'>
          <div class='span3 no_margin_left'>
            <a class='btn btn-primary add_to_cart' id='".$row["book_id"]."' role='button'>Add to cart</a>
          </div>  
          </form>
      </div>
      
    </div>  
  </div>  
  </div>
   <hr>
    <div class='row'>
      <div class='span9'>
          <div class='tabbable'>
              <ul class='nav nav-tabs' id='myTab'>
              <li class='active'><a href='#1' data-toggle='tab'>Description</a></li>
             <!-- <li><a href='#2' data-toggle='tab'>Reviews</a></li>-->
              </ul>
          <div class='tab-content'>
              <div class='tab-pane active' id='1'>
              <p> ".$row["book_desc"]." </p>
              
              </div>
              <div class='tab-pane' id='2'>
                <p> sfgdfgjndfg jkndfg jkns djkngsd </p>
              </div>
          </div>

          </div>
      </div>
    </div>";
	} 

	
?>
<script type="text/javascript">

    $("html, body").animate({ scrollTop: 0 }, "slow");
    $(".add_to_cart").click(function(e){
             e.preventDefault();
             //alert($(this).attr('id'))
             loadAjaxUpdateCart($(this).attr('id'));
          });
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
