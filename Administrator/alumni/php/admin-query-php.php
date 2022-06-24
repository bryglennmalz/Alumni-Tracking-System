<?php
	$user_id = Login::isloggedin();
	
	//Administrators Query
		$staffs = DB::query("SELECT * FROM admin");
		$aid = "";
		$afname = "";
		$amname = "";
		$alname = "";
		$aextname = "";
		$atype = "";
?>