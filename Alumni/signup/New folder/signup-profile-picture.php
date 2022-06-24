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
                                <h2 class="settings-title">STEP 11 OF 11: PROFILE PICTURE</h2>
                            </div>
							<br>
							<br>
						</article>
				
						<form action="#" class="form center-block" method="post" enctype = "multipart/form-data">
							<?php include ('../php/signup-profile-picture-php.php') ;?>
						
						<div class = "col-sm-12 wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".5s">
						
							<div class="row">
									<div class = "col-sm-12">
										<div class = "row">
											<div class = "col-sm-12" style = "text-align:center;">
												<input type = "file" name="profile-picture"></input>
											</div>
										</div>
									</div>
							</div>
							
							<hr>
						
						</div>
						
						<div class="col-sm-12 wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".9s" style = "text-align:right;">
							<br>
							<input type = "submit" class="btn btn-primary btn-sm" name="submit-signup-profile-picture" value="Save and Go to Next Step"></input>
							<div class="col-sm-1">
								<br>
							</div>
							<a href="profile.php">
								<button class="btn btn-sm" role="button">
									<h5>Skip and Go to Profile page</h5>
								</button>
							</a>
							<br>
							<br>
							<br>
							<br>
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