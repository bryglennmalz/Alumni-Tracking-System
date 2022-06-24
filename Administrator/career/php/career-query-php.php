<?php
	$user_id = Login::isloggedin();

	//Query Poll
	$jposts = DB::query('SELECT * FROM job_post ORDER BY job_post.`date_time` DESC');
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

	$very = 1;
	$n_alumni = DB::query('SELECT DISTINCT * FROM alumni WHERE verified = 1 ORDER BY datetime_ver ASC', array());

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

	//Number of job posts query
		$jpost =("SELECT `job_post`.`job_post_id` FROM `job_post`");

		$pdo_cntJpost_Res = $pdoConnect ->prepare($jpost);
		$pdoExec = $pdo_cntJpost_Res -> execute();
		$pdo_jpost = $pdo_cntJpost_Res->rowCount();
?>
