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
		require 'php/events-query-php.php';
		//require'php/post-event-php.php';
	}
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/app-calendar.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>CMU Events | CMU - Alumni Tracking And Information System</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Calendar CSS -->
    <link href="../../assets/plugins/calendar/dist/fullcalendar.css" rel="stylesheet" />
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

<body class="fix-header card-no-border">
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
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-plus-circle"></i>
									
								</a>
								<div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
									<ul>
										<li>
											<div class="drop-title">
												<a href="#" class="waves-effect waves-light model_img img-responsive" alt="default" data-toggle="modal" data-target=".bs-example-modal-lg">
													<i class="mdi mdi-message"></i> Add Events
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
                <!-- item-->
                <a href="#" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item-->
                <!--a href="#" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                <!-- item-->
                <a href="#" class="waves-effect waves-light link model_img img-responsive" alt="default" data-toggle="modal" data-target=".LogoutModal" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
            </div>
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
                        <h3 class="text-themecolor">CMU Events</h3>
                    </div>
					
					<!-- sample modal content -->
                                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
												<h4 class="modal-title" id="myLargeModalLabel">Event Post</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
											<form class="form center-block form-material" method="post" enctype = "multipart/form-data" class="l-form">
												<div class="modal-body">
													<br>
													<div class="form-group form-float form-group-lg">
														<div class="form-line">
															<input type="text" id="event-title" name="event-title" class="form-control" required/>
															<label class="form-label">Event name</label>
														</div>
													</div>
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group form-float form-group-lg">
																<div class="form-line">
																	<input type="date" id="date" name="date" class="form-control" required/>
																	<label class="form-label">Date</label>
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group form-float form-group-lg">
																<div class="form-line">
																	<input type="time" time="tmie" name="time" class="form-control" required/>
																	<label class="form-label">Time</label>
																</div>
															</div>
														</div>
													</div>
													<div class="form-group form-float form-group-lg">
														<div class="form-line">
															<input type="text" id="event-loc" name="event-loc" class="form-control" required/>
															<label class="form-label">Location</label>
														</div>
													</div>
													<div class="form-group">
														<div class="form-line">
															<textarea rows="1" id="event-desc" name="event-desc" class="form-control no-resize auto-growth" required></textarea>
															<label class="form-label">Event Description</label>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type = "submit" class="btn btn-outline-primary waves-effect text-left" name="EventPost">POST</button>
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
                <div class="row">
                    <div class="col-md-8 col-xlg-9">
						<!-- Row -->
                        <div class="row">
                            <!-- Column -->
                            <div class="col-lg-12">
								<!--FORUM CORNER-->
								<?php 
									if($pdo_event==0){
										echo "There are zero event posted as of this momment";
									}
									else{
										$ev_post = "";
										foreach($event as $ev){
								
											$eventid = $ev['event_id'];
											$eventtitle = $ev['event_title'];
											$eventdate = $ev['event_date'];
											$eventtime = $ev['event_time'];
											$eventloc = $ev['event_loc'];
											$eventdesc = $ev['event_desc'];
											$banner = $ev['image'];
											$datetime = $ev['datetime'];
											$staff = $ev['admin_id'];
											
											//Number of likes query
											$remarks = "Going";
											$remarks2 = "Interested";
											$remarks3 = "Not Now";
											
											//Number of Goers query
											$cntgoing =("SELECT `e_vote`.e_vote_id FROM alumni.`e_vote` WHERE `e_vote`.event_id = :fid AND remarks =:remarks");
												
											$pdo_cntGoing_Res = $pdoConnect ->prepare($cntgoing);
											$pdoExec = $pdo_cntGoing_Res -> execute(array(':fid' => $eventid, ':remarks' => $remarks));
											$pdo_cntgoings = $pdo_cntGoing_Res->rowCount();
																				
											//Number of Undecided query
											$cntinterested =("SELECT `e_vote`.e_vote_id FROM alumni.`e_vote` WHERE `e_vote`.event_id = :fid AND remarks =:remarks");
												
											$pdo_cntInterested_Res = $pdoConnect ->prepare($cntinterested);
											$pdoExec = $pdo_cntInterested_Res -> execute(array(':fid' => $eventid, ':remarks' => $remarks2));
											$pdo_cntinteresteds = $pdo_cntInterested_Res->rowCount();
																				
											//Number of Not Now query
											$cntnotnow =("SELECT `e_vote`.e_vote_id FROM alumni.`e_vote` WHERE `e_vote`.event_id = :fid AND remarks =:remarks");
												
											$pdo_cntNotNow_Res = $pdoConnect ->prepare($cntnotnow);
											$pdoExec = $pdo_cntNotNow_Res -> execute(array(':fid' => $eventid, ':remarks' => $remarks3));
											$pdo_cntnotnows = $pdo_cntNotNow_Res->rowCount();
								
										$ev_post .= "<a href='event.php?eventid=".$eventid."' method='POST'>
														<div class='card'>
															<div class='card-body'>
																<div>
																	<table>
																		<tbody>
																			<tr>
																				<td>
																					<h3 class='card-title'>".$eventtitle."</h3>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					".$eventloc."
																				</td>
																			</tr>
																			<tr>
																				<td>
																					".date('F d, Y', strtotime($eventdate))." ".date('h:i A', strtotime($eventtime))."
																				</td>
																			</tr>
																		</tbody>
																	</table>
																	<hr>
																	<footer class='text-right'>
																		<p>
																			<small>
																				- ".$pdo_cntgoings." <i class='mdi mdi mdi-walk'></i> &nbsp&nbsp
																				- ".$pdo_cntinteresteds." <i class='mdi mdi-star'></i> &nbsp&nbsp
																				- ".$pdo_cntnotnows." <i class='mdi mdi-close'></i>
																			</small>
																		</p>
																	</footer>
																</div>
															</div>
														</div>
													</a>"; 
										}
										
										echo $ev_post;
									}
								?>
							</div>
                            <!-- Column -->
                        </div>
                        <!--div class="card">
                            <div class="card-body">
                                <div id="calendar"></div>
								
                            </div>
                        </div-->
                    </div>
					 <div class="col-md-4 col-xlg-3">
                        <!-- Column -->
                        <div class="card earning-widget">
                            <div class="card-header">
                                <div class="card-actions">
                                    <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                    <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                </div>
                                <h4 class="card-title m-b-0">Info</h4>
                            </div>
                            <div class="card-body b-t collapse show">
                                <table class="table v-middle no-border">
                                    <tbody>
                                        <tr>
                                            <td>No. of Events </td>
                                            <td align="right"><span class="label label-light-info"><?php echo $pdo_event;?></span></td>
                                        </tr>
                                        <tr>
                                            <td>No. of Events This Year</td>
                                            <td align="right"><span class="label label-light-success"><?php echo $pdo_event_year;?></span></td>
                                        </tr>
										<tr>
                                            <td>No. of Events This Month</td>
                                            <td align="right"><span class="label label-light-success"><?php echo $pdo_event_mo;?></span></td>
                                        </tr>
										<tr>
                                            <td>No. of Events This Day</td>
                                            <td align="right"><span class="label label-light-success"><?php echo $pdo_event_day;?></span></td>
                                        </tr>
										<tr>
                                            <td>No. of Upcomming Events</td>
                                            <td align="right"><span class="label label-light-success"><?php echo $pdo_event_up;?></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="card">
                            <div class="card-header bg-info">
                                <div class="card-actions">
                                    <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                    <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                </div>
                                <h4 class="card-title m-b-0">Newly Verified Accounts</h4>
                            </div>
                            <div class="card-body p-0 collapse show text-center">
                                <div id="myCarousel2" class="carousel slide" data-ride="carousel">
                                    <!-- Carousel items -->
                                    <div class="carousel-inner bg-info">
                                        <?php 
                                        $f_post = "";
                                        foreach($n_alumni as $na){
                                            $na_id = convert_string('decrypt', $na['alumni_id']);
                                            $na_fname = $na['fname'];
                                            $na_mname = $na['mname'];
                                            $na_lname = $na['lname'];
                                            $na_extname = $na['nameext'];
                                            $na_datetime = $na['datetime_ver'];
                                            
                                            $f_post .= "<div class='carousel-item flex-column'>
                                                            <div class='m-t-30 text-center'> <img src='../../assets/images/users/5.jpg' class='img-circle' width='150'>
                                                                <h4 class='card-title m-t-10'>". $na_fname. " ". $na_mname. " ". $na_lname ." ". $na_extname."</h4>
                                                                <h6 class='card-subtitle'>".$na_id."</h6>
                                                            </div> <br>
                                                        </div>";
                                            
                                        }
                                        echo $f_post;
                                        ?>
                                        <div class="carousel-item flex-column active">
                                            <div class='m-t-30 text-center'> <img src="../../assets/images/users/5.jpg" class="img-circle" width="150">
                                                <h4 class="card-title m-t-10">See More Alumni</h4>
                                                <h6 class="card-subtitle"> &nbsp </h6>
                                            </div> <br>
                                        </div>
                                    </div>
                                </div>
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
    <!-- Calendar JavaScript -->
    <script src="../../assets/plugins/calendar/jquery-ui.min.js"></script>
    <script src="../../assets/plugins/moment/moment.js"></script>
    <script src='../../assets/plugins/calendar/dist/fullcalendar.min.js'></script>
    <script src="../../assets/plugins/calendar/dist/cal-init.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

    <script>  

        $(document).on('submit', '#addForumForm', function(event){
                event.preventDefault();
                var base_url = window.location.origin;          
                if($('#event-title').val() == "")  
                {  
                    alert("Event name is required");  
                }  
                else if($('#date').val() == '')  
                {  
                    alert("Event date is required");  
                } 
                else if($('#time').val() == '')  
                {  
                    alert("Event time is required");  
                } 
                else if($('#event-loc').val() == '')  
                {  
                    alert("Event location is required");  
                } 
                else if($('#event-desc').val() == '')  
                {  
                    alert("Description is required");  
                }  
                else if ($('#forumtitle').val() != '' && $('#forumdesc').val() != '')
                {  
                    $.ajax({  
                        url:base_url+"/alumni-e-network-4/Administrator/events/php/post-event-php.php", 
                        method:"POST",  
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function(data){ 
                            alert(data);
                            $('#addForumForm')[0].reset();  
                            $('#forumModal').modal('hide'); 
                            //this.
                        }  
                    });  
                }       
            });
        



         
    </script>
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/app-calendar.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
