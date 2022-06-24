<?php
	ob_start();
	session_start();
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	
	//$connect = mysqli_connect("localhost", "root", "", "alumni");  
	if (isset($_POST['identifier'])){
		if (isset($_POST['adminid'])){
			if($_POST['identifier'] != '' && $_POST['adminid'] != ''){
				$polltitle = $_POST['poll-title'];
				$polldate = $_POST['date'];
				$polltime = $_POST['time'];
				$identifier = $_POST['identifier'];
				$adminid = $_POST['adminid'];
				
					DB::query('UPDATE alumnitracking.poll SET question=:polltitle, date_end=:polldate, time_end=:polltime WHERE poll_id=:identifier AND admin_id=:userid',
								array(':polltitle'=>$polltitle,':polldate'=>$polldate,':polltime'=>$polltime,':identifier'=>$identifier,':userid'=>$adminid));
						
					echo "This post has been updated!";
			}	
		}
	}
?>