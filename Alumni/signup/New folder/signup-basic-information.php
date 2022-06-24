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
		
		<script type = "text/javascript">
			function change_country(){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.open("GET", "ajaxData.php?countrydd="+document.getElementById("country").value,false);
				xmlhttp.send(null);
				document.getElementById("province").innerHTML=xmlhttp.responseText;
			}
			
			/*$(document).ready(function(){
				$(#country).on('change',function(){
					var countryID = $(this).val();
					if(countryID){
						$.ajax({
							type:'POST',
							url:'ajaxData.php',
							data:'id =' countryID,
							success:function(html){
								$('#province').html(html);
								$('#city-municipality').html('<option>Select State/Province first.</option>');
							}
						});
					}
				}
				else{
					$('#province').html('<option>Select Country first.</option>');
							$('#city-municipality').html('<option>Select State/Province first.</option>');
				}
				
				$(#province).on('change',function(){
					var stateID = $(this).val();
					if(stateID){
						$.ajax({
							type:'POST',
							url:'ajaxData.php',
							data:'id =' stateID,
							success:function(html){
								$('#city-municipality').html(html);
							}
						});
					}
				}
				else{
					$('#city-municipality').html('<option>Select State/Province first.</option>');
				}
			});*/
		</script>
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
                                <h2 class="settings-title">STEP 1 OF 11: BASIC INFORMATION</h2>
                            </div>
							<br>
							<br>
						</article>
						<form action="#" class="form center-block" method="post" class="l-form">
							<?php include ('../php/signup-basic-information-php.php') ;?>
						
						<div class = "col-sm-6 wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".5s">
							<div class="row">
								<div class = "desc-name col-sm-3">
									<h5><b>Civil Status:</b> <i>*</i></h5>
								</div>
								<div class="description col-sm-9">
									<select name="civil-stat" placeholder="Civil Status" class="l-form-dbay-month form-control" required>
									<option>Single</option>
									<option>Maried</option>
									<option>Divorced/Anulled</option>
									<option>Widdowed</option>
								</select>
								</div>
							</div>
							
							<hr>
							
							<div class="row">
								<div class = "desc-name col-sm-3">
									<h5><b>Ethnicity:</b></h5>
								</div>
								<div class="description col-sm-9">
									<input type="text" name="ethnicity" placeholder="Please input your ethnicity..." class="r-form-major form-control" spellcheck="false" >
								</div>
							</div>
							
							<hr>
						
							<div class="row">
								<div class = "desc-name col-sm-3">
									<h5><b>Nationality:</b>  <i>*</i></h5>
								</div>
								<div class="description col-sm-9">
									<input type="text" name="nationality" placeholder="Please input your nationality..." class="r-form-major form-control" spellcheck="false" required>
								</div>
							</div>
							
							<hr>
							
							<div class="row">
								<div class = "desc-name col-sm-3">
									<h5><b>Religion:</b>  <i>*</i></h5>
								</div>
								<div class="description col-sm-9">
									<input type="text" name="religion" placeholder="Please input your religion..." class="r-form-major form-control" spellcheck="false" required>
								</div>
							</div>
							
							<hr>
						
							<div class="row">
								<div class = "desc-name col-sm-3">
									<h5><b>Contact No:</b>  <i>*</i></h5>
								</div>
								<div class="description col-sm-9">
									<input type="text" name="cp-no" placeholder="Please input your contact number..." class="r-form-major form-control" spellcheck="false" required>
								</div>
							</div>
							
							<hr>
							
							<div class="row">
								<div class = "desc-name col-sm-3">
									<h5><b>Telephone No:</b></h5>
								</div>
								<div class="description col-sm-9">
									<input type="text" name="tel-no" placeholder="Please input your telephone number..." class="r-form-major form-control" spellcheck="false" >
								</div>
							</div>
								
							<hr>
							
						</div>
						
						<div class = "col-sm-6 wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".5s">
							<div class="row">
								<div class = "desc-name col-sm-3">
									<h5><b>Employment status:</b></h5>
								</div>
								<div class="description col-sm-9">
									<select name="employ" class="r-form-major form-control">
										<option>Employed</option>
										<option>Unemployed</option>
										<option>Under-employed</option>
									</select>
								</div>
							</div>
								
							<hr>
							
							<div class="row">
								<div class = "desc-name col-sm-3">
									<h5><b>Home Address:</b>  <i>*</i></h5>
								</div>
								<div class="description col-sm-9">
									<div class="form-group">
												<label class="sr-only" for="bday">Country</label>
												<h6>Country:</h6>
												<select type="text" id="country" name="country" onchange = "change_country" placeholder="Please input your Country..." class="country form-control" spellcheck="false" >
													<?php 
														$query = DB::query('SELECT c_id, cname FROM country ORDER BY cname ASC');
														$rowCount = DB::query('SELECT COUNT(c_id) FROM country ORDER BY cname ASC');
														
															if ($rowCount != 0){
																foreach($query as $c){
																echo "<option value = ". $c['c_id'].">" . $c['cname']. "</option>";
																}
															}
															else{
																echo "<option>Country is not available.</option>";
															}
													?>
												</select>
												<br>
									</div>
									<div class="form-group">
												<label class="sr-only" for="bday">Province</label>
												<h6>Province/State:</h6>
												<select id="province" name="province" placeholder="Please input your Province..." class="province form-control" spellcheck="false" >
													<option>Please select a Country First.</option>
												</select>
												<br>
									</div>
									<div class="form-group">
												<label class="sr-only" for="bday">City/Municipality</label>
												<h6>City/Municipality:</h6>
												<select id="city-municipality" name="city-municipality" placeholder="Please input your City/Municipality..." class="city-municipality form-control" spellcheck="false" >
													<option>Please select a Province/State first.</option>
												</select>
												<br>
									</div>
									<div class="form-group">
												<label class="sr-only" for="bday">Country</label>
												<h6>Other Information:</h6>
												<input type="text" name="other-address" placeholder="..." class="r-form-major form-control" spellcheck="false" >
												<br>
									</div>
								</div>
							</div>
							
						</div>
						
						<div class="col-sm-12 wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".9s" style = "text-align:right;">
								<br>
								<br>
								<input type = "submit" class="btn btn-primary btn-sm" name="submit-signup-basic-info" value="Save and Go to Next Step"></input>
						</div>
						
						</form>
						
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