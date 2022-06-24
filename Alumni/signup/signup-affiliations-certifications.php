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
    <title>Signup Affiliations | CMU - Alumni Tracking And Information System</title>
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
                        <!-- ============================================================== -->
                        <!-- Profile -->
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
                            <span class="hide-menu" >Educational Background</span>
                        </li>
                        <li class="nav-devider"></li>
                        
                        <li> 
                            <span class="hide-menu">Job History</span>
                        </li>
                        <li class="nav-devider"></li>

                        <li> 
                            <span class="hide-menu" style="color: #14d26e;">Affiliations</span>
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
                                <form id="CErtificationsForm" onsubmit="return false">
                                    <h1>Affiliations - Certifications</h1>
                                    <small>You can click skip if you dont want to provide information.</small> <br>

                                    <div id="phase1">
                                        <br>
                                        <div id="certifications_div">
                                            <div id="certifications_div_yeah">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="alumniId">Certificate name:</label>
                                                        <input type="text" class="form-control" id="certName[]" name="certName[]" oninput="this.className = ''" required> 
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alumniId">Certificate authority:</label>
                                                        <input type="text" class="form-control" id="certAuth[]" name="certAuth[]" oninput="this.className = ''" required> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="firstName"> Month started : <span class="danger">*</span> </label>
                                                                <select class="form-control" id="mStarted[]" name="mStarted[]" oninput="this.className = ''" required>
                                                                    <option >Select month</option>
                                                                    <option value="January">January</option>
                                                                    <option value="Febuary">Febuary</option>
                                                                    <option value="March">March</option>
                                                                    <option value="April">April</option>
                                                                    <option value="May">May</option>
                                                                    <option value="June">June</option>
                                                                    <option value="July">July</option>
                                                                    <option value="August">August</option>
                                                                    <option value="September">September</option>
                                                                    <option value="October">October</option>
                                                                    <option value="November">November</option>
                                                                    <option value="December">December</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="middleInitial"> Month ended : <span class="danger">*</span> </label>
                                                                <select class="form-control" id="mEnded[]" name="mEnded[]" oninput="this.className = ''" required>
                                                                    <option >Select month</option>
                                                                    <option value="No Expiration">No Expiration</option>
                                                                    <option value="January">January</option>
                                                                    <option value="Febuary">Febuary</option>
                                                                    <option value="March">March</option>
                                                                    <option value="April">April</option>
                                                                    <option value="May">May</option>
                                                                    <option value="June">June</option>
                                                                    <option value="July">July</option>
                                                                    <option value="August">August</option>
                                                                    <option value="September">September</option>
                                                                    <option value="October">October</option>
                                                                    <option value="November">November</option>
                                                                    <option value="December">December</option>
                                                                </select>
                                                             </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lastName"> Year started : <span class="danger">*</span> </label>
                                                                <select class="form-control" id="yrStarted[]" name="yrStarted[]" oninput="this.className = ''" required>
                                                                    <option >Select year</option>
                                                                    <?php
                                                                        for ($i = date("Y"); $i > 1910 - 1; $i--){
                                                                            echo '<option value = "' .$i.'">' .$i. '</option>';}
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="extName"> Year ended : <span class="danger">*</span> </label>
                                                                <select class="form-control" id="yrEnded[]" name="yrEnded[]"" oninput="this.className = ''" required>
                                                                    <option >Select year</option>
                                                                    <option value="No Expiration">No Expiration</option>
                                                                    <?php
                                                                        for ($x=10; $x > 0; $x--) { 
                                                                            $dx = date("Y")+$x;
                                                                            echo '<option value = "' .$dx.'">' .$dx. '</option>';
                                                                        }
                                                                        for ($i = date("Y"); $i > 1910 - 1; $i--){
                                                                            echo '<option value = "' .$i.'">' .$i. '</option>';}
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alumniId">URL:</label>
                                                        <input type="text" class="form-control" id="certUrl[]" name="certUrl[]" oninput="this.className = ''"> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" name="addInfo" id="addInfo" class="btn btn-success">Add more</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                                                <input type="hidden" name="operation" value="Add Certifications">
                                                <button type="button" class="btn btn-secondary" name="skip" onclick="processPhaseBack3()">Skip</button>
                                                <input type="hidden" name="alumniid" value="<?php echo Login::isloggedin();?>">
                                                <button type="submit" name="SubmitBI" onclick="submitForm()">Submit Data</button>
                                                
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

    <script> 
        var certName, certAuth, mStarted, mEnded, yrStarted, yrEnded;

        function _(x){
            return document.getElementById(x);
        } 
        function submitForm(){
            certName = _('certName[]').value;
            certAuth = _('certAuth[]').value;
            mStarted = _('mStarted[]').value;
            mEnded = _('mEnded[]').value;
            yrStarted = _('yrStarted[]').value;
            yrEnded = _('yrEnded[]').value;
            if(certName.length < 2){
                alert("Please enter the Certificate name");
            }
            else if (certAuth.length < 2){
                alert("Please enter the Certificate associated");
            }
            else if (mStarted.length < 0){
                alert("Please enter the Certificate month validation started");
            }
            else if (mEnded.length < 0){
                alert("Please enter the Certificate year validation started");
            }
            else if (yrStarted.length < 0){
                alert("Please enter the Certificate month validation ends or ended");
            }
            else if (yrEnded.length < 0){
                alert("Please enter the Certificate year validation ends or ended");
            }
            else if (certName.length > 2 && certAuth.length > 2 && mStarted.length > 0 && mEnded.length > 0 && yrStarted.length > 0 && yrEnded.length > 0){
                _("CErtificationsForm").method = "post";
                _("CErtificationsForm").action = "php/signup-affiliations-cert-php.php";
                _("CErtificationsForm").submit();

            }
        }

        function processPhaseBack3(){
                _("CErtificationsForm").method = "post";
                _("CErtificationsForm").action = "signup-affiliations-honors-awards.php";
                _("CErtificationsForm").submit();
        }
    </script>

    <script> 

         $(document).ready(function(){
            $('#locCountry').on('change',function(){
                var countryID = $(this).val();
                if(countryID){
                    $.ajax({
                        type:'POST',
                        url:'ajaxData.php',
                        data:'country_id='+countryID,
                        success:function(html){
                            $('#locProv').html(html);
                            $('#locCityMun').html('<option value="">Select province first</option>'); 
                        }
                    }); 
                }else{
                    $('#locProv').html('<option value="">Select country first</option>');
                    $('#locCityMun').html('<option value="">Select province first</option>'); 
                }
            });
            
            $('#locProv').on('change',function(){
                var stateID = $(this).val();
                if(stateID){
                    $.ajax({
                        type:'POST',
                        url:'ajaxData.php',
                        data:'state_id='+stateID,
                        success:function(html){
                            $('#locCityMun').html(html);
                        }
                    }); 
                }else{
                    $('#locCityMun').html('<option value="">Select province first</option>'); 
                }
            });
        });
    </script>
	
	<script type="text/javascript">
        let i=1;
        let b=1; 

        function removeJobHist(a)
        {
            var button_id = $(this).attr("id");    
            $('#certifications_div_yuh'+a.id).remove();  
        }

        $('#addInfo').click(function(){ 
            let q = `
            <div id= 'certifications_div_yuh`+i+`'>
                <hr>
                <button type="button" name="remove" id="`+i+`" class="btn btn-danger btn_removes" onclick="removeJobHist(this)">Remove</button>
                <div class="col-sm-12"><br></div>
                <div id="certifications_div_yeah">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="alumniId">Certificate name:</label>
                            <input type="text" class="form-control" id="certName[]" name="certName[]" oninput="this.className = ''" required> 
                        </div>
                        <div class="form-group">
                            <label for="alumniId">Certificate authority:</label>
                            <input type="text" class="form-control" id="certAuth[]" name="certAuth[]" oninput="this.className = ''" required> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName"> Month started : <span class="danger">*</span> </label>
                                    <select class="form-control" id="mStatred[]" name="mStarted[]" oninput="this.className = ''" required>
                                        <option >Select month</option>
                                        <option value="January">January</option>
                                        <option value="Febuary">Febuary</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                     </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="middleInitial"> Month ended : <span class="danger">*</span> </label>
                                    <select class="form-control" id="mEnded[]" name="mEnded[]" oninput="this.className = ''" required>
                                        <option >Select month</option>
                                        <option value="No Expiration">No Expiration</option>
                                        <option value="January">January</option>
                                        <option value="Febuary">Febuary</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                 </div>
                             </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName"> Year started : <span class="danger">*</span> </label>
                                    <select class="form-control" id="yrStarted[]" name="yrStarted[]" oninput="this.className = ''" required>
                                        <option >Select year</option>
                                        <?php
                                            for ($i = date("Y"); $i > 1910 - 1; $i--){
                                                echo '<option value = "' .$i.'">' .$i. '</option>';}
                                        ?>
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="extName"> Year ended :</label>
                                    <select class="form-control" id="yrEnded[]" name="yrEnded[] oninput="this.className = ''" required">
                                        <option >Select year</option>
                                        <option value="No Expiration">No Expiration</option>
                                        <?php
                                            for ($x=10; $x > 0; $x--) { 
                                                $dx = date("Y")+$x;
                                                echo '<option value = "' .$dx.'">' .$dx. '</option>';
                                            }
                                            for ($i = date("Y"); $i > 1910 - 1; $i--){
                                                echo '<option value = "' .$i.'">' .$i. '</option>';}
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alumniId">URL:</label>
                            <input type="text" class="form-control" id="certUrl[]" name="certUrl[]" oninput="this.className = ''"> 
                        </div>
                    </div>
                </div>
            </div>`;

            $('#certifications_div_yeah').append(q);      
            i++;  
        });

        
    </script>
	
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
