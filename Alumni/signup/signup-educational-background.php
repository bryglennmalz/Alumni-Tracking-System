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
		require 'php/signup-educ-back-query-php.php';
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
    <title>Signup Educational Background | CMU - Alumni Tracking And Information System</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!--link href="../../assets/plugins/wizard/steps.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="../../assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../../assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="../../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
	<link href="../../assets/plugins/css-chart/css-chart.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="../../assets/plugins/c3-master/c3.min.css" rel="stylesheet">
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
        form#EducBackForm{ border:#000 0px solid; padding:24px; width:100%; }
        form#EducBackForm > #phase2, #phase3, #phase4, #N_High, #show_all_data{ display:none; }
        
        form#multiphase{ border:#000 1px solid; padding:24px; width:100%; }
        form#multiphase > #phase2, #phase3, #phase4, #show_all_data{ display:none; }

        input[type=checkbox]{
            font-size: 110%; margin: 0px; width: 30%;
        }
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
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> 
                            <span class="hide-menu">Basic Information</span>
                        </li>
                        <li class="nav-devider"></li>
                        
                        <li> 
                            <span class="hide-menu" style="color: #14d26e;">Educational Background</span>
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
                                <form id="EducBackForm" onsubmit="return false">
                                    <h1>Educational Background</h1>
                                    <progress id="progressBar" value="33" max="100" style="width:100%;"></progress>
                                    <h3 id="status">Phase 1 of 3</h3>
                                    <br>
                                    <br>
                                    <div id="phase1">
                                        <h3 id="status">Elementary</h3>
                                        <div class="form-group">
                                            <label for="alumniId">School name : <span class="danger">*</span></label>
                                            <input type="text" class="form-control" id="elemSchName" name="elemSchName" oninput="this.className = ''" required autofocus> 
                                        </div>
                                        <div class="form-group">
                                            <label for="alumYrgrad">Year Graduated : <span class="danger">*</span></label>
                                            <select class="form-control" id="elemYrGrad" name="elemYrGrad" required>
                                                <option value="">Select year graduated</option>
                                                <?php
                                                    for ($i = date("Y"); $i > 1910 - 1; $i--){
                                                        echo '<option value = "' .$i.'">' .$i. '</option>';}
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="alumniId">Comment :</label>
                                            <textarea rows="5" name="elemComment" id="elemComment" class="form-control no-resize auto-growth"></textarea>
                                        </div>
                                        <input type="hidden" class="form-control" id="eEducLevel" name="eEducLevel" value="Elementary">
                                        <div>
                                            <br>
                                            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                                                <button class="btn btn-success" onclick="processPhase1()">Continue</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="phase2">
                                        <h3 id="status">Secondary</h3>
                                        <br>

                                        <div class = "is_new" class="demo-checkbox">
                                            <div class="form-group">
                                                <!--div class="demo-radio-button">
                                                    <input name="group1" type="radio" id="radio_1" name="is_new_system" value="0" onclick="showHideForm()" checked />
                                                    <label for="radio_1">Old Educational System</label>
                                                    <input name="group1" type="radio" id="radio_2" name="is_new_system" value="1" onclick="showHideForm()"/>
                                                    <label for="radio_2">New Educational System</label>
                                                </div-->
                                                <input type="checkbox" id="is_new_system" name="is_new_system" value="1" onclick="showHideForm()">
                                                <label for="is_new_system">Check this box if you're in New Educational System</label>
                                            </div>
                                        </div>

                                        <div id="O_High">
                                            
                                            <div class="form-group">
                                                <label for="alumniId">School name : <span class="danger">*</span></label>
                                                <input type="text" class="form-control" id="oSchName" name="oSchName" oninput="this.className = ''" required autofocus> 
                                            </div>
                                            <div class="form-group">
                                                <label for="alumYrgrad">Year Graduated : <span class="danger">*</span></label>
                                                <select class="form-control" id="oYrGrad" name="oYrGrad" required>
                                                    <option value="">Select year graduated</option>
                                                    <?php
                                                        for ($i = date("Y"); $i > 1910 - 1; $i--){
                                                            echo '<option value = "' .$i.'">' .$i. '</option>';}
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="alumniId">Comment :</label>
                                                <textarea rows="5" name="oComment" id="oComment" class="form-control no-resize auto-growth" required></textarea>
                                            </div>
                                            <input type="hidden" class="form-control" id="oEducLevel" name="oEducLevel" value="High School">
                                        </div>

                                        

                                        <div id="N_High">
                                            <div class="form-group">
                                                <h4 id="status">Junior High</h4>
                                                <br>
                                            </div>
                                            <div class="form-group">
                                                <label for="alumniId">School name : <span class="danger">*</span></label>
                                                <input type="text" class="form-control" id="jhSchName" name="jhSchName" oninput="this.className = ''" autofocus> 
                                            </div>
                                            <div class="form-group">
                                                <label for="alumYrgrad">Year Graduated <span class="danger">*</span></label>
                                                <select class="form-control" id="jhYrGrad" name="jhYrGrad">
                                                    <option value="">Select year graduated</option>
                                                    <?php
                                                        for ($i = date("Y"); $i > 1910 - 1; $i--){
                                                            echo '<option value = "' .$i.'">' .$i. '</option>';}
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="alumniId">Comment :</label>
                                                <textarea rows="5" name="jhComment" id="jhComment" class="form-control no-resize auto-growth"></textarea>
                                            </div>
                                            <input type="hidden" class="form-control" id="jhEducLevel" name="jhEducLevel" value="Junior High School"-->

                                            <br><hr><br>

                                            <div class="form-group">
                                                <h4 id="status">Senior High</h4>
                                                <br>
                                            </div>
                                            <div class="form-group">
                                                <label for="alumniId">School name : <span class="danger">*</span></label>
                                                <input type="text" class="form-control" id="shSchName" name="shSchName" oninput="this.className = ''"  autofocus> 
                                            </div>
                                            <div class="form-group">
                                                <label for="alumYrgrad">Year Graduated : <span class="danger">*</span></label>
                                                <select class="form-control" id="shYrGrad" name="shYrGrad" >
                                                    <option value="">Select year graduated</option>
                                                    <?php
                                                        for ($i = date("Y"); $i > 1910 - 1; $i--){
                                                            echo '<option value = "' .$i.'">' .$i. '</option>';}
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="alumniId">Comment :</label>
                                                <textarea rows="5" name="shComment" id="shComment" class="form-control no-resize auto-growth"></textarea>
                                            </div>
                                            <input type="hidden" class="form-control" id="shEducLevel" name="shEducLevel" value="Senior High School">
                                        </div>
                                        <div>
                                            <br>
                                            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                                                <button class="btn btn-secondary" onclick="processPhaseBack1()">Back</button>
                                                <button class="btn btn-success" onclick="processPhase2()">Continue</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="phase3">
                                        <h3 id="status">Tertiary</h3>
                                        <br>
                                        <div id="Tertiary_level">
                                            <div id="Tertiary">
                                                <div class="form-group">
                                                    <label for="alumniId">School name : </label>
                                                    <input type="text" class="form-control" id="cSchName[]" name="cSchName[]" oninput="this.className = ''" autofocus> 
                                                </div>
                                                <div class="form-group">
                                                    <label for="cityMun">Degree level : </label>
                                                    <select class="form-control" id="cDegLevel[]" name="cDegLevel[]" oninput="this.className = ''" required>
                                                        <option value="">Select degree level</option>
                                                        <option value="Associate Degree">Associate Degree</option>
                                                        <option value="Bachelor's Degree">Bachelor's Degree</option>
                                                        <option value="Master's Degree">Master's Degree</option>
                                                        <option value="Doctoral Degree">Doctoral Degree</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alumniId">Program studied : </label>
                                                    <input type="text" class="form-control" id="cStudied[]" name="cStudied[]" oninput="this.className = ''" autofocus> 
                                                </div>
                                                <div class="form-group">
                                                    <label for="alumniId">Program major : </label>
                                                    <input type="text" class="form-control" id="cMajor[]" name="cMajor[]" oninput="this.className = ''" autofocus> 
                                                </div>
                                                <div class="form-group">
                                                    <label for="alumYrgrad">Year Graduated : </label>
                                                    <select class="form-control" id="cYrGrad[]" name="cYrGrad[]">
                                                        <option value="">Select year graduated</option>
                                                        <?php
                                                            for ($i = date("Y"); $i > 1910 - 1; $i--){
                                                                echo '<option value = "' .$i.'">' .$i. '</option>';}
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alumniId">Comment :</label>
                                                    <textarea rows="5" name="cComment[]" id="cComment[]" class="form-control no-resize auto-growth"></textarea>
                                                </div>
                                                <input type="hidden" class="form-control" id="cEducLevel[]" name="cEducLevel[]" value="Tertiary">
                                            </div>
                                            <div id="sq"></div>

                                        </div>
                                        <div class="form-group">
                                            <button type="button" name="addInfo" id="addInfo" class="btn btn-success">Add more</button>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example"><br><br><br>
                                                <input type="hidden" name="operation" value="Update Educ">
                                                <input type="hidden" name="alumniid" value="<?php echo Login::isloggedin();?>">
                                                <button type="button" class="btn btn-secondary" onclick="processPhaseBack2()">Back</button>
                                                <button type="submit" name="SubmitEB" onclick="submitForm()">Submit Data</button>
                                                
                                            </div>
                                        </div>
                                        </div>
                                    </div>

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
    <script src="sbi/step.js"></script>
    <!--script src="../../assets/plugins/wizard/steps.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
	<script src="../../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script type="text/javascript">
        var elemSchName, elemYrGrad, oSchName, oYrGrad, jhSchName, jhYrGrad, shSchName, shYrGrad, cSchName, cDegLevel, cStudied, cYrGrad, cComment, cEducLevel;

        function _(x){
            return document.getElementById(x);
        }
        function processPhase1(){
            
            elemSchName = _("elemSchName").value;
            elemYrGrad = _("elemYrGrad").value;
            if(elemSchName.length > 3 && elemYrGrad.length > 0) {
                _("phase1").style.display = "none";
                _("phase2").style.display = "block";
                _("progressBar").value = 66;
                _("status").innerHTML = "Phase 2 of 4";
            } 
            else if(elemSchName.length < 3) {
                alert("Please enter the School Name where graduated in Elementary");    
            } 
            else if(elemYrGrad.length < 0) {
                alert("Please enter the Year graduated in Elementary");    
            }
        }

        function processPhase2(){
            oSchName = _('oSchName').value;
            oYrGrad = _('oYrGrad').value;
            jhSchName = _('jhSchName').value;
            jhYrGrad = _('jhYrGrad').value;
            shSchName = _('shSchName').value;
            shYrGrad = _('shYrGrad').value;
            if (document.getElementById('is_new_system').checked == false){
                if(oSchName.length < 4) {
                    alert("Please enter the School Name where graduated in High School");
                } 
                else if (oYrGrad.length < 0){
                    alert("Please enter the Year graduated in High School");
                }
                else{
                    _("phase2").style.display = "none";
                    _("phase3").style.display = "block";
                    _("progressBar").value = 100;
                    _("status").innerHTML = "Phase 3 of 3";
                }
            }
            else if (document.getElementById('is_new_system').checked == true){
                if(jhSchName.length < 4) {
                    alert("Please enter the School Name where graduated in Junior High School");
                } 
                else if (jhYrGrad.length < 0){
                    alert("Please enter the Year graduated in Junior High School");
                }
                else if(shSchName.length < 4) {
                    alert("Please enter the School Name where graduated in Senior High School");
                } 
                else if (shYrGrad.length < 0){
                    alert("Please enter the Year graduated in Senior High School");
                }
                else{
                    _("phase2").style.display = "none";
                    _("phase3").style.display = "block";
                    _("progressBar").value = 100;
                    _("status").innerHTML = "Phase 3 of 3";
                }
            }
                
        }

        function processPhaseBack1(){
                _("phase2").style.display = "none";
                _("phase1").style.display = "block";
                _("progressBar").value = 33;
                _("status").innerHTML = "Phase 1 of 3";
        }
        function processPhaseBack2(){
                _("phase3").style.display = "none";
                _("phase2").style.display = "block";
                _("progressBar").value = 66;
                _("status").innerHTML = "Phase 2 of 3";
        }
        
        function submitForm(){
            cSchName = _('cSchName[]').value;
            cDegLevel = _('cDegLevel[]').value;
            cStudied = _('cStudied[]').value;
            cYrGrad = _('cYrGrad[]').value;
            if(cSchName.length < 1) {
                alert("Please enter the School Name where graduated in Junior High School");
            } 
            else if (cDegLevel.length < 0){
                alert("Please enter the Degree type");
            } 
            else if (cStudied.length < 2){
                alert("Please enter the Degree studied");
            }
            else if (cYrGrad.length < 0){
                alert("Please enter the Year graduated");
            }
            else if(cSchName.length > 1 && cDegLevel.length > 0 && cStudied.length > 2 && cYrGrad.length > 0){
                _("EducBackForm").method = "post";
                _("EducBackForm").action = "php/signup-educ-back-php.php";
                _("EducBackForm").submit();
            }
        }
    </script>

    <script type="text/javascript">
        function showHideForm(){
            if (document.getElementById('is_new_system').checked == true){
                document.getElementById('oSchName').required = false;
                document.getElementById('oYrGrad').required = false;
                document.getElementById('jhSchName').required = true;
                document.getElementById('jhYrGrad').required = true;
                document.getElementById('shSchName').required = true;
                document.getElementById('shYrGrad').required = true;

                document.getElementById('O_High').style.display = 'none';
                document.getElementById('N_High').style.display = 'block';
            } else {
                document.getElementById('oSchName').required = true;
                document.getElementById('oYrGrad').required = true;
                document.getElementById('jhSchName').required = false;
                document.getElementById('jhYrGrad').required = false;
                document.getElementById('shSchName').required = false;
                document.getElementById('shYrGrad').required = false;

                document.getElementById('N_High').style.display = 'none';
                document.getElementById('O_High').style.display = 'block';
            }
        }
    </script>
    <script type="text/javascript">
        let i=1;
        let b=1; 

        function removeEducInfo(a)
        {
            var button_id = $(this).attr("id");  
             //$('#Master_yeah'+a.id+'').remove();  
            $('#Tertiary'+a.id).remove();  
        }

        $('#addInfo').click(function(){ 
            let q = `
            <div id= 'Tertiary`+i+`'>
                <div class="col-sm-12"><hr></div>
                <button type="button" name="remove" id="`+i+`" class="btn btn-danger btn_removes" onclick="removeEducInfo(this)">Remove</button>
                <div class="row"><br></div>
                <div class="form-group">
                    <label for="alumniId">School name : </label>
                    <input type="text" class="form-control" id="cSchName[]" name="cSchName[]" oninput="this.className = ''" autofocus> 
                </div>
                <div class="form-group">
                    <label for="cityMun">Degree level : </label>
                    <select class="form-control" id="cDegLevel[]" name="cDegLevel[]" oninput="this.className = ''" required>
                        <option >Select degree level</option>
                        <option value="Associate Degree">Associate Degree</option>
                        <option value="Bachelor's Degree">Bachelor's Degree</option>
                        <option value="Master's Degree">Master's Degree</option>
                        <option value="Doctoral Degree">Doctoral Degree</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="alumniId">Program studied : </label>
                    <input type="text" class="form-control" id="cStudied[]" name="cStudied[]" oninput="this.className = ''" autofocus> 
                </div>
                <div class="form-group">
                    <label for="alumniId">Program major : </label>
                    <input type="text" class="form-control" id="cMajor[]" name="cMajor[]" oninput="this.className = ''" autofocus> 
                </div>
                <div class="form-group">
                    <label for="alumYrgrad">Year Graduated : </label>
                    <select class="form-control" id="cYrGrad[]" name="cYrGrad[]">
                        <?php
                            for ($i = date("Y"); $i > 1910 - 1; $i--){
                                echo '<option value = "' .$i.'">' .$i. '</option>';}
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="alumniId">Comment :</label>
                    <textarea rows="5" name="cComment[]" id="cComment[]" class="form-control no-resize auto-growth"></textarea>
                </div>
                <input type="hidden" class="form-control" id="cEducLevel[]" name="cEducLevel[]" value="Tertiary">
            </div>`;

            $('#Tertiary').append(q);      
            i++;  
        });

        
    </script>
	
	 <script>  
		/*$(document).ready(function(){  
		
			var i=1;  
			$('#addLanguage').click(function(){  
			   i++;  
			   $('#dynamic_field_Lang').append('<tr id="row'+i+'"><td style=" width: 90%"><input type="text" id="language[]" name="language[]" placeholder="Language" class="form-control name_list" required/><select class="form-control" id="langProf" name="langProf" required><option value="">Select Proficiency</option><option value="Limited proficiency">Limited proficiency</option><option value="Native or biligual proficiency">Native or biligual proficiency</option><option value="Professional proficiency">Professional proficiency</option></select></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
			});  
			$(document).on('click', '.btn_remove', function(){  
			   var button_id = $(this).attr("id");   
			   $('#row'+button_id+'').remove();  
			});

			var i=1;  
			$('#addSkill').click(function(){  
				i++;  
				$('#dynamic_field_Skill').append('<tr id="row'+i+'"><td style=" width: 90%"><input type="text" id="skill[]" name="skill[]" placeholder="Skill" class="form-control name_list" required/><select class="form-control" id="langProf" name="langProf" required><option value="">Select Proficiency</option><option value="Basic">Basic</option><option value="Intermediate">Intermediate</option><option value="Advance">Advance</option><option value="Expert">Expert</option></select></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_removes">X</button></td></tr>');  
			});  
			$(document).on('click', '.btn_removes', function(){  
				var button_id = $(this).attr("id");   
				$('#row'+button_id+'').remove();  
			}); 
		}); */
	 </script>
	
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
