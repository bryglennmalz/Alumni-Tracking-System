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

        //Home Address
        $alumni_ad = DB::query("SELECT alumni.home_other AS home_other, address_city_mun.cm_name AS home_city_mun, address_province.ps_name AS home_province, address_region.reg_name AS home_region, address_country.c_name AS home_country, alumni.home_zip AS home_zipcode, alumni.alumni_id as alumni_id FROM alumni INNER JOIN address_city_mun ON alumni.home_cm_id = address_city_mun.cm_id INNER JOIN address_country ON alumni.home_c_id = address_country.c_id INNER JOIN address_province ON address_province.c_id = address_country.c_id AND alumni.home_prov_id = address_province.ps_id AND address_city_mun.ps_id = address_province.ps_id INNER JOIN address_region ON address_region.c_id = address_country.c_id AND alumni.home_reg_id = address_region.reg_id AND address_province.reg_id = address_region.reg_id WHERE alumni.alumni_id = :id", array(':id' => $_GET['alumniid']));
        foreach ($alumni_ad as $aad){
            $h_address1 = $aad['home_other'];
            $h_city_mun = $aad['home_city_mun'];
            $h_prov = $aad['home_province'];
            $h_region = $aad['home_region'];
            $h_country = $aad['home_country'];
            $h_zip = $aad['home_zipcode'];
            //$coordinates = $aad['coordinates'];
        }   

        //Current Address
        $alumni_ad2 = DB::query("SELECT alumni.current_other AS current_other, address_city_mun.cm_name AS current_city_mun, address_province.ps_name AS current_province, address_region.reg_name AS current_region, address_country.c_name AS current_country, alumni.current_zip AS current_zipcode, alumni.alumni_id as alumni_id FROM alumni INNER JOIN address_city_mun ON alumni.current_cm_id = address_city_mun.cm_id INNER JOIN address_country ON alumni.current_c_id = address_country.c_id INNER JOIN address_province ON address_province.c_id = address_country.c_id AND alumni.current_prov_id = address_province.ps_id AND address_city_mun.ps_id = address_province.ps_id INNER JOIN address_region ON address_region.c_id = address_country.c_id AND alumni.current_reg_id = address_region.reg_id AND address_province.reg_id = address_region.reg_id WHERE alumni.alumni_id = :id", array(':id' => $_GET['alumniid']));
        
        foreach ($alumni_ad2 as $aad){
            $c_address1 = $aad['current_other'];
            $c_city_mun = $aad['current_city_mun'];
            $c_prov = $aad['current_province'];
            $c_region = $aad['current_region'];
            $c_country = $aad['current_country'];
            $c_zip = $aad['current_zipcode'];
            //$coordinates = $aad['coordinates'];
        } 

        //$hcm = DB::query('SELECT alumni.home_cm_id AS home_cm FRom alumni INNER JOIN address_city');


        /*$estat= DB::query('SELECT * FROM job_employment_status WHERE id=:empstat', array(':empstat'=>$employstat));
            foreach ($estat as $k) {
                $empstats= $k['stat_name'];
            }
		
		//Query Alumni Adress
		$alumni_ad = DB::query("SELECT address.id AS address_id, address.address1 AS address1, address_city_mun.cm_name AS city_mun, address_province.ps_name AS province, address_region.reg_name AS region, address_country.c_name AS country, address.zipcode AS zipcode, address.type AS type, address.alumni_id as alumni_id FROM address INNER JOIN address_city_mun ON address.cm_id = address_city_mun.cm_id INNER JOIN address_country ON address.c_id = address_country.c_id INNER JOIN address_province ON address_province.c_id = address_country.c_id AND address.ps_id = address_province.ps_id AND address_city_mun.ps_id = address_province.ps_id INNER JOIN address_region ON address_region.c_id = address_country.c_id AND address.reg_id = address_region.reg_id AND address_province.reg_id = address_region.reg_id WHERE address.alumni_id = :id AND address.type = :type", array(':id' => $_GET['alumniid'], ':type'=>convert_string('encrypt', "Home Address")));
		
        foreach ($alumni_ad as $aad){
            $h_address1 = $aad['address1'];
            $h_city_mun = $aad['city_mun'];
            $h_prov = $aad['province'];
            $h_region = $aad['region'];
            $h_country = $aad['country'];
            $h_zip = $aad['zipcode'];
            //$coordinates = $aad['coordinates'];
        }	

        //Query Alumni Adress
        $alumni_ad2 = DB::query("SELECT address.id AS c_address_id, address.address1 AS c_address1, address_city_mun.cm_name AS c_city_mun, address_province.ps_name AS c_province, address_region.reg_name AS c_region, address_country.c_name AS c_country, address.zipcode AS c_zipcode, address.type AS type, address.alumni_id as c_alumni_id FROM address INNER JOIN address_city_mun ON address.cm_id = address_city_mun.cm_id INNER JOIN address_country ON address.c_id = address_country.c_id INNER JOIN address_province ON address_province.c_id = address_country.c_id AND address.ps_id = address_province.ps_id AND address_city_mun.ps_id = address_province.ps_id INNER JOIN address_region ON address_region.c_id = address_country.c_id AND address.reg_id = address_region.reg_id AND address_province.reg_id = address_region.reg_id WHERE address.alumni_id = :id AND address.type = :type", array(':id' => $_GET['alumniid'], ':type'=>convert_string('encrypt', "Current Address")));
        
        foreach ($alumni_ad2 as $aad){
            $c_address1 = $aad['c_address1'];
            $c_city_mun = $aad['c_city_mun'];
            $c_prov = $aad['c_province'];
            $c_region = $aad['c_region'];
            $c_country = $aad['c_country'];
            $c_zip = $aad['c_zipcode'];
            //$coordinates = $aad['coordinates'];
        }	*/				
		
		//Query Alumni Languages
		$alumni_l = DB::query("SELECT * FROM alumni_languages WHERE alumni_id = :id ORDER BY language ASC", array(':id' => $_GET['alumniid']));
		
		//Query Alumni Skills
		$alumni_s = DB::query("SELECT * FROM alumni_skills WHERE alumni_id = :id ORDER BY skill ASC", array(':id' => $_GET['alumniid']));
			
		//Query Alumni Education
		$alumni_ed = DB::query("SELECT * FROM educations WHERE educations.alumni_id = :id ORDER BY year_grad ASC", array(':id' => $_GET['alumniid']));
			
			
		//Query Alumni Job History
		$alumni_jh = DB::query("SELECT * FROM job_history WHERE job_history.alumni_id = :id ORDER BY mo_end AND yr_end ASC", array(':id' => $_GET['alumniid']));
			foreach ($alumni_jh as $ajh){
				$jh_ids = $ajh['job_hist_id'];
				$companys = $ajh['company'];
				$positions = $ajh['position'];
			}						
			
		//Query Alumni Affiliation Certification
		$alumni_ac = DB::query("SELECT * FROM affiliations_certifications WHERE alumni_id = :id ORDER BY from_month AND from_year ASC", array(':id' => $_GET['alumniid']));
			
			
		//Query Alumni Affiliation Honors And Awards
		$alumni_aha = DB::query("SELECT * FROM affiliations_honors_awards WHERE alumni_id = :id ORDER BY month AND year ASC", array(':id' => $_GET['alumniid']));
			
			
		//Query Alumni Affiliation Organizations
		$alumni_ao = DB::query("SELECT * FROM affiliations_organizations WHERE alumni_id = :id ORDER BY from_month AND from_year ASC", array(':id' => $_GET['alumniid']));
			
			
		//Query Alumni Affiliation Seminar
		$alumni_as = DB::query("SELECT * FROM affiliation_sem_train_workshop WHERE alumni_id = :id ORDER BY month AND year ASC", array(':id' => $_GET['alumniid']));
			
			
		//Query Alumni Settings
		/*$alumni_set = DB::query("SELECT * FROM alumnitracking.affiliations_settings WHERE alumni_id = :id", array(':id' => $_GET['alumniid']));
			foreach ($alumni_set as $aset){
				$set_id = $aao['id'];
				$showcp = $aao['showcp'];
				$showtel = $aao['showtel'];
				$showemail = $aao['showemail'];
			}*/
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
                            <?php echo '<a href="profile.php?alumniid='.$userid.'" class="dropdown-item"><i class="ti-user"></i> My Profile</a> ';?>
                                <div class="dropdown-divider"></div> 
                             <?php echo '<a href="../settings/account-settings.php?alumniid='.$userid.'" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>';?>
                             <?php echo '<a href="../settings/edit-profile.php?alumniid='.$userid.'" class="dropdown-item"><i class="ti-pencil-alt"></i> Edit Profile</a>';?>
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
                                <hr> </div>
                            <div class="card-body"> 
								<small class="text-muted">Sex </small>
									<h6><?php echo convert_string('decrypt', $sex);?></h6> 
								<small class="text-muted">Birthday </small>
									<h6><?php echo convert_string('decrypt', $bmonth), " ", convert_string('decrypt', $bday), ", ", convert_string('decrypt', $byear);?></h6> 
								<small class="text-muted">Civil Status </small>
									<h6><?php echo convert_string('decrypt', $civilstatus);?></h6> 
								<small class="text-muted">Email address </small>
									<h6><?php echo convert_string('decrypt', $email);?></h6> 
								<small class="text-muted">Phone</small>
									<h6><?php if ($telno != null){ echo convert_string('decrypt', $telno), ", ", convert_string('decrypt', $cphone);} else { echo convert_string('decrypt', $cphone);}?></h6> 
                                <small class="text-muted">Home Address</small>
                                    <?php
                                        if($h_address1 == "" || $h_address1 == null){
                                            echo "<h6>",$h_city_mun, ", ", $h_prov, ", ", $h_country, ", ", convert_string('decrypt', $h_zip),"</h6>";
                                        }
                                        else{
                                            echo convert_string('decrypt', $h_address1), ", ", $h_city_mun, ", ", $h_prov, ", ", $h_country, ", ", convert_string('decrypt', $h_zip);
                                        }
                                    ?>
                                <small class="text-muted">Residential Address</small>
                                    <?php
                                        if($c_address1 == "" || $c_address1 == null){
                                            echo "<h6>",$c_city_mun, ", ", $c_prov, ", ", $c_country, ", ", convert_string('decrypt', $c_zip),"</h6>";
                                        }
                                        else{
                                            echo convert_string('decrypt', $c_address1), ", ", $c_city_mun, ", ", $c_prov, ", ", $c_country, ", ", convert_string('decrypt', $c_zip);
                                        }
                                    ?>
                                <br/>
                                <?php
									
									if ($fb != null || $ig != null || $linkedin != null || $twitter != null || $website != null){
										echo "<small class='text-muted p-t-30 db'>Social Profile</small>";
									}
								
									if ($fb != null){
										echo "<a class='btn btn-circle btn-secondary' href = ",convert_string('decrypt',$fb),"><i class='fa fa-facebook'></i></a>";
									}
									if ($ig != null){
										echo "<a class='btn btn-circle btn-secondary' href = ",convert_string('decrypt',$ig),"><i class='fa fa-instagram'></i></a>";
									}
									if ($linkedin != null){
										echo "<a class='btn btn-circle btn-secondary' href = ",convert_string('decrypt',$linkedin),"><i class='fa fa-linkedin'></i></a>";
									}
									if ($twitter != null){
										echo "<a class='btn btn-circle btn-secondary' href = ",convert_string('decrypt',$twitter),"><i class='fa fa-twitter'></i></a>";
									}
									if ($website != null){
										echo "<a class='btn btn-circle btn-secondary' href = ",convert_string('decrypt',$website),"><i class='fa fa-globe'></i></a>";
									}
								?>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
						<div class = "card">
							<div class="card-body">
                                <h3 class="card-title">Personal Information</h3>
                                <div class="row">
                                    <div class="col-md-3 col-xs-6 b-r"> <small class="text-muted">Employment Status</small>
                                        <br>
                                        <strong><?php echo convert_string('decrypt', $employstat);?></strong>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r"> <small class="text-muted">Nationality</small>
                                        <br>
                                        <strong><?php echo convert_string('decrypt', $nationality);?></strong>
                                    </div>
									<div class="col-md-3 col-xs-6 b-r"> <small class="text-muted">Ethnicity</small>
                                        <br>
                                        <strong><?php echo convert_string('decrypt', $ethnicity);?></strong>
                                    </div>
                                    <div class="col-md-3 col-xs-6"> <small class="text-muted">Religion</small>
                                        <br>
                                        <strong><?php echo convert_string('decrypt', $religion);?></strong>
                                    </div>
									<div class="col-md-12 col-xs-6">
										<hr>
									</div>

                                    <?php
                                        if($f_g_name != null){
                                            echo "<div class='col-md-12 col-xs-6'> <small class='text-muted'>Father/Guarian's name</small>
            										<br>
            										<strong>".convert_string('decrypt', $f_g_name)."</strong>
            									</div>";
                                        }
                                        if($f_g_occupationn != null){
									       echo "<div class='col-md-12 col-xs-6'> <small class='text-muted'>Father/Guarian's occupation</small>
            										<br>
            										<strong>". convert_string('decrypt', $f_g_occupationn)."</strong>
            									</div>";
                                        }
                                        if($f_g_name != null || $f_g_occupationn != null){
                                            echo "<div class='col-md-12 col-xs-6'>
                                                        <hr>
                                                    </div>";
                                        }
										if($mother_name != null){
											echo "	<div class='col-md-12 col-xs-6'> <small class='text-muted'>Mother's name</small>
														<br>
														<strong>",convert_string('decrypt', $mother_name),"</strong>
													</div>";
                                        }
                                        if($m_occupation != null){
											echo "<div class='col-md-12 col-xs-6'> <small class='text-muted'>Mother's occupation</small>
														<br>
														<strong>",convert_string('decrypt', $m_occupation),"</strong>
													</div>";
										}
                                        if($mother_name != null || $m_occupation != null){
                                            echo "<div class='col-md-12 col-xs-6'>
                                                        <hr>
                                                    </div>";
                                        }
									?>
                                </div>
								<div class="row">
									
								</div>
								<!--hr-->
								<div class="row">
									<div class="col-sm-12 table-responsive">
										<h4 class="card-title">Languages</h4>
										<table class="table table-hover">
											<tbody>
												<?php foreach($alumni_l as $al){
														$language_id = $al['id'];
														$language = $al['language'];
														$l_proficiency = $al['proficiency'];
												?>
														<tr>
															<td><?php echo convert_string('decrypt', $language);?></td>
													<?php   if (convert_string('decrypt', $l_proficiency) == "Limited proficiency"){
																echo "<td align='right'><span class='label label-light-info'>",convert_string('decrypt', $l_proficiency),"</span></td>";
															} 
                                                            else if (convert_string('decrypt', $l_proficiency) == "Native or biligual proficiency"){
																echo "<td align='right'><span class='label label-light-megna'>", convert_string('decrypt', $l_proficiency),"</span></td>";
															} 
                                                            else if (convert_string('decrypt', $l_proficiency) == "Professional proficiency"){
																echo "<td align='right'><span class='label label-light-warning'>", convert_string('decrypt', $l_proficiency),"</span></td>";
															} ?>
														</tr>
												<?php }?>
											</tbody>
										</table>
									</div>
                                     <div class='col-md-12 col-xs-6'>
                                        <hr>
                                    </div>
									<div class="col-sm-12 table-responsive">
										<h4 class="card-title">Skills</h4>
										<table class="table table-hover">
											<tbody>
												<?php foreach($alumni_s as $as){
														$language_id = $as['id'];
														$skill = $as['skill'];
														$s_proficiency = $as['proficiency'];
												?>
														<tr>
															<td><?php echo convert_string('decrypt', $skill);?></td>
													<?php   if (convert_string('decrypt', $s_proficiency) == "Basic"){
																echo "<td align='right'><span class='label label-light-info'>",convert_string('decrypt', $s_proficiency),"</span></td>";
															} elseif (convert_string('decrypt', $s_proficiency) == "Intermediate"){
																echo "<td align='right'><span class='label label-light-megna'>", convert_string('decrypt', $s_proficiency),"</span></td>";
															} elseif (convert_string('decrypt', $s_proficiency) == "Advance"){
																echo "<td align='right'><span class='label label-light-warning'>", convert_string('decrypt', $s_proficiency),"</span></td>";
															} elseif (convert_string('decrypt', $s_proficiency) == "Expert"){
																echo "<td align='right'><span class='label label-light-danger'>", convert_string('decrypt', $s_proficiency),"</span></td>";
															} ?>
														</tr>												
												<?php }?>
											</tbody>
										</table>
									</div>
								</div>
                            </div>
						</div>
					
                         <!-- EDUCATIONAL BACKGROUND -->
                        <div class="Educload">
                            <div class="card earning-widget">
                                <div class="card-header">
                                    <div class="card-actions">
                                        <a class="" data-action="collapse"><i class="ti-plus"></i></a>
                                    </div>
                                    <h3 class="card-title m-b-0"> <a class="" data-action="collapse">Educational Background</a></h3>
                                </div>
                                <div class="card-body b-t collapse">
                                    <ul class="list-unstyled">
                                        <?php if ($_GET['alumniid'] == Login::isloggedin()){
                                            echo '
                                                <a href="" id="add_Educ_button" alt="default" data-toggle="modal" data-target="#AddEducModal" data-toggle="tooltip" title="AddEduc">
                                                    <li class="col-sm-12 media">
                                                        <img class="d-flex mr-3" src="../../assets/images/users/school.png" width="60" alt="Generic placeholder image">
                                                        <div class="media-body">
                                                            <h5 class="mt-0 mb-1"><strong>Add Educational Background</strong></h5>
                                                        </div>
                                                    </li>
                                                </a>
                                                <hr>';
                                        }

                                        ?>
    									
    									<?php foreach ($alumni_ed as $aed){
    											$ed_id = $aed['educ_id'];
                                                $schname = $aed['sch_name'];
                                                $educlevel = $aed['educ_level'];
    											$deglevel = $aed['deg_level'];
    											$progstudied = $aed['prog_studied'];
    											$progmajor = $aed['prog_major'];
    											$yeargrad = $aed['year_grad'];
    											$comments = $aed['comments'];
    									?>	
    											<div>
    												<div class="text-right">
                                                    <?php 
                                                        if ($_GET['alumniid'] == Login::isloggedin()){
                                                            if(convert_string('decrypt', $schname) != "Central Mindanao University"){
                                                                echo "
                                                                    <small class='text-muted'>
                                                                        <a href='' alt='default' id='updateEduc' data-edid='".$ed_id."' data-toggle='modal' data-target='#EditEducModal'>Edit</a>
                                                                    </small>
                                                                     &nbsp
                                                                    <small class='text-muted'>
                                                                        <a href='' alt='default' id='deletEduc' data-edid='".$ed_id."' data-toggle='tooltip'>Delete</a>
                                                                    </small>";
                                                            }
                                                            else{
                                                                echo '
                                                                    <small class="text-muted">
                                                                        <a href="" alt="default" id="updateCMUEduc" data-cmuedid="'.$ed_id.'" data-toggle="modal" data-target="#EditCMUEducModal">Edit</a>
                                                                    </small>';
                                                            }
                                                        }
    												?>
    												</div>
    												<li class="col-sm-12 media">
    													<img class="d-flex mr-3" src="../../assets/images/users/school.png" width="60" alt="Generic placeholder image">
    													<div class="media-body">
    														<h5 class='mt-0 mb-1'><strong><?php echo convert_string('decrypt', $schname);?></strong></h5>
    														<h6 class='text-muted'><?php if($progmajor == null) {echo convert_string('decrypt', $progstudied);}else{echo convert_string('decrypt', $progstudied), " - ", convert_string('decrypt', $progmajor);}?></h6>
    														<h6 class='text-muted'><?php echo convert_string('decrypt', $yeargrad);?></h6>
    													</div>
    												</li>
    											</div>
    									<?php }?>
                                    </ul>
                                </div>
                            </div>
                        </div>
						 <!-- /EDUCATIONAL BACKGROUND -->
						 
						 <!-- JOB HISTORY -->
						<div class="card earning-widget">
                            <div class="card-header">
                                <div class="card-actions">
                                    <a class="" data-action="collapse"><i class="ti-plus"></i></a>
                                </div>
                                <h3 class="card-title m-b-0"> <a class="" data-action="collapse">Job History</a></h3>
                            </div>
                            <div class="card-body b-t collapse">
								<ul class="list-unstyled">
                                    <?php if ($_GET['alumniid'] == Login::isloggedin()){
                                        echo '
                                            <a href="" alt="default" data-toggle="modal" data-target="#AddJobHistoryModal" data-toggle="tooltip" title="AddEduc">
                                                <li class="col-sm-12 media">
                                                    <img class="d-flex mr-3" src="../../assets/images/users/job.png" width="60" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-1"><strong>Add Job History</strong></h5>
                                                    </div>
                                                </li>
                                            </a>
                                            <hr>';
                                    }

                                    ?>
									
                                <?php 	foreach ($alumni_jh as $ajh){
											$jh_id = $ajh['job_hist_id'];
											$jh_company = $ajh['company'];
											$jh_position = $ajh['position'];
                                            $jh_senlevel = $ajh['senior_level'];
											$jh_empstat = $ajh['emp_type'];
											$jh_salary = $ajh['salary_range'];
											$jh_mostarted = $ajh['mo_start'];
											$jh_yearstarted = $ajh['yr_start'];
											$jh_moend = $ajh['mo_end'];
											$jh_yearend = $ajh['yr_end'];
                                            $jh_comments = $ajh['comments'];
                                            $jh_citymun = $ajh['cm_id'];
                                            $jh_prov = $ajh['ps_id'];
											$jh_country = $ajh['c_id'];
								?>
											<div class="text-right">
                                                <?php 
                                                        if ($_GET['alumniid'] == Login::isloggedin()){
                                                            echo '
                                                                    <small class="text-muted">
                                                                        <a href="" alt="default" data-toggle="modal" id="editJobHist" data-jobhistid="'.$jh_id.'" data-target="#EditJobHistoryModal" data-toggle="tooltip">Edit</a>
                                                                    </small> &nbsp
                                                                    <small class="text-muted">
                                                                        <a href="" alt="default" alt="default" id="deleteJobHist" data-jobhistid="'.$jh_id.'" data-toggle="tooltip">Delete</a>
                                                                    </small>';
                                                        }
                                                ?>
											</div>
											<li class="media">
												<img class="d-flex mr-3" src="../../assets/images/users/job.png" width="60" alt="Generic placeholder image">
												<div class="media-body">
													<h5 class='mt-0 mb-1'><strong><?php echo convert_string('decrypt', $jh_position);?></strong></h5>
													<h6 class='text-muted'><?php echo convert_string('decrypt', $jh_company);?></h6>
                                                    <h6 class='text-muted'><?php echo convert_string('decrypt', $jh_senlevel);?></h6>
													<h6 class='text-muted'><?php echo convert_string('decrypt', $jh_empstat);?></h6>
													<h6 class='text-muted'><?php echo convert_string('decrypt', $jh_salary);?></h6>
													<h6 class='text-muted'><?php if(convert_string('decrypt', $jh_yearend) == "Present" OR convert_string('decrypt', $jh_moend) == "Present"){echo convert_string('decrypt', $jh_mostarted), " ", convert_string('decrypt', $jh_yearstarted) ,"-", convert_string('decrypt', $jh_moend);} else{echo convert_string('decrypt', $jh_mostarted), " ", convert_string('decrypt', $jh_yearstarted), " - ", convert_string('decrypt', $jh_moend), " ", convert_string('decrypt', $jh_yearend);}?></h6>
												</div>
											</li>
								<?php	}?>
								
								</ul>
                            </div>
                        </div>
						<!-- /JOB HISTORY -->
						
						 <!-- AFFILIATION -->
						<div class="card earning-widget">
                            <div class="card-header">
                                <div class="card-actions">
                                    <a class="" data-action="collapse"><i class="ti-plus"></i></a>
                                </div>
                                <h3 class="card-title m-b-0"> <a class="" data-action="collapse">Affiliation</a></h3>
                            </div>
                            <div class="card-body b-t collapse">
								<ul class="nav nav-tabs customtab" role="tablist">
									<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home2" role="tab">Certification</a> </li>
									<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab">Honors and Awards</a> </li>
									<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages2" role="tab">Organizations</a> </li>
									<li class="nav-item"> <a class="nav-link" data-toggle="tab" id="dropdown1-tab" href="#dropdown1" role="tab">Seminars</a> </li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content">
									<div class="tab-pane active" id="home2" role="tabpanel">
										<ul class="list-unstyled">
											 <?php if ($_GET['alumniid'] == Login::isloggedin()){
                                        echo '
                                            <a href="" alt="default" data-toggle="modal" data-target="#AddCertificationsModal" data-toggle="tooltip" title="AddEduc">
                                                <li class="col-sm-12 media">
                                                    <img class="d-flex mr-3" src="../../assets/images/users/certificate.png" width="60" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-1"><strong>Add Certification</strong></h5>
                                                    </div>
                                                </li>
                                            </a>
                                            <hr>';
                                            }

                                           ?>
											<hr>
											<?php
												foreach ($alumni_ac as $aac){
													$ac_id = $aac['cert_id'];
													$ac_certname = $aac['cert_name'];
													$ac_certauthority = $aac['cert_authority'];
													$ac_frommonth = $aac['from_month'];
													$ac_fromyear = $aac['from_year'];
													$ac_tomonth = $aac['to_month'];
													$ac_toyear = $aac['to_year'];
                                                    $ac_url = $aac['url'];
													$ac_alumniid = $aac['alumni_id'];
											?>
                                            <div class="text-right">
                                                <?php 
                                                        if ($_GET['alumniid'] == Login::isloggedin()){
                                                            echo '
                                                                    <small class="text-muted">
                                                                        <a href="" alt="default" data-toggle="modal" id="editCert" data-certid="'.$ac_id.'" data-target="#EditCertificationsModal" data-toggle="tooltip">Edit</a>
                                                                    </small> &nbsp
                                                                    <small class="text-muted">
                                                                        <a href="" alt="default" alt="default" id="deleteJobHist" data-certid="'.$ac_id.'" data-toggle="tooltip">Delete</a>
                                                                    </small>';
                                                        }
                                                ?>
                                            </div>
													<li class="media">
														<img class="d-flex mr-3" src="../../assets/images/users/certificate.png" width="60" alt="Generic placeholder image">
														<div class="media-body">
															<h5 class='mt-0 mb-1'><strong><?php echo convert_string('decrypt', $ac_certname);?></strong></h5>
															<h6 class='text-muted'><?php echo convert_string('decrypt', $ac_certauthority);?></h6>
															<h6 class='text-muted'><?php if(convert_string('decrypt', $ac_tomonth) == "No Expiration" OR convert_string('decrypt', $ac_toyear) == "No Expiration"){echo convert_string('decrypt', $ac_frommonth), " ", convert_string('decrypt', $ac_fromyear) ," - ", convert_string('decrypt', $ac_tomonth);} else{echo convert_string('decrypt', $ac_frommonth), " ", convert_string('decrypt', $ac_fromyear) ,"-", convert_string('decrypt', $ac_tomonth), " ", convert_string('decrypt', $ac_toyear);}?></h6>
															<h6 class='text-muted'><a href = "<?php echo convert_string('decrypt', $ac_url);?>"><?php echo convert_string('decrypt', $ac_url);?></a></h6>
														</div>
													</li>
											<?php } ?>
										</ul>
									</div>
									<div class="tab-pane" id="profile2" role="tabpanel">
										<ul class="list-unstyled">
                                            <?php if ($_GET['alumniid'] == Login::isloggedin()){
                                        echo '
                                            <a href="" alt="default" data-toggle="modal" data-target="#AddHonorAwardsModal" data-toggle="tooltip" title="AddEduc">
                                                <li class="col-sm-12 media">
                                                    <img class="d-flex mr-3" src="../../assets/images/users/award.png" width="60" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-1"><strong>Add Honor or Award</strong></h5>
                                                    </div>
                                                </li>
                                            </a>
                                            <hr>';
                                            }?>
										<?php
											foreach ($alumni_aha as $aaha){
												$aha_id = $aaha['ha_id'];
												$ha_name = $aaha['ha_name'];
												$ha_associated = $aaha['associated'];
												$ha_issuer = $aaha['issuer'];
												$ha_month = $aaha['month'];
                                                $ha_year = $aaha['year'];
                                                $ha_comment = $aaha['ha_comment'];
												$ha_alumniid = $aaha['alumni_id'];
										?>
                                            <div class="text-right">
                                                <?php 
                                                        if ($_GET['alumniid'] == Login::isloggedin()){
                                                            echo '
                                                                    <small class="text-muted">
                                                                        <a href="" alt="default" data-toggle="modal" id="editHonorAward" data-haid="'.$aha_id.'" data-target="#EditHonorAwardsModal" data-toggle="tooltip">Edit</a>
                                                                    </small> &nbsp
                                                                    <small class="text-muted">
                                                                        <a href="" alt="default" alt="default" id="deleteHonorAward" data-haid="'.$aha_id.'" data-toggle="tooltip">Delete</a>
                                                                    </small>';
                                                        }
                                                ?>
                                            </div>
												<li class="media">
													<img class="d-flex mr-3" src="../../assets/images/users/award.png" width="60" alt="Generic placeholder image">
													<div class="media-body">
														<h5 class='mt-0 mb-1'><strong><?php echo convert_string('decrypt', $ha_name);?></strong></h5>
														<h6 class='text-muted'><?php echo convert_string('decrypt', $ha_associated);?></h6>
														<h6 class='text-muted'><?php echo convert_string('decrypt', $ha_issuer);?></h6>
														<h6 class='text-muted'><?php echo convert_string('decrypt', $ha_month), " ", convert_string('decrypt', $ha_year);?></h6>
														
													</div>
												</li>
										<?php } ?>
										</ul>
									</div>
									<div class="tab-pane" id="messages2" role="tabpanel">
                                        <ul class="list-unstyled">
                                        <?php if ($_GET['alumniid'] == Login::isloggedin()){
                                        echo '
                                            <a href="" alt="default" data-toggle="modal" data-target="#AddOrganizationModal" data-toggle="tooltip" title="AddEduc">
                                                <li class="col-sm-12 media">
                                                    <img class="d-flex mr-3" src="../../assets/images/users/award.png" width="60" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-1"><strong>Add Organization</strong></h5>
                                                    </div>
                                                </li>
                                            </a>
                                            <hr>';
                                            }?>
											<hr>
										<?php 
											foreach ($alumni_ao as $aao){
												$ao_id = $aao['org_id'];
												$ao_orgname = $aao['org_name'];
												$ao_position = $aao['position'];
												$ao_frommonth = $aao['from_month'];
												$ao_fromyear = $aao['from_year'];
												$ao_tomonth = $aao['to_month'];
												$ao_toyear = $aao['to_year'];
                                                $ao_comment = $aao['comments'];
												$ao_alumniid = $aao['alumni_id'];
										?>
                                            <div class="text-right">
                                                <?php 
                                                        if ($_GET['alumniid'] == Login::isloggedin()){
                                                            echo '
                                                                    <small class="text-muted">
                                                                        <a href="" alt="default" data-toggle="modal" id="editOrg" data-orgid="'.$ao_id.'" data-target="#EditOrganizationModal" data-toggle="tooltip">Edit</a>
                                                                    </small> &nbsp
                                                                    <small class="text-muted">
                                                                        <a href="" alt="default" alt="default" id="deleteJobHist" data-orgid="'.$ao_id.'" data-toggle="tooltip">Delete</a>
                                                                    </small>';
                                                        }
                                                ?>
                                            </div>
												<li class="media">
													<img class="d-flex mr-3" src="../../assets/images/users/org.png" width="60" alt="Generic placeholder image">
													<div class="media-body">
														<h5 class='mt-0 mb-1'><strong><?php echo convert_string('decrypt', $ao_orgname);?></strong></h5>
														<h6 class='text-muted'><?php echo convert_string('decrypt', $ao_position);?></h6>
														<h6 class='text-muted'><?php if(convert_string('decrypt', $ao_tomonth) == "Present" OR convert_string('decrypt', $ao_toyear) == "Present"){echo convert_string('decrypt', $ao_frommonth), " ", convert_string('decrypt', $ao_fromyear) ,"-", convert_string('decrypt', $ao_tomonth);} else{echo convert_string('decrypt', $ao_frommonth), " ", convert_string('decrypt', $ao_fromyear) ,"-", convert_string('decrypt', $ao_tomonth), " ", convert_string('decrypt', $ao_toyear);}?></h6>
														<h6 class='text-muted'><?php echo convert_string('decrypt', $ao_comment);?></h6>	
													</div>
												</li>
										<?php } ?>
										</ul>
									</div>
									<div class="tab-pane fade" id="dropdown1" role="tabpanel" aria-labelledby="dropdown1-tab">
										<ul class="list-unstyled">
                                            <?php if ($_GET['alumniid'] == Login::isloggedin()){
                                        echo '
                                            <a href="" alt="default" data-toggle="modal" data-target="#AddSemTrainWorkshopsModal" data-toggle="tooltip" title="AddEduc">
                                                <li class="col-sm-12 media">
                                                    <img class="d-flex mr-3" src="../../assets/images/users/award.png" width="60" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-1"><strong>Add Seminar, Training, or Workshop</strong></h5>
                                                    </div>
                                                </li>
                                            </a>
                                            <hr>';
                                            }?>
											<hr>
										<?php 
											foreach ($alumni_as as $aas){
												$astw_id = $aas['stw_id'];
												$astw_name = $aas['stw_name'];
												$astw_venue = $aas['venue'];
												$astw_mo = $aas['month'];
                                                $astw_yr = $aas['year'];
                                                $astw_type = $aas['type'];
												$astw_level = $aas['level'];
												$astw_comments = $aas['comments'];
										?>
                                            <div class="text-right">
                                                <?php 
                                                        if ($_GET['alumniid'] == Login::isloggedin()){
                                                            echo '
                                                                    <small class="text-muted">
                                                                        <a href="" alt="default" data-toggle="modal" id="editSemTrainWork" data-stwid="'.$astw_id.'" data-target="#EditSemTrainWorkshopsModal" data-toggle="tooltip">Edit</a>
                                                                    </small> &nbsp
                                                                    <small class="text-muted">
                                                                        <a href="" alt="default" alt="default" id="deleteSemTrainWork" data-stwid="'.$astw_id.'" data-toggle="tooltip">Delete</a>
                                                                    </small>';
                                                        }
                                                ?>
                                            </div>
												<li class="media">
													<img class="d-flex mr-3" src="../../assets/images/users/seminar.png" width="60" alt="Generic placeholder image">
													<div class="media-body">
														<h5 class='mt-0 mb-1'><strong><?php echo convert_string('decrypt', $astw_name);?></strong></h5>
														<h6 class='text-muted'><?php echo convert_string('decrypt', $astw_venue);?></h6>
														<h6 class='text-muted'><?php echo convert_string('decrypt', $astw_mo), " ", convert_string('decrypt', $astw_yr);?></h6>
														<h6 class='text-muted'><?php echo convert_string('decrypt', $astw_comments);?></h6>	
													</div>
												</li>
										<?php } ?>
										</ul>
									</div>
								</div>
                            </div>
                        </div>
						<!-- /AFFILIATION -->
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
			$('.updateBI').on('click', function(){
				var user_id = $(this).attr('id');
				$.ajax({
					url:"php/fetch_single.php",
					method:"POST",
					data:{user_id:user_id},
					dataType:"json",
					success:function(data)
					{
						$('#EditPerInfoModal').modal('show');
						
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
