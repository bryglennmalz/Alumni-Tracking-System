<?php 
	ob_start();
	session_start();
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
			
	if(!Login::isloggedin()){
		header('location: ../index.php');
	}
	else{
		require '../../php/query-php.php';
		require 'php/forum-query-php.php';
		require'php/post-forum-php.php';
	}
	
	if (isset($_GET['pollid'])){
		
		//Certain poll query
		$ppost = DB::query('SELECT * FROM alumni.poll WHERE poll.`poll-id` = :pollid', array(':pollid' => $_GET['pollid']));
		
		foreach($ppost as $p){
			$pid = $p['poll-id'];
			$pstaff = $p['staff-id'];
			$ptitle = $p['poll-title'];
			$pdpost = $p['date-post'];
			$pdend = $p['date-end'];
		}
		
		//determine the author
		$staffid = DB::query('SELECT * FROM alumni.staff WHERE id = :staffid', array(':staffid' => $pstaff));
		
		foreach($staffid as $s){
			$id = $s['id'];
			$fname = $s['fname'];
			$mi = $s['mname'];
			$lname = $s['lname'];
			$nameext = $s['nameext'];
		}
		
		//Number of poll votes query
		$cntvoteall =("SELECT poll_votes.p_vote_id, `poll-choice`.`p-choices-id`, poll.`poll-id` FROM poll_votes INNER JOIN `poll-choice` ON 
					   poll_votes.p_choices_id = `poll-choice`.`p-choices-id` INNER JOIN poll ON `poll-choice`.`poll-id` = poll.`poll-id` WHERE `poll-choice`.`poll-id` = :pollid");
		
		$pdo_cntVoteAll_Res = $pdoConnect ->prepare($cntvoteall);
		$pdoExec = $pdo_cntVoteAll_Res -> execute(array(':pollid' => $_GET['pollid']));
		$pdo_poll_all_likes = $pdo_cntVoteAll_Res->rowCount();
		
		//Poll Choices
		$poll_choices = DB::query('SELECT * FROM `poll-choice` WHERE `poll-choice`.`poll-id` = :pollid', array(':pollid' => $_GET['pollid']));
		//Number of overall query
		//$cntlikes =("SELECT `poll-votes`.`p-vote-id` FROM alumni.`poll-votes` WHERE `poll-votes`.forum_id = :fid");
		
		//$pdo_cntLikes_Res = $pdoConnect ->prepare($cntlikes);
		//$pdoExec = $pdo_cntLikes_Res -> execute(array(':fid' => $forumid));
		//$pdo_forum_likes = $pdo_cntLikes_Res->rowCount();
		
		
		
	}
	
	//Forum Edit
		
	//Forum delete
	//if (isset($_GET['delete_forumid'])){
		
		//DB::query('DELETE FROM alumni.forum WHERE forum.forumid = :del_fid', array(':del_fid' => $_GET['delete_forumid']));
		//header("location:forum-corner.php");
	//}
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
    <title>Poll | <?php echo $ptitle; ?></title>
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
                        <!-- Add Poll -->
                        <!-- ============================================================== -->
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-plus-circle"></i>
									
								</a>
								<div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
									<ul>
										<li>
											<div class="drop-title">
												<a href="#" class="waves-effect waves-light model_img img-responsive" alt="default" data-toggle="modal" data-target=".bs-example-modal-lg">
													<i class="mdi mdi-message"></i> Add Poll
												</a>
											</div>
										</li>
									</ul>
								</div>
							</li>
                        <!-- ============================================================== -->
                        <!-- End Add Poll -->
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
                        
						<li> <a class="has-arrow waves-effect waves-dark active" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">Research</span></a>
                            <ul aria-expanded="false" class="collapse" style="text-indent:40px;">
                                <li class="active"><a href="forum-corner.php">Forum Corner</a></li>
                                <li><a href="poll-corner.php">Poll Corner</a></li>
                                <li><a href="alumni-survey.php">Alumni Survey</a></li>
                            </ul>
                        </li>
						
                        <li> 
							<a class="waves-effect waves-dark" href="../career/career-corner.php" aria-expanded="false"><i class="mdi mdi-calendar-range"></i><span class="hide-menu">CMU Events</span></a>
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
                        <h3 class="text-themecolor"><?php echo $ftitle; ?></h3>
						<h6><small><ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../dashboard/home.php">Home</a></li>
							<li class="breadcrumb-item"><a href="forum-corner.php">Forum Corner</a></li>
                            <li class="breadcrumb-item active"><?php echo $ptitle;?></li>
                        </ol></small></h6>
                    </div>
					
					<!-- sample modal content -->
                                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
												<h4 class="modal-title" id="myLargeModalLabel">Poll Post</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
											<form class="form center-block floating-labels" name="add_name" id="add_name" method="post" enctype = "multipart/form-data" class="l-form">
												<div class="modal-body">
													<br>
													<div class="form-group form-float form-group-lg">
														<div class="form-line">
															<input type="text" name="poll-title" class="form-control" required/>
															<label class="form-label">Poll Question</label>
														</div>
													</div>
													
													<div class="clearfix"><br><br></div>
													
													<div class="table-responsive">  
													   <table class="table table-bordered" id="dynamic_field">  
															<tr>  
																 <td style=" width: 90%"><input type="text" name="choice[]" placeholder="Poll Choice" class="form-control name_list" require/></td>  
																 <td style=" width: 10%"><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
															</tr>  
															<tr>  
																 <td style=" width: 90%"><input type="text" name="choice[]" placeholder="Poll Choice" class="form-control name_list" require/></td>  
																 <td style=" width: 10%"></td>  
															</tr>  
													   </table>   
													</div>
													<div class="row">
														<div class="form-line col-sm-12">
															<br>
															<br>
														</div>
														<div class="form-group form-float form-group-lg col-sm-6">
															<div class="col-sm-12">
																<div class="form-group form-float form-group-lg">
																	<div class="form-line">
																		<input type="date" name="date" class="form-control datetime" required/>
																		<label class="form-label">Date End</label>
																	</div>
																</div>
															</div>
														</div>
														<div class="form-group form-float form-group-lg col-sm-6">
															<div class="col-sm-12">
																<div class="form-group form-float form-group-lg">
																	<div class="form-line">
																		<input type="time" name="time" class="form-control datetime" required/>
																		<label class="form-label">Time End</label>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type = "submit" class="btn btn-outline-primary waves-effect text-left" id="submit" name="submit">POST</button>
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
                    <div class="col-md-8 col-xlg-9">
                        <!-- Row -->
                        <div class="row">
                            <!-- Column -->
                            <div class="col-lg-12">
								<!--FORUM CORNER-->
								<!-- Tab panes -->
								<div class='card'>
									<div class='card-body'>
										<div>
											<h4 class='card-title text-justify'><?php echo $ptitle;?></h4>
											<br>
											
											<ul class="nav nav-tabs customtab" role="tablist">
												<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home2" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Results</span></a> </li>
											</ul>
											<!-- Tab panes -->
											<div class="tab-content">
												<div class="tab-pane active" id="home2" role="tabpanel">
													<div class="p-20">
														<ul class="list-unstyled">
															<?php
																	$p_result="";
																	foreach($poll_choices as $pca){
																		$c_id = $pca['p-choices-id'];
																		$p_id = $pca['poll-id'];
																		$choices = $pca['choice-title'];
																		
																		$cntvoteeach =("SELECT poll_votes.p_vote_id FROM poll_votes WHERE poll_votes.p_choices_id = :choices");
		
																		$pdo_cntVoteEach_Res = $pdoConnect ->prepare($cntvoteeach);
																		$pdoExec = $pdo_cntVoteEach_Res -> execute(array(':choices' => $c_id));
																		$pdo_poll_each_likes = $pdo_cntVoteEach_Res->rowCount();
																		
																		$p_result.="<table class='table v-middle no-border'>
																						<tbody>
																							<tr>
																								<td><h5>". $choices ."</h5></td>
																								<td align='right'><h5>". $pdo_poll_each_likes ." votes</h5></td>
																							</tr>
																						</tbody>
																					</table>";
																	}
																	echo $p_result;
																?>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
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
                                    <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                </div>
                                <h4 class="card-title m-b-0">Info</h4>
                            </div>
                            <div class="card-body b-t collapse show">
                                <table class="table v-middle no-border">
                                    <tbody>
                                        <tr>
                                            <td><h6><small><i>Posted by:</i></h6></small></td>
                                            <td align="right"><h6><?php echo $fname, " ", $mi, " ", $lname, " ", $nameext ;?></h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6><small><i>Date Posted:</i></h6></small></td>
                                            <td align="right"><h6><?php echo date('F d, Y  h:i A', strtotime($pdpost));?></h6></td>
                                        </tr>
										<tr>
                                            <td><h6><small><i>Poll End:</i></h6></small></td>
                                            <td align="right"><h6><?php echo date('F d, Y  h:i A', strtotime($pdend));?></h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6><small><i>No. of overall votes:</i></h6></small></td>
                                            <td align="right"><h6><?php echo $pdo_poll_all_likes;?></h6></td>
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
											$na_id = $na['id'];
											$na_fname = $na['fname'];
											$na_mname = $na['mi'];
											$na_lname = $na['lname'];
											$na_extname = $na['nameext'];
											$na_datetime = $na['datetime_verified'];
											
											$f_post .= "<div class='carousel-item flex-column'>
															<div class='m-t-30 text-center'> <img src='../../assets/images/users/5.jpg' class='img-circle' width='150'>
																<h4 class='card-title m-t-10'>". $na_fname. " ". $na_mname. ". ". $na_lname ." ". $na_extname."</h4>
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
	 });  
	 </script>
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
