<?php
	$user_id = Login::isloggedin();
	
		//Query Forum
	$surveys = DB::query('SELECT * FROM survey ORDER BY survey.datetime_post DESC');

	$surveyid =  "";
    $sataffid = "";
    $surveytitle = "";
    $datepost = "";
    $dateend = "";
    $timeend = "";

	
		$schname = 'Central Mindanao University';
	//Query Staff
	$_alumni = DB::query("SELECT alumni.alumni_id AS ID, alumni.fname AS Firstname, alumni.mname AS MI, alumni.lname AS Lastname, alumni.nameext AS NameExt, alumni.datetime_ver AS DateTime, educations.year_grad AS YearGrad FROM alumni INNER JOIN educations ON alumni.alumni_id = educations.alumni_id WHERE educations.sch_name = :schname AND alumni.verified = 1", array(':schname' => $schname));

	$very = 1;
	$n_alumni = DB::query('SELECT DISTINCT * FROM alumni WHERE alumni.verified = 1 ORDER BY alumni.datetime_ver ASC', array());

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
	
	//Number of forums query
		$cntsurvey =("SELECT `survey`.survey_id FROM `survey`");
		
		$pdo_cntSurvey_Res = $pdoConnect ->prepare($cntsurvey);
		$pdoExec = $pdo_cntSurvey_Res -> execute();
		$pdo_survey = $pdo_cntSurvey_Res->rowCount();


		$q_id = "";
        $q_ono = "";
        $q_question = "";
        $q_updated = "";
        $q_typeid = "";
        $q_required = "";
        $q_uinput = "";
        $q_surveyid = "";
        $q_datetime = "";
?>