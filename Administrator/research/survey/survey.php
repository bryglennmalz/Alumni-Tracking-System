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
		require 'php/survey-info-query-php.php';
	}
	
	$qType= DB::query("SELECT * FROM survey_question_type");
	if (isset($_GET['surveyid'])){
        $ids = convert_string('decrypt', $_GET['surveyid']);

        //Certain survey query
        $spost = DB::query('SELECT * FROM alumnitracking.survey WHERE survey.`survey_id` = :surveyid', array(':surveyid' => $ids));

		foreach($spost as $s){
			$surveyid =  convert_string('encrypt', $s['survey_id']);
            $staffid = $s['admin_id'];
            $surveytitle = $s['name'];
            $datetime_post = $s['datetime_post'];
            $datetime_start = $s['datetime_start'];
            $datetime_end = $s['datetime_end'];
		}

        //determine the author
        $staffids = DB::query('SELECT * FROM alumnitracking.admin WHERE admin_id = :admin_id', array(':admin_id' => $staffid));
        
        foreach($staffids as $s){
            $id = $s['admin_id'];
            $fname = $s['fname'];
            $mi = $s['mname'];
            $lname = $s['lname'];
            $nameext = $s['nameext'];
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
                        </li!-->
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
												<a href="create-new-survey.php" class="waves-effect waves-light model_img img-responsive"
													<i class="mdi mdi-message"></i> Create a new survey
												</a>
											</div>
										</li>
										<li>
											<div class="drop-title">
												<a href="#" class="waves-effect waves-light model_img img-responsive" alt="default" data-toggle="modal" data-target=".bs-example-modal-lg">
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
                        <h3 class="text-themecolor"><?php echo $surveytitle;?></h3>
						<h6><small><ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../dashboard/home.php">Home</a></li>
							<li class="breadcrumb-item"><a href="forum-corner.php">Alumni Survey Corner</a></li>
                            <li class="breadcrumb-item active"><?php echo $surveytitle;?></li>
                        </ol></small></h6>
                    </div>
					
					<!-- sample modal content -->
                    <div id="surveyQuestionModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myLargeModalLabel">Add New Survey Question Form</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <form class="form center-block floating-labels" name="addSurveyQuestionForm" id="addSurveyQuestionForm" method="post" enctype = "multipart/form-data" class="l-form">
                                    <div class="modal-body">
                                    <br>
                                    <div class="form-group col-sm-12">
                                        <div class="form-line ">
                                            <label class="form-label">Survey Question <span class="danger">*</span></label>
                                            <textarea rows="1" id="surveyQuestion" name="surveyQuestion" style="width:100%;"  class="form-control no-resize auto-growth" required></textarea>
                                        </div>
                                    </div>
                                                    
                                    <div class="clearfix"><br><br></div>                
                                        
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
                                            <input type="checkbox" id="requireA" name="requireA"/>
                                            <label for="requireA">Require users to answer this question? <span class="danger">*</span></label>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="survey-id" id="surveyid" value="<?php echo $ids;?>">
                                        <input type="hidden" name="survey-name" id="surveyname" value="<?php echo $surveytitle;?>">
                                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"/>
                                        <input type="hidden" name="operation" id="operation" value="Add"/>
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
                        <div id="survey_Questions">
                            <div class="row">
                                <!-- Column -->
                                <?php
                                    //COUNT NO OF QUESTIONS
                                    $cntquestion =("SELECT survey_questions.question_id FROM alumnitracking.survey_questions WHERE survey_questions.survey_id = :survey_id");
                                    $pdo_cntQuestion_Res = $pdoConnect ->prepare($cntquestion);
                                    $pdoExec = $pdo_cntQuestion_Res -> execute(array(':survey_id' => $ids));
                                    $pdo_questions = $pdo_cntQuestion_Res->rowCount();

                                    //COUNT NO OF ALUMNI SURVEYED
                                    $cntsurveyed =("SELECT DISTINCT alumni_survey_answer.alumni_id FROM alumnitracking.alumni_survey_answer WHERE alumni_survey_answer.survey_id = :survey_id");
                                    $pdo_cntSurveyed_Res = $pdoConnect ->prepare($cntsurveyed);
                                    $pdoExec = $pdo_cntSurveyed_Res -> execute(array(':survey_id' => $ids));
                                    $pdo_surveyed = $pdo_cntSurveyed_Res->rowCount();

                                    $questionaire = DB::query("SELECT * FROM survey_questions WHERE survey_questions.survey_id = :survey_id ORDER BY order_no ASC", array(":survey_id" => $ids));
                                    $p_result="";

                                    $sur_quest ="";
                                    $sur_quest2 ="";
                                    $sur_quest3 ="";
                                    $sur_questFinal ="";

                                    
                                    foreach($questionaire as $pca){
                                        $q_id = $pca['question_id'];
                                        $q_ono = $pca['order_no'];
                                        $q_question = $pca['question'];
                                        $q_updated = $pca['updated'];
                                        $q_typeid = $pca['question_type_id'];
                                        $q_required = $pca['q_required'];
                                        $q_datetime = $pca['datetime_post'];
                                        $q_surveyid = $pca['survey_id'];

                        $sur_quest .='  <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div>
                                                        <h4 class="card-title text-justify">
                                                            <table class="table v-middle no-border"><tbody>
                                                                <tr>
                                                                    <td style="width:10%;">'. $q_ono .'</td>
                                                                    <td style="width:90%;">
                                                                        '. $q_question .'
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:10%;"></td>
                                                                    <td style="width:90%;">
                                                                        <br><hr>
                                                                        <ul class="nav nav-tabs customtab" role="tablist">
                                                                            <li class="nav-item"> 
                                                                                <a class="nav-link active" data-toggle="tab" href="#home2" role="tab">
                                                                                    <span class="hidden-sm-up"><i class="ti-home"></i></span> 
                                                                                    <span class="hidden-xs-down">Results</span>
                                                                                </a> 
                                                                            </li>
                                                                        </ul>

                                                                        <!-- Tab panes -->
                                                                        <div class="tab-content">
                                                                            <div class="tab-pane active" id="home2" role="tabpanel">
                                                                                <div class="p-20">
                                                                                    <ul class="list-unstyled">';
                                                                                        if ($q_typeid == "1"){
                                                                                $sur_quest .='<table class="table v-middle no-border">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td><h5>Yes</h5></td>
                                                                                                        <td align="right"><h5> *counts here* votes</h5></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><h5>No</h5></td>
                                                                                                        <td align="right"><h5> *counts here* votes</h5></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>';
                                                                                        }
                                                                                        elseif($q_typeid == "2"){

                                                                                            $s_ans2 = DB::query('SELECT DISTINCT * FROM alumnitracking.alumni_survey_answer WHERE question_id = :q_id', array(':q_id' => $q_id));
                                                                                            
                                                                                            foreach ($s_ans2 AS $sa2) {
                                                                                                $sa2_answer = $sa2['answer'];
                                                                                $sur_quest .='<table class="table v-middle no-border">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td><h5>'. $sa2_answer.'</h5></td>
                                                                                                        <td align="right"><h5> *counts here* votes</h5></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>';

                                                                                            }
                                                                                        }
                                                                                        elseif($q_typeid == "3"){
                                                                                            $s_ans3 = DB::query('SELECT DISTINCT * FROM alumnitracking.survey_question_choices WHERE question_id = :q_id', array(':q_id' => $q_id));
                                                                                            
                                                                                            foreach ($s_ans3 AS $sa3) {
                                                                                                $sa3_answer = $sa3['answer_choices'];
                                                                                $sur_quest .='<table class="table v-middle no-border">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td><h5>'. $sa3_answer.'</h5></td>
                                                                                                        <td align="right"><h5> *counts here* votes</h5></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>';

                                                                                            }
                                                                                        }
                                                                                        elseif($q_typeid == "4"){
                                                                                            $s_ans4 = DB::query('SELECT DISTINCT * FROM alumnitracking.survey_question_choices WHERE question_id = :q_id', array(':q_id' => $q_id));
                                                                                            
                                                                                            foreach ($s_ans4 AS $sa4) {
                                                                                                $sa4_answer = $sa4['answer_choices'];
                                                                                $sur_quest .='<table class="table v-middle no-border">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td><h5>'. $sa4_answer.'</h5></td>
                                                                                                        <td align="right"><h5> *counts here* votes</h5></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>';

                                                                                            }
                                                                                        }
                                                                                        elseif($q_typeid == "5"){
                                                                                            $s_ans3 = DB::query('SELECT DISTINCT * FROM alumnitracking.survey_question_choices WHERE question_id = :q_id', array(':q_id' => $q_id));
                                                                                            
                                                                                            foreach ($s_ans3 AS $sa5) {
                                                                                                $sa5_answer = $sa5['answer_choices'];
                                                                                $sur_quest .='<table class="table v-middle no-border">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td><h5>'. $sa5_answer.'</h5></td>
                                                                                                        <td align="right"><h5> *counts here* votes</h5></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>';

                                                                                            }
                                                                                        }
                                                                                        elseif($q_typeid == "6"){
                                                                                            $s_ans6 = DB::query('SELECT DISTINCT * FROM alumnitracking.survey_question_choices WHERE question_id = :q_id', array(':q_id' => $q_id));
                                                                                            
                                                                                            foreach ($s_ans6 AS $sa6) {
                                                                                                $sa6_answer = $sa6['answer_choices'];
                                                                                $sur_quest .='<table class="table v-middle no-border">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td><h5>'. $sa6_answer.'</h5></td>
                                                                                                        <td align="right"><h5> *counts here* votes</h5></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>';

                                                                                            }
                                                                                        }
                                                                                        elseif($q_typeid == "7"){
                                                                                            $s_ans7 = DB::query('SELECT DISTINCT * FROM alumnitracking.alumni_survey_answer WHERE question_id = :q_id', array(':q_id' => $q_id));
                                                                                            
                                                                                            foreach ($s_ans7 AS $sa7) {
                                                                                                $sa7_answer = $sa7['answer'];
                                                                                $sur_quest .='<table class="table v-middle no-border">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td><h5>'. $sa7_answer.'</h5></td>
                                                                                                        <td align="right"><h5> *counts here* votes</h5></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>';

                                                                                            }
                                                                                        }
                                                                    $sur_quest  .='</ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody></table>
                                                        </h4>
                                                        <br>'; 
                                                                    


                                    $sur_quest .=   '</div>
                                                </div>
                                            </div>
                                        </div>';
                                        //$sur_questFinal = $sur_quest.$sur_quest2.$sur_quest3;
                                    }
                                    echo $sur_quest;
                                ?>


                                <!--div class='card'>
                                    <div class='card-body'>
                                        <div>
                                            <h4 class='card-title text-justify'><?php echo $q_question;?></h4>
                                            <br>
                                                
                                            <ul class="nav nav-tabs customtab" role="tablist">
                                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home2" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Results</span></a> </li>
                                            </ul>
                                            <!-- Tab panes >
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="home2" role="tabpanel">
                                                    <div class="p-20">
                                                        <ul class="list-unstyled">
                                                            <?php
                                                                $p_result="";
                                                                foreach($poll_choices as $pca){
                                                                    $c_id = $pca['id'];
                                                                    $p_id = $pca['poll_id'];
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
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div-->
                            </div>
						</div>
                        <!-- Column -->
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
                                            <td><h6><small><i>Posted by:</i></small></h6></td>
                                            <td align="right"><h6><?php echo convert_string('decrypt', $fname), " ", convert_string('decrypt', $mi), " ", convert_string('decrypt', $lname), " ", convert_string('decrypt', $nameext) ;?></h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6><small><i>Date Posted:</i></small></h6></td>
                                            <td align="right"><h6><?php echo date('F d, Y  h:i A', strtotime($datetime_post));?></h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6><small><i>Survey Start:</i></small></h6></td>
                                            <td align="right"><h6><?php echo date('F d, Y  h:i A', strtotime($datetime_start));?></h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6><small><i>Survey End:</i></small></h6></td>
                                            <td align="right"><h6><?php echo date('F d, Y  h:i A', strtotime($datetime_end));?></h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6><small><i>No. of Questions:</i></small></h6></td>
                                            <td align="right"><h6><?php echo $pdo_questions;?></h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6><small><i>No. of Alumni Surveyed:</i></small></h6></td>
                                            <td align="right"><h6><?php echo $pdo_surveyed;?></h6></td>
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

    </script>

    <!--Dynamically ADD NEW QUESTIONNAIRE-->
    <script>  
        $(document).on('submit', '#addSurveyQuestionForm', function(event){
                event.preventDefault();
                var base_url = window.location.origin;          
                if($('#surveyQuestion').val() == "")  
                {  
                    alert("Poll question is required");  
                }  
                else if($('#questionNo').val() == '')  
                {  
                    alert("Poll Date end is required");  
                } 
                else if($('#questionType').val() == '')  
                {  
                    alert("Poll time end is required");  
                } 
                else if ($('#surveyQuestion').val() != '' && $('#questionNo').val() != '' && $('#questionType').val() != '')
                {  
                    $.ajax({  
                        url:base_url+"/alumni-e-network-4/Administrator/research/php/post-new-question-survey-php.php", 
                        method:"POST",  
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function(data){ 
                            alert(data);
                            $('#addSurveyQuestionForm')[0].reset();  
                            $('#surveyQuestionModal').modal('hide'); 
                            $('#survey_Questions').load()
                            //this.
                        }  
                    });  
                }       
            });
    </script>
	
	
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
