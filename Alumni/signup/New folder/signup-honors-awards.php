<?php 
	ob_start();
	session_start();
	
	require '../php/myconnection.php';
	require '../php/home-php.php';
			
	if(!Login::isloggedin()){
		header('location: index.php');
	}
	else{
		require '../php/query-php.php';
	}
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <title>Home CMU-Alumni Tracking and Information System</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Template CSS Files
        ================================================== -->
        <!-- Twitter Bootstrs CSS -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <!-- Ionicons Fonts Css -->
        <link rel="stylesheet" href="../css/ionicons.min.css">
        <!-- animate css -->
        <link rel="stylesheet" href="../css/animate.css">
        <!-- Hero area slider css-->
        <link rel="stylesheet" href="../css/slider.css">
        <!-- owl craousel css -->
        <link rel="stylesheet" href="../css/owl.carousel.css">
        <link rel="stylesheet" href="../css/owl.theme.css">
        <link rel="stylesheet" href="../css/jquery.fancybox.css">
        <!-- template main css file -->
        <link rel="stylesheet" href="../css/main.css">
        <!-- responsive css -->
        <link rel="stylesheet" href="../css/responsive.css">
        
        <!-- Template Javascript Files
        ================================================== -->
        <!-- modernizr js -->
        <script src="../js/vendor/modernizr-2.6.2.min.js"></script>
        <!-- jquery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!-- owl carouserl js -->
        <script src="../js/owl.carousel.min.js"></script>
        <!-- bootstrap js -->

        <script src="../js/bootstrap.min.js"></script>
        <!-- wow js -->
        <script src="../js/wow.min.js"></script>
        <!-- slider js -->
        <script src="../js/slider.js"></script>
        <script src="../js/jquery.fancybox.js"></script>
        <!-- template main js -->
        <script src="../js/main.js"></script>
		<script type="text/javascript" src="../js/script.js"></script> 
    </head>
    <body>
        <!--
        ==================================================
        Header Section Start
        ================================================== -->
        <header id="top-bar" class="navbar-fixed-top animated-header">
            <div class="container">
                <div class="navbar-header">
                    <!-- responsive nav button >
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <!-- /responsive nav button -->
                    
                    <!-- logo -->
                    <div class="navbar-brand">
                        <a href="index.php" >
                            <img src="../images/logo.png" alt="">
                        </a>
                    </div>
				</div>
            </div>
        </header>
        <!--
        ==================================================
        Global Page Section Start
        ================================================== -->
		
        <section id="blog-full-width">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 contents">
						
						<article class="wow fadeInDown opportunity-corner" data-wow-delay=".3s" data-wow-duration="500ms">
							<div class="settings-title text-center">
                                <h2 class="settings-title">STEP 7 OF 11: HONORS AND AWARDS</h2>
                            </div>
							<br>
							<br>
						</article>
						
						<article class="article-center">
						<form action="#" class="form center-block" method="post" class="l-form">
							<?php include ('../php/signup-honors-awards-php.php') ;?>
						
						<div class = "row panel">
							<div class = "col-sm-12 wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".5s">
							
								<br>
								
								<table id="dataTable" class="form" style = "width:100%;">
									<tbody>
										<tr>
										<p>
											<td>
												<div class="col-sm-1">
												<input type="checkbox" required="required" name="chk[]" checked="checked" />
												</div>
											</td>
											<td>
												<div class="col-sm-12"><div class="row">
													<br>
													<div class = "desc-name col-sm-3">
														<h5><b>Honor/Award name:</b>  <i>*</i></h5>
													</div>
													<div class="description col-sm-9">
														<input type="text" name="ha-name[]" placeholder="Please input your Company Name..." class="r-form-major form-control" spellcheck="false" required>
													</div>
												</div></div>
							
												<hr>
						
												<div class="col-sm-12"><div class="row">
													<br>
													<div class = "desc-name col-sm-3">
														<h5><b>Associated with:</b></h5>
													</div>
													<div class="description col-sm-9">
														<i style = "font-size: 12px">(School, Organization, Company, and etc...)</i>
															<input type="text" name="ha-associated[]" placeholder="School, Organization, Company, and etc..." class="r-form-major form-control" spellcheck="false">
													
															<!--select name="ha-associated[]" class="r-form-major form-control" spellcheck="false" required>
																<?php
																	$userid = Login::isloggedin();
																	$user_education = DB::query('SELECT DISTINCT * FROM alumni.education WHERE userid = :userid ORDER BY schname ASC', array(':userid' => $userid));
																	foreach ($user_education as $q){
																		echo '<option value = "' .$q['schname'].'">' .$q['schname'].'</option>';
																	}
																?>
																<?php
																	$userid = Login::isloggedin();
																	$user_job_hist = DB::query('SELECT DISTINCT company FROM alumni.jobhistory WHERE alumniid = :userid ORDER BY company ASC', array(':userid' => $userid));
																	foreach ($user_job_hist as $q){
																		echo '<option value = "' .$q['company'].'">' .$q['company'].'</option>';
																	}
																?>
																<?php
																	$userid = Login::isloggedin();
																	$user_organizaation = DB::query('SELECT DISTINCT orgname FROM alumni.organizations WHERE alumniid = :userid ORDER BY orgname ASC', array(':userid' => $userid));
																	foreach ($user_organizaation as $q){
																		echo '<option value = "' .$q['orgname'].'">' .$q['orgname'].'</option>';
																	}
																?>
																</select-->
													</div>
												</div></div>
							
												<hr>
												
												<div class="col-sm-12"><div class="row">
													<br>
													<div class = "desc-name col-sm-3">
														<h5><b>Issuer:</b>  <i>*</i></h5>
													</div>
													<div class="description col-sm-9">
														<input type="text" name="ha-issuer[]" placeholder="Please input the Honor/Award Issuer..." class="r-form-major form-control" spellcheck="false" required>
													</div>
												</div></div>
							
												<hr>
							
												<div class="col-sm-12"><div class="row">
													<br>
													<div class = "desc-name col-sm-3">
														<h5><b>Date Issued:</b>  <i>*</i></h5>
													</div>
													<div class="description col-sm-9">
														<div class = 'col-sm-5'>
															<div class = 'row'>
															Month:<select name="ha-month[]" class="r-form-major form-control" spellcheck="false" required>
																<option>January</option>
																<option>Febuary</option>
																<option>March</option>
																<option>April</option>
																<option>May</option>
																<option>June</option>
																<option>July</option>
																<option>August</option>
																<option>September</option>
																<option>October</option>
																<option>November</option>
																<option>December</option>
															</select>
															</div>
														</div>
									
														<div class='col-sm-2'>
															<br>
														</div>
									
														<div id = "job-end" class = 'col-sm-5'>
															<div class = 'row'>
															Year:<select name="ha-year[]"  class="r-form-major form-control" spellcheck="false" required>
																<?php
																	for ($i = date("Y"); $i > 1910 - 1; $i--){
																		$e = $i + 1;
																		echo '<option value = "' .$i.'">' .$i.'</option>';
																	}
																?>
															</select>
															</div>
														</div>
														<div class = "col-sm-12">
														<br>
														<br>
														<br>
														<br>
														</div>
													</div>
												</div></div>
							
												<br>
											</td>
										</p>
										</tr>
									</tbody>
								</table>
							
							</div>
						</div>
						
						<div class="col-sm-6 wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".9s">
							<br>
							<p> 
								<input type="button" value="Add Certification" onClick="addRow('dataTable')" /> 
								<input type="button" value="Remove Certificatioon" onClick="deleteRow('dataTable')"  /> 
								<p style="font-size:12px">(All actions apply only to entries with check marked check boxes only.)</p>
							</p>
						</div>
						
						<div class="col-sm-6 wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".9s" style = "text-align:right;">
							<br>
							<input type = "submit" class="btn btn-primary btn-sm" name="submit-signup-honors-awards" value="Save and Go to Next Step"></input>
							<div class="col-sm-1">
								<br>
							</div>
							<a href="signup-skills.php"><button class="btn btn-sm" role="button" data-toggle="modal" aria-hidden="true">
								<h5>Skip and Go to Next Step</h5>
							</button></a>
							<br>
							<br>
							<br>
							<br>
						</div>
						
						</form>
						</article>
						
                    </div>
                </div>
        </section>
        <!--
        ==================================================
        Footer Section Start
        ================================================== -->
        <footer id="footer">
            <div class="container">
                <div class="col-md-8">
                    <p class="copyright">Copyright: <span>2015</span> . Design and Developed by <a href="http://www.Themefisher.com">Themefisher</a></p>
                </div>
                <div class="col-md-4">
                    <!-- Social Media -->
                    <ul class="social">
                        <li>
                            <a href="#" class="Facebook">
                                <i class="ion-social-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="Twitter">
                                <i class="ion-social-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="Linkedin">
                                <i class="ion-social-linkedin"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="Google Plus">
                                <i class="ion-social-googleplus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer> <!-- /#footer -->
	
    </body>
</html>
</html>