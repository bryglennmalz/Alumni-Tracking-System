<?php
	ob_start();
	session_start();
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	
	//$connect = mysqli_connect("localhost", "root", "", "alumni");  
	if (isset($_POST['identifier'])){
		if (isset($_POST['adminid'])){
			if($_POST['identifier'] != '' && $_POST['adminid'] != ''){
				$eventtitle = $_POST['event-title'];
				$eventdate = $_POST['date'];
				$eventtime = $_POST['time'];
				$eventloc = $_POST['event-loc'];
				$eventdesc= $_POST['event-desc'];
				$identifier = $_POST['identifier'];
				$adminid = $_POST['adminid'];
				 
					DB::query('UPDATE alumnitracking.events SET event_title=:eventtitle, event_date=:eventdate, event_time=:eventtime, event_loc=:eventloc, event_desc=:eventdesc
								WHERE event_id=:identifier AND admin_id=:adminid', array(':eventtitle'=>$eventtitle, ':eventdate'=>$eventdate, ':eventtime'=>$eventtime,
								':eventloc'=>$eventloc, ':eventdesc'=>$eventdesc, ':identifier'=>$identifier, ':adminid'=>$adminid));
					
								
					echo "This post has been updated!";
			}	
		}
	}
?>