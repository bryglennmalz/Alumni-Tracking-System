<?php 
	ob_start();
	session_start();
	
	require '../php/myconnection.php';
	require '../php/home-php.php';
			
	if(!Login::isloggedin()){
		header('location: ../index.php');
	}
	else{
		require '../php/query-php.php';
		require 'php/admin-query-php.php';
		require 'php/add-admin-php.php';
		
		foreach($admin as $s){
			$afname = $s['fname'];
			$amname = $s['mname'];
			$alname = $s['lname'];
			$aextname = $s['nameext'];
			$ahead = $s['head'];
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
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon-2.png">
    <title>Administrator Accounts | CMU - Alumni Tracking And Information System</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../../css/colors/blue.css" id="theme" rel="stylesheet">
	 <!-- datatables CSS -->
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
                    <a class="navbar-brand" href="../dashboard/home.php">
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
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <!--li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-view-grid"></i></a>
                            <div class="dropdown-menu scale-up-left">
                                <ul class="mega-dropdown-menu row">
                                    <li class="col-lg-4 col-xlg-2 m-b-30">
										<ul class="dropdown-user">
											<li>
												<div class="dw-user-box">
													<div class="u-img"><img src="../../assets/images/users/1.jpg" alt="user"></div>
													<div class="u-text">
														<p class="text-muted"><?php echo $user_id;?></p>
														<h5><?php echo $afname, ' ', $amname, ' ', $alname, ' ', $aextname;?></h5>
														<a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
												</div>
											</li>
											<li role="separator" class="divider"></li>
											<li><a href="#"><i class="ti-user"></i> My Profile</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
										</ul>
									</li>
                                    <li class="col-lg-4  m-b-30">
                                        <h4 class="m-b-20">Send Feedback</h4>
                                        <!-- Contact -->
                                        <form>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputname1" placeholder="Enter Name"> </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Enter email"> </div>
                                            <div class="form-group">
                                                <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Message"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </form>
                                    </li>
                                    <li class="col-lg-4 col-xlg-4 m-b-30">
                                        <h4 class="m-b-20">Notification</h4>
                                        <!-- List style -->
                                        <ul class="list-style-none">
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> You can give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another Give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Forth link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another fifth link</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
							<!-- ============================================================== -->
                        <!-- Add Administrator -->
                        <!-- ============================================================== -->
						<?php if ($ahead == 1){ ?>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-plus-circle"></i>
									
								</a>
								<div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
									<ul>
										<li>
											<div class="drop-title">
												<a href="#" id="add_button" class="waves-effect waves-light model_img img-responsive" alt="default" data-toggle="modal" data-target=".bs-example-modal-lg">
													<i class="mdi mdi-message"></i> Add Admin
												</a>
											</div>
										</li>
									</ul>
								</div>
							</li>
						<?php } else{?>
							<div class="nav-link dropdown-toggle dropdown-toggle waves-effect waves-dark">
									</div>
						<?php } ?>
                        <!-- ============================================================== -->
                        <!-- End Add Administrator -->
                        <!-- ============================================================== -->
						<!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../../assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="../../assets/images/users/1.jpg" alt="user"></div>
                                            <div class="u-text">
												<p class="text-muted"><?php echo $user_id;?></p>
                                                <h5><?php echo $afname, ' ', $amname, ' ', $alname, ' ', $aextname;?></h5>
                                                <a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
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
						<a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo $afname, ' ', $amname, ' ', $alname, ' ', $aextname;?></a>
                        <div class="dropdown-menu animated flipInY">
							<a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a> 
							
							<div class="dropdown-divider"></div> 
							<a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                            
							<div class="dropdown-divider"></div> 
							<a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a> 
						</div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
						<li> 
							<a class="waves-effect waves-dark" href="../dashboard/home.php"><i class="mdi mdi-gauge"></i>Dashboard</a>
                        </li>
                        
						<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">Research</span></a>
                            <ul aria-expanded="false" class="collapse" style="text-indent:40px;">
                                <li><a href="../research/forum-corner.php">Forum Corner</a></li>
                                <li><a href="../research/poll-corner.php">Poll Corner</a></li>
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
							<a class="waves-effect waves-dark" href="administrator-accounts.php" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Administrator Accounts</span></a>
                        </li>
						<li class="nav-devider"></li>
						<li class="nav-small-cap">INFORMATIONS</li>
						
						<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Charts and Statistics</span></a>
                            <ul aria-expanded="false" class="collapse" style="text-indent:40px;">
                                <li><a href="../research/forum-corner.php">User Overview</a></li>
                                <li><a href="../research/poll-corner.php">Survey Charts and Results</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Logs</span></a>
                            <ul aria-expanded="false" class="collapse" style="text-indent:40px;">
                                <li><a href="../research/forum-corner.php">Website Visit Logs</a></li>
                                <li><a href="../research/poll-corner.php">Admin Activity Logs</a></li>
                                <li><a href="../research/alumni-survey.php">Error Logs</a></li>
                            </ul>
                        </li>
						<li> 
							<a class="waves-effect waves-dark" href="../administrator/administrator-accounts.php" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Logs</span></a>
                        </li>
						
						<li> 
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
                        <h3 class="text-themecolor">Administrator Accounts</h3>
                    </div>
					
					<!-- sample modal content -->
                                <div id="userModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
												<h4 class="modal-title" id="myLargeModalLabel">Add New Adminitrator Account</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
											<form class="form center-block floating-labels" id="user_form" method="post" enctype = "multipart/form-data" class="l-form">
												<div class="modal-body">
													<br>
													<div class="form-group form-float form-group-lg">
														<div class="form-line">
															<input type="text" name="admin-id" id="adminID" class="form-control" required/>
															<label class="form-label">ID Number</label>
														</div>
													</div>
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group form-float form-group-lg">
																<div class="form-line">
																	<input type="text" name="f-name" id="fName" class="form-control" required/>
																	<label class="form-label">First name</label>
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group form-float form-group-lg">
																<div class="form-line">
																	<input type="text" name="mi" id="MI" class="form-control" required/>
																	<label class="form-label">Middle name</label>
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group form-float form-group-lg">
																<div class="form-line">
																	<input type="text" name="l-name" id="lName" class="form-control" required/>
																	<label class="form-label">Last name</label>
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group form-float form-group-lg">
																<div class="form-line">
																	<select name="ext-name" id="extName" class="form-control"/>
																		<option></option>
																		<option>Jr.</option>
																		<option>Sr.</option>
																		<option>I</option>
																		<option>II</option>
																		<option>III</option>
																		<option>IV</option>
																		<option>V</option>
																		<option>VI</option>
																		<option>VII</option>
																		<option>VIII</option>
																	</select>
																	<label class="form-label">Extension name</label>
																</div>
															</div>
														</div>
													</div>
													
													<div class="form-group form-float form-group-lg">
														<div class="form-line">
															<input type="email" name="email" id="email" class="form-control" required/>
															<label class="form-label">Email</label>
														</div>
													</div>
													<div class="form-group form-float form-group-lg">
														<div class="form-line">
															<input type="password" name="p-word" id="pword" class="form-control" required/>
															<label class="form-label">Password</label>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<input type="hidden" name="user_id" id="user_id" />
													<input type="hidden" name="operation" id="operation" />
													<input type="submit" name="adminSave" id="actions" class="btn btn-success" value="Save" />
													<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
												</div>
											</form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                    <!-- /.modal -->
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12 col-xlg-12">
                        <!-- Row -->
                        <div class="row">
                            <!-- column -->
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<div class="table-responsive">
										
												<table id="user_data" class="table table-bordered table-striped cellspacing="0" width="100%"">
													<thead>
														<tr>
															<th width="10%">ID</th>
															<th width="40%">Name</th>
															<th width="30%">Remarks</th>
															<th width="10%">Options</th>
														</tr>
													</thead>
												</table>
										</div>
									</div>
								</div>
							</div>
							<!-- Column -->
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
    <!-- This is data table -->
    <script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="../../cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="../../cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="../../cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="../../cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="../../cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="../../cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="../../cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
	
	<script type="text/javascript" language="javascript" >
		$(document).ready(function(){
			$('#add_button').click(function(){
				$('#user_form')[0].reset();
				$('.modal-title').text("Add Administrator User");
				$('#action').val("Add");
				$('#operation').val("Add");
			});
			
			var dataTable = $('#user_data').DataTable({
				"processing":true,
				"serverSide":true,
				"order":[],
				"ajax":{
					url:"fetch.php",
					type:"POST"
				},
				"columnDefs":[
					{
						"targets":[0, 3],
						"orderable":false,
					},
				],

			});

			$(document).on('submit', '#user_form', function(event){
				event.preventDefault();
				var adminID = $('#adminID').val();
				var firstName = $('#fName').val();
				var middleName = $('#MI').val();
				var lastName = $('#lName').val();
				var nameExt = $('#nameExt').val();
				var email = $('#email').val();
				var pword = $('#pword').val();
				/*var extension = $('#user_image').val().split('.').pop().toLowerCase();
				if(extension != '')
				{
					if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
					{
						alert("Invalid Image File");
						$('#user_image').val('');
						return false;
					}
				}*/	
				if(firstName != '' && lastName != '')
				{
					$.ajax({
						url:"insert.php",
						method:'POST',
						data:new FormData(this),
						contentType:false,
						processData:false,
						success:function(data)
						{
							alert(data);
							$('#user_form')[0].reset();
							$('#userModal').modal('hide');
							dataTable.ajax.reload();
						}
					});
				}
				else
				{
					alert("Both Fields are Required");
				}
			});
			
			$(document).on('click', '.update', function(){
				var user_id = $(this).attr("id");
				$.ajax({
					url:"fetch_single.php",
					method:"POST",
					data:{user_id:user_id},
					dataType:"json",
					success:function(data)
					{
						$('#userModal').modal('show');
						$('#adminID').val(data.alumID);
						$('#fName').val(data.fname);
						$('#MI').val(data.mname);
						$('#lName').val(data.lname);
						$('#email').val(data.email);
						$('#pword').val(data.pword);
						$('.modal-title').text("Edit Administrator User");
						$('#user_id').val(user_id);
						$('#action').val("Edit");
						$('#operation').val("Edit");
					}
				})
			});
			
			$(document).on('click', '.disable', function(){
				var user_id = $(this).attr("id");
				if(confirm("Are you sure you want to Disable this? By clicking 'okay' this user will not be able to login to this site."))
				{
					$.ajax({
						url:"disable.php",
						method:"POST",
						data:{user_id:user_id},
						success:function(data)
						{
							alert(data);
							dataTable.ajax.reload();
						}
					});
				}
				else
				{
					return false;	
				}
			});
			
			
		});
	</script>
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
