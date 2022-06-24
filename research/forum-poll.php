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
		//require'php/post-forum-php.php';
	}
	
	if (isset($_GET['postid'])){

        $ids = convert_string('decrypt', $_GET['postid']);
		
		//Certain forum query
		$fpost = DB::query('SELECT * FROM forum_poll WHERE post_id = :forum_id', array(':forum_id' => $ids));
		
		foreach($fpost as $f){
			$forumid = $f['post_id'];
			$ftitle = $f['f_title'];
			$fdesc = $f['f_desc'];
			$datetime = $f['datetime_post'];
            $staff = $f['admin_id'];
			$datetime_end = $f['datetime_end'];
            $type = $f['type'];
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
        $cntlikes2 =("SELECT `forum_react`.id FROM `forum_react` WHERE `forum_react`.post_id = :fid");
        
        $pdo_cntLikes2_Res = $pdoConnect ->prepare($cntlikes2);
        $pdoExec = $pdo_cntLikes2_Res -> execute(array(':fid' => $ids));
        $pdo_forum_likes = $pdo_cntLikes2_Res->rowCount();
        
        //SELECT forum_comment.f_comment_id FROM forum_comment WHERE forum_comment.`forum-id` = 
        
        //Number of comments query
        $cntcomments2 =("SELECT forum_comment.f_comment_id FROM forum_comment WHERE forum_comment.`post_id` = :fid");
        
        $pdo_cntcomments2_Res = $pdoConnect ->prepare($cntcomments2);
        $pdoExec = $pdo_cntcomments2_Res -> execute(array(':fid' => $ids));
        $pdo_forum_commentss = $pdo_cntcomments2_Res->rowCount();
        
        //Forum Likes Query
        $flikes = DB::query("SELECT `forum_react`.id FROM `forum_react` WHERE `forum_react`.post_id = :fid", array(':fid' => $forumid));
        
        $fl_id = "";
        $fl_fid="";
        $fl_alumniid="";
        
        //Alumni Forum Likers
        $likes_alumni = DB::query("SELECT DISTINCT alumni.alumni_id AS id, alumni.fname AS fname, alumni.mname AS mname, alumni.lname AS lname, alumni.nameext AS nameext FROM alumni , forum_poll , `forum_react` WHERE `forum_react`.post_id = :forumid AND `forum_react`.alumni_id = alumni.alumni_id", array(':forumid' => $forumid));
        
        //Forum comments query
        $fc_commentss = DB::query("SELECT alumni.alumni_id AS fc_id, alumni.fname AS fc_fname, alumni.mname AS fc_mname, alumni.lname AS fc_lname, alumni.nameext AS fc_nameext, forum_comment.f_comment_id AS fc_coid, `forum_comment`.`comment_text` AS fc_commments, `forum_comment`.`datetime` AS fc_datetime FROM  forum_poll INNER JOIN forum_comment ON forum_poll.post_id = forum_comment.`post_id` INNER JOIN alumni ON forum_comment.`alumni_id` = alumni.alumni_id WHERE  `forum_comment`.`post_id` = :fid AND `forum_comment`.`alumni_id` = alumni.alumni_id", array(':fid' => $forumid));
		

        //Number of poll votes query
        $cntvoteall =("SELECT poll_votes.id, `poll_choices`.`id`, forum_poll.`post_id` FROM poll_votes INNER JOIN `poll_choices` ON 
                       poll_votes.p_choice_id = `poll_choices`.`id` INNER JOIN forum_poll ON `poll_choices`.`post_id` = forum_poll.`post_id` WHERE `poll_choices`.`post_id` = :pollid");
        
        $pdo_cntVoteAll_Res = $pdoConnect ->prepare($cntvoteall);
        $pdoExec = $pdo_cntVoteAll_Res -> execute(array(':pollid' => $ids));
        $pdo_poll_all_likes = $pdo_cntVoteAll_Res->rowCount();
//Poll Choices
        $poll_choices = DB::query('SELECT * FROM `poll_choices` WHERE `poll_choices`.`post_id` = :pollid', array(':pollid' => $ids));
	}
	
	//Forum Edit
		
	//Forum delete
	if (isset($_GET['delete_forumid'])){
		
		DB::query('DELETE FROM atis.forum WHERE forum.forum_id = :del_fid', array(':del_fid' => $_GET['delete_forumid']));
		header("location:forum-corner.php");
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
                                                <a href="#" id="add_button" class="add_button waves-effect waves-light model_img img-responsive" alt="default" data-toggle="modal" data-target=".bs-example-modal-lg">
                                                    <i class="mdi mdi-message"></i> Add Forum
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="drop-title">
                                                <a href="#" class="waves-effect waves-light model_img img-responsive" alt="default" data-toggle="modal" data-target="#pollModal">
                                                    <i class="mdi mdi-poll-box"></i> Add Poll
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
						<a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo convert_string('decrypt', $afname), ' ', convert_string('decrypt',$amname), ' ', convert_string('decrypt',$alname), ' ', convert_string('decrypt',$aextname);?></a>
                        <div class="dropdown-menu animated flipInY">
							<a href="../accounts/profile.php" class="dropdown-item"><i class="ti-user"></i> My Profile</a> 
							
							<div class="dropdown-divider"></div> 
							<a href="../accounts/account-settings.php" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                            
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
                        
						<li> <a class="has-arrow waves-effect waves-dark active" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">Research</span></a>
                            <ul aria-expanded="false" class="collapse" style="text-indent:40px;">
                                <li><a href="../research/forum-and-poll.php">Forum and Polls</a></li>
                                <li><a href="alumni-survey.php">Alumni Survey</a></li>
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
							<li class="breadcrumb-item"><a href="forum-and-poll.php">Forum and Poll</a></li>
                            <li class="breadcrumb-item active"><?php echo $ftitle;?></li>
                        </ol></small></h6>
                    </div>
					<div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="">
								<div class="btn-group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu animated slideInUp">
                                        <?php
                                            if($type == "Forum"){
                                                echo    '<a type="button" id="updateForum" data-postid="',$forumid,'" class="dropdown-item waves-effect waves-light model_img img-responsive" href="" alt="default" data-toggle="modal" data-target="#updateforumModal">Update</a>
                                        <div class="dropdown-divider"></div>';
                                            }
                                        ?>
                                        <a type='button' id="deleteForum" data-postid="<?php echo $forumid;?>"  class="dropdown-item waves-effect waves-light model_img img-responsive deleteForum" href="" alt="default">Delete</a>
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
                                            <?php
                                                if($type == "Forum"){
                                                    echo    "<h4 class='card-title text-justify'>",$fdesc,"</h4>
                                                            <br><br><br>";
                                                }
                                                else if ($type == "Poll"){
                                                    echo    "<h4 class='card-title text-justify'>",$ftitle,"</h4>
                                                            <br>";

                                                    echo    "<div class='p-20'>
                                                                <ul class='list-unstyled'>";

                                                            $p_result="";
                                                            foreach($poll_choices as $pca){
                                                                $c_id = $pca['id'];
                                                                $p_id = $pca['post_id'];
                                                                $choices = $pca['choices'];
                                                                        
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

                                                    echo    "   </ul>
                                                            </div>";
                                                }

                                            ?>
											
											
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
                                    <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
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
                                        <?php

                                        if ($type == "Poll"){
                                            echo '  <tr>
                                                        <td><h6><small><i>Poll End:</i></h6></small></td>
                                                        <td align="right"><h6>',date('F d, Y   h:i A', strtotime($datetime_end)),'</h6></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h6><small><i>No. of overall votes:</i></h6></small></td>
                                                        <td align="right"><h6><?php echo $pdo_poll_all_likes;?></h6></td>
                                                    </tr>';
                                        }

                                        ?>
                                        <tr>
                                            <td><h6><small><i>No. of Comments:</i></h6></small></td>
                                            <td align="right"><h6><?php echo $pdo_forum_commentss;?></h6></td>
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
                                            $na_id = $na['alumni_id'];
                                            $na_fname = $na['fname'];
                                            $na_mname = $na['mname'];
                                            $na_lname = $na['lname'];
                                            $na_extname = $na['nameext'];
                                            $na_datetime = $na['datetime_ver'];
                                            
                                            $f_post .= "<div class='carousel-item flex-column'>
                                                            <div class='m-t-30 text-center'> <img src='../../assets/images/users/5.jpg' class='img-circle' width='150'>
                                                                <h4 class='card-title m-t-10'>". convert_string('decrypt',$na_fname). " ". convert_string('decrypt',$na_mname). " ". convert_string('decrypt',$na_lname) ." ". convert_string('decrypt',$na_extname)."</h4>
                                                                <h6 class='card-subtitle'>".convert_string('decrypt',$na_id)."</h6>
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

    <!-- Add Forum -->
    <div id="forumModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Forum Post</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                
                </div>
                <form class="form center-block form-material" name="addForum" id="addForumForm" method="post" enctype = "multipart/form-data" class="l-form">
                    <div class="modal-body">
                        <br>
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <label class="form-label">Forum Title</label>
                                <input type="text" name="forum-title" id="forumtitle" class="form-control" autofocus required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <label class="form-label">Forum Description</label>
                                <textarea rows="1" name="forum-desc" id="forumdesc" class="form-control no-resize auto-growth" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"/>
                        <input type="hidden" name="operation2" id="operation2" value="Add Forum"/>
                        <input type="hidden" name="type" id="type" value="Forum"/>
                        <button type = "submit" class="btn btn-outline-primary waves-effect text-left" id="submit" name="ForumPost">POST</button>
                        <button type="button" class="btn btn-outline-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <!-- sample modal content -->
    <div id="updateforumModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Update Forum Post</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                
                </div>
                <form id="forum_update_form" class="form center-block form-material" method="post" enctype = "multipart/form-data" class="l-form">
                    <div class="modal-body">
                        <br>
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <label class="form-label">Forum Title</label>
                                <input type="text" name="forum-title" id="forum_title" class="form-control" required autofocus/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <label class="form-label">Forum Description</label>
                                <textarea rows="1" name="forum-desc" id="forum_desc" class="form-control no-resize auto-growth" required autofocus></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="identifier" id="identifier" />  
                        <input type="hidden" name="adminid" id="adminid" />   
                        <button type = "submit" id="ForumUpdate" class="btn btn-outline-primary waves-effect text-left" name="ForumUpdate">Update</button>
                        <button type="button" class="btn btn-outline-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->





    <!-- Poll -->
    <div id="pollModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Poll Post</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form center-block form-material" name="addPollForm" id="addPollForm" method="post" enctype = "multipart/form-data" class="l-form">
                    <div class="modal-body">
                        <br>
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <label for="polltitle">Poll Question</label>
                                <input type="text" id="polltitle" name="poll-title" class="form-control" required/>
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
                                            <label class="form-label">Date End</label>
                                            <input type="date" id="polldate" name="date" class="form-control datetime" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float form-group-lg col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-group form-float form-group-lg">
                                        <div class="form-line">
                                            <label class="form-label">Time End</label>
                                            <input type="time" id="polltime" name="time" class="form-control datetime" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"/>
                        <input type="hidden" name="operation" id="operation" value="Add Poll"/>
                        <input type="hidden" name="type" id="type" value="Poll"/>
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
	<script type="text/javascript" language="javascript" >
	    $(document).on('submit', '#addForumForm', function(event){
            event.preventDefault();
            var base_url = window.location.origin;          
            if($('#forumtitle').val() == "")  
            {  
                alert("Forum title is required");  
            }  
            else if($('#forumdesc').val() == '')  
            {  
                alert("Description is required");  
            }  
            else if ($('#forumtitle').val() != '' && $('#forumdesc').val() != '')
            {  
                $.ajax({  
                    url:base_url+"/alumni-e-network-5/Administrator/research/php/post-forum-php.php", 
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



		$('#updateForum').click(function(){
			var base_url = window.location.origin;
			var postid = $(this).data("postid");
			//alert (forumid);
			$.ajax({
				url:base_url+"/alumni-e-network-5/administrator/research/forum/fetch_identifier.php",
				method:"POST",  
                data:{postid:postid},  
                dataType:"json",  
				success:function(data){ 
					$('#forum_title').val(data.f_title);  
                    $('#forum_desc').val(data.f_desc); 
                    $('#identifier').val(data.post_id);  
                    $('#adminid').val(data.admin_id); 
				},
				error:function(data)
				{
					console.log(data);
				}
			});
		});	
		$(document).on('submit', '#forum_update_form', function(event){
			event.preventDefault();
			var base_url = window.location.origin;			
			if($('#forum_title').val() == "")  
			{  
				alert("Forum title is required");  
			}  
			else if($('#forum_desc').val() == '')  
			{  
				alert("Description is required");  
			}  
			else if ($('#forum_title').val() != '' && $('#forum_desc').val() != '')
			{  
				$.ajax({  
					url:base_url+"/alumni-e-network-5/Administrator/research/forum/forum_update_php.php", 
					method:"POST",  
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data){ 
						alert(data);
						$('#forum_update_form')[0].reset();  
						$('#updateforumModal').modal('hide'); 
						//this.
					}  
				});  
			}
			else{
				alert("Both Fields are Required");
			}		
		});
		
		$('#deleteForum').click(function(){
			var base_url = window.location.origin;
			var postid = $(this).data("postid");
			if(confirm("Are you sure you want to delete this?"))
			{
				$.ajax({
					url:base_url+"/alumni-e-network-5/administrator/research/forum/forum_delete_php.php", 
					method:"POST",
					data:{postid:postid},
					success:function(data)
					{
						alert(data);
						window.location.assign(base_url+"/alumni-e-network-5/administrator/research/forum-and-poll.php");
					}
				});
			}
			else
			{
				return false;	
			}
		});
		</script>
	
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
