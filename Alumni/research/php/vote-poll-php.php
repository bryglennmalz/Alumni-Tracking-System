<?php
	
	//Query Alumni Name
	//$user_name = DB::query('SELECT * FROM alumni.staff WHERE id = :userid', array(':userid' => $userid));

	if (isset($_POST['vote'])){
		$choices = $_POST['choices'];
		$pollid = $_POST['pollid'];
			
		//$pchoice = $_POST['choice'];

		$userid = Login::isloggedin();
	
		DB::query('INSERT INTO alumnitracking.`poll_votes` VALUES (\'\',:choices, :pollid, Now(), :userid)', array(':choices' => $choices, ':pollid' => $pollid, ':userid' => $userid));
		
	}


?>