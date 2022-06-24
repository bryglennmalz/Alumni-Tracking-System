<?php
	$userid = Login::isloggedin();
	
	//Query Alumni Name
	$userx = DB::query('SELECT * FROM alumni WHERE alumni_id = :userid', array(':userid' => $userid));
	
	$id = "";
	$fname = "";
	$mname = "";
	$lname = "";
	$extname = "";
	
	foreach($userx as $u){
		$id = $u['alumni_id'];
		$fname = $u['fname'];
		$mname = $u['mname'];
		$lname = $u['lname'];
		$extname = $u['nameext'];
		$email = $u['email'];
		$bday = $u['b_day'];
		$bmonth = $u['b_month'];
		$byear = $u['b_year'];
		$sex = $u['sex'];
		$phoneno = $u['cel_no'];
		
		$bdate = "";
		$bdate = array(convert_string('decrypt',$bmonth)," ",convert_string('decrypt',$bday),", ",convert_string('decrypt',$byear));
	}
	
	
	
?>