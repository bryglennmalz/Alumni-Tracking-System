<?php
	$user_id = Login::isloggedin();
	
	//Query Staff
	$admin = DB::query('SELECT * FROM admin WHERE admin_id = :userid', array(':userid' => $user_id));

	$id = "";
	$afname = "";
	$amname = "";
	$alname = "";
	$aextname = "";
	$ahead = "";

	foreach($admin as $s){
		$afname = $s['fname'];
		$amname = $s['mname'];
		$alname = $s['lname'];
		$aextname = $s['nameext'];
		$vercode = $s['vercode'];
		$ahead = $s['type'];
	}

	/*
	$schname = "Central Mindanao University";
	//Query Staff
	$alumni = DB::query('SELECT graduates.id AS ID, graduates.fname AS Firstname, graduates.mi AS MI, graduates.lname AS Lastname, graduates.nameext AS NameExt, graduates.verified AS Verified, education.progstudied AS Course, education.progmajor AS Major, education.yeargrad AS YearGrad FROM alumni.graduates INNER JOIN alumni.education ON graduates.id = education.userid WHERE education.schname = :schname', array(':schname' => $schname));

    /*extract($_POST);

    if(isset($size) && isset($price))
        $sql.=" WHERE size IN (".implode(',', $size).") OR price IN (".implode(',', $price).")"; 
    else if(isset($size)) 
        $sql.=" WHERE size IN (".implode(',', $size).")";

    else if(isset($price))

        $sql.=" WHERE (price IN (".implode(',', $price)."))";

    $all_row=$db->query($sql);

	$id = "";
	$fname = "";
	$mname = "";
	$lname = "";
	$extname = "";
	$verified = "";
	$progstudied = "";
	$major = "";
	$yeargrad = "";
	
	//Query Poll
	$poll = DB::query('SELECT * FROM alumni.poll ORDER BY poll.`datepost` DESC');
	$pollid = "";
	$polltitle = "";
	$polldesc = "";
	$polltype = "";
	$datepost = "";
	$dateend = "";
	
	//Query Events
	$event = DB::query('SELECT * FROM alumni.events ORDER BY events.`datetime` DESC');
	$eventid = "";
	$eventtitle = "";
	$eventdate = "";
	$eventtime = "";
	$eventloc = "";
	$eventdesc = "";
	$banner = "";
	$datetime = "";
	
	//Query Job Post
	$jobpost = DB::query('SELECT * FROM alumni.jobpost ORDER BY jobpost.`datetime` DESC');
	$jobid = "";
	$posname = "";
	$compname = "";
	$complocation = "";
	$jobdescription = "";
	$jobrequirements = "";
	$email = "";
	$contactno = "";
	$datetime = "";
	$userid = "";
	
	
	$admin_view = DB::query('SELECT * FROM alumni.staff ORDER BY staff.id ASC');

	$id = "";
	$avfname = "";
	$avmname = "";
	$avlname = "";
	$avextname = "";
	$avverified = "";

	foreach($admin_view as $av){
		$avfname = $av['fname'];
		$avmname = $av['mname'];
		$avlname = $av['lname'];
		$avextname = $av['nameext'];
		$avverified = $av['verified'];
	}*/

?>