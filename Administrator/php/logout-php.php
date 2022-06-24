<?php
	ob_start();
	session_start();
	
	require '../php/myconnection.php';
	require '../php/home-php.php';
	
	
	if(!Login::isloggedin()){
		
		header('location:../index.php');
		die('Not logged in.');
	}
	if (isset($_POST['logout'])){
		if (isset($_COOKIE['SNID_ADMIN'])){
			DB::query('DELETE FROM admin_logintokens WHERE token = :token', array(':token' =>sha1($_COOKIE['SNID_ADMIN'])));
		}
		else{
			echo "SNID cannot find.";
		}
		setcookie('SNID_ADMIN', '1', time()-3600);
		setcookie('SNID_AD', '1', time()-3600);
			
		header('location:../index.php');
	}
	elseif (isset($_POST['logoutAll'])){
		DB::query('DELETE FROM admin_logintokens WHERE admin_id = :userid', array(':userid' =>Login::isloggedin()));
		header('location:../index.php');
	}

?>