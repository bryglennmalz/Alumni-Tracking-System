<?php 
    ob_start();
    session_start();
    
    require '../../php/myconnection.php';
    require '../../php/home-php.php';
    require '../../php/function.php';
            
    if(!Login::isloggedin()){
        header('location: ../../index.php');
    }
    else{
        require '../../php/query-php.php';
    }
    
    if (isset($_GET['alumniid'])){
        
        //Query Alumni
        $alumni = DB::query("SELECT * FROM alumni WHERE alumni_id = :id", array(':id' => $_GET['alumniid']));
            foreach ($alumni as $a){
                $id = $a['alumni_id'];
                $fname = $a['fname'];
                $mi = $a['mname'];
                $lname = $a['lname'];
                $nameext = $a['nameext'];
                $email = $a['email'];
                $civilstatus = $a['civil_stat'];
                $employstat = $a['emp_stat'];
                $ethnicity = $a['ethnicity'];
                $nationality = $a['nationality'];
                $bday = $a['b_day'];
                $bmonth = $a['b_month'];
                $byear = $a['b_year'];
                $sex = $a['sex'];
                $cphone = $a['cel_no'];
                $telno = $a['tel_no'];
                $f_g_name = $a['fg_name'];
                $f_g_occupationn = $a['fg_occupation'];
                $mother_name = $a['m_name'];
                $m_occupation = $a['m_occupation'];
                $religion = $a['religion']; 
                $fb = $a['fb'];
                $ig = $a['ig'];
                $linkedin = $a['linkedin'];
                $twitter = $a['twitter'];
                $website = $a['website'];
                $home_other = $a['home_other'];
                $home_cm = $a['home_cm_id'];
                $home_prov = $a['home_prov_id'];
                $home_c = $a['home_c_id'];
                $home_zip = $a['home_zip'];
                $current_other = $a['current_other'];
                $current_cm = $a['current_cm_id'];
                $current_prov = $a['current_prov_id'];
                $current_c =  $a['current_c_id'];
                $hcurrent_zip = $a['current_zip'];
            }
            
            
        //Query Alumni Job History
        $alumni_jh = DB::query("SELECT * FROM job_history WHERE job_history.alumni_id = :id ORDER BY mo_end AND yr_end ASC", array(':id' => $_GET['alumniid']));
            foreach ($alumni_jh as $ajh){
                $jh_ids = $ajh['job_hist_id'];
                $companys = $ajh['company'];
                $positions = $ajh['position'];
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
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <title>Profile | CMU - Alumni Tracking And Information System</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="../../../assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../../../assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="../../../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="../../assets/plugins/css-chart/css-chart.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="../../../assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../../css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../../../css/colors/blue.css" id="theme" rel="stylesheet">
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
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../../../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="../../../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="../../../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                         <!-- Light Logo text -->    
                         <img src="../../../assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span> </a>
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
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../../assets/images/users/user.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="../../assets/images/users/user.png" alt="user"></div>
                                            <div class="u-text">
                                                <p class="text-muted"><?php echo $alid;?></p>
                                                <h5><?php echo $alfname, ' ', $almname, ' ', $allname, ' ', $alextname;?></h5>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="../profile/profile.php?alumniid=<?php echo $alid;?>"><i class="ti-user"></i> My Profile</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href=""><i class="ti-settings"></i> Account Setting</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="" alt="default" data-toggle="modal" data-target=".LogoutModal" data-toggle="tooltip" title="Logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li-->
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
                <div class="user-profile" style="background: url(../../../assets/images/background/user-info.jpg) no-repeat;">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="../../../assets/images/users/user.png" alt="user" /> </div>
                    <!-- User profile text-->
                    <div class="profile-text"> 
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo convert_string('decrypt', $alfname) , ' ', convert_string('decrypt', $almname), ' ', convert_string('decrypt', $allname), ' ', convert_string('decrypt', $alextname);?></a>
                        <div class="dropdown-menu animated flipInY"> 
                            <?php echo '<a href="../account/profile.php?alumniid='.$userid.'" class="dropdown-item"><i class="ti-user"></i> My Profile</a> ';?>
                                <div class="dropdown-divider"></div> 
                            <a class="dropdown-item has-arrow waves-effect waves-dark" aria-expanded="false"><i class="ti-settings"></i> Account Setting</a>
                            <a class="dropdown-item has-arrow waves-effect waves-dark" aria-expanded="false"><i class="ti-pencil-alt"></i> Edit Profile</a>
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
                            <a class="waves-effect waves-dark" href="../account/profile.php?alumniid=<?php echo $userid;?>"><i class="mdi mdi-gauge"></i><span class="hide-menu">Profile</span></a>
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
                            <a class="waves-effect waves-dark" href="../research/forum-corner.php" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Forum Corner</span></a>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="../research/poll-corner.php" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Poll Corner</span></a>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="../research/alumni-survey.php" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Alumni Survey</span></a>
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
                <!-- item--><a href="#" class="link" data-toggle="tooltip" title="Email"><i class="ti-user"></i></a>
                <!-- item--><a href="#" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
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
            <div class="container-fluid"><br>
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!--div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10">
                                <div class="chart-text m-r-10">
                                    <div class="drop-title"> 
                                        <?php 
                                            echo "<button href='' type='button' name='updateBI' id='".$_GET['alumniid']."' class='waves-effect btn btn-outline-secondary btn-xs updateBI'>Edit Profile</button>";
                                        ?>
                                        <a type="button" href="" name="updateBI" <?php echo "id='",$_GET['alumniid'],"'";?> class="waves-effect btn btn-outline-secondary waves-light model_img img-responsive updateBI" alt="default" data-toggle="modal" data-target="#EditPerInfoModal" data-toggle="tooltip">
                                            Edit Profile
                                        </a>
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
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="../../../assets/images/users/user.png" class="img-circle" width="150" />
                                    <h4 class="card-title m-t-10"><?php echo convert_string('decrypt', $fname), ' ', convert_string('decrypt', $mi), ' ', convert_string('decrypt', $lname), ' ', convert_string('decrypt', $nameext);?></h4>
                                    <h6 class="card-subtitle"><?php echo convert_string('decrypt', $positions), " at ", convert_string('decrypt', $companys);?></h6>
                                    <h6 class="card-subtitle"><?php echo convert_string('decrypt', $alid);?></h6>
                                    <div class="row text-center justify-content-md-center">
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> 
                            </div>
                            <div class="card-body"> 
                                <ul class="nav nav-tabs profile-tab" role="tablist">
                                    <li class="nav-item form-control"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Update email</a> </li>
                                    <li class="nav-item form-control"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Update password</a> </li>
                                    <li class="nav-item form-control"> <a id="updateProfile" data-al_id='<?php echo Login::isloggedin();?>' class="nav-link" data-toggle="tab" href="#settings" role="tab">Update Profile</a> </li>
                                    <li class="nav-item form-control"> <a class="nav-link" href="#" alt="default" data-toggle="modal" data-target=".DeactivateModal" data-toggle="tooltip">Deactivate</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class = "card">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">
                                        <h3>Update email</h3>
                                        <form class="form center-block form-material" name="updateEmail" id="updateEmail" method="post" enctype = "multipart/form-data" class="l-form">
                                            <?php include 'php/change-email.php';?>
                                            <br>
                                            <div class="form-group row">
                                                <label for="lux" class="col-sm-3 text-right control-label col-form-label">Old email: </label>
                                                <div class="col-sm-9">
                                                    <input type="email" name="oldEmail" id="oldEmail" class="form-control" autofocus required/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="lux" class="col-sm-3 text-right control-label col-form-label">New email: </label>
                                                <div class="col-sm-9">
                                                    <input type="email" name="newEmail" id="newEmail" class="form-control" autofocus required/>
                                                </div>
                                            </div>
                                            <div><hr></div>
                                            <div class="form-group row">
                                                <label for="lux" class="col-sm-3 text-right control-label col-form-label">Password: </label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="password" id="password" class="form-control" autofocus required/>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="user_id" id="user_id" value="<?php echo Login::isloggedin();?>"/>
                                                <input type="hidden" name="operation2" id="operation2" value="Update Email"/>
                                                <input type="hidden" name="type" id="type" value="Forum"/>
                                                <button type = "submit" class="btn btn-outline-primary waves-effect text-left" id="submit" name="ChangeEmail">Update</button>
                                            </div>
                                                                        
                                            <div class="clearfix"><br><br></div>
                                        </form>
                                        
                                    </div>
                                </div>
                                <!--second tab-->
                                <div class="tab-pane" id="profile" role="tabpanel">
                                    <div class="card-body">
                                        <h3>Change password</h3>
                                        <form class="form center-block form-material" name="changePassword" id="changePassword" method="post" enctype = "multipart/form-data" class="l-form">
                                            <?php include 'php/change-password-php.php';?>
                                            <br>
                                            <div class="form-group row">
                                                <label for="lux" class="col-sm-3 text-right control-label col-form-label">Current Password: </label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="oldPassword" id="oldPassword" class="form-control" autofocus required/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="lux" class="col-sm-3 text-right control-label col-form-label">New password: </label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="newPassword" id="newPassword" class="form-control" autofocus required/>
                                                </div>
                                            </div>
                                            <div><hr></div>
                                            <div class="form-group row">
                                                <label for="lux" class="col-sm-3 text-right control-label col-form-label">Re-enter new password: </label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="newPassword2" id="newPassword2" class="form-control" autofocus required/>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="user_id" id="user_id" value="<?php echo Login::isloggedin();?>"/>
                                                <input type="hidden" name="operation2" id="operation2" value="Update Email"/>
                                                <input type="hidden" name="type" id="type" value="Forum"/>
                                                <button type = "submit" class="btn btn-outline-primary waves-effect text-left" id="submit" name="ChangePassword">Update</button>
                                            </div>
                                                                        
                                            <div class="clearfix"><br><br></div>
                                        </form>
                                    </div>
                                </div>

                                <div class="tab-pane" id="settings" role="tabpanel">
                                    <div class="card-body">
                                        <h3>Update Profile</h3>
                                        <form class="form center-block form-material" name="updateProfile" id="updateProfile" method="post" enctype = "multipart/form-data" class="l-form">
                                            <section>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="alumniId">Alumni ID :</label>
                                                            <input type="tel" class="form-control" id="alumniId" name="alumniId" readonly> </div>
                                                            </div>
                                                    </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4 class="card-title">Name</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="firstName"> First Name : <span class="danger">*</span> </label>
                                                            <input type="text" class="form-control required" id="firstName" name="firstName" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="middleInitial"> Middle Initial : <span class="danger">*</span> </label>
                                                            <input type="text" class="form-control required" id="middleInitial" name="middleInitial" readonly> </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="lastName"> Last Name : <span class="danger">*</span> </label>
                                                            <input type="text" class="form-control required" id="lastName" name="lastName" readonly> </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="extName"> Extension Name :</label>
                                                            <input type="text" class="form-control" id="extName" name="extName" readonly> </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="birthday">Date of Birth : </label>
                                                            <input type="text" class="form-control required" id="birthday" name="birthday"> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sex">Sex : <span class="danger">*</span></label>
                                                            <select class="form-control" id="sex" name="sex" oninput="this.className = ''" required>
                                                                <option value="">Select Sex</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="civilStat">Civil Status : <span class="danger">*</span> </label>
                                                            <select class="form-control" id="civilStat" name="civilStat" oninput="this.className = ''" required>
                                                                <option value="">Select Civil Status</option>
                                                                <option value="Single">Single</option>
                                                                <option value="Married">Married</option>
                                                                <option value="Divorced">Divorced</option>
                                                                <option value="Widowed">Widowed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nationality">Nationality : <span class="danger">*</span> </label>
                                                            <input type="text" class="form-control" id="nationality" name="nationality" oninput="this.className = ''" required> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6"> 
                                                        <div class="form-group">
                                                            <label for="ethnicity"> Ethnicity : <span class="danger">*</span> </label>
                                                            <input type="text" class="form-control" id="ethnicity" name="ethnicity" oninput="this.className = ''" required> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="religion"> Religion : <span class="danger">*</span> </label>
                                                            <input type="text" class="form-control" id="religion" name="religion" oninput="this.className = ''" required> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="religion"> Employment Status : <span class="danger">*</span> </label>
                                                            <select class="form-control" id="empstat" name="empstat" oninput="this.className = ''" required>
                                                                <option value="">Select Employment Status</option>
                                                                <option value = "Employed">Employed</option>
                                                                <option value = "Under-employed">Under-employed</option>
                                                                <option value = "Unemployed">Unemployed</option>
                                                                <option value = "Unemployed ever since">Unemployed ever since</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4 class="card-title">Contact Information</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phoneNo">Phone Number :</label>
                                                            <input type="tel" class="form-control" id="phoneNo" name="phoneNo"> </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="telephoneNo">Telephone Number :</label>
                                                            <input type="tel" class="form-control" id="telephoneNo" name="telephoneNo"> </div>
                                                        </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="facebook"> Facebook :</label>
                                                            <input type="email" class="form-control" id="facebook" name="facebook"> </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="instagram"> Instagram :</label>
                                                            <input type="email" class="form-control" id="instagram" name="instagram"> </div>
                                                        </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="linkedin"> Linkedin :</label>
                                                            <input type="email" class="form-control" id="linkedin" name="linkedin"> </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="twitter"> Twitter :</label>
                                                            <input type="email" class="form-control" id="twitter" name="twitter"> </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="website"> Website :</label>
                                                            <input type="email" class="form-control" id="website" name="website"> </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4 class="card-title">Home Address</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                         <div class="form-group">
                                                            <label for="other"> Other : </label>
                                                            <input type="text" class="form-control" id="h_other" name="h_other" oninput="this.className = ''" > </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="cityMun"> Select Municipality/City : <span class="danger">*</span> </label>
                                                            <select class="form-control" id="h_cityMun" name="h_cityMun" oninput="this.className = ''" required>
                                                                <option value="">Select province first</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="provinceState"> Select Province : <span class="danger">*</span> </label>
                                                            <select class="form-control" id="h_province" name="h_province" oninput="this.className = ''" required>
                                                                <option value="">Select country first</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="country"> Select Country : <span class="danger">*</span> </label>
                                                            <select class="form-control" id="h_country" name="h_country" oninput="this.className = ''" required>
                                                                <option >Select country</option>
                                                                <?php
                                                                    foreach ($country as $c){
                                                                        $id = $c['c_id'];
                                                                        $cname = $c['c_name'];
                                                                        echo '<option value = "' .$id. '">' .$cname. '</option>';
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="zipCode"> Zip Code : <span class="danger">*</span> </label>
                                                            <input type="text" class="form-control" id="h_zipCode" name="h_zipCode" oninput="this.className = ''" required> </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4 class="card-title">Current Address</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="other"> Other : </label>
                                                            <input type="text" class="form-control" id="c_other" name="c_other" oninput="this.className = ''"> </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="cityMun"> Select Municipality/City : <span class="danger">*</span> </label>
                                                            <select class="form-control" id="c_cityMun" name="c_cityMun" oninput="this.className = ''" required>
                                                                <option value="">Select province first</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="provinceState"> Select Province/State : <span class="danger">*</span> </label>
                                                            <select class="form-control" id="c_province" name="c_province" oninput="this.className = ''" required>
                                                                <option value="">Select country first</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="country"> Select Country : <span class="danger">*</span> </label>
                                                            <select class="form-control" id="c_country" name="c_country" oninput="this.className = ''" required>
                                                                <option value="">Select country</option>
                                                                <?php
                                                                    foreach ($country as $c){
                                                                        $id = $c['c_id'];
                                                                        $cname = $c['c_name'];
                                                                        echo '<option value = "' .$id. '">' .$cname. '</option>';
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="zipCode"> Zip Code : <span class="danger">*</span> </label>
                                                            <input type="text" class="form-control" id="c_zipCode" name="c_zipCode" oninput="this.className = ''" required> </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4 class="card-title">Other Information</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="instagram"> Father/Guardian's Name :</label>
                                                            <input type="email" class="form-control" id="instagram" name="instagram"> </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="linkedin"> Father/Guardian's Occupation :</label>
                                                            <input type="email" class="form-control" id="linkedin" name="linkedin"> </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                     <div class="form-group">
                                                            <label for="twitter"> Mother's Name :</label>
                                                            <input type="email" class="form-control" id="twitter" name="twitter"> </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="website"> Mother's Occupation :</label>
                                                            <input type="email" class="form-control" id="website" name="website"> </div>
                                                    </div>
                                                </div>
                                            </section>
                                                                        
                                            <div class="clearfix"><br><br></div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"/>
                                                <input type="hidden" name="operation2" id="operation2" value="Update Email"/>
                                                <input type="hidden" name="type" id="type" value="Forum"/>
                                                <button type = "submit" class="btn btn-outline-primary waves-effect text-left" id="submit" name="ForumPost">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
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

    <!-- Logout Modal Content -->
    <div id="DeactivateModal" class="modal fade DeactivateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Deactivate account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form action="../../php/logout-php.php" class="form center-block" method="post" class="l-form">
                    <div class="modal-body">
                        <div class="form-group">
                            <center><h5>Do you want to deactiver your account?</h5></center>
                            <small>You can still activate your account if you login to this website again.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type = "submit" class="btn btn-primary btn-sm" name="Deactivate" value="Deactivate"></input>
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
    <script src="../../../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../../js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../../../js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../../js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../../../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="../../../js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- sparkline chart -->
    <script src="../../../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../../../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="scripts/education-scripts.js"></script>
    <script src="scripts/job-history-scripts.js"></script>
    <script src="scripts/certification-scripts.js"></script>
    <script src="scripts/honors-awards-scripts.js"></script>
    <script src="scripts/org-scripts.js"></script>
    <script src="scripts/sem-train-work-scripts.js"></script>
    
    <script>
        $(document).ready(function(){
            $('.updateProfile').on('click', function(){
                var user_id = $(this).attr('al_id');
                $.ajax({
                    url:"php/fetch_single.php",
                    method:"POST",
                    data:{user_id:user_id},
                    dataType:"json",
                    success:function(data)
                    {
                        //$('#EditPerInfoModal').modal('show');
                        
                        $('#alumniId').val(user_id);
                        $('#firstName').val(data.fname);
                        $('#middleInitial').val(data.mi);
                        $('#lastName').val(data.lname);
                        $('#extName').val(data.nameext);
                        
                        $('.modal-title').text("Edit User");
                        $('#user_id').val(user_id);
                        $('#user_uploaded_image').html(data.user_image);
                        $('#action').val("Edit");
                        $('#operation').val("Edit");
                    }
                })
            });
            
        });
    </script>
    
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
