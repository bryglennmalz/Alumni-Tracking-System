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
	}
	
	if (isset($_GET['eventid'])){
		
		//Certain forum query
		$epost = DB::query('SELECT * FROM events WHERE events.event_id = :eventid', array(':eventid' => $_GET['eventid']));
		
		foreach($epost as $ev){
			$eventid = $ev['event_id'];
			$eventtitle = $ev['event_title'];
			$eventdate = $ev['event_date'];
			$eventtime = $ev['event_time'];
			$eventloc = $ev['event_loc'];
			$eventdesc = $ev['event_desc'];
			$banner = $ev['image'];
			$datetime = $ev['datetime'];
			$staff = $ev['admin_id'];
		}
		
		//determine the author
		$staffid = DB::query('SELECT * FROM admin WHERE admin_id = :staffid', array(':staffid' => $staff));
		
		foreach($staffid as $s){
			$id = $s['admin_id'];
			$fname = $s['fname'];
			$mi = $s['mname'];
			$lname = $s['lname'];
			$nameext = $s['nameext'];
		}
		
		//Number of likes query
		$remarks = "Going";
		$remarks2 = "Interested";
		$remarks3 = "Not Now";
		
		//Number of Goers query
		$cntgoing =("SELECT `event_vote`.event_vote_id FROM event_vote WHERE event_id = :fid AND remarks =:remarks");
			
		$pdo_cntGoing_Res = $pdoConnect ->prepare($cntgoing);
		$pdoExec = $pdo_cntGoing_Res -> execute(array(':fid' => $_GET['eventid'], ':remarks' => $remarks));
		$pdo_cntgoings = $pdo_cntGoing_Res->rowCount();
											
		//Number of Undecided query
		$cntinterested =("SELECT `event_vote`.e_vote_id FROM event_vote WHERE event_id = :fid AND remarks =:remarks");
			
		$pdo_cntInterested_Res = $pdoConnect ->prepare($cntinterested);
		$pdoExec = $pdo_cntInterested_Res -> execute(array(':fid' => $_GET['eventid'], ':remarks' => $remarks2));
		$pdo_cntinteresteds = $pdo_cntInterested_Res->rowCount();
											
		//Number of Not Now query
		$cntnotnow =("SELECT `event_vote`.e_vote_id FROM event_vote WHERE event_id = :fid AND remarks =:remarks");
			
		$pdo_cntNotNow_Res = $pdoConnect ->prepare($cntnotnow);
		$pdoExec = $pdo_cntNotNow_Res -> execute(array(':fid' => $_GET['eventid'], ':remarks' => $remarks3));
		$pdo_cntnotnows = $pdo_cntNotNow_Res->rowCount();
		
												
		//Alumni Goers
		$goers_alumni = DB::query("SELECT event_vote.alumni_id AS AlumniID, alumni.fname AS FName, alumni.mname AS Mi, alumni.lname AS Lname, alumni.nameext AS NameExt FROM `events` INNER JOIN event_vote ON event_vote.event_id = `events`.event_id INNER JOIN alumni ON event_vote.alumni_id = alumni.alumni_id WHERE event_vote.remarks = :remarks AND event_vote.event_id = :eventid", array(':remarks' => $remarks,':eventid' => $_GET['eventid']));
		
		//Alumni
		$interesteds_alumni = DB::query("SELECT event_vote.alumni_id AS AlumniID, alumni.fname AS FName, alumni.mname AS Mi, alumni.lname AS Lname, alumni.nameext AS NameExt FROM `events` INNER JOIN event_vote ON event_vote.event_id = `events`.event_id INNER JOIN alumni ON event_vote.alumni_id = alumni.alumni_id WHERE event_vote.remarks = :remarks AND event_vote.event_id = :eventid", array(':remarks' => $remarks2,':eventid' => $_GET['eventid']));
		//Alumni
		$notnows_alumni = DB::query("SELECT event_vote.alumni_id AS AlumniID, alumni.fname AS FName, alumni.mname AS Mi, alumni.lname AS Lname, alumni.nameext AS NameExt FROM `events` INNER JOIN event_vote ON event_vote.event_id = `events`.event_id INNER JOIN alumni ON event_vote.alumni_id = alumni.alumni_id WHERE event_vote.remarks = :remarks AND event_vote.event_id = :eventid", array(':remarks' => $remarks3,':eventid' => $_GET['eventid']));
	}


	
	if (isset($_POST['going'])) {
		$eventids = $_POST['event_ids'];
		$remarks = 'Going';
		
		DB::query('INSERT INTO `event_vote` VALUES (\'\', :eventid,, :remarks :alumniid)', array(':eventid' => $_GET['eventid'], ':remarks' => $remarks, ':alumniid' => $alid));
		
		//Number of likes query
		$cntgoing =("SELECT `event_vote`.id FROM `event_vote` WHERE `event_vote`.event_id = :fid AND remarks =:remarks");
			
		$pdo_cntGoing_Res = $pdoConnect ->prepare($cntgoing);
		$pdoExec = $pdo_cntGoing2_Res -> execute(array(':fid' => $_GET['eventid'], ':remarks' => $remarks));
		$pdo_cntgoings = $pdo_cntGoing2_Res->rowCount();
												
		exit();
	}
	
	if (isset($_POST['interesteds'])) {
		$eventids = $_POST['event_ids'];
		$remarks = 'Interested';
		
		DB::query('INSERT INTO `event_vote` VALUES (\'\', :eventid, :remarks, :alumniid)', array(':eventid' => $_GET['eventid'], ':remarks' => $remarks, ':alumniid' => $alid));
			
		//Number of likes query
		$cntinterested =("SELECT `event_vote`.id FROM `event_vote` WHERE `event_vote`.event_id = :fid AND remarks =:remarks");
			
		$pdo_cntGoing_Res = $pdoConnect ->prepare($cntinterested);
		$pdoExec = $pdo_cntInterested_Res -> execute(array(':fid' => $_GET['eventid'], ':remarks' => $remarks));
		$pdo_cntinteresteds = $pdo_cntInterested_Res->rowCount();
												
		exit();
	}
	
	if (isset($_POST['notnows'])) {
		$eventids = $_POST['event_ids'];
		$remarks = 'Not Now';
		
		DB::query('INSERT INTO `event_vote` VALUES (\'\', :eventid, :remarks, :alumniid)', array(':eventid' => $_GET['eventid'], ':remarks' => $remarks, ':alumniid' => $alid));
			
		//Number of likes query
		$cntnotnow =("SELECT `event_vote`.id FROM `event_vote` WHERE `event_vote`.event_id = :fid AND remarks =:remarks");
			
		$pdo_cntNotNow_Res = $pdoConnect ->prepare($cntnotnow);
		$pdoExec = $pdo_cntNotNow_Res -> execute(array(':fid' => $_GET['eventid'], ':remarks' => $remarks));
		$pdo_cntnotnows = $pdo_cntNotNow_Res->rowCount();
												
		exit();
	}
	
	if (isset($_POST['editgoings'])) {
		$eventids = $_POST['event_ids'];
		$remarks = 'Going';
		
		DB::query('UPDATE `event_vote` SET remarks = :remarks WHERE event_id = :eventid AND alumni_id = :alumniid', array(':remarks' => $remarks, ':eventid' => $eventids, ':alumniid' => $alid));
			
		//Number of likes query
		$cntgoing =("SELECT `event_vote`.id FROM `event_vote` WHERE `event_vote`.event_id = :fid AND remarks =:remarks");
			
		$pdo_cntGoing_Res = $pdoConnect ->prepare($cntgoing);
		$pdoExec = $pdo_cntGoing2_Res -> execute(array(':fid' => $_GET['eventid'], ':remarks' => $remarks));
		$pdo_cntgoings = $pdo_cntGoing2_Res->rowCount();
												
		exit();
	}
	
	if (isset($_POST['editinteresteds'])) {
		$eventids = $_POST['event_ids'];
		$remarks = 'Interested';
		
		DB::query('UPDATE `event_vote` SET remarks = :remarks WHERE event_id = :eventid AND alumni_id = :alumniid', array(':remarks' => $remarks, ':eventid' => $eventids, ':alumniid' => $alid));
		
		//Number of likes query
		$cntinterested =("SELECT `event_vote`.id FROM `event_vote` WHERE `event_vote`.event_id = :fid AND remarks =:remarks");
			
		$pdo_cntGoing_Res = $pdoConnect ->prepare($cntinterested);
		$pdoExec = $pdo_cntInterested_Res -> execute(array(':fid' => $_GET['eventid'], ':remarks' => $remarks));
		$pdo_cntinteresteds = $pdo_cntInterested_Res->rowCount();
												
		exit();
	}
	
	if (isset($_POST['editnotnows'])) {
		$eventids = $_POST['event_ids'];
		$remarks = 'Not Now';
		
		DB::query('UPDATE `event_vote` SET remarks = :remarks WHERE event_id = :eventid AND alumni_id = :alumniid', array(':remarks' => $remarks, ':eventid' => $eventids, ':alumniid' => $alid));
		
		//Number of likes query
		$cntnotnow =("SELECT `event_vote`.id FROM `event_vote` WHERE `event_vote`.event_id = :fid AND remarks =:remarks");
			
		$pdo_cntNotNow_Res = $pdoConnect ->prepare($cntnotnow);
		$pdoExec = $pdo_cntNotNow_Res -> execute(array(':fid' => $_GET['eventid'], ':remarks' => $remarks));
		$pdo_cntnotnows = $pdo_cntNotNow_Res->rowCount();
												
		exit();
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
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Event | <?php echo $eventtitle; ?></title>
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
						<!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
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
							<a class="waves-effect waves-dark active" href="cmu-events.php" aria-expanded="false"><i class="mdi mdi-calendar-range"></i><span class="hide-menu">CMU Events</span></a>
                        </li>
						
                        <li> 
							<a class="waves-effect waves-dark" href="../career/career-bulletin.php" aria-expanded="false"><i class="mdi mdi-briefcase"></i><span class="hide-menu">Career Bulletin</span></a>
                        </li>
						
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">RESEARCH CORNER</li>
						
                        <li> 
							<a class="waves-effect waves-dark" href="../research/forum-corner.php" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Forum Corner</span></a>
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
                        <h3 class="text-themecolor"><?php echo $eventtitle; ?></h3>
						<h6><small><ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../dashboard/home.php">Home</a></li>
							<li class="breadcrumb-item"><a href="cmu-events.php">CMU Events</a></li>
                            <li class="breadcrumb-item active"><?php echo $eventtitle;?></li>
                        </ol></small></h6>
                    </div>
					
					<!-- sample modal content -->
                                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
												<h4 class="modal-title" id="myLargeModalLabel">Event Post</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
											<form class="form center-block floating-labels" method="post" enctype = "multipart/form-data" class="l-form">
												<div class="modal-body">
													<br>
													<div class="form-group form-float form-group-lg">
														<div class="form-line">
															<input type="text" name="event-title" class="form-control" required/>
															<label class="form-label">Event name</label>
														</div>
													</div>
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group form-float form-group-lg">
																<div class="form-line">
																	<input type="date" name="date" class="form-control" required/>
																	<label class="form-label">Date</label>
																</div>
															</div>
														</div>
														<div class="col-sm-6">
															<div class="form-group form-float form-group-lg">
																<div class="form-line">
																	<input type="time" name="time" class="form-control" required/>
																	<label class="form-label">Time</label>
																</div>
															</div>
														</div>
													</div>
													<div class="form-group form-float form-group-lg">
														<div class="form-line">
															<input type="text" name="event-loc" class="form-control" required/>
															<label class="form-label">Location</label>
														</div>
													</div>
													<div class="form-group">
														<div class="form-line">
															<textarea rows="1" name="event-desc" class="form-control no-resize auto-growth" required></textarea>
															<label class="form-label">Event Description</label>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type = "submit" class="btn btn-link waves-effect text-left" name="EventPost">POST</button>
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
											<div>
												<table width="100%">
													<tbody>
														<tr>
															<td>
																<h1 class="card-title"> <?php echo $eventtitle;?> </h1>
															</td>
														</tr>
														<tr>
															<td>
																<?php echo $eventloc;?>
															</td>
														</tr>
														<tr>
															<td>
																<?php echo date('F d, Y', strtotime($eventdate))," ", date('h:i A', strtotime($eventtime)); ?>
															</td>
														</tr>
														<tr>
															<td>
																<br>
															</td>
														</tr>
														<tr>
															<td>
																<hr>
																<?php
																	if($eventdate < date("Y-m-d")){
																		echo "Event is already done.";
																	}
																	else if($eventdate == date("Y-m-d") ){
																		echo "<h6>Event is on going</h6>";
																		if(!DB::query('SELECT * FROM alumnitracking.event_vote WHERE event_vote.event_id=:event_id AND event_vote.alumni_id=:alumni_id', array(':event_id'=> $_GET['eventid'], ':alumni_id'=> $alid))){
																		echo "<div class='btn-group btn-group-lg' role='group'>
																				<a href='' type='button' id='",$_GET['eventid'],"' class='going btn btn-secondary'>Going</a>
																				<a href='' type='button' id='",$_GET['eventid'],"' class='interested btn btn-secondary'>Interested</a>
																				<a href='' type='button' id='",$_GET['eventid'],"' class='notnow btn btn-secondary'>Not Now</a>
																			</div>";
																		}
																		else{
																			
																			//Query remarks
																			$remak = DB::query('SELECT * FROM event_vote WHERE event_id = :eventid AND alumni_id = :alumniid', array(':eventid' => $_GET['eventid'], ':alumniid' => $alid));
																			foreach($remak as $r){
																				$remark = $r['remarks'];
																			}
																			
																			echo "<div class='btn-group btn-group-lg' role='group'>
																					<span ><button type='submit' class='btn btn-secondary' name='voteresult'><b>",$remark,"</b></button></span>
																					<span class='edit'>
																						<button id='btnGroupDrop1' type='button' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
																						</button>
																						<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>
																							<div class='dw-user-box'>
																								<h5></h5>
																							</div>
																							<a class='editgoing dropdown-item' href='' id='",$_GET['eventid'],"'>Going</a>
																							<a class='editinterested dropdown-item' href='' id='",$_GET['eventid'],"'>Interested</a>
																							<a class='editnotnow dropdown-item' href='' id='",$_GET['eventid'],"'>Not Now</a>
																						</div>
																					</span>
																				</div>";
																		}
																	}
																	else{
																		if(!DB::query('SELECT * FROM alumnitracking.event_vote WHERE event_vote.event_id=:event_id AND event_vote.alumni_id=:alumni_id', array(':event_id'=> $_GET['eventid'], ':alumni_id'=> $alid))){
																		echo "<div class='btn-group btn-group-lg' role='group'>
																				<a href='' type='button' id='",$_GET['eventid'],"' class='going btn btn-secondary'>Going</a>
																				<a href='' type='button' id='",$_GET['eventid'],"' class='interested btn btn-secondary'>Interested</a>
																				<a href='' type='button' id='",$_GET['eventid'],"' class='notnow btn btn-secondary'>Not Now</a>
																			</div>";
																		}
																		else{
																			
																			//Query remarks
																			$remak = DB::query('SELECT * FROM event_vote WHERE event_id = :eventid AND alumni_id = :alumniid', array(':eventid' => $_GET['eventid'], ':alumniid' => $alid));
																			foreach($remak as $r){
																				$remark = $r['remarks'];
																			}
																			
																			echo "<div class='btn-group btn-group-lg' role='group'>
																					<span ><button type='submit' class='btn btn-secondary' name='voteresult'><b>",$remark,"</b></button></span>
																					<span class='edit'>
																						<button id='btnGroupDrop1' type='button' class='btn btn-secondary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
																						</button>
																						<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>
																							<div class='dw-user-box'>
																								<h5></h5>
																							</div>
																							<a class='editgoing dropdown-item' href='' id='",$_GET['eventid'],"'>Going</a>
																							<a class='editinterested dropdown-item' href='' id='",$_GET['eventid'],"'>Interested</a>
																							<a class='editnotnow dropdown-item' href='' id='",$_GET['eventid'],"'>Not Now</a>
																						</div>
																					</span>
																				</div>";
																		}
																	}
																	
																?>
																<hr>
															</td>
														</tr>
														<tr>
															<td>
																<br>
															</td>
														</tr>
														<tr>
															<td>
																<?php echo $eventdesc;?>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<br><br><br>
										</div>
									</div>
								</div>	
								
								<div class='card'>
									<div class='card-body'>
										<div>
											<ul class="nav nav-tabs customtab" role="tablist">
												<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home2" role="tab"><span class="hidden-sm-up">Going</span> <span class="hidden-xs-down">Going</span></a> </li>
												<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab"><span class="hidden-sm-up">Interested</span> <span class="hidden-xs-down">Interested</span></a> </li>
												<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages2" role="tab"><span class="hidden-sm-up">Not Now</span> <span class="hidden-xs-down">Not Now</span></a> </li>
											</ul>
											<!-- Tab panes -->
											<div class="tab-content">
												<div class="tab-pane active" id="home2" role="tabpanel">
													<div class="p-20">
														<ul class="list-unstyled">
															<?php
																if($pdo_cntgoings == 0){
																	echo "There are 0 alumni confirmed to go to the event as of this moment.";
																}else{
																	$goings_alumni="";
																	foreach($goers_alumni as $fla){
																		$fl_id = $fla['AlumniID'];
																		$fl_fname = $fla['FName'];
																		$fl_mi = $fla['Mi'];
																		$fl_lname = $fla['Lname'];
																		$fl_nameext = $fla['NameExt'];
																		
																		$fl_alumni.="<li class='media'>
																							<img class='d-flex mr-3' src='../../assets/images/users/1.jpg' width='60' alt='Generic placeholder image'>
																							<div class='media-body'>
																								<h5 class='mt-0 mb-1'>". $fl_fname ." ". $fl_mi .". ". $fl_lname ." ". $fl_nameext."</h5>
																							</div>
																					</li>";
																	}
																	echo $goings_alumni;
																}
															?>
														</ul>
													</div>
												</div>
												<div class="tab-pane" id="profile2" role="tabpanel">
													<div class="p-20">
														<ul class="list-unstyled">
															<?php
																if($pdo_cntinteresteds == 0){
																	echo "There are 0 alumni is interested to go to the event as of this moment.";
																}else{
																	$interest_alumni="";
																	foreach($interesteds_alumni as $fla){
																		$fl_id = $fla['AlumniID'];
																		$fl_fname = $fla['FName'];
																		$fl_mi = $fla['Mi'];
																		$fl_lname = $fla['Lname'];
																		$fl_nameext = $fla['NameExt'];
																		
																		$interest_alumni.="<li class='media'>
																							<img class='d-flex mr-3' src='../../assets/images/users/1.jpg' width='60' alt='Generic placeholder image'>
																							<div class='media-body'>
																								<h5 class='mt-0 mb-1'>". $fl_fname ." ". $fl_mi .". ". $fl_lname ." ". $fl_nameext."</h5>
																							</div>
																					</li>";
																	}
																	echo $interest_alumni;
																}
															?>
														</ul>
													</div>
												</div>
												<div class="tab-pane" id="messages2" role="tabpanel">
													<div class="p-20">
														<ul class="list-unstyled">
															<?php
																if($pdo_cntnotnows == 0){
																	echo "There are 0 alumni who don't want to go to the event as of this moment.";
																}else{
																	$nn_alumni="";
																	foreach($notnows_alumni as $fla){
																		$fl_id = $fla['AlumniID'];
																		$fl_fname = $fla['FName'];
																		$fl_mi = $fla['Mi'];
																		$fl_lname = $fla['Lname'];
																		$fl_nameext = $fla['NameExt'];
																		
																		$nn_alumni.="<li class='media'>
																							<img class='d-flex mr-3' src='../../assets/images/users/1.jpg' width='60' alt='Generic placeholder image'>
																							<div class='media-body'>
																								<h5 class='mt-0 mb-1'>". $fl_fname ." ". $fl_mi .". ". $fl_lname ." ". $fl_nameext."</h5>
																							</div>
																					</li>";
																	}
																	echo $nn_alumni;
																}
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
                                </div>
                                <h4 class="card-title m-b-0">Info</h4>
                            </div>
                            <div class="card-body b-t collapse show">
                                <table class="table v-middle no-border">
                                    <tbody>
                                        <tr>
                                            <td><h6><small><i>No. of Goers:</i></h6></small></td>
                                            <td align="right"><h6><?php echo $pdo_cntgoings;?></h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6><small><i>No. of Interested:</i></h6></small></td>
                                            <td align="right"><h6><?php echo $pdo_cntinteresteds;?></h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6><small><i>No. of Not Now:</i></h6></small></td>
                                            <td align="right"><h6><?php echo $pdo_cntnotnows;?></h6></td>
                                        </tr><tr>
                                            <td><h6><small><i>Posted By:</i></h6></small></td>
                                            <td align="right"><h6><?php echo convert_string('decrypt', $fname), " ", convert_string('decrypt', $mi), " ", convert_string('decrypt', $lname), " ", convert_string('decrypt', $nameext) ;?></h6></td>
                                        </tr><tr>
                                            <td><h6><small><i>Date and Time Posted:</i></h6></small></td>
                                            <td align="right"><h6><?php echo date('F d, Y h:i A', strtotime($datetime));?></h6></td>
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
	
	<script>
		$(document).ready(function(){
			// when the user clicks on going
			$('.going').on('click', function(){
				var event_ids = $(this).attr('id');
					
				$.ajax({
					url: 'event.php',
					type: 'post',
					async: false,
					data: {
						'going': 1,
						'event_ids': event_ids
					},
					success: function(){
						
					}
				});
			});

			// when the user clicks on interested
			$('.interested').on('click', function(){
				var event_ids = $(this).attr('id');
				
				$.ajax({
					url: 'event.php?eventid=<?php echo $_GET['eventid']?>',
					type: 'post',
					async: false,
					data: {
						'interesteds': 1,
						'event_ids': event_ids
					},
					success: function(){
						
					}
				});
			});
			
			// when the user clicks on notnow
			$('.notnow').on('click', function(){
				var event_ids = $(this).attr('id');
				
				$.ajax({
					url: 'event.php?eventid=<?php echo $_GET['eventid']?>',
					type: 'post',
					async: false,
					data: {
						'notnows': 1,
						'event_ids': event_ids
					},
					success: function(){
						
					}
				});
			});
		});
		
		$(document).ready(function(){
			// when the user clicks on going
			$('.editgoing').on('click', function(){
				var event_ids = $(this).attr('id');
					
				$.ajax({
					url: 'event.php?eventid=<?php echo $_GET['eventid']?>',
					type: 'post',
					async: false,
					data: {
						'editgoings': 1,
						'event_ids': event_ids
					},
					success: function(){
						
					}
				});
			});

			// when the user clicks on interested
			$('.editinterested').on('click', function(){
				var event_ids = $(this).attr('id');
				
				$.ajax({
					url: 'event.php?eventid=<?php echo $_GET['eventid']?>',
					type: 'post',
					async: false,
					data: {
						'editinteresteds': 1,
						'event_ids': event_ids
					},
					success: function(){
						
					}
				});
			});
			
			// when the user clicks on notnow
			$('.editnotnow').on('click', function(){
				var event_ids = $(this).attr('id');
				
				$.ajax({
					url: 'event.php?eventid=<?php echo $_GET['eventid']?>',
					type: 'post',
					async: false,
					data: {
						'editnotnows': 1,
						'event_ids': event_ids
					},
					success: function(){
						
					}
				});
			});
		});
	</script>
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
