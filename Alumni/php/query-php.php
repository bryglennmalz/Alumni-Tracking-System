<?php
	$userid = Login::isloggedin();
	
	//Query Alumni Name
	$user_ = DB::query('SELECT * FROM alumni WHERE alumni_id = :userid', array(':userid' => $userid));
	
	$id = "";
	$fname = "";
	$mname = "";
	$lname = "";
	$extname = "";
	
	foreach($user_ as $u){
		$alid = $u['alumni_id'];
		$alfname = $u['fname'];
		$almname = $u['mname'];
		$allname = $u['lname'];
		$alextname = $u['nameext'];
		$fb = $u['fb'];
		$google = $u['google'];
		$ig = $u['ig'];
		$linkedin = $u['linkedin'];
		$twitter = $u['twitter'];
		$website = $u['website'];
	}
	
?>