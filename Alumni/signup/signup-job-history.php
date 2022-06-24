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
    <title>Signup Basic Information | CMU - Alumni Tracking And Information System</title>
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
                            <span class="hide-menu" style="color: #14d26e;">Job History</span>
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
								<form id="JobHistForm" onsubmit="return false">
                                    <h1>Job History</h1>
                                    <br>
                                    <br>

                                    <div id="phase4">
                                        <div id="Masters_char">
                                            <div id="Master_yeah">
                                                <div class="form-group">
                                                    <label for="alumniId">Job position : </label>
                                                    <input type="text" class="form-control" id="jobPos[]" name="jobPos[]" oninput="this.className = ''" autofocus> 
                                                </div>
                                                <div class="form-group">
                                                    <label for="alumniId">Company name : </label>
                                                    <input type="text" class="form-control" id="compName[]" name="compName[]" oninput="this.className = ''" autofocus> 
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="firstName"> Monthly salary range : <span class="danger">*</span> </label>
                                                            <select class="form-control" id="salRange[]" name="salRange[]" oninput="this.className = ''" required>
                                                                <option value="">Select salary range</option>
                                                                <option value="Below P 5,000.00">Below P 5,000.00</option>
                                                                <option value="P 5,000.00 to less than P 10,000.00">P 5,000.00 to less than P 10,000.00</option>
                                                                <option value="P 10,000.00 to less than P 15,000.00">P 10,000.00 to less than P 15,000.00</option>
                                                                <option value="P 20,000.00 to less than P 20,000.00">P 20,000.00 to less than P 20,000.00</option>
                                                                <option value="P 20,000.00 to less than P 25,000.00">P 20,000.00 to less than P 25,000.00</option>
                                                                <option value="P 25,000.00 and above">P 25,000.00 and above</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="middleInitial"> Employment type : <span class="danger">*</span> </label>
                                                            <select class="form-control" id="empType[]" name="empType[]" oninput="this.className = ''" required>
                                                                <option value="">Select employment type</option>
                                                                <option value="Full-time">Full-time</option>
                                                                <option value="Part-time">Part-time</option>
                                                                <option value="Contract">Contract</option>
                                                                <option value="Temporary">Temporary</option>
                                                                <option value="Volunteer">Volunteer</option>
                                                                <option value="Internship">Internship</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="middleInitial"> Seniority level : <span class="danger">*</span> </label>
                                                            <select class="form-control" id="senLevel[]" name="senLevel[]" oninput="this.className = ''" required>
                                                                <option value="">Select seniority level</option>
                                                                <option value="Internship">Internship</option>
                                                                <option value="Entry level">Entry level</option>
                                                                <option value="Associate">Associate</option>
                                                                <option value="Mid-Senior level">Mid-Senior level</option>
                                                                <option value="Director">Director</option>
                                                                <option value="Executive">Executive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="firstName"> Month statred : <span class="danger">*</span> </label>
                                                            <select class="form-control" id="mStatred[]" name="mStatred[]" oninput="this.className = ''" required>
                                                                <option value="">Select month</option>
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
                                                                <option value="">Select month</option>
                                                                <option value="Present">Present</option>
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
                                                                <option value="">Select year</option>
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
                                                            <select class="form-control" id="yrEnded[]" name="yrEnded[] oninput="this.className = ''" required">
                                                                <option value="">Select year</option>
                                                                <option value="Present">Present</option>
                                                                <?php
                                                                    for ($i = date("Y"); $i > 1910 - 1; $i--){
                                                                        echo '<option value = "' .$i.'">' .$i. '</option>';}
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h4 class="card-title">Company address</h4>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="firstName"> City : </label>
                                                            <select class="form-control" id="locCityMun" name="locCityMun[]" oninput="this.className = ''" >
                                                                <option value="">Select province first</option> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="firstName"> Province : </label>
                                                            <select class="form-control" id="locProv" name="locProv[]" oninput="this.className = ''">
                                                                <option value="">Select country first</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="middleInitial"> Country : <span class="danger">*</span> </label>
                                                            <select class="form-control" id="locCountry" name="locCountry[]" oninput="this.className = ''" required>
                                                                <option value="">Select country</option>
                                                            <?php
                                                                $Cy = DB::query("SELECT * FROM address_country ORDER BY c_name ASC");
                                                                foreach ($Cy as $c){
                                                                    $id = $c['c_id'];
                                                                    $cou = $c['c_name'];
                                                                    echo '<option value = "' .$id. '">' .$cou. '</option>';
                                                                }
                                                            ?>  
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alumniId">Comment :</label>
                                                    <textarea rows="5" name="mComment[]" id="mComment[]" class="form-control no-resize auto-growth"></textarea>
                                                </div>
                                            </div>
                                            <div id="sq"></div>
                                            

                                        </div>
                                            <div class="form-group">
                                                <button type="button" name="addInfo" id="addInfo" class="btn btn-success">Add more</button>
                                            </div>
                                        <div class="col-sm-12">
                                            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example"><br><br><br>
                                                <input type="hidden" name="operation" value="Update Educ">
                                                <input type="hidden" name="alumniid" value="<?php echo Login::isloggedin();?>">
                                                <button type="submit" name="SubmitJH" onclick="submitForm()">Submit Data</button>
                                                
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
        let i=1;
        let b=1;


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
	
	 <script> 
        var jobPos, compName, salRange, empType, senLevel, mStatred, mEnded, yrStarted, yrEnded, locCountry;

        function _(x){
            return document.getElementById(x);
        } 
        function submitForm(){
            jobPos = _('jobPos[]').value;
            compName = _('compName[]').value;
            salRange = _('salRange[]').value;
            senLevel = _('senLevel[]').value;
            empType = _('empType[]').value;
            mStatred = _('mStatred[]').value;
            mEnded = _('mEnded[]').value;
            yrStarted = _('yrStarted[]').value;
            yrEnded = _('yrEnded[]').value;
            locCountry = _('locCountry').value;
            if(jobPos.length < 1) {
                alert("Please enter the Job position");
            } 
            else if (compName.length < 1){
                alert("Please enter the Company name");
            } 
            else if (salRange.length < 0){
                alert("Please enter the Salary range");
            }
            else if (senLevel.length < 0){
                alert("Please enter the Seniority level");
            }
            else if (empType.length < 0){
                alert("Please enter the Year graduated");
            }
            else if (mStatred.length < 0){
                alert("Please enter the Year graduated");
            }
            else if (mEnded.length < 0){
                alert("Please enter the Year graduated");
            }
            else if (yrStarted.length < 0){
                alert("Please enter the Year graduated");
            }
            else if (yrEnded.length < 0){
                alert("Please enter the Year graduated");
            }
            else if (mEnded.length < 0){
                alert("Please enter the Year graduated");
            }
            else if (locCountry.length < 0){
                alert("Please enter the Year graduated");
            }
            else if(jobPos.length > 1 && compName.length > 1 && salRange.length > 0 && senLevel.length > 0 && empType.length > 0 && mStatred.length > 0 && mEnded.length > 1 && yrStarted.length > 1 && yrEnded.length > 0 && locCountry.length > 0){
                _("JobHistForm").method = "post";
                _("JobHistForm").action = "php/signup-job-hist-php.php";
                _("JobHistForm").submit();
            }
        }
	 </script>

    <script type="text/javascript">
         

        function removeJobHist(a)
        {
            var button_id = $(this).attr("id");  
             //$('#Master_yeah'+a.id+'').remove();  
            $('#Master_yeah'+a.id).remove();  
        }

        $('#addInfo').click(function(){ 
            let q = `
            <div id= 'Master_yeah`+i+`'><hr>
                <button type="button" name="remove" id="`+i+`" class="btn btn-danger btn_removes" onclick="removeJobHist(this)">Remove</button><div class="col-sm-12"><br></div>
                <div class="form-group">
                    <label for="alumniId">Job position : </label>
                    <input type="text" class="form-control" id="jobPos[]" name="jobPos[]" oninput="this.className = ''" autofocus> 
                </div>
                <div class="form-group">
                    <label for="alumniId">Company name : </label>
                    <input type="text" class="form-control" id="compName[]" name="compName[]" oninput="this.className = ''" autofocus> 
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="firstName"> Monthly salary range : <span class="danger">*</span> </label>
                            <select class="form-control" id="salRange[]" name="salRange[]" oninput="this.className = ''" required>
                                <option value="">Select salary range</option>
                                <option value="Below P 5,000.00">Below P 5,000.00</option>
                                <option value="P 5,000.00 to less than P 10,000.00">P 5,000.00 to less than P 10,000.00</option>
                                <option value="P 10,000.00 to less than P 15,000.00">P 10,000.00 to less than P 15,000.00</option>
                                <option value="P 20,000.00 to less than P 20,000.00">P 20,000.00 to less than P 20,000.00</option>
                                <option value="P 20,000.00 to less than P 25,000.00">P 20,000.00 to less than P 25,000.00</option>
                                <option value="P 25,000.00 and above">P 25,000.00 and above</option>
                            </select>
                     </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middleInitial"> Employment type : <span class="danger">*</span> </label>
                            <select class="form-control" id="empType[]" name="empType[]" oninput="this.className = ''" required>
                                <option value="">Select employment type</option>
                                <option value="Full-time">Full-time</option>
                                <option value="Part-time">Part-time</option>
                                <option value="Contract">Contract</option>
                                <option value="Temporary">Temporary</option>
                                <option value="Volunteer">Volunteer</option>
                                <option value="Internship">Internship</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middleInitial"> Seniority level : <span class="danger">*</span> </label>
                            <select class="form-control" id="senLevel[]" name="senLevel[]" oninput="this.className = ''" required>
                                <option value="">Select seniority level</option>
                                <option value="Internship">Internship</option>
                                <option value="Entry level">Entry level</option>
                                <option value="Associate">Associate</option>
                                <option value="Mid-Senior level">Mid-Senior level</option>
                                <option value="Director">Director</option>
                                <option value="Executive">Executive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstName"> Month statred : <span class="danger">*</span> </label>
                            <select class="form-control" id="mStatred[]" name="mStatred[]" oninput="this.className = ''" required>
                                <option >Select month</option>
                                <option value="January">January</option>
                                <option value="Febuary">Febuary</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="">September</option>
                                <option value="September">October</option>
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
                                <option value="Present">Present</option>
                                <option value="January">January</option>
                                <option value="Febuary">Febuary</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="">September</option>
                                <option value="September">October</option>
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
                                <option value="Present">Present</option>
                                <?php
                                    for ($i = date("Y"); $i > 1910 - 1; $i--){
                                        echo '<option value = "' .$i.'">' .$i. '</option>';}
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="card-title">Company address</h4>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="firstName"> City : </label>
                            <select class="form-control" id="locCityMun" name="locCityMun[]" oninput="this.className = ''" >
                                <option>Select province first</option> 
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="firstName"> Province : </label>
                            <select class="form-control" id="locProv" name="locProv[]" oninput="this.className = ''">
                                <option>Select country first</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middleInitial"> Country : <span class="danger">*</span> </label>
                            <select class="form-control" id="locCountry" name="locCountry[]" oninput="this.className = ''" required>
                                <option>Select country</option>
                            <?php
                                $Cy = DB::query("SELECT * FROM address_country ORDER BY c_name ASC");
                                foreach ($Cy as $c){
                                    $id = $c['c_id'];
                                    $cou = $c['c_name'];
                                    echo '<option value = "' .$id. '">' .$cou. '</option>';
                                }
                            ?>  
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="alumniId">Comment :</label>
                    <textarea rows="5" name="mComment[]" id="mComment[]" class="form-control no-resize auto-growth"></textarea>
                </div>
            </div>`;

            $('#Masters_char').append(q);      
            i++;  
        });

        
    </script>
	
</body>


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/material/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Jan 2018 01:29:24 GMT -->
</html>
