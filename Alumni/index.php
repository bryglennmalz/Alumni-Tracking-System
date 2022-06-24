<?php 
	ob_start();
	session_start();
	
	require 'php/myconnection.php';
	require 'php/home-php.php';
	//require 'php/function.php';
			
	if(Login::isloggedin()){
		header('location: home.php');
	}
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/layout-single-column.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:30:45 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon-2.png">
    <title>Welcome to CMU - Alumni Tracking And Information System</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header single-column card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                         <!-- dark Logo text -->
                         <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                         <!-- Light Logo text -->    
                         <img src="../assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <!--div class="col-md-12 col-sm-12 text-center align-self-center">
						<br><br><br>
                        <h1 class="text-themecolor m-b-0 m-t-0">
							ALUMNI TRACKING AND INFORMATION SYSTEM
						</h1>
						<h3>
							An alumni site of Central Mindanao University
						</h3>
						<br><br><br>
                    </div-->
					<div class="col-12">
						<br>
						<br>
					</div>
					
					<div class="col-7">
                            <div class="card-body text-center">
								<br><br><br><br>
								<h1 class="text-themecolor m-b-0 m-t-0">
									ALUMNI TRACKING AND INFORMATION SYSTEM
								</h1>
								<h2>
									An alumni site of Central Mindanao University
									<?php //echo convert_string('decrypt',"NmZjSUJad3FQdkNpT3U3NkNoQytjZz09");?>
								</h2>
								<br><br><br><br>
                            </div>
                    </div>
					
					<div class="col-sm-5">
                        <div class="card">
                            <div class="card-body">
								<ul class="nav nav-pills m-t-30 m-b-30">
                                    <li class=" nav-item"> <a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false">Registered Alumni</a> </li>
                                </ul>
								<div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                            <div class="col-sm-12">
												<form id="LoginForm" class="form-horizontal form-material" method="POST">
													<?php include 'php/login-php.php';?>
													<br>
													
													<div class="form-group row">
														<label for="alumniid" class="col-sm-3 text-right control-label col-form-label">Alumni ID*</label>
														<div class="col-sm-9">
															<input type="text" class="form-control" id="alumniid" name="alumniid" placeholder="Alumni ID" required autofocus>
														</div>
													</div>
													<div class="form-group row">
														<label for="pass" class="col-sm-3 text-right control-label col-form-label">Password*</label>
														<div class="col-sm-9">
															<input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
														</div>
													</div>
													<div class="form-group row">
														<div class="col-sm-12 text-center">
															<small><a href="forgot-password.php">Forgot Password?</a></small>
														</div>
														<div class="col-sm-12 text-center">
															<small><a href="pre-signup.php">Don't have any account?</a></small>
														</div>
													</div>
													
													<br>
													
													<div class="form-group m-b-0">
														<input type="hidden" name="operation" value="Login">
														<div class="offset-sm-3 col-sm-9">
															<button type="submit" class="btn btn-info waves-effect waves-light m-t-10" id="login" name="login">Sign in</button>
														</div>
													</div>
												</form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
					
					<div class="col-4">
                        <div class="card">
                            <div class="card-body">
								<h2 class="text-themecolor m-b-0 m-t-0 text-center">
									Track
								</h2>
                            </div>
                        </div>
                    </div>
					<div class="col-4">
                        <div class="card">
                            <div class="card-body">
								<h2 class="text-themecolor m-b-0 m-t-0 text-center">
									Research
								</h2>
                            </div>
                        </div>
                    </div>
					<div class="col-4">
                        <div class="card">
                            <div class="card-body">
								<h2 class="text-themecolor m-b-0 m-t-0 text-center">
									Update
								</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-right">
				<small>
					<p>
						<a href="">
							cmu.edu.ph
						</a> - 
						 <a href="">
							About
						</a> -  
						 <a href="">
							Developer
						</a> - 
						 <a href="">
							Terms and Conditions
						</a>
					</p>
					© 2017 Material Pro Admin by wrappixel.com
				</small>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="../js/custom.min.js"></script>
	<!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="../js/jasny-bootstrap.js"></script>
    <!-- ============================================================== -->
	<script>
		/*$(document).on('submit', '#SignupForm', function(event){
                event.preventDefault();
                var base_url = window.location.origin;          
                $.ajax({  
                        url:base_url+"/alumni-e-network-4/Alumni/php/pre_signup_php.php", 
                        method:"POST",  
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function(data){ 
                            alert(data);
                            $('#SignupForm')[0].reset();
                            window.location = base_url+"/alumni-e-network-4/Alumni/new-member-verification.php"
                        }  
                    });       
            });

		$(document).on('submit', '#LoginForm', function(event){
                event.preventDefault();
                var base_url = window.location.origin;          
                $.ajax({  
                        url:base_url+"/alumni-e-network-4/Alumni/php/login_php.php", 
                        method:"POST",  
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function(data){ 
                            alert(data);
                            $('#LoginForm')[0].reset();
                            window.location = base_url+"/alumni-e-network-4/Alumni/home.php"
                        }  
                    });       
            });

		/*$(document).ready(function(){  
			var base_url = window.location.origin;
			
			$('#login').click(function(){            
				$.ajax({  
						url:base_url+"/alumni-e-network-3/alumni/php/login-php.php",  
						method:"POST",  
						data:$(this).serialize(),  
						beforesend:function(){  
						{  
							 alert(data); 
						}  
				});  
			});  
		 }); 
		 
		$(document).ready(function(){
			var base_url = window.location.origin;
			
			$('#submitLogin').click(function(){
				$.ajax({
					url:base_url+"/alumni-e-network-3/alumni/php/login-php.php",
					type: POST,
					datatype: 'json',
					data:$(this).serialize(),
					beforesend:function(){
						
					}
				});
			});
			
			$('#createaccount').click(function(){
				$.ajax({
					url:base_url+"/alumni-e-network-3/alumni/php/login-php.php",
					type: POST,
					datatype: 'json',
					data:$(this).serialize(),
					beforesend:function(){
						
					}
				});
			});
		});*/
	</script>
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/layout-single-column.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:30:45 GMT -->
</html>
