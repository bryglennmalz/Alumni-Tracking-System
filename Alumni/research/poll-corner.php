<?php 
	ob_start();
	session_start();
	
	require '../php/myconnection.php';
    require '../php/home-php.php';
    require '../php/function.php';
			
	if(!Login::isloggedin()){
		header('location: ../index.php');
	}
	else{
		require '../php/query-php.php';
		require 'php/poll-query-php.php';
		require'php/post-poll-php.php';
	}
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:22 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon-2.png">
    <title>Poll Corner | CMU - Alumni Tracking And Information System</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="../../assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../../assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="../../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
	<link href="../assets/plugins/css-chart/css-chart.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="../../assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../../css/colors/blue.css" id="theme" rel="stylesheet">

	<!--script src="repeater.js" type="text/javascript"></script>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
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
                    <a class="navbar-brand" href="../home.php">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="../../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="../../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                         <!-- Light Logo text -->    
                         <img src="../../assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        
                        
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
						<!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <!--li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../../assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="../../assets/images/users/1.jpg" alt="user"></div>
                                            <div class="u-text">
												<p class="text-muted"><?php echo $alid;?></p>
                                                <h5><?php echo $alfname, ' ', $almname, ' ', $allname, ' ', $alextname;?></h5>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="../profile/profile.php?alumniid=<?php echo $alid;?>"><i class="ti-user"></i> My Profile</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="" alt="default" data-toggle="modal" data-target=".LogoutModal" data-toggle="tooltip" title="Logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
						<!-- ============================================================== -->
                        <!-- End Profile -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile" style="background: url(../../assets/images/background/user-info.jpg) no-repeat;">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="../../assets/images/users/profile.png" alt="user" /> </div>
                    <!-- User profile text-->
                    <div class="profile-text"> 
						<a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo convert_string('decrypt', $alfname) , ' ', convert_string('decrypt', $almname), ' ', convert_string('decrypt', $allname), ' ', convert_string('decrypt', $alextname);?></a>
                        <div class="dropdown-menu animated flipInY"> 
                            <?php echo '<a href="../account/profile.php?alumniid='.$userid.'" class="dropdown-item"><i class="ti-user"></i> My Profile</a> ';?>
                                <div class="dropdown-divider"></div> 
                            <a href="profile.php?alumniid=<?php echo $alid;?>" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                                <div class="dropdown-divider"></div> 
                            <a href="#" class="dropdown-item waves-effect waves-light link model_img img-responsive" alt="default" data-toggle="modal" data-target=".LogoutModal" data-toggle="tooltip" title="Logout"><i class="fa fa-power-off"></i> Logout</a> 
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
						<li> 
							<a class="waves-effect waves-dark" href="../home.php"><i class="mdi mdi-gauge"></i>Home</a>
                        </li>
						
                        <li> 
							<a class="waves-effect waves-dark" href="../events/cmu-events.php" aria-expanded="false"><i class="mdi mdi-calendar-range"></i><span class="hide-menu">CMU Events</span></a>
                        </li>
						
                        <li> 
							<a class="waves-effect waves-dark" href="../career/career-bulletin.php" aria-expanded="false"><i class="mdi mdi-briefcase"></i><span class="hide-menu">Career Bulletin</span></a>
                        </li>
						
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">RESEARCH CORNER</li>
						
                        <li> 
							<a class="waves-effect waves-dark" href="forum-corner.php" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Forum Corner</span></a>
                        </li>
                        <li> 
							<a class="waves-effect waves-dark" href="poll-corner.php" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Poll Corner</span></a>
                        </li>
						 <li> 
							<a class="waves-effect waves-dark" href="alumni-survey.php" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Alumni Survey</span></a>
                        </li>
						<li> 
							<br>
                        </li>
						<li> 
							<br>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item--><a href="#" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item--><!--a href="#" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                <!-- item--><a href="#" class="waves-effect waves-light link model_img img-responsive" alt="default" data-toggle="modal" data-target=".LogoutModal" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a> </div>
            <!-- End Bottom points-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
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
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Poll Corner</h3>
                    </div>
								
                    <!--div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                                    <h4 class="m-t-0 text-info">$58,356</h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"></div>
                                </div>
                            </div>
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                                    <h4 class="m-t-0 text-primary">$48,356</h4></div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"></div>
                                </div>
                            </div>
                            <div class="">
                                <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                            </div>
                        </div>
                    </div-->
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <div class="col-md-8 col-xlg-9">
                        <!-- Row -->
                        <div class="row">
                            <!-- Column -->
                            <div class="col-lg-12">
								<!--FORUM CORNER-->
								<?php 
									if($pdo_poll==0){
										echo "There are zero poll posted as of this momment";
									}
									else{
										$f_post = "";
										foreach($polls as $p){
								
											$pollid = $p['poll_id'];
											$polltitle = $p['question'];
											$datepost = $p['datetime_post'];
                                            $dateend = $p['date_end'];
											$timeend = $p['time_end'];
                                            $sataffid = $p['admin_id'];
											
												//Number of poll votes query
												$cntvotes =("SELECT poll.`poll_id` FROM alumni.`forum-react` WHERE `forum-react`.forum_id = :pollid");
												
												$pdo_cntVotes_Res = $pdoConnect ->prepare($cntvotes);
												$pdoExec = $pdo_cntVotes_Res -> execute(array(':pollid' => $id));
												$pdo_forum_votes = $pdo_cntVotes_Res->rowCount();
								
										$f_post .= "<a href='poll.php?pollid=".$pollid."' method='POST'>
														<div class='card'>
															<div class='card-body'>
																<div>
																	<h4 class='card-title'>".$polltitle."</h4>
																	
																	<hr>
																	<footer class='text-right'>
																		<p>
																			<small>
																				- ".$pdo_forum_votes." <i class='mdi mdi-poll-box'></i>
																				 &nbsp &nbsp &nbsp &nbsp - Poll Posted: ".date('F d, Y  h:i A', strtotime($datepost))."
																			</small>
																		</p>
																	</footer>
																</div>
															</div>
														</div>
													</a>"; 
										}
										
										echo $f_post;
									}
								?>
							</div>
                            <!-- Column -->
                        </div>
                    </div>
                    <div class="col-md-4 col-xlg-3">
                        <!-- Column -->
                        <div class="card earning-widget">
                            <div class="card-header">
                                <div class="card-actions">
                                    <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                </div>
                                <h4 class="card-title m-b-0">Info</h4>
                            </div>
                            <div class="card-body b-t collapse show">
                                <table class="table v-middle no-border">
                                    <tbody>
                                        <tr>
                                            <td>No. of Poll Posted</td>
                                            <td align="right"><span class="label label-light-info"><?php echo $pdo_poll;?></span></td>
                                        </tr>
                                        <tr>
                                            <td>No. of Alumni Poll Answered</td>
                                            <td align="right"><span class="label label-light-success"><?php echo $pdo_poll_corner_likes;?></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
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
            <footer class="footer">
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
	
	<!-- Logout Modal Content -->
    <div id="LogoutModal" class="modal fade LogoutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Logout</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
				<form action="../../php/logout-php.php" class="form center-block" method="post" class="l-form">
					<div class="modal-body">
						<div class="form-group">
							<center><h5>Do you want to logout your account?</h5></center>
						</div>
					</div>
					<div class="modal-footer">
						<input type = "submit" class="btn btn-primary btn-sm" name="logoutAll" value="Logout All Device"></input>
						<input type = "submit" class="btn btn-primary btn-sm" name="logout" value="Logout"></input>
						<button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
	
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../../js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="../../js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
	<!-- chartist chart -->
    <script src="../../assets/plugins/chartist-js/dist/chartist.min.js"></script>
    <script src="../../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../../assets/plugins/echarts/echarts-all.js"></script>
	<!-- Vector map JavaScript -->
    <script src="../../assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../../assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- chartist chart -->
    <script src="../../assets/plugins/chartist-js/dist/chartist.min.js"></script>
    <script src="../../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 JavaScript -->
    <script src="../../assets/plugins/d3/d3.min.js"></script>
    <script src="../../assets/plugins/c3-master/c3.min.js"></script>
    <!-- Chart JS -->
	<!-- sparkline chart -->
    <script src="../../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="../../js/dashboard4.js"></script>
    <script src="../../js/dashboard6.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
	
	
	<!--Dynamically add POLL CHOICES-->
	 <script>  
	 $(document).ready(function(){  
		  var i=1;  
		  $('#add').click(function(){  
			   i++;  
			   $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="choice[]" placeholder="Poll Choice" class="form-control name_list" require/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
		  });  
		  $(document).on('click', '.btn_remove', function(){  
			   var button_id = $(this).attr("id");   
			   $('#row'+button_id+'').remove();  
		  });  
		  $('#submit').click(function(){            
			   $.ajax({  
					url:"php/post-poll-php.php",  
					method:"POST",  
					data:$('#add_name').serialize(),  
					success:function(data)  
					{  
						 alert(data);  
						 $('#add_name')[0].reset();  
					}  
			   });  
		  }); 

			//include "php/post-refresh-php.php";
	 });  
	 </script>
	 
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
