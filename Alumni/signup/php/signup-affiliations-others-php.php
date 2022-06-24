<?php
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	
	if(isset($_POST["operation"])){
		if ($_POST["operation"] == "Add Profile Picture"){

			$alumniid =$_POST['alumniid'];

			$loggedin = Login::isloggedin();

			if($alumniid == $loggedin){
				
			}
		}
	}
?>