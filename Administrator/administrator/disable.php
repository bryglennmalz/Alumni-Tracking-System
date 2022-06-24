<?php
	ob_start();
	session_start();
	
	require '../php/myconnection.php';
	require '../php/home-php.php';
	include('db.php');
	include("function.php");
	
	
	if(isset($_POST["user_id"])){
		DB::query("UPDATE alumnitracking.admin SET verified =:ver WHERE admin_id = :id", array(":ver"=> 2, ":id"=> $_POST["user_id"]));
		echo "Admin ", convert_string('decrypt',$_POST["user_id"]), " cannot login and visit the site.";
	}
?>