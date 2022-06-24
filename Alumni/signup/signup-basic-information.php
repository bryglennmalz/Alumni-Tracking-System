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
		require 'php/signup-basic-info-query-php.php';
	}

    $country= DB::query("SELECT * FROM address_country ORDER BY c_name ASC");
    //$emp_stat= DB::query("SELECT * FROM job_employment_status ORDER BY stat_name ASC");
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
    <title>Signup Basic Information | CMU - Alumni Tracking And Information System</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!--link href="../../assets/plugins/wizard/steps.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../css/style.css" rel="stylesheet">
    <link href="sbi/step.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../../css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

	<style>
		form#BasicInfoForm{ border:#000 0px solid; padding:24px; width:100%; }
		form#BasicInfoForm > #phase2, #phase3, #phase4, #show_all_data{ display:none; }
		
		form#multiphase{ border:#000 1px solid; padding:24px; width:100%; }
		form#multiphase > #phase2, #phase3, #phase4, #show_all_data{ display:none; }
	</style>
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
						<a href="#"><?php echo convert_string('decrypt',$alfname), ' ', convert_string('decrypt',$almname), ' ', convert_string('decrypt',$allname), ' ', convert_string('decrypt',$alextname);?></a>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> 
                            <span class="hide-menu" style="color: #14d26e;">Basic Information</span>
                        </li>
                        <li class="nav-devider"></li>
                        
                        <li> 
                            <span class="hide-menu">Educational Background</span>
                        </li>
                        <li class="nav-devider"></li>
                        
                        <li> 
                            <span class="hide-menu">Job History</span>
                        </li>
                        <li class="nav-devider"></li>

                        <li> 
                            <span class="hide-menu">Affiliations</span>
                        </li>
                        <li class="nav-devider"></li>
                        
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
                        <h3 class="text-themecolor">New Member Form</h3>
                    </div>
                    <!--div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                                    <h4 class="m-t-0 text-info">$58,356</h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"></div>
                                </div>
                            </div>
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                                    <h4 class="m-t-0 text-primary">$48,356</h4></div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"></div>
                                </div>
                            </div>
                            <div class="">
                                <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                            </div>
                        </div>
                    </div-->
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <!-- Validation wizard -->
                <div class="row" id="validation">
                    <div class="col-12">
                        <div class="card wizard-content">
                            <div class="card-body">
								<form id="BasicInfoForm" class="form-material" onsubmit="return false">

									<h1>Basic Information</h1>
									
									<progress id="progressBar" value="25" max="100" style="width:100%;"></progress>
									<h3 id="status">Phase 1 of 4</h3>

									<!-- One "tab" for each step in the form: -->
									<div id="phase1">
										<br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="alumniId">Alumni ID :</label>
                                                    <input type="text" class="form-control" id="alumniId" name="alumniId" value="<?php echo convert_string('decrypt',$id);?>" readonly> </div>
                                            </div>
                                        </div>
										<hr>
										<div class="row">
                                            <div class="col-md-12">
                                                <h4 class="card-title">Name</h4>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="firstName"> First Name : </label>
                                                    <input type="text" class="form-control required" id="firstName" name="firstName" value="<?php echo convert_string('decrypt',$fname);?>" readonly> </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="middleInitial"> Middle Name : </label>
                                                    <input type="text" class="form-control required" id="middleInitial" name="middleInitial" value="<?php echo convert_string('decrypt',$mname);?>" readonly> </div>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lastName"> Last Name : </label>
                                                    <input type="text" class="form-control required" id="lastName" name="lastName" value="<?php echo convert_string('decrypt',$lname);?>" readonly> </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="extName"> Extension Name :</label>
                                                    <input type="text" class="form-control" id="extName" name="extName" value="<?php echo convert_string('decrypt',$extname);?>" readonly> </div>
                                            </div>
                                        </div>
										<hr>
                                        <div class="row">
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="birthday">Date of Birth : </label>
                                                    <input type="text" class="form-control required" id="birthday" name="birthday" value="<?php echo implode($bdate);?>" readonly> 
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
                                                    <label for="phoneNo">Phone Number : </label>
                                                    <input type="tel" class="form-control" id="phoneNo" name="phoneNo" value="<?php echo convert_string('decrypt',$phoneno);?>" readonly> </div>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="telephoneNo">Telephone Number :</label>
                                                    <input type="tel" class="form-control" id="telephoneNo" name="telephoneNo" oninput="this.className = ''" required> </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="googlePlus"> Google Plus :</label>
                                                    <input type="text" class="form-control" id="googlePlus" name="googlePlus" oninput="this.className = ''"> </div>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="facebook"> Facebook :</label>
                                                    <input type="text" class="form-control" id="facebook" name="facebook" oninput="this.className = ''"> </div>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="instagram"> Instagram :</label>
                                                    <input type="text" class="form-control" id="instagram" name="instagram" oninput="this.className = ''"> </div>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="linkedin"> Linkedin :</label>
                                                    <input type="text" class="form-control" id="linkedin" name="linkedin" oninput="this.className = ''"> </div>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="twitter"> Twitter :</label>
                                                    <input type="text" class="form-control" id="twitter" name="twitter" oninput="this.className = ''"> </div>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="website"> Website :</label>
                                                    <input type="text" class="form-control" id="website" name="website" oninput="this.className = ''"> </div>
                                            </div>
                                        </div>
										<br>
										<div class="row">
											
											<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
												<button class="btn btn-success" onclick="processPhase1()">Continue</button>
											</div>
										</div>
									</div>

									<div id="phase2">
										<br>
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
										<hr>
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
										<br>
										<div class="row">
											<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
												<button class="btn btn-secondary" onclick="processPhaseBack1()">Back</button>
												<button class="btn btn-success" onclick="processPhase2()">Continue</button>
											</div>
										</div>
									</div>

									<div id="phase3">
										<br>
										<div class="row">
											
											<div class="col-md-6">
                                                <table class="table table-bordered" id="dynamic_field_Lang">  
													<th>Languages<th>
													<tr>  
														<td style=" width: 90%">
															<input type="text" name="language[]" placeholder="Language" class="form-control name_list" oninput="this.className = ''" required/>
															<select class="form-control" name="langProf[]" oninput="this.className = ''"  required>
																<option value="">Select Proficiency</option>
																<option value="Limited proficiency">Limited proficiency</option>
																<option value="Native or biligual proficiency">Native or biligual proficiency</option>
																<option value="Professional proficiency">Professional proficiency</option>
															</select>
														</td>  
														<td style=" width: 5%"><button type="button" name="addLanguage" id="addLanguage" class="btn btn-success">+</button></td>  
													</tr>   
											   </table>
                                            </div>
											<div class="col-md-6">
                                                <table class="table table-bordered" id="dynamic_field_Skill">  
													<th>Skills<th>
													<tr>  
														<td style=" width: 90%">
															<input type="text"  name="skill[]" placeholder="Skill" class="form-control name_list" oninput="this.className = ''" required/>
															<select class="form-control" name="skillProf[]" oninput="this.className = ''" required>
																<option value="">Select Proficiency</option>
																<option value="Basic">Basic</option>
																<option value="Intermediate">Intermediate</option>
																<option value="Advance">Advance</option>
																<option value="Expert">Expert</option>
															</select>
														</td>  
														 <td style=" width: 5%"><button type="button" name="addSkill" id="addSkill" class="btn btn-success">+</button></td>  
													</tr>  
											   </table> 
                                            </div>
											
                                        </div>
										<br>
										<div class="row">
											<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
												<button type="button" class="btn btn-secondary" onclick="processPhaseBack2()">Back</button>
												<button type="button" class="btn btn-success" onclick="processPhase3()">Continue</button>
											</div>
										</div>
									</div>

									<div id="phase4">
										<br>
										<div class="row">
											<div class="col-md-12">
                                                <h4 class="card-title">Other Information</h4>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fathername"> Father/Guardian's Name :</label>
                                                    <input type="text" class="form-control" id="fathername" name="fathername" oninput="this.className = ''"> 
												</div>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fatherocc"> Father/Guardian's Occupation :</label>
                                                    <input type="text" class="form-control" id="fatherocc" name="fatherocc" oninput="this.className = ''"> 
												</div>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mothername"> Mother's Name :</label>
                                                    <input type="text" class="form-control" id="mothername" name="mothername" oninput="this.className = ''"> 
												</div>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="motherocc"> Mother's Occupation :</label>
                                                    <input type="text" class="form-control" id="motherocc" name="motherocc" oninput="this.className = ''"> 
												</div>
                                            </div>
											<div class="col-md-12">
                                                <h4 class="card-title">Questions</h4>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="birthday">What is the name of your first pet? <span class="danger">*</span></label>
                                                    <input type="text" class="form-control required" id="answer1" name="answer1" placeholder="Answer" oninput="this.className = ''" required> </div>
                                            </div>
											<div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sex">What is your nickname? <span class="danger">*</span></label>
													<input type="text" class="form-control required" id="answer2" name="answer2" placeholder="Answer" oninput="this.className = ''" required>
												</div>
                                            </div>
                                        </div>
										<div class="row">
											<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                                                <input type="hidden" name="operation" value="Update Basic Info">
												<button type="button" class="btn btn-secondary" onclick="processPhaseBack3()">Back</button>
												<button type="submit" name="SubmitBI" onclick="submitForm()">Submit Data</button>
												
											</div>
										</div>
									</div>
									
									<!--div id="show_all_data">
										First Name: <span id="display_fname"></span> <br>
										Last Name: <span id="display_lname"></span> <br>
										Gender: <span id="display_gender"></span> <br>
										Country: <span id="display_country"></span> <br>
										<button type="submit" name="SubmitBI" onclick="submitForm()">Submit Data</button>
									</div-->
								</form>
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
				<form action="../../../php/logout-php.php" class="form center-block" method="post" class="l-form">
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
    <script src="../../assets/plugins/sparkline/jquery.sparkline.min.js"></script>>
	<!--Custom JavaScript -->
    <script src="../../js/custom.min.js"></script>
    <script src="../../assets/plugins/moment/min/moment.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="../../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <!--script src="sbi/step.js"></script>
    <!--script src="../../assets/plugins/wizard/steps.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
	<script src="../../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#h_country').on('change',function(){
                var HomecountryID = $(this).val();
                if(HomecountryID){
                    $.ajax({
                        type:'POST',
                        url:'ajaxData.php',
                        data:'Homecountry_id='+HomecountryID,
                        success:function(html){
                            $('#h_province').html(html);
                            $('#h_cityMun').html('<option value="">Select province first</option>'); 
                        }
                    }); 
                }else{
                    $('#h_province').html('<option value="">Select country first</option>');
                    $('#h_cityMun').html('<option value="">Select province first</option>'); 
                }
            });
            
            $('#h_province').on('change',function(){
                var HomeprovID = $(this).val();
                if(HomeprovID){
                    $.ajax({
                        type:'POST',
                        url:'ajaxData.php',
                        data:'HomeprovID_id='+HomeprovID,
                        success:function(html){
                            $('#h_cityMun').html(html);
                        }
                    }); 
                }else{
                    $('#h-cityMun').html('<option value="">Select province first</option>'); 
                }
            });

            $('#c_country').on('change',function(){
                var CurrentcountryID = $(this).val();
                if(CurrentcountryID){
                    $.ajax({
                        type:'POST',
                        url:'ajaxData.php',
                        data:'CurrentcountryID='+CurrentcountryID,
                        success:function(html){
                            $('#c_province').html(html);
                            $('#c_cityMun').html('<option value="">Select province first</option>'); 
                        }
                    }); 
                }else{
                    $('#c_province').html('<option value="">Select country first</option>');
                    $('#c_cityMun').html('<option value="">Select province first</option>'); 
                }
            });
            
            $('#c_province').on('change',function(){
                var CurrentprovID = $(this).val();
                if(CurrentprovID){
                    $.ajax({
                        type:'POST',
                        url:'ajaxData.php',
                        data:'CurrentprovID='+CurrentprovID,
                        success:function(html){
                            $('#c_cityMun').html(html);
                        }
                    }); 
                }else{
                    $('#c_cityMun').html('<option value="">Select province first</option>'); 
                }
            });
        });
    </script>
	
	<script>
		var sex, phoneno, civilStat, nationality, ethnicity, religion, hcountry, hstateprov, hcitymun, hother, hzip, ccountry, cstateprov, ccitymun, cother, czip, gender, country, language, langProf, skill, skillProf;
		function _(x){
			return document.getElementById(x);
		}
		function processPhase1(){
            phoneno = _("phoneNo").value;
			sex = _("sex").value;
			civilStat = _("civilStat").value;
			nationality = _("nationality").value;
			ethnicity = _("ethnicity").value;
			religion = _("religion").value;
			if(sex.length> 0 && phoneno.length > 10 && civilStat.length > 0 && nationality.length > 1 && ethnicity.length > 1 && religion.length > 1) {
				_("phase1").style.display = "none";
				_("phase2").style.display = "block";
				_("progressBar").value = 50;
				_("status").innerHTML = "Phase 2 of 4";
			} else {
				alert("Please fill-in the fields marked *");	
			}
		}
		function processPhase2(){
			hcountry = _("h_country").value;
			hstateprov = _("h_province").value;
			hcitymun = _("h_cityMun").value;
			hother = _("h_other").value;
			hzip = _("h_zipCode").value;

			ccountry = _("c_country").value;
			cstateprov = _("c_province").value;
			ccitymun = _("c_cityMun").value;
			cother = _("c_other").value;
			czip = _("c_zipCode").value;
			
			if(hcountry.length > 0 && hstateprov.length > 0  && hcitymun.length > 0 && hzip.length > 3  && ccountry.length > 0  && cstateprov.length > 0  && ccitymun.length > 0 && czip.length > 3){
				_("phase2").style.display = "none";
				_("phase3").style.display = "block";
				_("progressBar").value = 75;
				_("status").innerHTML = "Phase 3 of 4";
			} 
            else if (hcountry.length < 0){
                alert("Please fill-in the Country field in Home Address");    
            } 
            else if (hstateprov.length < 0){
                alert("Please fill-in the State/Province field in Home Address");    
            }
            else if (hcitymun.length < 0){
                alert("Please fill-in the City/Municipality field in Home Address");    
            }
            else if (hzip.length < 0){
                alert("Please fill-in the Zipcode field in Home Address");    
            }
            else if (ccountry.length < 0){
                alert("Please fill-in the Country field in Current Address");    
            }
            else if (cstateprov.length < 0){
                alert("Please fill-in the State/Province field in Current Address");    
            }
            else if (ccitymun.length < 0){
                alert("Please fill-in the City/Municipality field in Current Address");    
            }
            else if (czip.length < 1){
                alert("Please fill-in the Zipcode field in Current Address");    
            }
		}
		function processPhase3(){
				_("phase3").style.display = "none";
				_("phase4").style.display = "block";
				_("progressBar").value = 100;
				_("status").innerHTML = "Phase 4 of 4";
		}
		/*function processPhase4(){
			country = _("country").value;
			if(country.length > 0){
				_("phase3").style.display = "none";
				_("show_all_data").style.display = "block";
				_("display_fname").innerHTML = fname;
				_("display_lname").innerHTML = lname;
				_("display_gender").innerHTML = gender;
				_("display_country").innerHTML = country;
				_("progressBar").value = 100;
				_("status").innerHTML = "Data Overview";
			} else {
				alert("Please choose your country");	
			}
		}*/
		
		function processPhaseBack1(){
				_("phase2").style.display = "none";
				_("phase1").style.display = "block";
				_("progressBar").value = 0;
				_("status").innerHTML = "Phase 1 of 4";
		}
		function processPhaseBack2(){
				_("phase3").style.display = "none";
				_("phase2").style.display = "block";
				_("progressBar").value = 25;
				_("status").innerHTML = "Phase 2 of 4";
		}
		
		function processPhaseBack3(){
				_("phase4").style.display = "none";
				_("phase3").style.display = "block";
				_("progressBar").value = 75;
				_("status").innerHTML = "Phase 3 of 4";
		}
		
		function submitForm(){
            answer1 = _("answer1").value;
			answer2 = _("answer2").value;
			if(answer1.length > 0 && answer2.length > 0){
				_("BasicInfoForm").method = "post";
				_("BasicInfoForm").action = "php/signup-basic-info-php.php";
				_("BasicInfoForm").submit();
			} else {
				alert("Please choose your country");	
			}
			
		}
	</script>
	
	<script>
		$(document).ready(function(){  
		
			var i=1;  
			$('#addLanguage').click(function(){  
			   i++;  
			   $('#dynamic_field_Lang').append('<tr id="row'+i+'"><td style=" width: 90%"><input type="text" name="language[]" placeholder="Language" class="form-control name_list" required/><select class="form-control" name="langProf[]" required><option value="">Select Proficiency</option><option value="Limited proficiency">Limited proficiency</option><option value="Native or biligual proficiency">Native or biligual proficiency</option><option value="Professional proficiency">Professional proficiency</option></select></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
			});  
			$(document).on('click', '.btn_remove', function(){  
			   var button_id = $(this).attr("id");   
			   $('#row'+button_id+'').remove();  
			});

			var i=1;  
			$('#addSkill').click(function(){  
				i++;  
				$('#dynamic_field_Skill').append('<tr id="row'+i+'"><td style=" width: 90%"><input type="text" name="skill[]" placeholder="Skill" class="form-control name_list" required/><select class="form-control" name="skillProf[]" required><option value="">Select Proficiency</option><option value="Basic">Basic</option><option value="Intermediate">Intermediate</option><option value="Advance">Advance</option><option value="Expert">Expert</option></select></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_removes">X</button></td></tr>');  
			});  
			$(document).on('click', '.btn_removes', function(){  
				var button_id = $(this).attr("id");   
				$('#row'+button_id+'').remove();  
			}); 
		}); 
	</script>
	
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
