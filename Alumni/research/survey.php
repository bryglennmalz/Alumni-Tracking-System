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
        $survey = DB::query('SELECT * FROM survey WHERE survey_id = :id', array(':id'=> $_GET['surveyid']));
            foreach($survey as $s){
                $s_surveyid = $s['survey_id'];
                $s_name = $s['name'];
                $s_datetime_start = $s['datetime_start'];
                $s_datetime_end = $s['datetime_end'];
                $s_datetime_post = $s['datetime_post'];
                $s_description = $s['description'];
            }

        $sur_question = DB::query('SELECT * FROM survey_questions WHERE survey_id = :id ORDER BY order_no',array(':id'=> $_GET['surveyid']));
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
												<p class="text-muted"><?php echo $alid;?></p>
                                                <h5><?php echo $alfname, ' ', $almname, ' ', $allname, ' ', $alextname;?></h5>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="../profile/profile.php"><i class="ti-user"></i> My Profile</a></li>
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
						<!-- ============================================================== -->
                        <!-- Add Forum -->
                        <!-- ============================================================== -->
						<!--li class="nav-item dropdown">
							<div class="nav-link dropdown-toggle dropdown-toggle waves-effect waves-dark">
                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-primary model_img img-responsive" alt="default" data-toggle="modal" data-target=".bs-example-modal-lg">
									<i class="mdi mdi-message"></i> Add Poll
								</button>
                            </div>
						</li>
						<!-- ============================================================== -->
                        <!-- End Add Forum -->
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
							<a class="waves-effect waves-dark" href="../events/cmu-events.php" aria-expanded="false"><i class="mdi mdi-calendar-range"></i><span class="hide-menu">CMU Events</span></a>
                        </li>
						
                        <li> 
							<a class="waves-effect waves-dark" href="../career/career-bulletin.php" aria-expanded="false"><i class="mdi mdi-briefcase"></i><span class="hide-menu">Career Bulletin</span></a>
                        </li>
						
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">RESEARCH CORNER</li>
						
                        <li> 
							<a class="waves-effect waves-dark" href="forum-corner.php" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Forum Corner</span></a>
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
                <!-- item><a href="#" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a-->
                <!-- item--><a href="#" class="waves-effect waves-light link model_img img-responsive" alt="default" data-toggle="modal" data-target=".LogoutModal" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
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
                    <div class="col-md-8 col-8 align-self-center">
                        <h3 class="text-themecolor"><?php echo $s_name;?></h3>
                        <?php
                            if(!DB::query('SELECT * FROM alumni_survey_answer WHERE survey_id = :surveyid',array(':surveyid'=> $_GET['surveyid']))){
                                echo "<small>Question with asterisque symbol (*), marked as required to answer.</small>";
                            }
                        ?>
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
                    <div class="col-md-12 col-xlg-12">
                        <!-- Row -->
                        <div class="row">
                            <!-- Column -->
                            <div class="col-lg-12">
                                <div class='card'>
                                    <div class='card-body'>
                                        <div>
                                            <?php
                                                $survey_form = "";
                                                if(!DB::query('SELECT * FROM alumni_survey_answer WHERE survey_id = :surveyid',array(':surveyid'=> $_GET['surveyid']))){
                                    $survey_form.= " <form id='SurveyForm' class='SurveyForm form center-block floating-labels'  method='post' enctype = 'multipart/form-data' class='l-form'>";
                                                    if( $s_description != ''){
                                            $survey_form.= '<li class="media">
                                                                <div class="media-body">
                                                                    <h5 class="mt-0 mb-1"><b><i>'.$s_description.'</i></b></h5> 
                                                                </div>
                                                            </li><br>';
                                                    }

                                                
                                                    foreach($sur_question as $sq){
                                                        $sq_quest_id = $sq['question_id'];
                                                        $sq_orderno = $sq['order_no'];
                                                        $sq_question = $sq['question'];
                                                        $sq_quest_type_id = $sq['question_type_id'];
                                                        $sq_required = $sq['q_required'];
                                                        $sq_survey_is = $sq['survey_id'];

                                                        //ANSWERABLE BY YES OR NO
                                                        if($sq_quest_type_id == 1){
                                            $survey_form.=" <li class='media'>
                                                                <h4 class='card-title text-justify'>".$sq_orderno.". &nbsp&nbsp&nbsp&nbsp</h4>
                                                                <div class='media-body'>
                                                                    <h5 class='mt-0 mb-1'><strong>".$sq_question."</strong></h5>
                                                                    <h6 class='text-muted'>
                                                                        <input name='yesno".$sq_orderno."' type='radio' id='".$sq_orderno."_yes' value='Yes'"; if($sq_required == 1){ $survey_form.="required";}  $survey_form.="/>
                                                                        <label for='".$sq_orderno."_yes'>Yes</label>
                                                                    </h6>
                                                                    <h6 class='text-muted'>
                                                                        <input name='yesno".$sq_orderno."' type='radio' id='".$sq_orderno."_no' value='No'"; if($sq_required == 1){ $survey_form.="required";}  $survey_form.="/>
                                                                        <label for='".$sq_orderno."_no'>No</label>
                                                                    </h6>
                                                                    <input type='hidden' id='order[]' name='order[]' value='".$sq_orderno."' class='form-control'/>
                                                                    <input type='hidden' id='qtype".$sq_orderno."' name='qtype".$sq_orderno."' value='".$sq_quest_type_id."' class='form-control'/>
                                                                    <input type='hidden' id='qid".$sq_orderno."' name='qid".$sq_orderno."' value='".$sq_quest_id."' class='form-control'/>
                                                                </div>
                                                            </li>";

                                                        }
                                                        //OPINION
                                                        else if ($sq_quest_type_id == 2){
                                            $survey_form.=" <li class='media'>
                                                                <h4 class='card-title text-justify'>".$sq_orderno.". &nbsp&nbsp&nbsp&nbsp</h4> 
                                                                <div class='media-body'>
                                                                    <h5 class='mt-0 mb-1'><strong>".$sq_question."</strong>";if($sq_required == "1"){ $survey_form.="&nbsp&nbsp<span class='danger'>*</span>";}
                                                    $survey_form.=" </h5>
                                                                    <h6 class='text-muted'>
                                                                        <textarea class='form-control' id='ufcomment' name='opinion".$sq_orderno."' placeholder='Your answer here.' rows='3%' cols='100%' "; if($sq_required == "1"){ $survey_form.="required";}  $survey_form.=" ></textarea>
                                                                    </h6>
                                                                    <input type='hidden' id='order[]' name='order[]' value='".$sq_orderno."' class='form-control'/>
                                                                    <input type='hidden' id='qtype".$sq_orderno."' name='qtype".$sq_orderno."' value='".$sq_quest_type_id."' class='form-control'/>
                                                                    <input type='hidden' id='qid".$sq_orderno."' name='qid".$sq_orderno."' value='".$sq_quest_id."' class='form-control'/>
                                                                </div>
                                                            </li>";
                                                        }
                                                        //SELECT ONE ANSWER
                                                        else if ($sq_quest_type_id == 3){
                                            $survey_form.=" <li class='media'>
                                                                <h4 class='card-title text-justify'>".$sq_orderno.". &nbsp&nbsp&nbsp&nbsp</h4>
                                                                <div class='media-body'>
                                                                    <h5 class='mt-0 mb-1'><strong>".$sq_question."</strong>";if($sq_required == "1"){ $survey_form.="&nbsp&nbsp<span class='danger'>*</span>";}$survey_form.="</h5>";

                                                                        $sq_choices = DB::query('SELECT * FROM survey_question_choices WHERE question_id  = :id',array(':id'=> $sq_quest_id));
                                                                            $i='';
                                                                            $i = 1;
                                                                            foreach($sq_choices as $sqc){
                                                                                $sqc_id = $sqc['id'];
                                                                                $sqc_anschoice = $sqc['answer_choices'];
                                                                                $sqc_questid = $sqc['question_id'];

                                                                $survey_form.=" <h6 class='text-muted'>
                                                                                    <input name='oneans".$sq_orderno."' type='radio' id='".$sq_orderno."_".$i."' value='".$sqc_anschoice."'"; if($sq_required == "1"){ $survey_form.="required";}  $survey_form.="/>
                                                                                    <label for='".$sq_orderno."_".$i."'>".$sqc_anschoice."</label>
                                                                                </h6>";
                                                                                $i++;
                                                                            }
                                                 $survey_form.="    <input type='hidden' id='order[]' name='order[]' value='".$sq_orderno."' class='form-control'/>
                                                                    <input type='hidden' id='qtype".$sq_orderno."' name='qtype".$sq_orderno."' value='".$sq_quest_type_id."' class='form-control'/>
                                                                    <input type='hidden' id='qid".$sq_orderno."' name='qid".$sq_orderno."' value='".$sq_quest_id."' class='form-control'/>
                                                                </div>
                                                            </li>";

                                                        }
                                                        //SELECT ONE OR MORE ANSWERS
                                                        else if ($sq_quest_type_id == 4){
                                            $survey_form.=" <li class='media'>
                                                                <h4 class='card-title text-justify'>".$sq_orderno.". &nbsp&nbsp&nbsp&nbsp</h4>
                                                                <div class='media-body'>
                                                                    <h5 class='mt-0 mb-1'><strong>".$sq_question."</strong>";if($sq_required == "1"){ $survey_form.="&nbsp&nbsp<span class='danger'>*</span>";}$survey_form.="</h5>";

                                                                        $sq_choices = DB::query('SELECT * FROM survey_question_choices WHERE question_id  = :id',array(':id'=> $sq_quest_id));
                                                                            $i='';
                                                                            $i = 1;
                                                                            foreach($sq_choices as $sqc){
                                                                                $sqc_id = $sqc['id'];
                                                                                $sqc_anschoice = $sqc['answer_choices'];
                                                                                $sqc_questid = $sqc['question_id'];

                                                                $survey_form.=" <h6 class='text-muted'>
                                                                                    <input name='moreans".$sq_orderno."[]' type='checkbox' id='".$sq_orderno."_".$i."' value='".$sqc_anschoice."'"; if($sq_required == "1"){ $survey_form.="required";}  $survey_form.="/>
                                                                                    <label for='".$sq_orderno."_".$i."'>".$sqc_anschoice."</label>
                                                                                </h6>";
                                                                                $i++;
                                                                            }
                                                    $survey_form.=" <input type='hidden' id='order[]' name='order[]' value='".$sq_orderno."' class='form-control'/>
                                                                    <input type='hidden' id='qtype".$sq_orderno."' name='qtype".$sq_orderno."' value='".$sq_quest_type_id."' class='form-control' />
                                                                    <input type='hidden' id='qid".$sq_orderno."' name='qid".$sq_orderno."' value='".$sq_quest_id."' class='form-control' />
                                                                </div>
                                                            </li>";
                                                        }
                                                        else if ($sq_quest_type_id == 5){
                                            $survey_form.=" <li class='media'>
                                                                <h4 class='card-title text-justify'>".$sq_orderno.". &nbsp&nbsp&nbsp&nbsp</h4>
                                                                <div class='media-body'>
                                                                    <h5 class='mt-0 mb-1'><strong>".$sq_question."</strong>";if($sq_required == "1"){ $survey_form.="&nbsp&nbsp<span class='danger'>*</span>";}$survey_form.="</h5>";

                                                                        $sq_choices = DB::query('SELECT * FROM survey_question_choices WHERE question_id  = :id',array(':id'=> $sq_quest_id));
                                                                            $i='';
                                                                            $i = 1;
                                                                            foreach($sq_choices as $sqc){
                                                                                $sqc_id = $sqc['id'];
                                                                                $sqc_anschoice = $sqc['answer_choices'];
                                                                                $sqc_questid = $sqc['question_id'];

                                                                $survey_form.=" <h6 class='text-muted'>
                                                                                    <input name='oneinput".$sq_orderno."' type='radio' id='".$sq_orderno."_".$i."' value='".$sqc_anschoice."'"; if($sq_required == "1"){ $survey_form.="required";}  $survey_form.="/>
                                                                                    <label for='".$sq_orderno."_".$i."'>".$sqc_anschoice."</label>
                                                                                </h6>";
                                                                                $i++;
                                                                            }
                                                    $survey_form.=" <h6 class='text-muted'>
                                                                        <input name='oneinput".$sq_orderno."' type='radio' id='".$sq_orderno."_".$i."' value='1'"; if($sq_required == "1"){ $survey_form.="required";}  $survey_form.="/>
                                                                        <label for='".$sq_orderno."_".$i."' style='width:100%;'><input type='text' name='oneinputt".$sq_orderno."' class='form-control' placeholder='Other option'/></label>
                                                                    </h6>
                                                                    <input type='hidden' id='order[]' name='order[]' value='".$sq_orderno."' class='form-control'/>
                                                                    <input type='hidden' id='qtype".$sq_orderno."' name='qtype".$sq_orderno."' value='".$sq_quest_type_id."' class='form-control' />
                                                                    <input type='hidden' id='qid".$sq_orderno."' name='qid".$sq_orderno."' value='".$sq_quest_id."' class='form-control'/>
                                                                </div>
                                                            </li>";
                                                        }
                                                        else if ($sq_quest_type_id == 6){
                                            $survey_form.=" <li class='media'>
                                                                <h4 class='card-title text-justify'>".$sq_orderno.". &nbsp&nbsp&nbsp&nbsp</h4>
                                                                <div class='media-body'>
                                                                    <h5 class='mt-0 mb-1'><strong>".$sq_question."</strong>";if($sq_required == "1"){ $survey_form.="&nbsp&nbsp<span class='danger'>*</span>";}$survey_form.="</h5>";

                                                                        $sq_choices = DB::query('SELECT * FROM survey_question_choices WHERE question_id  = :id',array(':id'=> $sq_quest_id));
                                                                            $y='';
                                                                            $y = 1;
                                                                            foreach($sq_choices as $sqc){
                                                                                $sqc_id = $sqc['id'];
                                                                                $sqc_anschoice = $sqc['answer_choices'];
                                                                                $sqc_questid = $sqc['question_id'];

                                                                $survey_form.=" <h6 class='text-muted'>
                                                                                    <input name='moreinput".$sq_orderno."[]' type='checkbox' id='".$sq_orderno."_".$y."' value='".$sqc_anschoice."'"; if($sq_required == "1"){ $survey_form.="required";}  $survey_form.="/>
                                                                                    <label for='".$sq_orderno."_".$y."'>".$sqc_anschoice."</label>
                                                                                </h6>";
                                                                                $y++;
                                                                            }
                                                    $survey_form.=" <h6 class='text-muted'>
                                                                        <input name='moreinput".$sq_orderno."[]' type='checkbox' id='".$sq_orderno."_".$y."' value='1'"; if($sq_required == "1"){ $survey_form.="required";}  $survey_form.="/>
                                                                        <label for='".$sq_orderno."_".$y."' style='width:100%;'><input type='text' name='moreinputt".$sq_orderno."' class='form-control' placeholder='Other option'/></label>
                                                                    </h6>
                                                                    <input type='hidden' id='order[]' name='order[]' value='".$sq_orderno."' class='form-control'/>
                                                                    <input type='hidden' id='qtype".$sq_orderno."' name='qtype".$sq_orderno."' value='".$sq_quest_type_id."' class='form-control'/>
                                                                    <input type='hidden' id='qid".$sq_orderno."' name='qid".$sq_orderno."' value='".$sq_quest_id."' class='form-control'/>
                                                                </div>
                                                            </li>";
                                                        }
                                                        
                                                    }
                                        $survey_form.=" <hr>
                                                        <div class='col-sm-12'>
                                                            <input type='hidden' id='alumniid' name='alumniid' class='form-control' value='".$alid."'/>
                                                            <input type='hidden' id='surveyid' name='surveyid' class='form-control' value='".$s_surveyid."'/>
                                                            <input type='hidden' id='operation' name='operation' id='uoperation' value='Send Answer Survey'/>
                                                            <button type = 'submit' class='btn btn-outline-primary waves-effect text-left' id='submit' name='ForumUpdateCommentPost' onclick='submitForm3()'>Submit</button>
                                                        </div>
                                                    </form>";
                                                }

                                                else{

                                                    $survey_form.= '<li class="media">
                                                                <div class="media-body">
                                                                    <h5 class="mt-0 mb-1"><b><i>Your answers</i></b></h5> 
                                                                </div>
                                                            </li><br>';

                                                    foreach($sur_question as $sq){
                                                        $sq_quest_id = $sq['question_id'];
                                                        $sq_orderno = $sq['order_no'];
                                                        $sq_question = $sq['question'];
                                                        $sq_quest_type_id = $sq['question_type_id'];
                                                        $sq_required = $sq['q_required'];
                                                        $sq_survey_is = $sq['survey_id'];

                                                        //VIEW YES NO ANSWERS
                                                        if($sq_quest_type_id == 1){
                                            $survey_form.=" <li class='media'>
                                                                <h4 class='card-title text-justify'>".$sq_orderno.". &nbsp&nbsp&nbsp&nbsp</h4>
                                                                <div class='media-body'>
                                                                    <h5 class='mt-0 mb-1'><strong>".$sq_question."</strong></h5>
                                                                    <h6 class='text-muted'>";

                                                                        $ansyesno = DB::query('SELECT * FROM alumni_survey_answer WHERE question_id = :questionid AND  survey_id = :surveyid AND alumni_id = :alumniid', array(':questionid'=>$sq_quest_id, ':surveyid'=>$s_surveyid, ':alumniid'=>$alid));
                                                                            foreach($ansyesno as $yn){
                                                                                $yesno = $yn['answer'];
                                                                            }
                                                                            if ($yesno == "Yes"){
                                                                    $survey_form.="<h6><label for='".$sq_orderno."_yes'>".$yesno."</label></h6>";
                                                                            }
                                                                            elseif($yesno == "No"){
                                                                    $survey_form.="<h6><label for='".$sq_orderno."_yes'>".$yesno."</label></h6>";
                                                                            }
                                                                            if (!DB::query('SELECT * FROM alumni_survey_answer WHERE question_id = :questionid', array(':questionid'=>$sq_quest_id))){
                                                                    $survey_form.="<i>You skipped this question.</i>";
                                                                            }
                                                $survey_form.="</h6>
                                                                    <input type='hidden' id='order[]' name='order[]' value='".$sq_orderno."' class='form-control'/>
                                                                    <input type='hidden' id='qtype".$sq_orderno."' name='qtype".$sq_orderno."' value='".$sq_quest_type_id."' class='form-control'/>
                                                                    <input type='hidden' id='qid".$sq_orderno."' name='qid".$sq_orderno."' value='".$sq_quest_id."' class='form-control'/>
                                                                </div>
                                                            </li>";

                                                        }
                                                        //VIEW OPINIONS ANSWER
                                                        if($sq_quest_type_id == 2){
                                            $survey_form.=" <li class='media'>
                                                                <h4 class='card-title text-justify'>".$sq_orderno.". &nbsp&nbsp&nbsp&nbsp</h4>
                                                                <div class='media-body'>
                                                                    <h5 class='mt-0 mb-1'><strong>".$sq_question."</strong></h5>
                                                                    <h6 class='text-muted'>";

                                                                        $ansyesno = DB::query('SELECT * FROM alumni_survey_answer WHERE question_id = :questionid AND  survey_id = :surveyid AND alumni_id = :alumniid', array(':questionid'=>$sq_quest_id, ':surveyid'=>$s_surveyid, ':alumniid'=>$alid));
                                                                            foreach($ansyesno as $yn){
                                                                                $yesno = $yn['answer'];
                                                                            }
                                                                            if (!DB::query('SELECT * FROM alumni_survey_answer WHERE question_id = :questionid', array(':questionid'=>$sq_quest_id))){
                                                                    $survey_form.="<i>You skipped this question.</i>";
                                                                            }
                                                                            elseif($yesno != ""){
                                                                    $survey_form.="<h6><label for='".$sq_orderno."_yes'>".$yesno."</label><h6>";
                                                                            }
                                                $survey_form.="</h6>
                                                                    <input type='hidden' id='order[]' name='order[]' value='".$sq_orderno."' class='form-control'/>
                                                                    <input type='hidden' id='qtype".$sq_orderno."' name='qtype".$sq_orderno."' value='".$sq_quest_type_id."' class='form-control'/>
                                                                    <input type='hidden' id='qid".$sq_orderno."' name='qid".$sq_orderno."' value='".$sq_quest_id."' class='form-control'/>
                                                                </div>
                                                            </li>";

                                                        }
                                                        //VIEW CHOOSE ONE ANSWER
                                                        if($sq_quest_type_id == 3){
                                            $survey_form.=" <li class='media'>
                                                                <h4 class='card-title text-justify'>".$sq_orderno.". &nbsp&nbsp&nbsp&nbsp</h4>
                                                                <div class='media-body'>
                                                                    <h5 class='mt-0 mb-1'><strong>".$sq_question."</strong></h5>
                                                                    <h6 class='text-muted'>";

                                                                        $ansyesno = DB::query('SELECT * FROM alumni_survey_answer WHERE question_id = :questionid AND  survey_id = :surveyid AND alumni_id = :alumniid', array(':questionid'=>$sq_quest_id, ':surveyid'=>$s_surveyid, ':alumniid'=>$alid));
                                                                            foreach($ansyesno as $yn){
                                                                                $yesno = $yn['answer'];
                                                                            }
                                                                            if (!DB::query('SELECT * FROM alumni_survey_answer WHERE question_id = :questionid', array(':questionid'=>$sq_quest_id))){
                                                                    $survey_form.="<i>You skipped this question.</i>";
                                                                            }
                                                                            elseif($yesno != ""){
                                                                    $survey_form.="<h6><label for='".$sq_orderno."_yes'>".$yesno."</label><h6>";
                                                                            }
                                                $survey_form.="</h6>
                                                                    <input type='hidden' id='order[]' name='order[]' value='".$sq_orderno."' class='form-control'/>
                                                                    <input type='hidden' id='qtype".$sq_orderno."' name='qtype".$sq_orderno."' value='".$sq_quest_type_id."' class='form-control'/>
                                                                    <input type='hidden' id='qid".$sq_orderno."' name='qid".$sq_orderno."' value='".$sq_quest_id."' class='form-control'/>
                                                                </div>
                                                            </li>";

                                                        }
                                                        //VIEW ONE OR MORE ANSWERS
                                                        if($sq_quest_type_id == 4){
                                            $survey_form.=" <li class='media'>
                                                                <h4 class='card-title text-justify'>".$sq_orderno.". &nbsp&nbsp&nbsp&nbsp</h4>
                                                                <div class='media-body'>
                                                                    <h5 class='mt-0 mb-1'><strong>".$sq_question."</strong></h5>
                                                                    <h6 class='text-muted'>";

                                                                        $ansyesno = DB::query('SELECT * FROM alumni_survey_answer WHERE question_id = :questionid AND  survey_id = :surveyid AND alumni_id = :alumniid', array(':questionid'=>$sq_quest_id, ':surveyid'=>$s_surveyid, ':alumniid'=>$alid));
                                                                            foreach($ansyesno as $yn){
                                                                                $yesno = $yn['answer'];
                                                                                
                                                                                if (!DB::query('SELECT * FROM alumni_survey_answer WHERE question_id = :questionid', array(':questionid'=>$sq_quest_id))){
                                                                        $survey_form.="<i>You skipped this question.</i>";
                                                                                }
                                                                                elseif($yesno != ""){
                                                                        $survey_form.="<h6><label for='".$sq_orderno."_yes'>".$yesno."</label><h6>";
                                                                                }
                                                                            }
                                                $survey_form.="</h6>
                                                                    <input type='hidden' id='order[]' name='order[]' value='".$sq_orderno."' class='form-control'/>
                                                                    <input type='hidden' id='qtype".$sq_orderno."' name='qtype".$sq_orderno."' value='".$sq_quest_type_id."' class='form-control'/>
                                                                    <input type='hidden' id='qid".$sq_orderno."' name='qid".$sq_orderno."' value='".$sq_quest_id."' class='form-control'/>
                                                                </div>
                                                            </li>";

                                                        }
                                                        //VIEW CHOOSE ONE ANSWER WITH USER INPUT
                                                        if($sq_quest_type_id == 5){
                                            $survey_form.=" <li class='media'>
                                                                <h4 class='card-title text-justify'>".$sq_orderno.". &nbsp&nbsp&nbsp&nbsp</h4>
                                                                <div class='media-body'>
                                                                    <h5 class='mt-0 mb-1'><strong>".$sq_question."</strong></h5>
                                                                    <h6 class='text-muted'>";

                                                                        $ansyesno = DB::query('SELECT * FROM alumni_survey_answer WHERE question_id = :questionid AND  survey_id = :surveyid AND alumni_id = :alumniid', array(':questionid'=>$sq_quest_id, ':surveyid'=>$s_surveyid, ':alumniid'=>$alid));
                                                                            foreach($ansyesno as $yn){
                                                                                $yesno = $yn['answer'];
                                                                            }
                                                                            if (!DB::query('SELECT * FROM alumni_survey_answer WHERE question_id = :questionid', array(':questionid'=>$sq_quest_id))){
                                                                    $survey_form.="<i>You skipped this question.</i>";
                                                                            }
                                                                            elseif($yesno != ""){
                                                                    $survey_form.="<h6><label for='".$sq_orderno."_yes'>".$yesno."</label><h6>";
                                                                            }
                                                $survey_form.="</h6>
                                                                    <input type='hidden' id='order[]' name='order[]' value='".$sq_orderno."' class='form-control'/>
                                                                    <input type='hidden' id='qtype".$sq_orderno."' name='qtype".$sq_orderno."' value='".$sq_quest_type_id."' class='form-control'/>
                                                                    <input type='hidden' id='qid".$sq_orderno."' name='qid".$sq_orderno."' value='".$sq_quest_id."' class='form-control'/>
                                                                </div>
                                                            </li>";
                                                        }
                                                         //VIEW ONE OR MORE ANSWERS WITH USER INPUT
                                                        if($sq_quest_type_id == 6){
                                            $survey_form.=" <li class='media'>
                                                                <h4 class='card-title text-justify'>".$sq_orderno.". &nbsp&nbsp&nbsp&nbsp</h4>
                                                                <div class='media-body'>
                                                                    <h5 class='mt-0 mb-1'><strong>".$sq_question."</strong></h5>
                                                                    <h6 class='text-muted'>";

                                                                        $ansyesno = DB::query('SELECT * FROM alumni_survey_answer WHERE question_id = :questionid AND  survey_id = :surveyid AND alumni_id = :alumniid', array(':questionid'=>$sq_quest_id, ':surveyid'=>$s_surveyid, ':alumniid'=>$alid));
                                                                            foreach($ansyesno as $yn){
                                                                                $yesno = $yn['answer'];
                                                                                
                                                                                if (!DB::query('SELECT * FROM alumni_survey_answer WHERE question_id = :questionid', array(':questionid'=>$sq_quest_id))){
                                                                        $survey_form.="<i>You skipped this question.</i>";
                                                                                }
                                                                                elseif($yesno != ""){
                                                                        $survey_form.="<h6><label for='".$sq_orderno."_yes'>".$yesno."</label><h6>";
                                                                                }
                                                                            }
                                                $survey_form.="</h6>
                                                                    <input type='hidden' id='order[]' name='order[]' value='".$sq_orderno."' class='form-control'/>
                                                                    <input type='hidden' id='qtype".$sq_orderno."' name='qtype".$sq_orderno."' value='".$sq_quest_type_id."' class='form-control'/>
                                                                    <input type='hidden' id='qid".$sq_orderno."' name='qid".$sq_orderno."' value='".$sq_quest_id."' class='form-control'/>
                                                                </div>
                                                            </li>";

                                                        }


                                                    }
                                                }
                                            ?>
                                            
                                                <?php
                                                    
                                                    
                                                    echo $survey_form;
                                                ?>
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

    <script type="text/javascript">
        function _(x){
            return document.getElementById(x);
        }

        function submitForm3(){  
                    _("SurveyForm").method = "post";
                    _("SurveyForm").action = "php/send-survey-php.php";
                    _("SurveyForm").submit();
        }
    </script>
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
