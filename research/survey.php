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


    if (isset($_GET['surveyid'])){
        $ids = convert_string('decrypt', $_GET['surveyid']);

        //Certain survey query
        $spost = DB::query('SELECT * FROM survey WHERE survey.`survey_id` = :surveyid', array(':surveyid' => $ids));

        foreach($spost as $s){
            $surveyid =  convert_string('encrypt', $s['survey_id']);
            $staffid = $s['admin_id'];
            $surveytitle = $s['name'];
            $datetime_post = $s['datetime_post'];
            $datetime_start = $s['datetime_start'];
            $datetime_end = $s['datetime_end'];
            $s_description = $s['description'];
        }

        //determine the author
        $staffids = DB::query('SELECT * FROM admin WHERE admin_id = :admin_id', array(':admin_id' => $staffid));

        foreach($staffids as $s){
            $id = $s['admin_id'];
            $fname = $s['fname'];
            $mi = $s['mname'];
            $lname = $s['lname'];
            $nameext = $s['nameext'];
        }

        $sur_question = DB::query('SELECT * FROM survey_questions WHERE survey_id = :id ORDER BY order_no',array(':id'=> $ids));

        $qType= DB::query("SELECT * FROM survey_question_type");

        //COUNT NO OF QUESTIONS
        $cntquestion =("SELECT survey_questions.question_id FROM survey_questions WHERE survey_questions.survey_id = :survey_id");
        $pdo_cntQuestion_Res = $pdoConnect ->prepare($cntquestion);
        $pdoExec = $pdo_cntQuestion_Res -> execute(array(':survey_id' => $ids));
        $pdo_questions = $pdo_cntQuestion_Res->rowCount();

        //COUNT NO OF ALUMNI SURVEYED
        $cntsurveyed =("SELECT DISTINCT alumni_survey_answer.alumni_id FROM alumni_survey_answer WHERE alumni_survey_answer.survey_id = :survey_id");
        $pdo_cntSurveyed_Res = $pdoConnect ->prepare($cntsurveyed);
        $pdoExec = $pdo_cntSurveyed_Res -> execute(array(':survey_id' => $ids));
        $pdo_surveyed = $pdo_cntSurveyed_Res->rowCount();
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
    <title>Alumni Survey | <?php echo $surveytitle; ?></title>
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
                                                <a href="" class="waves-effect waves-light model_img img-responsive" alt="default" data-toggle="modal" data-target="#addSurveyModal">
                                                    <i class="mdi mdi-message"></i> Create a new survey
                                                </a>
                                            </div>
                                        </li>
                                    <?php
                                        if( date('m d, Y  h:i A', strtotime($datetime_start)) > Date('m d, Y  h:i A') ){
                                            echo '<li>
                                            <div class="drop-title">
                                                <a href="#" class="waves-effect waves-light model_img img-responsive" alt="default" data-toggle="modal" data-target="#AddSurveyQuestionModal">
                                                    <i class="mdi mdi-message"></i> Add survey question
                                                </a>
                                            </div>
                                        </li>';
                                        }
                                    ?>

                                    </ul>
                                </div>
                            </li>
                        <!-- ============================================================== -->
                        <!-- End Add Poll -->
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
                        </li-->
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
                    <div class="col-md-8 col-8 align-self-center">
                        <h3 class="text-themecolor"><?php echo $surveytitle;?></h3>
                        <h6><small><ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../dashboard/home.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="alumni-survey.php">Alumni Survey Corner</a></li>
                            <li class="breadcrumb-item active"><?php echo $surveytitle;?></li>
                        </ol></small></h6>
                    </div>
                    <div class="col-md-4 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="">
                                <div class="btn-group">
                                    <a type="button" href='survey-stats.php?surveyid=<?php echo $_GET['surveyid'];?>' method='POST' class="btn btn-secondary">
                                        View Stats
                                    </a>
                                     <?php
                                            if( date('m d, Y  h:i A', strtotime($datetime_end)) > Date('m d, Y  h:i A') ){
                                    ?>
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu animated slideInUp">
                                        <?php
                                            if( date('m d, Y  h:i A', strtotime($datetime_start)) > Date('m d, Y  h:i A') ){
                                                echo '  <a type="button" id="updateSurvey" data-surveyid="'.$ids.'" class="dropdown-item waves-effect waves-light model_img img-responsive" href="" alt="default" data-toggle="modal" data-target="#EditSurveyModal">Update Survey</a>
                                                        <div class="dropdown-divider"></div>';
                                            }
                                            if( date('m d, Y  h:i A', strtotime($datetime_end)) > Date('m d, Y  h:i A') ){
                                                echo '  <a type="button" id="deleteSurvey" data-surveyid="'.$ids.'" class="dropdown-item waves-effect waves-light model_img img-responsive" href="" alt="default" data-toggle="modal" data-target="#deletepollModal">End Survey</a>
                                                        <div class="dropdown-divider"></div>';
                                            }
                                        ?>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
											<div class="p-20">

                                            <?php
                                                if( $s_description != ''){
                                                    echo '  <li class="media">
                                                                <div class="media-body">
                                                                    <h5 class="mt-0 mb-1"><b><i>'.$s_description.'</i></b></h5>
                                                                </div>
                                                            </li><br>';
                                                }
                                            ?>

                                            <?php
                                                $questionl_list='';
                                                foreach($sur_question as $sq){
                                                        $sq_quest_id = $sq['question_id'];
                                                        $sq_orderno = $sq['order_no'];
                                                        $sq_question = $sq['question'];
                                                        $sq_quest_type_id = $sq['question_type_id'];
                                                        $sq_required = $sq['q_required'];
                                                        $sq_survey_is = $sq['survey_id'];

                                                        $type = DB::query('SELECT * FROM survey_question_type WHERE id =:id', array(':id'=> $sq_quest_type_id));
                                                        foreach ($type as $k) {
                                                            $question_type = $k['type_name'];
                                                        }

                                                        if($sq_quest_type_id == 1){
                                                            $questionl_list .=' <li class="media">
                                                                                    <h3 class="card-title text-justify">'.$sq_orderno.'. &nbsp&nbsp&nbsp&nbsp</h3>
                                                                                    <div class="media-body">
                                                                                        <h4 class="mt-0 mb-1">'.$sq_question.'</h4>
                                                                                        <small><i>'.$question_type.'';if($sq_required == "1"){ $questionl_list.="&nbsp&nbsp,&nbsp&nbspRequired to answer";}$questionl_list.="</i></small>";
                                                                    $questionl_list .=' <hr>
                                                                                        <div class="">
                                                                                            <table><tbody>
                                                                                                <tr>
                                                                                                    <h5>
                                                                                                        <td><i class="mdi mdi-radiobox-marked"></i><td>
                                                                                                        <td>Yes<td>
                                                                                                    </h5>
                                                                                                </tr>
                                                                                            </table></tbody>
                                                                                            <table><tbody>
                                                                                                <tr>
                                                                                                    <h5>
                                                                                                        <td><i class="mdi mdi-radiobox-marked"></i><td>
                                                                                                        <td>No<td>
                                                                                                    </h5>
                                                                                                </tr>
                                                                                            </table></tbody>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>';

                                                        }
                                                        else if($sq_quest_type_id == 2){
                                                            $questionl_list .=' <li class="media">
                                                                                    <h3 class="card-title text-justify">'.$sq_orderno.'. &nbsp&nbsp&nbsp&nbsp</h3>
                                                                                    <div class="media-body">
                                                                                        <h4 class="mt-0 mb-1">'.$sq_question.'</h4>
                                                                                        <small><i>'.$question_type.'';if($sq_required == "1"){ $questionl_list.="&nbsp&nbsp,&nbsp&nbspRequired to answer";}$questionl_list.="</i></small>";
                                                                    $questionl_list .=' <hr>
                                                                                    </div>
                                                                                </li>';

                                                        }
                                                        else if($sq_quest_type_id == 3){
                                                            $questionl_list .=' <li class="media">
                                                                                    <h3 class="card-title text-justify">'.$sq_orderno.'. &nbsp&nbsp&nbsp&nbsp</h3>
                                                                                    <div class="media-body">
                                                                                        <h4 class="mt-0 mb-1">'.$sq_question.'</h4>
                                                                                        <small><i>'.$question_type.'';if($sq_required == "1"){ $questionl_list.="&nbsp&nbsp,&nbsp&nbspRequired to answer";}$questionl_list.="</i></small>";
                                                                    $questionl_list .=' <hr>
                                                                                        <hr>
                                                                                        <div class="">';
                                                                                            $sq_choices = DB::query('SELECT * FROM survey_question_choices WHERE question_id  = :id',array(':id'=> $sq_quest_id));
                                                                                            foreach($sq_choices as $sqc){
                                                                                                $sqc_id = $sqc['id'];
                                                                                                $sqc_anschoice = $sqc['answer_choices'];
                                                                                                $sqc_questid = $sqc['question_id'];

                                                                            $questionl_list .=' <table><tbody>
                                                                                                <tr>
                                                                                                    <h5>
                                                                                                        <td><i class="mdi mdi-radiobox-marked"></i><td>
                                                                                                        <td>'.$sqc_anschoice.'<td>
                                                                                                    </h5>
                                                                                                </tr>
                                                                                            </table></tbody>';
                                                                                            }
                                                                    $questionl_list .='</div>
                                                                                    </div>
                                                                                </li>';

                                                        }
                                                        else if($sq_quest_type_id == 4){
                                                            $questionl_list .=' <li class="media">
                                                                                    <h3 class="card-title text-justify">'.$sq_orderno.'. &nbsp&nbsp&nbsp&nbsp</h3>
                                                                                    <div class="media-body">
                                                                                        <h4 class="mt-0 mb-1">'.$sq_question.'</h4>
                                                                                        <small><i>'.$question_type.'';if($sq_required == "1"){ $questionl_list.="&nbsp&nbsp,&nbsp&nbspRequired to answer";}$questionl_list.="</i></small>";
                                                                    $questionl_list .=' <hr>
                                                                                        <hr>
                                                                                        <div class="">';
                                                                                            $sq_choices = DB::query('SELECT * FROM survey_question_choices WHERE question_id  = :id',array(':id'=> $sq_quest_id));
                                                                                            foreach($sq_choices as $sqc){
                                                                                                $sqc_id = $sqc['id'];
                                                                                                $sqc_anschoice = $sqc['answer_choices'];
                                                                                                $sqc_questid = $sqc['question_id'];

                                                                            $questionl_list .=' <table><tbody>
                                                                                                <tr>
                                                                                                    <h5>
                                                                                                        <td><i class="mdi mdi-checkbox-marked-circle"></i><td>
                                                                                                        <td>'.$sqc_anschoice.'<td>
                                                                                                    </h5>
                                                                                                </tr>
                                                                                            </table></tbody>';
                                                                                            }
                                                                    $questionl_list .='</div>
                                                                                    </div>
                                                                                </li>';

                                                        }
                                                        else if($sq_quest_type_id == 5){
                                                            $questionl_list .=' <li class="media">
                                                                                    <h3 class="card-title text-justify">'.$sq_orderno.'. &nbsp&nbsp&nbsp&nbsp</h3>
                                                                                    <div class="media-body">
                                                                                        <h4 class="mt-0 mb-1">'.$sq_question.'</h4>
                                                                                        <small><i>'.$question_type.'';if($sq_required == "1"){ $questionl_list.="&nbsp&nbsp,&nbsp&nbspRequired to answer";}$questionl_list.="</i></small>";
                                                                    $questionl_list .=' <hr>
                                                                                        <hr>
                                                                                        <div class="">';
                                                                                            $sq_choices = DB::query('SELECT * FROM survey_question_choices WHERE question_id  = :id',array(':id'=> $sq_quest_id));
                                                                                            foreach($sq_choices as $sqc){
                                                                                                $sqc_id = $sqc['id'];
                                                                                                $sqc_anschoice = $sqc['answer_choices'];
                                                                                                $sqc_questid = $sqc['question_id'];

                                                                            $questionl_list .=' <table><tbody>
                                                                                                <tr>
                                                                                                    <h5>
                                                                                                        <td><i class="mdi mdi-radiobox-marked"></i><td>
                                                                                                        <td>'.$sqc_anschoice.'<td>
                                                                                                    </h5>
                                                                                                </tr>
                                                                                            </table></tbody>';
                                                                                            }
                                                                    $questionl_list .='</div>
                                                                                    </div>
                                                                                </li>';

                                                        }
                                                        else if($sq_quest_type_id == 6){
                                                            $questionl_list .=' <li class="media">
                                                                                    <h3 class="card-title text-justify">'.$sq_orderno.'. &nbsp&nbsp&nbsp&nbsp</h3>
                                                                                    <div class="media-body">
                                                                                        <h4 class="mt-0 mb-1">'.$sq_question.'</h4>
                                                                                        <small><i>'.$question_type.'';if($sq_required == "1"){ $questionl_list.="&nbsp&nbsp,&nbsp&nbspRequired to answer";}$questionl_list.="</i></small>";
                                                                    $questionl_list .=' <hr>
                                                                                        <hr>
                                                                                        <div class="">';
                                                                                            $sq_choices = DB::query('SELECT * FROM survey_question_choices WHERE question_id  = :id',array(':id'=> $sq_quest_id));
                                                                                            foreach($sq_choices as $sqc){
                                                                                                $sqc_id = $sqc['id'];
                                                                                                $sqc_anschoice = $sqc['answer_choices'];
                                                                                                $sqc_questid = $sqc['question_id'];

                                                                            $questionl_list .=' <table><tbody>
                                                                                                <tr>
                                                                                                    <h5>
                                                                                                        <td><i class="mdi mdi-checkbox-marked-circle"></i><td>
                                                                                                        <td>'.$sqc_anschoice.'<td>
                                                                                                    </h5>
                                                                                                </tr>
                                                                                            </table></tbody>';
                                                                                            }
                                                                    $questionl_list .='</div>
                                                                                    </div>
                                                                                </li>';
                                                        }

                                                    }
                                                print($questionl_list) ;
                                            ?>
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

    <!-- _____________________________________________________________________________________________________________________________________________ -->
    <!-- _____________________________________________________________________________________________________________________________________________ -->
    <!-- _____________________________________________________________________________________________________________________________________________ -->
    <!-- _____________________________________________________________________________________________________________________________________________ -->

    <!-- sample modal content -->
    <div class="modal fade bs-example-modal-lg" id="addSurveyModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="form center-block form-material" id="AddSurveyForm" method="post" enctype = "multipart/form-data" class="l-form">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Add Survey Form</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <?php //include('php/post-forum-php.php');?>
                    </div>
                    <div class="modal-body">
                        <br>
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <label class="form-label">Survey title <span class="danger">*</span></label>
                                <input type="text" id="surveytitle" name="surveytitle" class="form-control"/>
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
                                            <input type="date" id="ssdate" name="ssdate" class="form-control datetime"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float form-group-lg col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-group form-float form-group-lg">
                                        <div class="form-line">
                                            <label class="form-label">Survey time start <span class="danger">*</span></label>
                                            <input type="time" id="sstime" name="sstime" class="form-control datetime"/>
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
                                            <input type="date" id="sedate" name="sedate" class="form-control datetime"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float form-group-lg col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-group form-float form-group-lg">
                                        <div class="form-line">
                                            <label class="form-label">Survey time end <span class="danger">*</span></label>
                                            <input type="time" id="setime" name="setime" class="form-control datetime"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-float form-group-lg">
                            <div class="form-line">
                                <label class="form-label">Survey description <span class="danger">*</span></label>
                                <textarea rows="5" name="description" id="description" class="form-control no-resize auto-growth"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="adminid" name="adminid" value="<?php echo $user_id;?>" class="form-control"/>
                        <input type="hidden" id="operation" name="operation" value="Add Survey" class="form-control"/>
                        <button type = "submit" class="btn btn-outline-primary waves-effect text-left" id="submit" onclick="submitForm()">SAVE</button>
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- sample modal content -->
    <div class="modal fade bs-example-modal-lg" id="EditSurveyModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="form center-block form-material" id="EditSurveyForm" method="post" enctype = "multipart/form-data" class="l-form">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Edit Survey Form</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <?php //include('php/post-forum-php.php');?>
                    </div>
                    <div class="modal-body">
                        <br>
                        <div class="form-group form-group-lg">
                            <div class="form-line">
                                <label class="form-label">Survey title <span class="danger">*</span></label>
                                <input type="text" id="edSurveytitle" name="surveytitle" class="form-control"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-line col-sm-12">
                                <br>
                            </div>
                            <div class="form-group form-group-lg col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-group form-float form-group-lg">
                                        <div class="form-line">
                                            <label class="form-label">Survey date start <span class="danger">*</span></label>
                                            <input type="date" id="edSsdate" name="ssdate" class="form-control datetime"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-lg col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-group form-float form-group-lg">
                                        <div class="form-line">
                                            <label class="form-label">Survey time start <span class="danger">*</span></label>
                                            <input type="time" id="edSstime" name="sstime" class="form-control datetime"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-line col-sm-12">
                                <br>
                            </div>
                            <div class="form-group form-group-lg col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-group form-group-lg">
                                        <div class="form-line">
                                            <label class="form-label">Survey date end <span class="danger">*</span></label>
                                            <input type="date" id="edSedate" name="sedate" class="form-control datetime"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-lg col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-group form-float form-group-lg">
                                        <div class="form-line">
                                            <label class="form-label">Survey time end <span class="danger">*</span></label>
                                            <input type="time" id="edSetime" name="setime" class="form-control datetime"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-lg">
                            <div class="form-line">
                                <label class="form-label">Survey description</label>
                                <textarea rows="5" name="description" id="edDescription" class="form-control no-resize auto-growth"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="edalumniid1" name="adminid" value="<?php echo $user_id;?>" class="form-control"/>
                        <input type="hidden" id="edsurveyid1" name="surveyid" class="form-control"/>
                        <input type="hidden" id="operation" name="operation" value="Update Survey" class="form-control"/>
                        <button type = "submit" class="btn btn-outline-primary waves-effect text-left" id="submit" onclick="submitForm2()">SAVE</button>
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- _____________________________________________________________________________________________________________________________________________ -->
    <!-- _____________________________________________________________________________________________________________________________________________ -->
    <!-- _____________________________________________________________________________________________________________________________________________ -->
    <!-- _____________________________________________________________________________________________________________________________________________ -->

    <!-- sample modal content -->
    <div id="AddSurveyQuestionModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Add New Survey Question Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form center-block form-material" name="addSurveyQuestionForm" id="addSurveyQuestionForm" method="post" enctype = "multipart/form-data" class="l-form">
                    <div class="modal-body">
                        <br>
                        <div class="form-group col-sm-12">
                            <div class="form-line ">
                                <label class="form-label">Survey Question <span class="danger">*</span></label>
                                <textarea rows="1" id="surveyQuestion" name="surveyQuestion" style="width:100%;"  class="form-control no-resize auto-growth"></textarea>
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
                                                <select class="form-control" id="questionNo" name="questionNo">
                                                    <option value="">Select question number</option>
                                                    <option value = "01">1</option>
                                                    <option value = "02">2</option>
                                                    <option value = "03">3</option>
                                                    <option value = "04">4</option>
                                                    <option value = "05">5</option>
                                                    <option value = "06">6</option>
                                                    <option value = "07">7</option>
                                                    <option value = "08">8</option>
                                                    <option value = "09">9</option>
                                                    <?php
                                                        for ($y = 10; $y < 99 + 1; $y++){
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
                                                <select class="form-control" id="questionType" name="questionType">
                                                    <option value="">Select question type</option>
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
                                <input type="checkbox" id="requireA" name="requireA" value="1"/>
                                <label for="requireA">Require users to answer this question? <span class="danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="survey-id" id="surveyid" value="<?php echo $ids;?>">
                        <input type="hidden" name="survey-name" id="surveyname" value="<?php echo $surveytitle;?>">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"/>
                        <input type="hidden" name="operation" id="operation" value="Add Survey Question"/>
                        <button type = "submit" class="btn btn-outline-primary waves-effect text-left" id="submitAddSQ" name="submit"  onclick="submitForm3()">POST</button>
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- sample modal content -->
    <div id="EditSurveyQuestionModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Update Survey Question Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form center-block form-material" name="addSurveyQuestionForm" id="addSurveyQuestionForm" method="post" enctype = "multipart/form-data" class="l-form">
                    <div class="modal-body">
                        <br>
                        <div class="form-group col-sm-12">
                            <div class="form-line ">
                                <label class="form-label">Survey Question <span class="danger">*</span></label>
                                <textarea rows="1" id="surveyQuestion" name="surveyQuestion" style="width:100%;"  class="form-control no-resize auto-growth"></textarea>
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
                                                <select class="form-control" id="edquestionNo" name="edquestionNo">
                                                    <option value="">Select question number</option>
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
                                                <select class="form-control" id="edquestionType" name="edquestionType">
                                                    <option value="">Select question type</option>
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
                                <input type="checkbox" id="edrequireA" name="edrequireA" value="1"/>
                                <label for="requireA">Require users to answer this question? <span class="danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="survey-id" id="edsurveyid" value="<?php echo $ids;?>">
                        <input type="hidden" name="survey-name" id="edsurveyname" value="<?php echo $surveytitle;?>">
                        <input type="hidden" name="user_id" id="eduser_id" value="<?php echo $user_id;?>"/>
                        <input type="hidden" name="question_id" id="edquestion_id" value=""/>
                        <input type="hidden" name="operation" id="operation" value="Edit Survey Question"/>
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

        $(document).on('click', '.btn_removes', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

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

        $("#edquestionType").change(function() {
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
        $("#edquestionType").trigger("change");

    </script>








	<!--Dynamically add POLL CHOICES-->
     <script>
     /*$(document).on('submit', '#addSurveyQuestionForm', function(event){
                event.preventDefault();
                var base_url = window.location.origin;
                if($('#surveyQuestion').val() == "")
                {
                    alert("Survey question is required");
                }
                else if($('#questionNo').val() == '')
                {
                    alert("Question number is required");
                }
                else if($('#questionType').val() == '')
                {
                    alert("Question type is required");
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
                            $('#AddSurveyQuestionModal').modal('hide');
                            $('#survey_Questions').load()
                            //this.
                        }
                    });
                }
            });*/


        var surveytitle, ssdate, sstime, sedate, setime, surveyQuestion, questionNo, questionType;

        function _(x){
            return document.getElementById(x);
        }

        function submitForm3(){
                if($('#surveyQuestion').val() == "")
                {
                    alert("Survey question is required");
                }
                else if($('#questionNo').val() == '')
                {
                    alert("Question number is required");
                }
                else if($('#questionType').val() == '')
                {
                    alert("Question type is required");
                }
                else if ($('#surveyQuestion').val() != '' && $('#questionNo').val() != '' && $('#questionType').val() != '')
                {
                    _("addSurveyQuestionForm").method = "post";
                    _("addSurveyQuestionForm").action = "php/post-new-question-survey-php.php";
                    _("addSurveyQuestionForm").submit();
                    /*$.ajax({
                        url:base_url+"/alumni-e-network-4/Administrator/research/php/post-new-question-survey-php.php",
                        method:"POST",
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function(data){
                            alert(data);
                            $('#addSurveyQuestionForm')[0].reset();
                            $('#AddSurveyQuestionModal').modal('hide');
                            $('#survey_Questions').load()
                            //this.
                        }
                    });*/
                }
        }


        function submitForm(){
            if($('#surveytitle').val() == "")
            {
                alert("Survey name is required");
            }
            else if($('#ssdate').val() == '')
            {
                alert("Survey date start is required");
            }
            else if($('#sstime').val() == '')
            {
                alert("Survey time start is required");
            }
            else if($('#sedate').val() == '')
            {
                alert("Survey date ends is required");
            }
            else if($('#setime').val() == '')
            {
                alert("Survey time ends is required");
            }
            else if($('#surveytitle').val() != '' && $('#ssdate').val() != '' && $('#sstime').val() != '' && $('#sedate').val() != '' && $('#setime').val() != ''){
                _("AddSurveyForm").method = "post";
                _("AddSurveyForm").action = "php/add-survey-php.php";
                _("AddSurveyForm").submit();
                $('#AddSurveyForm')[0].reset();
                $('#addSurveyModal').modal('hide');
            }

        }

        $('#updateSurvey').click(function(){
            var base_url = window.location.origin;
            var surveyid = $(this).data("surveyid");
                    //alert (surveyid);
            $.ajax({
                url:base_url+"/alumni-e-network-4/Administrator/research/php/survey_fetch_identifier.php",
                method:"POST",
                      data:{surveyid:surveyid},
                      dataType:"json",
                success:function(data){
                    $('#edsurveyid1').val(data.survey_id);
                    $('#edSurveytitle').val(data.name);
                    $('#edSsdate').val(data.datetime_start);
                    $('#edSstime').val(data.datetime_start);
                    $('#edSedate').val(data.datetime_end);
                    $('#edSetime').val(data.datetime_end);
                    $('#edalumniid1').val(data.alumni_id);
                    $('#edDescription').val(data.description);
                },
                error:function(data)
                {
                    console.log(data);
                }
            });
        });
        function submitForm2(){
            if($('#edSurveytitle').val() == "")
            {
                alert("Survey name is required");
            }
            else if($('#edSsdate').val() == '')
            {
                alert("Survey date start is required");
            }
            else if($('#edSstime').val() == '')
            {
                alert("Survey time start is required");
            }
            else if($('#edSedate').val() == '')
            {
                alert("Survey date ends is required");
            }
            else if($('#edSetime').val() == '')
            {
                alert("Survey time ends is required");
            }
            else if($('#edSurveytitle').val() != '' && $('#edSsdate').val() != '' && $('#edSstime').val() != '' && $('#edSedate').val() != '' && $('#edSetime').val() != ''){
                _("EditSurveyForm").method = "post";
                _("EditSurveyForm").action = "php/edit-survey-php.php";
                _("EditSurveyForm").submit();
                $('#EditSurveyForm')[0].reset();
                $('#EditSurveyForm').modal('hide');
            }

        }







        $('#deleteForum').click(function(){
            var base_url = window.location.origin;
            var forumid = $(this).data("forumid");
            if(confirm("Are you sure you want to delete this?"))
            {
                $.ajax({
                    url:base_url+"/alumni-e-network-4/Alumni/account/php/delete-job-history-php.php",
                    method:"POST",
                    data:{forumid:forumid},
                    success:function(data)
                    {
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
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
