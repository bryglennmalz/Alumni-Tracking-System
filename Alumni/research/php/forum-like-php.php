<?php
	if (isset($_GET['forum_id'])){
		if (!DB::query('SELECT * FROM alumni.`forum-react` WHERE `forum-react`.forum_id = :forumid AND `forum-react`.user_id = :alumniid', array(':forumid' => $_GET['forum_id'], ':alumniid'=>$alid)) ){
			DB::query('INSERT INTO `forum-react` VALUES (\'\', :forumid, :alumniid)', array(':forumid' => $_GET['forum_id'], ':alumniid' => $alid));
		}
		else {
			DB::query('DELETE FROM `forum-react` WHERE `forum-react`.forum_id = :forumid AND `forum-react`.user_id = :alumniid', array(':forumid' => $_GET['forum_id'], ':alumniid' => $alid));
		}
	}
?>