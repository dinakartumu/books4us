<?php 
  // Start the session
    session_start();
    include "header.html";
?>
<!DOCTYPE html>
<html lang="en">
 <body>
    <h1 style="text-align:center">BOOKS 4 US</h1>

        <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <!-- <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div> -->
                            
                        <form id="loginForm" class="form-horizontal" action="userLogin.php" enctype="multipart/form-data" accept-charset="utf-8" data-validate="true">
                              
                             <div class="form-group">
                                    <div style="margin-bottom: 25px;float: right !important; margin-right: 20px;" class="input-group col-xs-9">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login_username" type="text" class="form-control" name="login_username"  placeholder="Email">                                        
                                    </div>
                              </div>
                               <div class="form-group">
                                     <div style="margin-bottom: 25px;float: right !important; margin-right: 20px;" class="input-group col-xs-9">
                                       <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login_password" type="password" class="form-control" name="login_password" placeholder="password">
                                    </div>
                              </div> 
                                <div class="form-group">
                                    <div class="col-xs-5 col-xs-offset-3">
                                        <button type="submit" class="btn btn-primary">Login</button>
                                        <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Sign Up Here
                                        </a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     
                        </div>                     
                    </div>  
        </div>
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="registerForm" class="form-horizontal" role="form" action="userRegister.php">
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <input id="firstname" type="text" class="form-control" name="firstname" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9">
                                        <input id="lastname" type="text" class="form-control" name="lastname" placeholder="Last Name">
                                    </div>
                                </div>

                               <div class="form-group">
                                    <label for="sid" class="col-md-3 control-label">Student Id</label>
                                    <div class="col-md-9">
                                        <input id="sid" type="number" class="form-control" name="sid" placeholder="Student id" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input id="email" type="email" class="form-control" name="email" placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                </div>
                                    <div class="form-group">
                                    <label for="confirm_password" class="col-md-3 control-label">Confirm Password</label>
                                    <div class="col-md-9">
                                        <input id="confirmPassword" type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password">
                                    </div>
                                </div> 

                                <div class="form-group"> 
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                         <button type="submit" class="btn btn-primary">Register</button>
                                    </div>
                                </div>                
                            </form>
                         </div>
                    </div>
         </div> 
    </div>
    
  </body>
</html>