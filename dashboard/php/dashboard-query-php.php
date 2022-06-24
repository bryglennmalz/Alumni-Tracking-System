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

	//QUERY FOR TOTAL OF ALUMNI ACCOUNCTS
	$cnt_alumniusers =("SELECT alumni_id FROM alumni");
		
		$pdo_cntForum_Res = $pdoConnect ->prepare($cnt_alumniusers);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$cnt_alumni_users = $pdo_cntForum_Res->rowCount();

	//QUERY FOR TOTAL OF ALUMNI ACCOUNCTS ACTIVATED
	$cnt_alumniusersactive =("SELECT alumni_id FROM alumni WHERE verified = 1");
		$pdo_cntForum_Res = $pdoConnect ->prepare($cnt_alumniusersactive);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$cnt_alumni_users_active = $pdo_cntForum_Res->rowCount();

	//QUERY FOR TOTAL OF ALUMNI ACCOUNCTS LOGGED IN
	$cnt_alumniloggedin =("SELECT DISTINCT(alumni_id) FROM alumni_logintokens");
		$pdo_cntForum_Res = $pdoConnect ->prepare($cnt_alumniloggedin);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$cnt_alumni_loggedin = $pdo_cntForum_Res->rowCount();

	//QUERY FOR TOTAL OF NEWLY ACTIVATED ACCOUNTS
	$cnt_alumniactivetoday =("SELECT alumni_id FROM alumni WHERE datetime_ver = Date('m-d-Y')");
		$pdo_cntForum_Res = $pdoConnect ->prepare($cnt_alumniactivetoday);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$cnt_alumni_active_today = $pdo_cntForum_Res->rowCount();



	//QUERY FOR TOTAL OF ADMINISTRATOR ACCOUNTS ACTIVATED
	$cnt_adminusers =("SELECT admin_id FROM admin");
		$pdo_cntForum_Res = $pdoConnect ->prepare($cnt_adminusers);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$cnt_admin_users = $pdo_cntForum_Res->rowCount();


	//QUERY FOR TOTAL OF ADMINISTRATOR ACCOUNTS ACTIVATED
	$cnt_adminusersactive =("SELECT admin_id FROM admin WHERE verified = 1");
		$pdo_cntForum_Res = $pdoConnect ->prepare($cnt_adminusersactive);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$cnt_admin_users_active = $pdo_cntForum_Res->rowCount();

	//QUERY FOR TOTAL OF ADMIN ACCOUNCTS LOGGED IN
	$cnt_adminloggedin =("SELECT DISTINCT(admin_id) FROM admin_logintokens");
		$pdo_cntForum_Res = $pdoConnect ->prepare($cnt_adminloggedin);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$cnt_admin_loggedin = $pdo_cntForum_Res->rowCount();



	//QUERY FOR TOTAL NUMBER OF FORUMS
	$cntforums =("SELECT forum_id FROM forum");
		$pdo_cntForum_Res = $pdoConnect ->prepare($cntforums);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$cnt_forum = $pdo_cntForum_Res->rowCount();

	//QUERY FOR TOTAL NUMBER OF FORUMS INTERACTION
	$cntforumreact =("SELECT DISTINCT(alumni_id) FROM forum_react WHERE DATE_FORMAT(forum_react.datetime,'m-d-Y') = DATE_FORMAT(Now(),'m-d-Y')");
		$pdo_cntForum_Res = $pdoConnect ->prepare($cntforumreact);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$cnt_forum_react = $pdo_cntForum_Res->rowCount();

	$cntforumcomment =("SELECT DISTINCT(alumni_id) FROM forum_comment WHERE DATE_FORMAT(forum_comment.datetime,'m-d-Y') = DATE_FORMAT(Now(),'m-d-Y')");
		$pdo_cntForum_Res = $pdoConnect ->prepare($cntforumcomment);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$cnt_forum_comment = $pdo_cntForum_Res->rowCount();

		$cnt_forum_interact = 0;
		$cnt_forum_interact = $cnt_forum_comment + $cnt_forum_react;


	//QUERY FOR TOTAL NUMBER OF POLLS
	$cntpolls =("SELECT poll_id FROM poll WHERE DATE_FORMAT(poll.date_end,'m-d-Y') >= DATE_FORMAT(Now(),'m-d-Y')");
		$pdo_cntForum_Res = $pdoConnect ->prepare($cntpolls);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$cnt_poll = $pdo_cntForum_Res->rowCount();

	//QUERY FOR TOTAL NUMBER OF POLL INTERACTIONS
	$cntpollinteract=("SELECT id FROM poll_votes");
		$pdo_cntForum_Res = $pdoConnect ->prepare($cntpollinteract);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$cnt_poll_interact = $pdo_cntForum_Res->rowCount();


	//QUERY FOR TOTAL NUMBER OF ACTIVE SURVEYS
	$cntsurvey =("SELECT survey_id FROM survey WHERE DATE_FORMAT(datetime_end,'m-d-Y') >= DATE_FORMAT(Now(),'m-d-Y')");
		$pdo_cntForum_Res = $pdoConnect ->prepare($cntsurvey);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$cnt_survey = $pdo_cntForum_Res->rowCount();

	//QUERY FOR TOTAL SURVEY INTERACTIONS
	$cntsurveyinteract=("SELECT DISTINCT alumni_survey_answer.survey_id, alumni_survey_answer.alumni_id FROM alumni_survey_answer");
		$pdo_cntForum_Res = $pdoConnect ->prepare($cntsurveyinteract);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$cnt_survey_interact = $pdo_cntForum_Res->rowCount();


	//QUERY FOR TOTAL NUMBER OF ONGOING EVENTS
	$cntevents =("SELECT event_id FROM events WHERE DATE_FORMAT(event_date,'m-d-Y') >= DATE_FORMAT(Now(),'m-d-Y')");
		$pdo_cntForum_Res = $pdoConnect ->prepare($cntevents);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$cnt_events = $pdo_cntForum_Res->rowCount();

	//QUERY FOR TOTAL EVENT INTERACTIONS
	$cnteventvote =("SELECT event_id FROM event_vote");
		$pdo_cntForum_Res = $pdoConnect ->prepare($cnteventvote);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$cnt_event_vote = $pdo_cntForum_Res->rowCount();
?>