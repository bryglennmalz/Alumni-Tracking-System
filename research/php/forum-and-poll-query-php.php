<?php
	$user_id = Login::isloggedin();
	
		//Query Forum
	$forum = DB::query('SELECT * FROM forum_poll ORDER BY forum_poll.datetime_post DESC');
	$id = "";
	$ftitle = "";
	$fdesc = "";
	$datetime = "";
	
	$schname = 'Central Mindanao University';
	//Query Staff
	$_alumni = DB::query("SELECT alumni.alumni_id AS ID, alumni.fname AS Firstname, alumni.mname AS MI, alumni.lname AS Lastname, alumni.nameext AS NameExt, alumni.datetime_ver AS DateTime, educations.year_grad AS YearGrad FROM alumni INNER JOIN educations ON alumni.id = educations.alumni_id WHERE educations.sch_name = :schname AND alumni.verified = 1", array(':schname' => $schname));

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
		$cntforums =("SELECT post_id FROM `forum_poll`");
		
		$pdo_cntForum_Res = $pdoConnect ->prepare($cntforums);
		$pdoExec = $pdo_cntForum_Res -> execute();
		$pdo_forum = $pdo_cntForum_Res->rowCount();
	
	//Number of likes query
		$cntlikes =("SELECT `forum_react`.id FROM `forum_react`");
		
		$pdo_cntLikes_Res = $pdoConnect ->prepare($cntlikes);
		$pdoExec = $pdo_cntLikes_Res -> execute();
		$pdo_forum_corner_likes = $pdo_cntLikes_Res->rowCount();
		
		//Number of comments query
		$cntcomments =("SELECT `forum_comment`.`f_comment_id` FROM `forum_comment`");
		
		$pdo_cntComment_Res = $pdoConnect ->prepare($cntcomments);
		$pdoExec = $pdo_cntComment_Res -> execute();
		$pdo_forum_corner_comments = $pdo_cntComment_Res->rowCount();
?>