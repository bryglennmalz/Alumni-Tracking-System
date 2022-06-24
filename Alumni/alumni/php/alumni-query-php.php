<?php
	$user_id = Login::isloggedin();
	
	$schname = "Central Mindanao University";
	$n_alumni = DB::query('SELECT * FROM alumni.education INNER JOIN alumni.alumni ON alumni.id = education.userid WHERE education.schname = :schname ORDER BY alumni.id ASC', array(':schname' => $schname));

	$id = "";
	$fname = "";
	$mname = "";
	$lname = "";
	$extname = "";
	$verified = "";
	$datetime = "";
	$progstudied = "";
	$progmajor = "";
	$major = "";
	$yeargrad = "";
	
	$schname2 = "Central Mindanao University";
	$degree = DB::query('SELECT DISTINCT education.progstudied FROM education WHERE education.schname = :schname2 ORDER BY education.progstudied ASC',array(':schname2' => $schname2));
	$progstudied = "";
	
	
	//Number of job posts query
		$jpost =("SELECT `jobpost`.`jobid` FROM alumni.`jobpost`");
		
		$pdo_cntJpost_Res = $pdoConnect ->prepare($jpost);
		$pdoExec = $pdo_cntJpost_Res -> execute();
		$pdo_jpost = $pdo_cntJpost_Res->rowCount();
?>