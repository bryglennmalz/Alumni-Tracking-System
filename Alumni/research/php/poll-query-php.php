<?php
	$user_id = Login::isloggedin();
	
	//Query Poll
	$polls = DB::query('SELECT * FROM alumnitracking.poll ORDER BY poll.`datetime_post` DESC');
	$pollid = "";
	$polltitle = "";
	$polldesc = "";
	$polltype = "";
	$datepost = "";
	$dateend = "";
	
	$very = 1;
	$n_alumni = DB::query('SELECT DISTINCT * FROM alumnitracking.alumni WHERE alumni.verified = 1 ORDER BY alumni.datetime_ver ASC', array());

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
	
	//Number of poll query
		$cntpoll =("SELECT poll.`poll_id` FROM alumnitracking.`poll`");
		
		$pdo_cntPoll_Res = $pdoConnect ->prepare($cntpoll);
		$pdoExec = $pdo_cntPoll_Res -> execute();
		$pdo_poll = $pdo_cntPoll_Res->rowCount();
	
	//Number of likes query
		$cntvotes =("SELECT `poll_votes`.`id` FROM alumnitracking.`poll_votes`");
		
		$pdo_cntVotes_Res = $pdoConnect ->prepare($cntvotes);
		$pdoExec = $pdo_cntVotes_Res -> execute();
		$pdo_poll_corner_likes = $pdo_cntVotes_Res->rowCount();

?>