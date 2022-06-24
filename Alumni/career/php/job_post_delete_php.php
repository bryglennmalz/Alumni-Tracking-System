<?php
	ob_start();
	session_start();
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	
	$connect = mysqli_connect("localhost", "root", "", "alumnitracking");  
	
	if (isset($_POST['careerid'])){
		
		DB::query("DELETE FROM alumnitracking.job_post WHERE job_post_id = :id",
				array(":id"=>$_POST['careerid']));
		
		
		
		header("location:career-bulletin.php");
		echo "This post has been deleted.";
	}
?>