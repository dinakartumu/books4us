<?php 
// Start the session
session_start(); 
include "header.html";
include "connection.php";

if(!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])) {
   header("Location: index.php");
   die();
}?>
		<div id="content" class="container">
		<div class="panel panel-default" style="margin-top:50px;">
		   <div class="panel-body" style="margin:-15px;"> 
			     <a class="navbar-brand" href="#" id="manageUser" style="margin-top:10px">Manage Users</a>
			     <a class="navbar-brand" href="#" id="manageBooks" style="margin-top:10px">Manage Books</a>
			       <a class="navbar-brand" href="#" id="manageCats" style="margin-top:10px">Manage Categories</a>
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
		   </div>
		</div>
		<a class="navbar-brand navbar-right" data-target="#addModal" id="addCat" data-toggle="modal" style="margin-bottom:20px">Add Category</a>
    	<div id="manageTable"></div>
			
		</div>
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Add Category !!!</h4>
            </div>

            <div class="modal-body">
                <!-- The form is placed inside the body of modal -->
                <form id="addCatForm" method="post" class="form-horizontal" action="addCategory.php" enctype="multipart/form-data" accept-charset="utf-8" data-remote="true">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Category Name</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" name="catName"  id="catName" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-5 col-xs-offset-3">
                            <button type="submit" class="btn btn-primary">Add</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script> 
// When your page loads
      $(function(){

        loadAjaxUsers(0);
        $("#addCat").hide();

        // When Manage Books button click
          $("#manageBooks").click(function(e){
             e.preventDefault();
             $("#addCat").hide();
             loadAjaxBooks(0);
          });
		 // When Manage User button click
          $("#manageUser").click(function(e){
             e.preventDefault();
             $("#addCat").hide();
             loadAjaxUsers(0);
          });
          // When Manage User button click
          $("#manageCats").click(function(e){
             e.preventDefault();
              $("#addCat").show();
             loadAjaxCats(0);
          });
          // when logout button clicks 
          $("#logOff").click(function(e){
             e.preventDefault();
               document.location = 'logout.php';
          }); 

      });
      function loadAjaxUsers(rowId) {
        $.ajax({
          method: "POST",
          url: "loadUsers.php",
          data: { rowId : rowId}
        })
          .done(function( msg ) { 
         	//	alert(msg);
              //$( "#manageTable").show();
              $( "#manageTable" ).empty(); 
              $( "#manageTable" ).append( msg );
          });
      }
       function loadAjaxBooks(rowId) {
        //alert(rowId);
        $.ajax({
          method: "POST",
          url: "loadBooks.php",
          data: { rowId : rowId}
        })
          .done(function( msg ) { 
         	//	alert(msg);
              //$( "#manageTable").show();
              $( "#manageTable" ).empty(); 
              $( "#manageTable" ).append( msg );
          });
      }
      function loadAjaxCats(rowId) {
        $.ajax({
          method: "POST",
          url: "loadCats.php",
          data: { rowId : rowId}
        })
          .done(function( msg ) { 
         	//	alert(msg);
              //$( "#manageTable").show();
              $( "#manageTable" ).empty(); 
              $( "#manageTable" ).append( msg );
          });
      }
</script>