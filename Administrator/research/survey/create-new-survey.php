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
	}
	
	$qType= DB::query("SELECT * FROM alumnitracking.survey_question_type");
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
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Alumni Survey | CMU - Alumni Tracking And Information System</title>
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

	<style>
		form#AddSurveyForm{ border:#000 0px solid; padding:24px; width:100%; }
		form#AddSurveyForm > #phase2{ display:none; }
	</style>
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
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <!--li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-view-grid"></i></a>
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
											<li><a href="#"><i class="ti-email"></i> Inbox</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
										</ul>
									</li>
                                    <li class="col-lg-4  m-b-30">
                                        <h4 class="m-b-20">Send Feedback</h4>
                                        <!-- Contact -->
                                        <!--form>
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
                                        <!--ul class="list-style-none">
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
							<!--li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-plus-circle"></i>
									
								</a>
								<div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
									<ul>
										<li>
											<div class="drop-title">
												<a href="create-new-survey.php" class="waves-effect waves-light model_img img-responsive"
													<i class="mdi mdi-message"></i> Create a new survey
												</a>
											</div>
										</li>
										<li>
											<div class="drop-title">
												<a href="#" class="waves-effect waves-light model_img img-responsive" alt="default" data-toggle="modal" data-target="#add-survey-question">
													<i class="mdi mdi-message"></i> Add survey question
												</a>
											</div>
										</li>
									</ul>
								</div>
							</li>
                        <!-- ============================================================== -->
                        <!-- End Add Administrator -->
                        <!-- ============================================================== -->
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
						<a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo convert_string('decrypt', $afname), ' ', convert_string('decrypt',$amname), ' ', convert_string('decrypt',$alname), ' ', convert_string('decrypt',$aextname);?></a>
                        <div class="dropdown-menu animated flipInY">
							<a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
							
							<div class="dropdown-divider"></div> 
							<a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                            
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
							<a class="waves-effect waves-dark" href="../dashboard/home.php"><i class="mdi mdi-gauge"></i>Dashboard</a>
                        </li>
                        
						<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">Research</span></a>
                            <ul aria-expanded="false" class="collapse" style="text-indent:40px;">
                                <li><a href="forum-corner.php">Forum Corner</a></li>
                                <li><a href="poll-corner.php">Poll Corner</a></li>
                                <li><a href="alumni-survey.php">Alumni Survey</a></li>
                            </ul>
                        </li>
						
                        <li> 
							<a class="waves-effect waves-dark" href="../events/cmu-events.php" aria-expanded="false"><i class="mdi mdi-calendar-range"></i><span class="hide-menu">CMU Events</span></a>
                        </li>
						
                        <li> 
							<a class="waves-effect waves-dark" href="../career/career-corner.php" aria-expanded="false"><i class="mdi mdi-briefcase"></i><span class="hide-menu">Career Bulletin</span></a>
                        </li>
						
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">ACCOUNTS</li>
						
                        <li> 
							<a class="waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Alumni Accounts</span></a>
                        </li>
                        <li> 
							<a class="waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Administrator Accounts</span></a>
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
                <!-- item--><a href="#" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
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
                        <h3 class="text-themecolor">Create New Alumni Survey</h3>
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
								<!--CREATE NEW SURVEY NAME-->
								<div class='card'>
									<div class='card-body'>
										<form id="AddSurveyForm" onsubmit="return false">
										
											<h1>Create new survey</h1>
									
											<progress id="progressBar" value="50" max="100" style="width:100%;"></progress>
											<h3 id="status">Phase 1 of 2</h3>
											
											<div id="phase1">
												<br>
												
													<div class="form-group form-float form-group-lg">
														<div class="form-line">
															<label class="form-label">Survey title <span class="danger">*</span></label>
															<input type="text" id="surveytitle" name="surveytitle" class="form-control" required/>
														</div>
													</div>
													<div class="row">
														<div class="form-line col-sm-12">
															<br>
														</div>
														<div class="form-group form-float form-group-lg col-sm-6">
															<div class="col-sm-12">
																<div class="form-group form-float form-group-lg">
																	<div class="form-line">
																		<label class="form-label">Survey date start <span class="danger">*</span></label>
																		<input type="date" id="ssdate" name="ssdate" class="form-control datetime" required/>
																	</div>
																</div>
															</div>
														</div>
														<div class="form-group form-float form-group-lg col-sm-6">
															<div class="col-sm-12">
																<div class="form-group form-float form-group-lg">
																	<div class="form-line">
																		<label class="form-label">Survey time start <span class="danger">*</span></label>
																		<input type="time" id="sstime" name="sstime" class="form-control datetime" required/>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="form-line col-sm-12">
															<br>
														</div>
														<div class="form-group form-float form-group-lg col-sm-6">
															<div class="col-sm-12">
																<div class="form-group form-float form-group-lg">
																	<div class="form-line">
																		<label class="form-label">Survey date end <span class="danger">*</span></label>
																		<input type="date" id="sedate" name="sedate" class="form-control datetime" required/>
																	</div>
																</div>
															</div>
														</div>
														<div class="form-group form-float form-group-lg col-sm-6">
															<div class="col-sm-12">
																<div class="form-group form-float form-group-lg">
																	<div class="form-line">
																		<label class="form-label">Survey time end <span class="danger">*</span></label>
																		<input type="time" id="setime" name="setime" class="form-control datetime" required/>
																	</div>
																</div>
															</div>
														</div>
													</div>
													
													<br>
												
												<div class="row">
													<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
														<button class="btn btn-success" onclick="processPhase1()">Continue</button>
													</div>
												</div>
											</div>
											
											<div id="phase2">
												<br>
												<div class="row">
													<div class="form-group col-sm-12">
														<div class="form-line ">
															<label class="form-label">Survey Question <span class="danger">*</span></label>
															<textarea rows="1" id="surveyQuestion[]" name="surveyQuestion[]" style="width:100%;"  class="form-control no-resize auto-growth" required></textarea>
														</div>
													</div>
													<div id="questionX" class="question-x">
														<div class="row">
															<div class="form-line col-sm-12">
																<br>
															</div>
															<div class="form-group form-float form-group-lg col-sm-6">
																<div class="col-sm-12">
																	<div class="form-group form-float form-group-lg">
																		<div class="form-line">
																			<label class="form-label">Question # <span class="danger">*</span></label>
																			<select class="form-control" id="questionNo" name="questionNo" required>
																				<?php
																					for ($y = 1; $y < 200 + 1; $y++){
																						echo '<option value = "' .$y. '">' .$y. '</option>';}
																				?>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="form-group form-float form-group-lg col-sm-6">
																<div class="col-sm-12">
																	<div class="form-group form-float form-group-lg">
																		<div class="form-line">
																			<label class="form-label">Question type <span class="danger">*</span></label>
																			<select class="form-control" id="questionType" name="questionType" required>
																				<option >Select question type</option>
																				<?php
																					foreach ($qType as $q){
																						$idType = $q['id'];
																						$qt = $q['type_name'];
																						echo '<option value = "' .$idType. '">' .$qt. '</option>';
																					}
																				?>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div id="sq"></div>
                                                        <div id="requireAns" class="demo-checkbox">
                                                            <input type="checkbox" id="requireA[]" name="requireA[]" value="1"/>
                                                            <label for="requireA">Require users to answer this question? <span class="danger">*</span></label>
                                                        </div>
													</div>
													<div>
														<hr>
													</div>
													<button type="button" name="addQuestion" id="addQuestion" class="btn btn-success">Add more question</button>
                                                    <!-- <button onclick="newAnswer()">asdasd</button> -->
													
												</div>
												<div>
													<br>
												</div>
												<div class="row">
													<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                                                        <input type="hidden" name="adminids" id="adminids" value="<?php echo Login::isloggedin();?>">
														<button type="button" class="btn btn-secondary" onclick="processPhaseBack1()">Back</button>
														<button type="submit" name="SubmitSF" onclick="submitForm()">Submit Data</button>
														
													</div>
												</div>
											</div>
											<!--div class="modal-footer">
												<button type="submit" name="SubmitBI" onclick="submitForm()">Submit Data</button-->
												<!--button type = "submit" class="btn btn-outline-primary waves-effect text-left" id="submit" name="surveyNameSave">SAVE</button>
												<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
											</div-->
											
										</form>
									</div>
								</div>
								<!--END OF CREATE NEW SURVEY NAME-->
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
    <!-- ============================================================== --><!--c3 JavaScript -->
    <script src="../../assets/plugins/d3/d3.min.js"></script>
    <script src="../../assets/plugins/c3-master/c3.min.js"></script>
    <!-- Chart JS -->
	<!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
	
	<!--Dynamically add POLL CHOICES-->
	 <script> 
		/*$("#seeAnotherField").change(function() {
			if ($(this).val() == "yes") {
				$('#otherFieldDiv').show();
				$('#otherField').attr('required','');
				$('#otherField').attr('data-error', 'This field is required.');
			} else {
				$('#otherFieldDiv').hide();
				$('#otherField').removeAttr('required');
				$('#otherField').removeAttr('data-error');				
			}
		});
		$("#seeAnotherField").trigger("change");*/
		var surveytitle, ssdate, sstime, sedate, setime, surveyQuestion, questionNo, questionType;
		
		function _(x){
			return document.getElementById(x);
		}
		function processPhase1(){
            surveyTitle = _("surveytitle").value;
            surveySDate = _("ssdate").value;
            surveySTime = _("sstime").value;
            surveyEDate = _("sedate").value;
            surveyETime = _("setime").value;
            if(surveyTitle.length > 5 && surveySDate.length > 2 && surveySTime.length > 0 && surveyEDate.length > 0 && surveyETime.length > 0){
                _("phase1").style.display = "none";
                _("phase2").style.display = "block";
                _("progressBar").value = 100;
                _("status").innerHTML = "Phase 2 of 2";    
            } else {
                alert("Please fill-in the fields marked *");
            }
				
		}
		function processPhaseBack1(){
				_("phase2").style.display = "none";
				_("phase1").style.display = "block";
				_("progressBar").value = 50;
				_("status").innerHTML = "Phase 1 of 2";
		}
		
		function submitForm(){
			surveyQuestion = _("surveyQuestion[]").value;
			questionNo = _("questionNo").value;
			questionType = _("questionType").value;
			if(surveyQuestion.length > 5 && questionNo.length > 0 && questionType.length > 0){
				_("AddSurveyForm").method = "post";
				_("AddSurveyForm").action = "php/ssf-php.php";
				_("AddSurveyForm").submit();
			} else {
				alert("Please fill-in the fields marked *");	
			}
			
		}
	
	</script>
	<script>

    let i=1;
    let b=1; 
        
	let sq = `<div id="ansNotOpinionYesNO" class="table-responsive">  
				<table class="table table-bordered" id="dynamic_f_Answer1">  
					<th>Answer choices <span class="danger">*</span></th>
					<tr>  
						<td style=" width: 90%">
							<input type="text" id="answer[]" name="answer[]" placeholder="Answer" class="form-control name_list" required/>
						</td>  
						 <td style=" width: 5%">
							<button type="button" name="addAnswer" onclick="newAnswer()" class="btn btn-success">+</button>
						</td>  
					</tr> 
					<tr>  
						<td style=" width: 90%">
							<input type="text" id="answer[]" name="answer[]" placeholder="Answer" class="form-control name_list" required/>
						</td>  
						 <td style=" width: 5%">
						</td>  
					</tr>  
			    </table>
			</div>
            <div id="ansNotOpinionYesNO21" class="demo-checkbox">
                <input type="checkbox" id="basic_checkbox_1[]" name="basic_checkbox_1[]"/>
                <label for="basic_checkbox_1">Enable to input answer incase the answer is not in the choices?</label>
            </div>`;


		$("#questionType").change(function() {
			if ($(this).val() == "1" || $(this).val() == "2" || $(this).val() == "7") {
				$('#ansNotOpinionYesNO').hide();
				$('#ansNotOpinionYesNO21').hide();
				$('#answer').removeAttr('required','');
				$('#answer').removeAttr('data-error');
			} 
			else if ($(this).val() == "3" || $(this).val() == "4" || $(this).val() == "5" || $(this).val() == "6") {
				$('#ansNotOpinionYesNO').hide();
                $('#ansNotOpinionYesNO21').hide();
                $('#answer').removeAttr('required','');
                $('#answer').removeAttr('data-error');

                $('#answer').attr('required','');
				$('#answer').attr('data-error', 'This field is required.');
				$('#sq').append(sq);
			} 
			else {
				$('#ansNotOpinionYesNO').hide();
				$('#ansNotOpinionYesNO21').hide();
				$('#answer').removeAttr('required','');
				$('#answer').removeAttr('data-error');				
			}
		});
		$("#questionType").trigger("change");
		
		$('#addChoice').click(function(){
			alert();
		});


        let tar = '';
        let tar2 = '';


        function qtypes(q) {
        
        let sq1 = `<div id="ansNotOpinionYesNO" class="table-responsive">  
                <table class="table table-bordered" id="dynamic_f_Answer`+i+`">  
                    <th>Answer choices <span class="danger">*</span></th>
                    <tr>  
                        <td style=" width: 90%">
                            <input type="text" id="answer[]" name="answer[]" placeholder="Answer" class="form-control name_list" required/>
                        </td>  
                         <td style=" width: 5%">
                            <button type="button" name="addAnswer" onclick="newAnswer()" class="btn btn-success">+</button>
                        </td>  
                    </tr> 
                    <tr>  
                        <td style=" width: 90%">
                            <input type="text" id="answer[]" name="answer[]" placeholder="Answer" class="form-control name_list" required/>
                        </td>  
                         <td style=" width: 5%">
                        </td>  
                    </tr>  
                </table>
            </div>
            <div id="ansNotOpinionYesNO21`+i+`" class="demo-checkbox">
                <input type="checkbox" id="basic_checkbox_1[]" name="basic_checkbox_1[]"/>
                <label for="basic_checkbox_1">Enable to input answer incase the answer is not in the choices?</label>
            </div>`;

            if ($(q).val() == "3" || $(q).val() == "4" || $(this).val() == "5" || $(this).val() == "6") {
                $('#ansNotOpinionYesNO').hide();
                $('#ansNotOpinionYesNO21').hide();
                $('#answer').removeAttr('required','');
                $('#answer').removeAttr('data-error');

                $('#answer').attr('required','');
                $('#answer').attr('data-error', 'This field is required.');
                $('#'+tar).append(sq1);
            } 
        };
    
        function newAnswer()
        {   
            let id = '#dynamic_f_Answer'+i;
            b++;  
            $(id).append('<tr id="row'+b+'"><td style=" width: 90%"><input type="text" id="answer[]" name="answer[]" placeholder="Answer" class="form-control name_list" required/></td><td><button type="button" name="remove" id="'+b+'" class="btn btn-danger btn_removes" onclick="removetr(this)">X</button></td></tr>'); 
        };

        function removequestion(a)
        {
            $('#a'+a.id).remove();  
        }

        $('#addQuestion').click(function(){ 
            let q = `
            <div id= 'arm`+i+`'>
                <button type="button" name="remove" id="rm`+i+`" class="btn btn-danger btn_removes" onclick="removequestion(this)">Remove</button>
                <div class="form-group">
                    <div class="form-line col-sm-12">
                        <label class="form-label">Survey Question <span class="danger">*</span></label>
                        <textarea rows="1" id="surveyQuestion[]" name="surveyQuestion[]" style="width:100%;" class="form-control no-resize auto-growth" required></textarea>
                    </div>
                </div>
                <div id="questionX" class="question-x">
                    <div class="row">
                        <div class="form-line col-sm-12">
                            <br>
                        </div>
                        <div class="form-group form-float form-group-lg col-sm-6">
                            <div class="col-sm-12">
                                <div class="form-group form-float form-group-lg">
                                    <div class="form-line">
                                        <label class="form-label">Question # <span class="danger">*</span></label>
                                        <select class="form-control" id="questionNo" name="questionNo" required>
                                            <?php
                                                for ($y = 1; $y < 200 + 1; $y++){
                                                    echo '<option value = "' .$y. '">' .$y. '</option>';}
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-float form-group-lg col-sm-6">
                            <div class="col-sm-12">
                                <div class="form-group form-float form-group-lg">
                                    <div class="form-line">
                                        <label class="form-label">Question type <span class="danger">*</span></label>
                                        <select class="form-control" onclick="qtypes(this)" name="questionType" required>
                                            <option >Select question type</option>
                                            <?php
                                                foreach ($qType as $q){
                                                    $idType = $q['id'];
                                                    $qt = $q['name'];
                                                    echo '<option value = "' .$idType. '">' .$qt. '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="sq`+i+`"></div>
                    <div id="requireAns" class="demo-checkbox">
                        <input type="checkbox" id="requireA[]" name="requireA[]"/>
                        <label for="requireA">Require users to answer this question? <span class="danger">*</span></label>
                    </div>
                </div>
                <div>
                    <hr>
                </div>
                </div>
            `;
            tar = 'sq'+i;
            tar2 = 'qt'+i;
           $('#questionX').append(q);      
           i++;  
        });  
	
		$(document).ready(function(){ 
            let a = 0; 
			$('#addAnswer').click(function(){  
				a++;  
				$('#dynamic_field_Answer'+i).append('<tr id="row'+a+'"><td style=" width: 90%"><input type="text" id="answer[]" name="answer[]" placeholder="Answer" class="form-control name_list" required/></td><td><button type="button" name="remove" id="'+a+'" class="btn btn-danger btn_removes">X</button></td></tr>');  
			});  
			$(document).on('click', '.btn_removes', function(){  
				var button_id = $(this).attr("id");   
				$('#row'+button_id+'').remove();  
			});
			
			
			
		$("#questionType").trigger("change");
			$(document).on('click', '.btn_remove', function(){  
			   var button_id = $(this).attr("id");   
			   $('#row'+button_id+'').remove();  
			});
			
		});  
	 </script>
	
	
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>