<?php 
// Start the session
session_start(); 
include "header.html";
include "connection.php";


if(!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])) {
   header("Location: index.php");
   die();
}

?>

<div class="container">    
<div class="panel panel-default" style="margin-top:50px;">
  <div class="panel-body"> 
     <a class="navbar-brand" href="#" id="home">Home</a>
    <a class="navbar-brand" data-target="#loginModal" data-toggle="modal">Post Book</a>
    <!-- <p class="navbar-text navbar-right">Welcome, <a href="#" class="navbar-link"><?php echo $_SESSION["user_name"]; ?></a></p> -->
    

    <ul class="nav nav-tabs navbar-right navbar-text">
      <li role="presentation" class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
          <?php echo $_SESSION["user_name"]; ?> <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="#" id="logOff">Logoff</a></li>
        </ul>
      </li>
    </ul>


      <div id="cart" class="navbar-right" data-toggle="modal" data-target=".bs-example-modal-lg" onclick=" loadAjaxCartView(0);">
          <button type="button" class="btn btn-primary" >
            <span id="cart-total">0</span> 
          </button>
      </div>
  </div>
</div>
<div class="jumbotron panel panel-default" style="margin-top:30px;">
  <div class="panel-body"> 
    <div class="col-lg">
       <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for books..." id="search">
          <span class="input-group-btn">
          <button class="btn btn-default" type="button" id="search_button">Go!</button>
          </span>
        </div> 
        <div class="row list_container">
        <div class="span3">

<!-- start sidebar -->
<ul class="breadcrumb">
    <li>Categories</li>
</ul>
<div class="span3 product_list">
  <ul class="nav">
  <?php 
  $result = mysql_query("SELECT * FROM categories where is_inuse=1");

  while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
      $result2 = mysql_query("SELECT count(book_id) as count FROM books where cat_id=".$row["category_id"]."");
      $row_rsexample = mysql_fetch_assoc($result2);
      echo "<li class='cat_class' id='".$row["category_id"]."' ><a class='' href=''>".$row["category_name"]."<span class='badge navbar-right'>".$row_rsexample['count']."</span></a></li>";
      }
  ?>
    
  </ul>
</div><!-- end sidebar -->

    </div>
     <div class="span9">
     <div class="breadcrumb">
       <span>Sort By</span>
          <select id="sortBy">
          <optgroup label="Published">
              <option value="1">Recent to Old</option>
              <option value="2">Old to Recent</option>
            </optgroup>
            <optgroup label="Price">
              <option value="3">High to Low</option>
              <option value="4">Low to High</option>
            </optgroup>
            
          </select>
     </div>
         
  
      <div id="body_container"></div> 
        
    </div>

      </div>
    </div> 
  </div>
</div>
<?php
include "recentlyAdded.php"; 
?>

</div>

<!-- Cart Modal-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">My Cart !!!</h4>
            </div>
            <div class="modal-body" id="cartItemsView">
         
            </div>
    </div>
  </div>
</div>
<!-- Post Book -->

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Post BOOK !!!</h4>
            </div>

            <div class="modal-body">
                <!-- The form is placed inside the body of modal -->
                <form id="postBookForm" method="post" class="form-horizontal" action="saveProducts.php" enctype="multipart/form-data" accept-charset="utf-8" data-remote="true">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Book Title</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" name="bookname"  id="bookname" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Book Description</label>
                        <div class="col-xs-5">
                            <textarea rows="5" class="form-control" name="bookdesc" id="bookdesc"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">category</label>

                        <div class="col-xs-5">
                        <select id="category" class="form-control" name="category" >
                         <?php 
                        $result = mysql_query("SELECT * FROM categories where is_inuse=1");
                          while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                              echo "<option class='form-control' value='".$row["category_id"]."'>".$row["category_name"]."</option>";
                          }
                        ?>
                         </select>
                         <span>If category is not present, please send a request mail to admin (kmondedd@nyit.edu)</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">ISBN Number</label>
                        <div class="col-xs-5">
                            <input type="number" class="form-control" name="ISBNNumber" id="ISBNNumber"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Price</label>
                        <div class="col-xs-5">
                            <input type="number" class="form-control" name="price"  id="price" />
                        </div>
                    </div>
                      <div class="form-group">
                      <label class="col-xs-3 control-label">Book Image</label>
                        
                        <div class="col-xs-5">
                            <input type="file" class="form-control" name="bookImage"  id="bookImage" />
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-xs-5 col-xs-offset-3">
                            <button type="submit" class="btn btn-primary">Post</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
 $('#loginModal').on('shown.bs.modal', function() {
               $('#loginForm').bootstrapValidator('resetForm', true);
        });
// When your page loads
      $(function(){
        var ClickliId = 0;
        loadAjax(ClickliId);
        loadAjaxUpdateCart();
         // When Home button click
          $("#home").click(function(e){
             e.preventDefault();
             ClickliId = 0;
             loadAjax(ClickliId);
          });
          // when logout button clicks 
          $("#logOff").click(function(e){
             e.preventDefault();
               document.location = 'logout.php';
          });
         // When search button click
          $("#search_button").click(function(e){
             e.preventDefault();
             ClickliId = 0;
             loadAjax(ClickliId);
          });
          $('#search').keypress(function(e){
             if(e.which == 13){//Enter key pressed
              ClickliId = 0;
                  loadAjax(ClickliId);//Trigger search button click event
              }
          });
          $(".cat_class").click(function(e){
             e.preventDefault();
             ClickliId = $(this).attr('id');
             //alert(ClickImageId)
             loadAjax(ClickliId);
          });
          $("#sortBy").change(function(e){
             e.preventDefault();
             loadAjax(ClickliId);
          });
      });


      function loadAjax(catId) {

        $.ajax({
          method: "POST",
          url: "loadProducts.php",
          data: { search: $("#search").val() , category: catId , sortBy: $("#sortBy").val()}
        })
          .done(function( msg ) { 
        //    alert(msg);
             $( ".breadcrumb").show();
             $( "#body_container" ).empty(); 
             $( "#body_container" ).append( msg );
          });
      }
      function loadAjaxUpdateCart() {
        //alert(catId);
        $.ajax({
          method: "POST",
          url: "cartUpdate.php",
          data: {  productId: '0'  , userId : '<?php  echo $_SESSION["user_id"]; ?>'}
        })
          .done(function( msg ) { 
            $( "#cart-total").text(msg);
            $("html, body").animate({ scrollTop: 0 }, "slow");
          });
      }
       function loadAjaxCartView(cartId) {

        $.ajax({
          method: "POST",
          url: "cartProducts.php",
          data: {  cartId: cartId, userId: '<?php  echo $_SESSION["user_id"]; ?>' }
        })
          .done(function( msg ) { 
            //alert(msg);
             // $( ".breadcrumb").show();
              $( "#cartItemsView" ).empty(); 
              $( "#cartItemsView" ).append( msg );
              loadAjaxUpdateCart(0);
          });
      }
</script>