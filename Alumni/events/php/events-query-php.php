<?php
	$user_id = Login::isloggedin();
	
	//Query Poll
	$event = DB::query('SELECT * FROM events ORDER BY events.`event_date` DESC');
	$pollid = "";
	$polltitle = "";
	$polldesc = "";
	$polltype = "";
	$datepost = "";
	$dateend = "";
	
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
	
	//Number of events query
		$cntevent =("SELECT `events`.`eventid` FROM alumni.`events`");
		
		$pdo_cntEvent_Res = $pdoConnect ->prepare($cntevent);
		$pdoExec = $pdo_cntEvent_Res -> execute();
		$pdo_event = $pdo_cntEvent_Res->rowCount();
		
	//Number of events this year query
		$cntev_year =("SELECT `events`.`event_id` FROM `events` WHERE events.event_date BETWEEN :yearst AND :yeard");
		
		$yearst = mktime(0, 0, 0, 01, 01, date("Y"));
		$yeard = mktime(23, 59, 59, 12, 31, date("Y"));
		
		
		$pdo_cntEventy_Res = $pdoConnect ->prepare($cntev_year);
		$pdoExec = $pdo_cntEventy_Res -> execute(array(":yearst" => htmlentities(date("Y-m-d",$yearst)), ":yeard" => htmlentities(date("Y-m-d",$yeard))));
		$pdo_event_year = $pdo_cntEventy_Res->rowCount();
		
	//Number of events this month query
		$cntev_mo =("SELECT `events`.`event_id` FROM `events` WHERE events.event_date BETWEEN :yearst AND :yeard");
		
		$yearst = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
		$yeard = mktime(23, 59, 59, date("m"), 31, date("Y"));
		
		
		$pdo_cntEventm_Res = $pdoConnect ->prepare($cntev_mo);
		$pdoExec = $pdo_cntEventm_Res -> execute(array(":yearst" => htmlentities(date("Y-m-d",$yearst)), ":yeard" => htmlentities(date("Y-m-d",$yeard))));
		$pdo_event_mo = $pdo_cntEventm_Res->rowCount();
		
	//Number of events this day
		$cntev_d =("SELECT `events`.`event_id` FROM `events` WHERE events.event_date = :yearst");
		
		$yearst = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
		
		$pdo_cntEventd_Res = $pdoConnect ->prepare($cntev_d);
		$pdoExec = $pdo_cntEventd_Res -> execute(array(":yearst" => htmlentities(date("Y-m-d",$yearst))));
		$pdo_event_day = $pdo_cntEventd_Res->rowCount();

	//Number of upcomming events query
		$cntev_up =("SELECT `events`.`event_id` FROM `events` WHERE events.event_date BETWEEN :yearst AND :yeard");
		
		$yearst = strtotime("tomorrow");
		$yeard = mktime(23, 59, 59, date("m"), 31, date("Y"));
		
		
		$pdo_cntEventup_Res = $pdoConnect ->prepare($cntev_up);
		$pdoExec = $pdo_cntEventup_Res -> execute(array(":yearst" => htmlentities(date("Y-m-d",$yearst)), ":yeard" => htmlentities(date("Y-m-d",$yeard))));
		$pdo_event_up = $pdo_cntEventup_Res->rowCount();

?>