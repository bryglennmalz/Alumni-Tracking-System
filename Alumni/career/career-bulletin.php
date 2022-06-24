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
		require 'php/career-query-php.php';
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
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon-2.png">
    <title>Career Bulletin | CMU - Alumni Tracking And Information System</title>
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
                        <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-plus-circle"></i>
                                    
                            </a>
                            <div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
                                <ul>
                                    <li>
                                        <div class="drop-title">
                                            <a href="#" id="add_button" class="add_button waves-effect waves-light model_img img-responsive" alt="default" data-toggle="modal" data-target=".bs-example-modal-lg">
                                                <i class="mdi mdi-message"></i> Add Career
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
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
                            <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a> 
                            <a href="../accounts/profile.php" class="dropdown-item">
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
							<a class="waves-effect waves-dark" href="career-bulletin.php" aria-expanded="false"><i class="mdi mdi-briefcase"></i><span class="hide-menu">Career Bulletin</span></a>
                        </li>
						
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">RESEARCH CORNER</li>
						
                        <li> 
							<a class="waves-effect waves-dark"  href="../research/forum-corner.php" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Forum Corner</span></a>
                        </li>
						
                        <li> 
							<a class="waves-effect waves-dark" href="../research/poll-corner.php" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Poll Corner</span></a>
                        </li>
						
						<li> 
							<a class="waves-effect waves-dark" href="../research/alumni-survey.php" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Alumni Survey</span></a>
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
                        <h3 class="text-themecolor">Career Bulletin</h3>
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
                    <div class="col-md-8 col-xlg-9">
                        <!-- Row -->
                        <div class="row">
                            <!-- Column -->
                            <div class="col-lg-12">
								<!--FORUM CORNER-->
								<?php 
                                    $jobid = '';
                                    $position = '';
                                    $comp_name = '';
                                    $comp_loc = '';
                                    $job_desc = '';
                                    $job_req = '';
                                    $comp_overview = '';
                                    $email = '';
                                    $cell_no = '';
                                    $tel_no = '';
                                    $website = '';
                                    $emp_type = '';
                                    $senior_level = '';
                                    $sal_range ='';
                                    $alumni_id ='';
                                    $date_time ='';

                                    $id = '';
                                    $fname = '';
                                    $mi = '';
                                    $lname = '';
                                    $nameext = '';

									if($pdo_jpost==0){
										echo "There are zero job vacant posted as of this momment";
									}
									else{
										$j_post = "";
										foreach($jposts as $jp){

											$jobid = $jp['job_post_id'];
                                            $position = $jp['position'];
											$comp_name = $jp['comp_name'];
											$comp_loc = $jp['comp_loc'];
											$job_desc = $jp['job_desc'];
											$job_req = $jp['job_req'];
                                            $comp_overview = $jp['comp_overview'];
											$email = $jp['email'];
											$cell_no = $jp['cell_no'];
											$tel_no = $jp['tel_no'];
											$website = $jp['website'];
											$emp_type = $jp['emp_type'];
                                            $senior_level = $jp['senior_level'];
                                            $sal_range = $jp['sal_range'];
                                            $alumni_id = $jp['alumni_id'];
                                            $date_time = $jp['date_time'];
											
											//Query Alumni who post
											$staffid = DB::query('SELECT * FROM alumni WHERE alumni_id = :userid', array(':userid' => $alumni_id));
											foreach($staffid as $s){
												$id = $s['id'];
												$fname = $s['fname'];
												$mi = $s['mname'];
												$lname = $s['lname'];
												$nameext = $s['nameext'];
											}
											
											//Query Employee Type
											
											//Query Seniority Level 
								
										$j_post .= "<a href='career.php?careerid=".$jobid."' method='POST'>
														<div class='card'>
															<div class='card-body'>
																<div>
																	<table width='100%'; height = '100%';>
																		<tbody>
																			<tr>
																				<td>
																					<h3 class='card-title'>".$position."</h3>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					".$senior_level."
																				</td>
																			</tr>
																			<tr>
																				<td>
																					".$emp_type."
																				</td>
																			</tr>
																			<tr>
																				<td>
																					<div class = 'row'>
																						<div class = 'col-sm-6'>
																							".$comp_name."
																						</div>
																						<div class = 'col-sm-6'>
																							".$comp_loc."
																						</div>
																					</div>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																	
																	<hr>
																	<footer class='text-right'>
																		<p>
																			<small>
																				- ".convert_string('decrypt', $fname) ." ". convert_string('decrypt', $mi) ." ". convert_string('decrypt', $lname) ." ". convert_string('decrypt', $nameext)."
																				 &nbsp &nbsp &nbsp &nbsp - ".date('F d, Y  h:i A', strtotime($date_time))."
																			</small>
																		</p>
																	</footer>
																</div>
															</div>
														</div>
													</a>"; 
										}
										
										echo $j_post;
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
                                            <td>No. of Jobs posted </td>
                                            <td align="right"><span class="label label-light-info"><?php echo $pdo_jpost;?></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Column -->
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

    <!-- sample modal content -->
    <div id="jobPostModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Job Announcement Post</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                
                </div>
                <form class="form center-block floating-labels" name="addJob" id="AddJobPost" method="post" enctype = "multipart/form-data" class="l-form">
                    <div class="modal-body">
                        <br>
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input type="text" name="jobName" id="jobName" class="form-control" autofocus required/>
                                <label class="form-label">Job name <span class="danger">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input type="text" name="compName" id="compName" class="form-control" autofocus required/>
                                <label class="form-label">Company name <span class="danger">*</span></label>
                            </div>
                        </div>
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input type="text" name="compLoc" id="compLoc" class="form-control" autofocus required/>
                                <label class="form-label">Company location <span class="danger">*</span></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="5" name="jobDesc" id="jobDesc" class="form-control no-resize auto-growth" required></textarea>
                                <label class="form-label">Job description <span class="danger">*</span></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="5" name="jobReq" id="jobReq" class="form-control no-resize auto-growth" required></textarea>
                                <label class="form-label">Job Requirements <span class="danger">*</span></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstName"> Monthly salary range : <span class="danger">*</span> </label>
                                    <select class="form-control" id="salRange" name="salRange" oninput="this.className = ''" required>
                                        <option value="">Select salary range</option>
                                        <option value="Below P 5,000.00">Below P 5,000.00</option>
                                        <option value="P 5,000.00 to less than P 10,000.00">P 5,000.00 to less than P 10,000.00</option>
                                        <option value="P 10,000.00 to less than P 15,000.00">P 10,000.00 to less than P 15,000.00</option>
                                        <option value="P 20,000.00 to less than P 20,000.00">P 20,000.00 to less than P 20,000.00</option>
                                        <option value="P 20,000.00 to less than P 25,000.00">P 20,000.00 to less than P 25,000.00</option>
                                        <option value="P 25,000.00 and above">P 25,000.00 and above</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="middleInitial"> Employment type : <span class="danger">*</span> </label>
                                    <select class="form-control" id="empType" name="empType" oninput="this.className = ''" required>
                                        <option value="">Select employment type</option>
                                        <option value="Full-time">Full-time</option>
                                        <option value="Part-time">Part-time</option>
                                        <option value="Contract">Contract</option>
                                        <option value="Temporary">Temporary</option>
                                        <option value="Volunteer">Volunteer</option>
                                        <option value="Internship">Internship</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="middleInitial"> Seniority level : <span class="danger">*</span> </label>
                                    <select class="form-control" id="senLevel" name="senLevel" oninput="this.className = ''" required>
                                        <option value="">Select seniority level</option>
                                        <option value="Internship">Internship</option>
                                        <option value="Entry level">Entry level</option>
                                        <option value="Associate">Associate</option>
                                        <option value="Mid-Senior level">Mid-Senior level</option>
                                        <option value="Director">Director</option>
                                        <option value="Executive">Executive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input type="text" name="comCel" id="comCel" class="form-control" autofocus/>
                                <label class="form-label">Company mobile number</label>
                            </div>
                        </div>
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input type="text" name="comTel" id="comTel" class="form-control" autofocus/>
                                <label class="form-label">Company telephone number</label>
                            </div>
                        </div>
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input type="email" name="compEmail" id="compEmail" class="form-control" autofocus />
                                <label class="form-label">Company email</label>
                            </div>
                        </div>
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <input type="text" name="compWeb" id="compWeb" class="form-control" autofocus/>
                                <label class="form-label">Company website</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="5" name="compOver" id="compOver" class="form-control no-resize auto-growth"></textarea>
                                <label class="form-label">Company overview</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="file" id="cpBanner" name="cpBanner"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"/>
                        <input type="hidden" name="operation" id="operation" value="Add Career"/>
                            <button type = "submit" class="btn btn-outline-primary waves-effect text-left" id="submit" name="CareerPost">POST</button>
                        <button type="button" class="btn btn-outline-danger waves-effect text-left" data-dismiss="modal">Close</button>
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
        $(document).on('submit', '#AddJobPost', function(event){
            event.preventDefault();
            var base_url = window.location.origin;          
            if($('#jobName').val() == "")  
            {  
                alert("Job name is required");  
            }  
            else if($('#compName').val() == '')  
            {  
                alert("Company name is required");  
            }  
            else if($('#compLoc').val() == '')  
            {  
                alert("Company location is required");  
            }  
            else if($('#jobDesc').val() == '')  
            {  
                alert("Job description is required");  
            }  
            else if($('#jobReq').val() == '')  
            {  
                alert("Job requirement is required");  
            }  
            else if ($('#jobName').val() != '' && $('#compName').val() != ''&& $('#compLoc').val() != ''&& $('#jobDesc').val() != ''&& $('#jobReq').val() != '')
            { 

                if($('#cpBanner').val() != ''){
                    var extension = $('#cpBanner').val().split('.').pop().toLowerCase();
                    if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1){
                        alert('Invalid Image file');
                        $('#cpBanner').val('');
                        return false;
                    }
                    else{
                        $.ajax({  
                            url:base_url+"/alumni-e-network-4/alumni/career/php/post-career-php.php", 
                            method:"POST",  
                            data:new FormData(this),
                            contentType:false,
                            processData:false,
                            success:function(data){ 
                                alert(data);
                                $('#AddJobPost')[0].reset();  
                                $('#jobPostModal').modal('hide'); 
                                $('.container-fluid').load(location.href + ".page-wrapper>*","");
                                    //this.
                            }  
                        });
                    }
                } else{
                    $.ajax({  
                        url:base_url+"/alumni-e-network-4/alumni/career/php/post-career-php.php", 
                        method:"POST",  
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function(data){ 
                            alert(data);
                            $('#AddJobPost')[0].reset();  
                            $('#jobPostModal').modal('hide'); 
                            $('.container-fluid').load(location.href + ".page-wrapper>*","");
                                //this.
                        }  
                    });
                } 
            }       
        });   
    </script>

</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
