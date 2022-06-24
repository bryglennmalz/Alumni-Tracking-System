<?php 
	ob_start();
	session_start();
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
    require '../../php/function.php';
			
	if(!Login::isloggedin()){
		header('location: ../../index.php');
	}
	else{
		require '../../php/query-php.php';
	}
	
	if (isset($_GET['adminid'])){
		
		//Query Alumni
		$alumni = DB::query("SELECT * FROM admin WHERE admin_id = :id", array(':id' => $_GET['adminid']));
			foreach ($alumni as $a){
				$id = $a['admin_id'];
				$fname = $a['fname'];
				$mi = $a['mname'];
				$lname = $a['lname'];
				$nameext = $a['nameext'];
                $email = $a['email'];
				$type = $a['type'];
			}
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
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <title>Profile | CMU - Alumni Tracking And Information System</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="../../../assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../../../assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="../../../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
	<link href="../../assets/plugins/css-chart/css-chart.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="../../../assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../../css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../../../css/colors/blue.css" id="theme" rel="stylesheet">
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
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../../../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="../../../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="../../../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                         <!-- Light Logo text -->    
                         <img src="../../../assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span> </a>
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
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../../assets/images/users/user.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="../../assets/images/users/user.png" alt="user"></div>
                                            <div class="u-text">
												<p class="text-muted"><?php echo $alid;?></p>
                                                <h5><?php echo $alfname, ' ', $almname, ' ', $allname, ' ', $alextname;?></h5>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="../profile/profile.php?alumniid=<?php echo $alid;?>"><i class="ti-user"></i> My Profile</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href=""><i class="ti-settings"></i> Account Setting</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="" alt="default" data-toggle="modal" data-target=".LogoutModal" data-toggle="tooltip" title="Logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li-->
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
                <div class="user-profile" style="background: url(../../../assets/images/background/user-info.jpg) no-repeat;">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="../../../assets/images/users/user.png" alt="user" /> </div>
                    <!-- User profile text-->
                    <div class="profile-text"> 
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo convert_string('decrypt', $afname), ' ', convert_string('decrypt',$amname), ' ', convert_string('decrypt',$alname), ' ', convert_string('decrypt',$aextname);?></a>
                        <div class="dropdown-menu animated flipInY"> 
                            <?php echo '<a href="profile.php?alumniid='.$userid.'" class="dropdown-item"><i class="ti-user"></i> My Profile</a> ';?>
                                <div class="dropdown-divider"></div> 
                             <?php echo '<a href="../settings/account-settings.php?alumniid='.$userid.'" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>';?>
                             <?php echo '<a href="../settings/edit-profile.php?alumniid='.$userid.'" class="dropdown-item"><i class="ti-pencil-alt"></i> Edit Profile</a>';?>
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
                            <a class="waves-effect waves-dark" href="home.php"><i class="mdi mdi-gauge"></i>Dashboard</a>
                        </li>
                        
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">Research</span></a>
                            <ul aria-expanded="false" class="collapse" style="text-indent:40px;">
                                <li><a href="../research/forum-and-poll.php">Forum and Polls</a></li>
                                <li><a href="../research/alumni-survey.php">Alumni Survey</a></li>
                            </ul>
                        </li>
                        
                        <li> 
                            <a class="waves-effect waves-dark" href="../events/cmu-events.php" aria-expanded="false"><i class="mdi mdi-calendar-range"></i><span class="hide-menu">CMU Events</span></a>
                        </li>
                        
                        <li> 
                            <a class="waves-effect waves-dark" href="../career/career-bulletin.php" aria-expanded="false"><i class="mdi mdi-briefcase"></i><span class="hide-menu">Career Bulletin</span></a>
                        </li>
                        
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">ACCOUNTS</li>
                        
                        <li> 
                            <a class="waves-effect waves-dark" href="../alumni/alumni-accounts.php" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Alumni Accounts</span></a>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="../administrator/administrator-accounts.php" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Administrator Accounts</span></a>
                        </li>
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">INFORMATIONS</li>
                        
                        <li> 
                            <a class="waves-effect waves-dark" href="../chart/charts-statistic-corner.php"" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Charts and Statistics</span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Logs</span></a>
                            <ul aria-expanded="false" class="collapse" style="text-indent:40px;">
                                <li><a href="../logs/admin-activity-logs.php">Admin Activity Logs</a></li>
                                <li><a href="../logs/alumni-activity-logs.php">Alumni Activity Logs</a></li>
                            </ul>
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
                <!-- item--><a href="#" class="link" data-toggle="tooltip" title="Email"><i class="ti-user"></i></a>
                <!-- item--><a href="#" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
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
            <div class="container-fluid"><br>
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!--div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10">
                                <div class="chart-text m-r-10">
                                    <div class="drop-title"> 
										<?php 
											echo "<button href='' type='button' name='updateBI' id='".$_GET['alumniid']."' class='waves-effect btn btn-outline-secondary btn-xs updateBI'>Edit Profile</button>";
										?>
										<a type="button" href="" name="updateBI" <?php echo "id='",$_GET['alumniid'],"'";?> class="waves-effect btn btn-outline-secondary waves-light model_img img-responsive updateBI" alt="default" data-toggle="modal" data-target="#EditPerInfoModal" data-toggle="tooltip">
											Edit Profile
										</a>
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
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="../../../assets/images/users/user.png" class="img-circle" width="150" />
                                    <h4 class="card-title m-t-10"><?php echo convert_string('decrypt', $fname), ' ', convert_string('decrypt', $mi), ' ', convert_string('decrypt', $lname), ' ', convert_string('decrypt', $nameext);?></h4>
                                    <h6 class="card-subtitle"><?php echo convert_string('decrypt', $type);?></h6>
                                    <h6 class="card-subtitle"><?php echo convert_string('decrypt', $id);?></h6>
                                    <div class="row text-center justify-content-md-center">
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
						<div class = "card">
							<div class="card-body">
                                <h3 class="card-title">Personal Information</h3>
                                <div class="row">

                                    <?php
                                        if($f_g_name != null){
                                            echo "<div class='col-md-12 col-xs-6'> <small class='text-muted'>Father/Guarian's name</small>
            										<br>
            										<strong>".convert_string('decrypt', $f_g_name)."</strong>
            									</div>";
                                        }
                                        if($f_g_occupationn != null){
									       echo "<div class='col-md-12 col-xs-6'> <small class='text-muted'>Father/Guarian's occupation</small>
            										<br>
            										<strong>". convert_string('decrypt', $f_g_occupationn)."</strong>
            									</div>";
                                        }
                                        if($f_g_name != null || $f_g_occupationn != null){
                                            echo "<div class='col-md-12 col-xs-6'>
                                                        <hr>
                                                    </div>";
                                        }
										if($mother_name != null){
											echo "	<div class='col-md-12 col-xs-6'> <small class='text-muted'>Mother's name</small>
														<br>
														<strong>",convert_string('decrypt', $mother_name),"</strong>
													</div>";
                                        }
                                        if($m_occupation != null){
											echo "<div class='col-md-12 col-xs-6'> <small class='text-muted'>Mother's occupation</small>
														<br>
														<strong>",convert_string('decrypt', $m_occupation),"</strong>
													</div>";
										}
                                        if($mother_name != null || $m_occupation != null){
                                            echo "<div class='col-md-12 col-xs-6'>
                                                        <hr>
                                                    </div>";
                                        }
									?>
                                </div>
                            </div>
						</div>

                    </div>
                    <!-- Column -->
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
    <script src="../../../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../../js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../../../js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../../js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../../../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="../../../js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
	<!-- sparkline chart -->
    <script src="../../../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../../../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="scripts/education-scripts.js"></script>
    <script src="scripts/job-history-scripts.js"></script>
    <script src="scripts/certification-scripts.js"></script>
    <script src="scripts/honors-awards-scripts.js"></script>
    <script src="scripts/org-scripts.js"></script>
    <script src="scripts/sem-train-work-scripts.js"></script>
	
	<script>
		$(document).ready(function(){
			$('.updateBI').on('click', function(){
				var user_id = $(this).attr('id');
				$.ajax({
					url:"php/fetch_single.php",
					method:"POST",
					data:{user_id:user_id},
					dataType:"json",
					success:function(data)
					{
						$('#EditPerInfoModal').modal('show');
						
						$('#alumniId').val(user_id);
						$('#firstName').val(data.fname);
						$('#middleInitial').val(data.mi);
						$('#lastName').val(data.lname);
						$('#extName').val(data.nameext);
						
						$('.modal-title').text("Edit User");
						$('#user_id').val(user_id);
						$('#user_uploaded_image').html(data.user_image);
						$('#action').val("Edit");
						$('#operation').val("Edit");
					}
				})
			});
			
		});
	</script>
	
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
