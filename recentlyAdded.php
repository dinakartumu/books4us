<div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Recently added</div>
                    </div>     
<div class="row" style="margin-top:20px; padding-left:30px; padding-right:30px;">
	<?php 
	$result = mysql_query("SELECT * FROM books order by published_on DESC LIMIT 4");

	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	   // printf("ID: %s  Name: %s", $row["book_id"], $row["book_title"]);
  		echo "<div class='col-sm-6 col-md-3'>";
   		echo "<div class='thumbnail'>";
      	echo "<a class='product_details' id='".$row["book_id"]."'><img class='custom_height' src='images/".$row["book_img"]."' alt=''></a>";
		    echo "<div class='caption'>";
        echo "<a class='product_details' id='".$row["book_id"]."'><h4>".$row["book_title"]."</h4></a>";
        echo "<p class='captionp'>".mb_strimwidth($row["book_desc"], 0, 80, "...")."</p>";
        echo "<p><input id='input-1' value='".$row["book_rating"]."' class='rating' data-size='xs' data-disabled='true' data-show-caption='false' data-show-clear='false'>";
        echo "<a href='#' id='".$row["book_id"]."' class='btn btn-primary add_to_cart' role='button'>Book Now</a></p>";
      	echo "</div>";
    	echo "</div>";
  		echo "</div>";
	}
	?>
  
</div>                                        
</div> 