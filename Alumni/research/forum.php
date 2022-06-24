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
		require 'php/forum-query-php.php';
		require'php/post-forum-php.php';
		require'php/post-comment-forum-php.php';
	}
		
	if (isset($_GET['forumid'])){
		
		//Certain forum query
		$fpost = DB::query('SELECT * FROM forum WHERE forum.forum_id = :forumid', array(':forumid' => $_GET['forumid']));
		
		foreach($fpost as $f){
			$forumid = $f['forum_id'];
			$ftitle = $f['f_title'];
			$fdesc = $f['f_desc'];
			$datetime = $f['datetime'];
			$staff = $f['admin_id'];
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
		$cntlikes2 =("SELECT `forum_react`.id FROM alumnitracking.`forum_react` WHERE `forum_react`.forum_id = :fid");
		
		$pdo_cntLikes2_Res = $pdoConnect ->prepare($cntlikes2);
		$pdoExec = $pdo_cntLikes2_Res -> execute(array(':fid' => $_GET['forumid']));
		$pdo_forum_likes = $pdo_cntLikes2_Res->rowCount();
		
		//SELECT forum_comment.f_comment_id FROM forum_comment WHERE forum_comment.`forum-id` = 
		
		//Number of comments query
		$cntcomments2 =("SELECT forum_comment.f_comment_id FROM forum_comment WHERE forum_comment.`forum_id` = :fid");
		
		$pdo_cntcomments2_Res = $pdoConnect ->prepare($cntcomments2);
		$pdoExec = $pdo_cntcomments2_Res -> execute(array(':fid' => $_GET['forumid']));
		$pdo_forum_commentss = $pdo_cntcomments2_Res->rowCount();
		
		//Forum Likes Query
		$flikes = DB::query("SELECT `forum_react`.id FROM alumnitracking.`forum_react` WHERE `forum_react`.forum_id = :fid", array(':fid' => $forumid));
		
		$fl_id = "";
		$fl_fid="";
		$fl_alumniid="";
		
		//Alumni Forum Likers
		$likes_alumni = DB::query("SELECT DISTINCT alumni.alumni_id AS id, alumni.fname AS fname, alumni.mname AS mname, alumni.lname AS lname, alumni.nameext AS nameext FROM alumnitracking.alumni , alumnitracking.forum , alumnitracking.`forum_react` WHERE `forum_react`.forum_id = :forumid AND `forum_react`.alumni_id = alumni.alumni_id", array(':forumid' => $forumid));
		
		//Forum comments query
		$fc_commentss = DB::query("SELECT alumni.alumni_id AS fc_id, alumni.fname AS fc_fname, alumni.mname AS fc_mname, alumni.lname AS fc_lname, alumni.nameext AS fc_nameext, forum_comment.f_comment_id AS fc_coid, `forum_comment`.`comment_text` AS fc_commments, `forum_comment`.`datetime` AS fc_datetime FROM  forum INNER JOIN forum_comment ON forum.forum_id = forum_comment.`forum_id` INNER JOIN alumni ON forum_comment.`alumni_id` = alumni.alumni_id WHERE  `forum_comment`.`forum_id` = :fid AND `forum_comment`.`alumni_id` = alumni.alumni_id", array(':fid' => $forumid));
		
		//Forum comments reply
		
	}
	
	if (isset($_POST['liked'])) {
		$forumids = $_POST['forum_ids'];
		
		DB::query('INSERT INTO `forum_react` VALUES (\'\', :forumid, :alumniid)', array(':forumid' => $forumids, ':alumniid' => $alid));
												
		//Alumni Forum Likers
		$likes_alumni = DB::query("SELECT DISTINCT alumni.alumni_id AS id, alumni.fname AS fname, alumni.mname AS mname, alumni.lname AS lname, alumni.nameext AS nameext FROM alumnitracking.alumni , alumnitracking.forum , alumnitracking.`forum_react` WHERE `forum_react`.forum_id = :forumid AND `forum_react`.alumni_id = alumni.alumni_id", array(':forumid' => $forumids));
			
		//Number of likes query
		$cntlikes2 =("SELECT `forum_react`.id FROM alumnitracking.`forum_react` WHERE `forum_react`.forum_id = :fid");
			
		$pdo_cntLikes2_Res = $pdoConnect ->prepare($cntlikes2);
		$pdoExec = $pdo_cntLikes2_Res -> execute(array(':fid' => $_GET['forumid']));
		$pdo_forum_likes = $pdo_cntLikes2_Res->rowCount();
												
		exit();
	}
	if (isset($_POST['unliked'])) {
		$forumids = $_POST['forum_ids'];
		
		DB::query('DELETE FROM forum_react WHERE forum_id = :forumid AND alumni_id = :alumniid', array(':forumid' => $forumids, ':alumniid' => $alid));
		
		//DELETE FROM forum_react WHERE forum_id = :forumid AND user_id = :alumniid
		
		//Alumni Forum Likers
		$likes_alumni = DB::query("SELECT DISTINCT alumni.alumni_id AS id, alumni.fname AS fname, alumni.mname AS mname, alumni.lname AS lname, alumni.nameext AS nameext FROM alumnitracking.alumni , alumnitracking.forum , alumnitracking.`forum_react` WHERE `forum_react`.forum_id = :forumid AND `forum_react`.alumni_id = alumni.alumni_id", array(':forumid' => $forumids));
		
		//Number of likes query
			$cntlikes2 =("SELECT `forum_react`.id FROM alumnitracking.`forum_react` WHERE `forum_react`.forum_id = :fid");
			
			$pdo_forum_likes=0;
			$pdo_cntLikes2_Res = $pdoConnect ->prepare($cntlikes2);
			$pdoExec = $pdo_cntLikes2_Res -> execute(array(':fid' => $_GET['forumid']));
			$pdo_forum_likes = $pdo_cntLikes2_Res->rowCount();
		
		exit();
	}
	
	//Forum Edit
		
	//Forum delete
	if (isset($_GET['delete_forumid'])){
		
		//DB::query('DELETE FROM alumni.forum WHERE forum.forumid = :del_fid', array(':del_fid' => $_GET['delete_forumid']));
		//header("location:forum-corner.php");
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
    <title>Forum | <?php echo $ftitle; ?></title>
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
                        
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
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
							<a class="waves-effect waves-dark active" href="forum-corner.php" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Forum Corner</span></a>
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
                        <h3 class="text-themecolor"><?php echo $ftitle; ?></h3>
						<h6><small><ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../dashboard/home.php">Home</a></li>
							<li class="breadcrumb-item"><a href="forum-corner.php">Forum Corner</a></li>
                            <li class="breadcrumb-item active"><?php echo $ftitle;?></li>
                        </ol></small></h6>
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
								<!-- Tab panes -->
								<div class='card'>
									<div class='card-body'>
										<div>
											<h1 class="card-title"> <?php echo $ftitle;?> </h1>
											<p class="card-text"><?php echo $fdesc;?></p>
											<br><br>
										</div>
									</div>
									
									<div class='card-body'>
										<?php 
											if (!DB::query('SELECT * FROM alumnitracking.`forum_react` WHERE `forum_react`.forum_id = :forumid AND `forum_react`.alumni_id = :alumniid', array(':forumid' => $_GET['forumid'], ':alumniid'=>$alid)) ): ?>
												<!-- user has not yet liked post -->
													<div class='form-group'>
														<div class='col-md-12 row'>
															<a href='' type='button' class='like btn btn-outline-secondary waves-effect' id="<?php echo $_GET['forumid'];?>">Like</a>
														</div>
													</div>
										<?php		
											else : ?>
											 	<!-- user already likes post -->
													<div class='form-group'>
														<div class='col-md-12 row'>
															<span class='unlike'>
																<a href='' type='button' class='unlike btn btn-success waves-effect' id="<?php echo $_GET['forumid'];?>">Liked</a>
															</span>
														</div>
													</div>
										<?php endif ?>
										
										
										<form action="#" class="form-horizontal form-bordered" method="post" style="background-color:#f2f2f2;">
											<div class="form-group">
												<div class="col-md-12 row">
													<small><br></small>
													<label class="control-label text-left col-md-12"><b>Post your comment here</b></label>
												</div>
												<div class="col-md-12 row">
													<div class="col-md-11">
														<textarea class="form-control" placeholder="Comment..." name="f-comment" rows="5%" cols="100%"></textarea>
														<input type="hidden" name="user-id" class="form-control" value="<?php echo $alid;?>" required/>
														<input type="hidden" name="pforum-id" class="form-control" value="<?php echo $forumid;?>" required/>
													</div>
													<div class="col-md-1">
														<button type="submit" class="btn btn-success waves-effect"  name="ForumCommentPost">Post</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								
								<div class='card'>
									<div class='card-body'>
										<div>
											<ul class="nav nav-tabs customtab" role="tablist">
												<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home2" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Likes</span></a> </li>
												<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile2" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Comments</span></a> </li>
											</ul>
											<!-- Tab panes -->
											<div class="tab-content">
												<div class="tab-pane" id="home2" role="tabpanel">
													<div class="p-20">
														<ul class="list-unstyled">
															<?php
																if($pdo_forum_likes == 0){
																	echo "This forum has 0 likes.";
																}else{
																	$fl_alumni="";
																	foreach($likes_alumni as $fla){
																		$fl_id = $fla['id'];
																		$fl_fname = $fla['fname'];
																		$fl_mname = $fla['mname'];
																		$fl_lname = $fla['lname'];
																		$fl_nameext = $fla['nameext'];
																		
																		$fl_alumni.="<li class='media row'>
																							<img class='d-flex mr-3' src='../../assets/images/users/1.jpg' width='60' alt='Generic placeholder image'>
																							<div class='media-body'>
																								<h5 class='mt-0 mb-1'>". convert_string('decrypt', $fl_fname) ." ". convert_string('decrypt', $fl_mname) ." ". convert_string('decrypt', $fl_lname) ." ". convert_string('decrypt', $fl_nameext)."</h5>
																							</div>
																					</li>";
																	}
																	echo $fl_alumni;
																}
															?>
														</ul>
													</div>
												</div>
												<div class="tab-pane active" id="profile2" role="tabpanel">
													<div class="p-20">
														<ul class="list-unstyled">
															<?php
															
															
																if($pdo_forum_commentss == 0){
																	echo "This forum has 0 comment.";
																}else{
																	$fc_alumni="";
																	foreach($fc_commentss as $f_c){
																		$fc_id = $f_c['fc_id'];
                                                                        $fc_coid = $f_c['fc_coid'];
																		$fc_fname = $f_c['fc_fname'];
																		$fc_mname = $f_c['fc_mname'];
																		$fc_lname = $f_c['fc_lname'];
																		$fc_nameext = $f_c['fc_nameext'];
																		$fc_comment = $f_c['fc_commments'];
																		$fc_datetime = $f_c['fc_datetime'];
																	
																		$fc_alumni.="<li class='media row'>
																							<img class='d-flex mr-3' src='../../assets/images/users/1.jpg' width='60' alt='Generic placeholder image'>
																							<div class='media-body'>
																								<h5 class='mt-0 mb-1'><b>". convert_string('decrypt', $fc_fname) ." ". convert_string('decrypt', $fc_mname) ." ". convert_string('decrypt', $fc_lname) ." ". convert_string('decrypt', $fc_nameext)."</b></h5>
																								<small><h6>". date('F d, Y  h:i A', strtotime($fc_datetime)) ." <br></h6></small>
																								". $fc_comment."
																								<small>
                                                                                                    <h6><br>";
                                                                                                        if($fc_id == Login::isloggedin()){
                                                                                                            $fc_alumni.= "<table>
                                                                                                                            <tbody>
                                                                                                                                <tr>
                                                                                                                                    <!--td style='width:'><a id='reply' class='reply dropdown-item waves-effect waves-light model_img img-responsive' href='' alt='default' data-toggle='modal' data-target='#ForumCommentModal'><b>Reply</b></a></td-->
                                                                                                                                    <td><a id='updateForum_comment' data-forumcid='".$fc_coid."' class='edit-comment dropdown-item waves-effect waves-light model_img img-responsive' href='' alt='default' data-toggle='modal' data-target='#ForumUpdateCommentModal'>Edit</a></td>
                                                                                                                                    <td><a id='deleteForum_comment' data-forumcid='".$fc_coid."'  class='delete-comment dropdown-item waves-effect waves-light model_img img-responsive' href='' alt='default'>Delete</a></td>
                                                                                                                                </tr>
                                                                                                                            </tbody>
                                                                                                                        </table>";
                                                                                                        }
                                                                                                    $fc_alumni.="</h6>
                                                                                                </small>
																									<!--form action='#' class='form-horizontal form-bordered' method='post''>
																										<div class='form-group'>
																											<div class='col-md-12 row'>
																												<div class='col-md-11'>
																													<textarea class='form-control' placeholder='Reply...' name='f-reply' rows='3%' cols='100%'></textarea>
																													<input type='hidden' name='user-id' class='form-control' value='". $alid. "' required/>
																													<input type='hidden' name='pforum-id' class='form-control' value='".$forumid."' required/>
																												</div>
																												<div class='col-md-1'>
																													<button type='submit' class='btn btn-success waves-effect'  name='ForumReplyPost'>Reply</button>
																												</div>
																											</div>
																										</div>
																									</form-->
																							</div>
																					</li>";
																	}
																	echo $fc_alumni;
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
                                            <td><h6><small><i>Posted by:</i></h6></small></td>
                                            <td align="right"><h6><?php echo convert_string('decrypt', $fname), " ", convert_string('decrypt', $mi), " ", convert_string('decrypt', $lname), " ", convert_string('decrypt', $nameext) ;?></h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6><small><i>Date Posted:</i></h6></small></td>
                                            <td align="right"><h6><?php echo date('F d, Y  h:i A', strtotime($datetime));?></h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6><small><i>No. of Likes:</i></h6></small></td>
                                            <td align="right"><h6><?php echo $pdo_forum_likes;?></h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6><small><i>No. of Comments:</i></h6></small></td>
                                            <td align="right"><h6><?php echo $pdo_forum_commentss;?></h6></td>
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

    <!-- update comment content -->
    <div id="ForumUpdateCommentModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Edit Comment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                
                </div>
                <form class="form center-block floating-labels" name="ForumUpdateComentForm" id="ForumUpdateComentForm" method="post" enctype = "multipart/form-data" class="l-form">
                    <div class="modal-body">
                        <br>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea class='form-control' id='ufcomment' name='ufcomment' rows='3%' cols='100%'></textarea>
                                <label class="form-label">Comment <span class="danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type='hidden' id='uuserid' name='uuserid' class='form-control' required/>
                        <input type='hidden' id='u_forumid' name='u_forumid' class='form-control' required/>
                        <input type='hidden' id='uforumcommentid' name='uforumcommentid' class='form-control' required/>
                        <input type="hidden" id="ucoperation" name="ucoperation" id="uoperation" value="Update Comment Post"/>
                            <button type = "submit" class="btn btn-outline-primary waves-effect text-left" id="submit" name="ForumUpdateCommentPost">Update</button>
                        <button type="button" class="btn btn-outline-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- reply content -->
    <div id="ForumCommentModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Reply</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                
                </div>
                <form class="form center-block floating-labels" name="ForumComentForm" id="ForumComentForm" method="post" enctype = "multipart/form-data" class="l-form">
                    <div class="modal-body">
                        <br>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea class='form-control' name='f-reply' rows='3%' cols='100%'></textarea>
                                <label class="form-label">Reply <span class="danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type='hidden' name='user-id' class='form-control' value='". $alid. "' required/>
                        <input type='hidden' name='pforum-id' class='form-control' value='".$forumid."' required/>
                        <input type="hidden" name="uoperation" id="uoperation" value="Add Reply"/>
                            <button type = "submit" class="btn btn-outline-primary waves-effect text-left" id="submit" name="ForumReplyPost">Reply</button>
                        <button type="button" class="btn btn-outline-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- update reply content -->
    <div id="ForumCommentModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Reply</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                
                </div>
                <form class="form center-block floating-labels" name="ForumComentForm" id="ForumComentForm" method="post" enctype = "multipart/form-data" class="l-form">
                    <div class="modal-body">
                        <br>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea class='form-control' name='f-reply' rows='3%' cols='100%'></textarea>
                                <label class="form-label">Reply <span class="danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type='hidden' name='user-id' class='form-control' value='". $alid. "' required/>
                        <input type='hidden' name='pforum-id' class='form-control' value='".$forumid."' required/>
                        <input type="hidden" name="uoperation" id="uoperation" value="Add Reply"/>
                            <button type = "submit" class="btn btn-outline-primary waves-effect text-left" id="submit" name="ForumReplyPost">Reply</button>
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
	
	<script>
		$("#reply").click(function(){
		  $("p").hide();
		});

		$("#reply").click(function(){
		  $("p").show();
		});
	</script>

    <script type="text/javascript">
        $(document).on('submit', '#ForumComentForm', function(event){
            event.preventDefault();
            var base_url = window.location.origin;          
            if($('#f-reply').val() == "")  
            {  
                alert("You can't reply a blank text!");  
            }   
            else
            { 
                $.ajax({  
                    url:base_url+"/alumni-e-network-4/alumni/research/php/post-comment-forum-php.php", 
                    method:"POST",  
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){ 
                        alert(data);
                        $('#ForumComentForm')[0].reset();  
                        $('#ForumCommentModal').modal('hide'); 
                        $('#profile2').load();
                            //this.
                    }  
                });
            }       
        });  

        $('#updateForum_comment').click(function(){
            var base_url = window.location.origin;
            var forumcid = $(this).data("forumcid");
            //alert (forumid);
            $.ajax({
                url:base_url+"/alumni-e-network-4/Alumni/research/php/forum_comment_fetch_identifier.php",
                method:"POST",  
                data:{forumcid:forumcid},  
                dataType:"json",  
                success:function(data){ 
                    $('#ufcomment').val(data.comment_text);  
                    $('#uuserid').val(data.alumni_id); 
                    $('#u_forumid').val(data.forum_id);  
                    $('#uforumcommentid').val(data.f_comment_id);  
                },
                error:function(data)
                {
                    console.log(data);
                }
            });
        }); 
        $(document).on('submit', '#ForumUpdateComentForm', function(event){
            event.preventDefault();
            var base_url = window.location.origin;          
            if($('#ufcomment').val() == "")  
            {  
                alert("You can't reply a blank text!");
            } 
            else
            {  
                $.ajax({  
                    url:base_url+"/alumni-e-network-4/alumni/research/php/update-comment-forum-php.php", 
                    method:"POST",  
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){ 
                        alert(data);
                        $('#ForumUpdateComentForm')[0].reset();  
                        $('#ForumUpdateCommentModal').modal('hide'); 
                        window.location = window.location;
                                //this.
                    }  
                });
            }       
        });

        $('#deleteForum_comment').click(function(){
            var base_url = window.location.origin;
            var forumcid = $(this).data("forumcid");
            if(confirm("Are you sure you want to delete this?"))
            {
                $.ajax({
                    url:base_url+"/alumni-e-network-4/alumni/research/php/comment-forum-delete-php.php", 
                    method:"POST",
                    data:{forumcid:forumcid},
                    success:function(data)
                    {
                        window.location.assign(base_url+"/alumni-e-network-4/Alumni/survey/forum-corner.php");
                        alert(data);
                    }
                });
            }
            else
            {
                return false;   
            }
        });

    </script>
	
	<script>
		$(document).ready(function(){
			// when the user clicks on like
			$('.like').on('click', function(){
				var forum_ids = $(this).attr('id');
					
				$.ajax({
					url: 'forum.php',
					type: 'post',
					async: false,
					data: {
						'liked': 1,
						'forum_ids': forum_ids
					},
					success: function(response){
						$post.addClass('hide');
						$post.siblings().removeClass('hide');
					}
				});
			});

			// when the user clicks on unlike
			$('.unlike').on('click', function(){
				var forum_ids = $(this).attr('id');
				
				$.ajax({
					url: 'forum.php',
					type: 'post',
					async: false,
					data: {
						'unliked': 1,
						'forum_ids': forum_ids
					},
					success: function(response){
						$post.addClass('hide');
						$post.siblings().removeClass('hide');
					}
				});
			});
		});
	</script>

</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
