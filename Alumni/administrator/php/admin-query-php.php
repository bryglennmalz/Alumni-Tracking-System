<?php
	$user_id = Login::isloggedin();

	
	$very = 1;
	$n_alumni = DB::query('SELECT DISTINCT * FROM alumni.alumni WHERE alumni.verified = 1 ORDER BY alumni.datetime_verified ASC', array());

	$id = "";
	$fname = "";
	$mname = "";
	$lname = "";
	$extname = "";
	$verified = "";
	$datetime = "";
	$progstudied = "";
	$major = "";
	$yeargrad = "";
	
	//Administrators Query
		$staffs = DB::query("SELECT * FROM alumni.staff");
		$aid = "";
		$afname = "";
		$amname = "";
		$alname = "";
		$aextname = "";
		$atype = "";
	
	//Number of admins posts query
		$jpost =("SELECT `jobpost`.`jobid` FROM alumni.`jobpost`");
		
		$pdo_cntJpost_Res = $pdoConnect ->prepare($jpost);
		$pdoExec = $pdo_cntJpost_Res -> execute();
		$pdo_jpost = $pdo_cntJpost_Res->rowCount();
?>