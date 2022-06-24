<?php
	$userid = Login::isloggedin();
	
	//Query Alumni Name
	$userx = DB::query('SELECT * FROM alumni WHERE alumni_id = :userid', array(':userid' => $userid));
	
	$id = "";
	$fname = "";
	$mname = "";
	$lname = "";
	$extname = "";
	
	foreach($userx as $u){
		$id = $u['alumni_id'];
	}

	//$deg_typei = DB::query('SELECT * FROM alumnitracking.deg_type WHERE id = :deg_type', array(':deg_type' => $deg_type_id));
	
	//$deg_type_id = "";
	
	//foreach($deg_typei as $d){
	//	$type_name = $d['deg_level_type_name'];
	//}
?>