<?php
	ob_start();
	session_start();
	
	require '../php/myconnection.php';
	require '../php/home-php.php';
    require '../php/function.php';

    if (isset($_POST['liked'])) {
		$forumids = $_POST['forum_ids'];
		$remarks = "going";
		
		DB::query('INSERT INTO `event_vote` VALUES (\'\', :eventid, :alumniid, :remarks)', array(':eventid' => $eventid, ':alumniid' => $alid, ':remarks' => $remarks));
												
		//Alumni Forum Likers
		$likes_alumni = DB::query("SELECT DISTINCT alumni.alumni_id AS id, alumni.fname AS fname, alumni.mname AS mname, alumni.lname AS lname, alumni.nameext AS nameext FROM alumnitracking.alumni , alumnitracking.forum , alumnitracking.`forum_react` WHERE `forum_react`.forum_id = :forumid AND `forum_react`.alumni_id = alumni.alumni_id", array(':forumid' => $forumids));
			
		//Number of likes query
		$cntlikes2 =("SELECT `forum_react`.id FROM alumnitracking.`forum_react` WHERE `forum_react`.forum_id = :fid");
			
		$pdo_cntLikes2_Res = $pdoConnect ->prepare($cntlikes2);
		$pdoExec = $pdo_cntLikes2_Res -> execute(array(':fid' => $_GET['forumid']));
		$pdo_forum_likes = $pdo_cntLikes2_Res->rowCount();
												
		exit();
	}
	if (isset($_POST['unliked'])) {
		$forumids = $_POST['forum_ids'];
		
		DB::query('DELETE FROM forum_react WHERE forum_id = :forumid AND alumni_id = :alumniid', array(':forumid' => $forumids, ':alumniid' => $alid));
		
		//DELETE FROM forum_react WHERE forum_id = :forumid AND user_id = :alumniid
		
		//Alumni Forum Likers
		$likes_alumni = DB::query("SELECT DISTINCT alumni.alumni_id AS id, alumni.fname AS fname, alumni.mname AS mname, alumni.lname AS lname, alumni.nameext AS nameext FROM alumnitracking.alumni , alumnitracking.forum , alumnitracking.`forum_react` WHERE `forum_react`.forum_id = :forumid AND `forum_react`.alumni_id = alumni.alumni_id", array(':forumid' => $forumids));
		
		//Number of likes query
			$cntlikes2 =("SELECT `forum_react`.id FROM alumnitracking.`forum_react` WHERE `forum_react`.forum_id = :fid");
			
			$pdo_forum_likes=0;
			$pdo_cntLikes2_Res = $pdoConnect ->prepare($cntlikes2);
			$pdoExec = $pdo_cntLikes2_Res -> execute(array(':fid' => $_GET['forumid']));
			$pdo_forum_likes = $pdo_cntLikes2_Res->rowCount();
		
		exit();
	}
	
	if (isset($_POST['goings'])) {
		$eventid = $_POST['event_ids'];
		$remarks = "Going";
		
		DB::query('INSERT INTO `event_vote` VALUES (\'\', :eventid, :alumniid, :remarks)', array(':eventid' => $eventid, ':alumniid' => $alid, ':remarks' => $remarks));
		
		//Number of likes query
		$cntgoing =("SELECT `event_vote`.id FROM alumnitracking.`event_vote` WHERE `event_vote`.event_id = :fid AND remarks =:remarks");
			
		$pdo_cntGoing_Res = $pdoConnect ->prepare($cntgoing);
		$pdoExec = $pdo_cntGoing2_Res -> execute(array(':fid' => $_GET['eventid'], ':remarks' => $remarks));
		$pdo_cntgoings = $pdo_cntGoing2_Res->rowCount();
												
		//exit();
	}
	
	if (isset($_POST['interesteds'])) {
		$eventid = $_POST['event_ids'];
		$remarks = 'Interested';
		
		DB::query('INSERT INTO `event_vote` VALUES (\'\', :eventid, :alumniid, :remarks)', array(':eventid' => $eventid, ':alumniid' => $alid, ':remarks' => $remarks));
			
		//Number of likes query
		$cntinterested =("SELECT `event_vote`.id FROM `event_vote` WHERE `event_vote`.event_id = :fid AND remarks =:remarks");
			
		$pdo_cntGoing_Res = $pdoConnect ->prepare($cntinterested);
		$pdoExec = $pdo_cntInterested_Res -> execute(array(':fid' => $_GET['eventid'], ':remarks' => $remarks));
		$pdo_cntinteresteds = $pdo_cntInterested_Res->rowCount();
												
		exit();
	}
	
	if (isset($_POST['notnows'])) {
		$eventid = $_POST['event_ids'];
		$remarks = 'Not Now';
		
		DB::query('INSERT INTO `event_vote` VALUES (\'\', :eventid, :alumniid, :remarks)', array(':eventid' => $eventid, ':alumniid' => $alid, ':remarks' => $remarks));
			
		//Number of likes query
		$cntnotnow =("SELECT `event_vote`.id FROM `event_vote` WHERE `event_vote`.event_id = :fid AND remarks =:remarks");
			
		$pdo_cntNotNow_Res = $pdoConnect ->prepare($cntnotnow);
		$pdoExec = $pdo_cntNotNow_Res -> execute(array(':fid' => $_GET['eventid'], ':remarks' => $remarks));
		$pdo_cntnotnows = $pdo_cntNotNow_Res->rowCount();
												
		exit();
	}
	
	if (isset($_POST['editgoings'])) {
		$eventid = $_POST['event_ids'];
		$remarks = 'Going';
		
		DB::query('UPDATE `event_vote` SET remarks = :remarks WHERE event_id = :eventid AND alumni_id = :alumniid', array(':remarks' => $remarks, ':eventid' => $eventid, ':alumniid' => $alid));
			
		//Number of likes query
		$cntgoing =("SELECT `event_vote`.id FROM alumnitracking.`event_vote` WHERE `event_vote`.event_id = :fid AND remarks =:remarks");
			
		$pdo_cntGoing_Res = $pdoConnect ->prepare($cntgoing);
		$pdoExec = $pdo_cntGoing2_Res -> execute(array(':fid' => $_GET['eventid'], ':remarks' => $remarks));
		$pdo_cntgoings = $pdo_cntGoing2_Res->rowCount();
												
		exit();
	}
	
	if (isset($_POST['editinteresteds'])) {
		$eventid = $_POST['event_ids'];
		$remarks = 'Interested';
		
		DB::query('UPDATE `event_vote` SET remarks = :remarks WHERE event_id = :eventid AND alumni_id = :alumniid', array(':remarks' => $remarks, ':eventid' => $eventid, ':alumniid' => $alid));
		
		//Number of likes query
		$cntinterested =("SELECT `event_vote`.id FROM alumnitracking.`event_vote` WHERE `event_vote`.event_id = :fid AND remarks =:remarks");
			
		$pdo_cntGoing_Res = $pdoConnect ->prepare($cntinterested);
		$pdoExec = $pdo_cntInterested_Res -> execute(array(':fid' => $_GET['eventid'], ':remarks' => $remarks));
		$pdo_cntinteresteds = $pdo_cntInterested_Res->rowCount();
												
		exit();
	}
	
	if (isset($_POST['editnotnows'])) {
		$eventid = $_POST['event_ids'];
		$remarks = 'Not Now';
		
		DB::query('UPDATE `event_vote` SET remarks = :remarks WHERE event_id = :eventid AND alumni_id = :alumniid', array(':remarks' => $remarks, ':eventid' => $eventid, ':alumniid' => $alid));
		
		//Number of likes query
		$cntnotnow =("SELECT `event_vote`.id FROM alumnitracking.`event_vote` WHERE `event_vote`.event_id = :fid AND remarks =:remarks");
			
		$pdo_cntNotNow_Res = $pdoConnect ->prepare($cntnotnow);
		$pdoExec = $pdo_cntNotNow_Res -> execute(array(':fid' => $_GET['eventid'], ':remarks' => $remarks));
		$pdo_cntnotnows = $pdo_cntNotNow_Res->rowCount();
												
		exit();
	}

?>