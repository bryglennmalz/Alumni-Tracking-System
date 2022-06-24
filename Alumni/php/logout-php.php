<?php
	ob_start();
	session_start();
	
	require '../php/myconnection.php';
	require '../php/home-php.php';
	$userid = "";
	
	if(!Login::isloggedin()){

		
		header('location:../index.php');
		die('Not logged in.');
	}
	else{
		$userid = Login::isloggedin();

	}
	if (isset($_POST['logout'])){
		if (isset($_COOKIE['SNID'])){
			DB::query('DELETE FROM alumni_logintokens WHERE token = :token', array(':token' =>sha1($_COOKIE['SNID'])));
		}
		setcookie('SNID', '1', time()-3600);
		setcookie('SNID_', '1', time()-3600);

		$admin = DB::query('SELECT * FROM alumni WHERE alumni_id = :userid', array(':userid' => $adminids));

					$id = "";
					$adfname = "";
					$admname = "";
					$adlname = "";
					$adextname = "";
					$adhead = "";

					foreach($admin as $s){
						$adfname = $s['fname'];
						$admname = $s['mname'];
						$adlname = $s['lname'];
						$adextname = $s['nameext'];
						$adhead = $s['type'];
					}

					if ($adextname == null){
						$names = "";
						$names .= convert_string('decrypt', $adfname)." ".convert_string('decrypt', $admname)." ".convert_string('decrypt', $adlname);
					}
						else{
						$names = "";
						$names .= convert_string('decrypt', $adfname)." ".convert_string('decrypt', $admname)." ".convert_string('decrypt', $adlname)." ".convert_string('decrypt', $adextname);
					}

					$description .= "Alumni ".$names." logged out!";
					$logtype = "Pre-register";

					DB::query("INSERT INTO alumni_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $adminids));
			
		header('location:../index.php');
	}
	elseif (isset($_POST['logoutAll'])){
		DB::query('DELETE FROM alumni_logintokens WHERE alumni_id = :userid', array(':userid' =>Login::isloggedin()));

		$admin = DB::query('SELECT * FROM admin WHERE admin_id = :userid', array(':userid' => $adminids));

					$id = "";
					$adfname = "";
					$admname = "";
					$adlname = "";
					$adextname = "";
					$adhead = "";

					foreach($admin as $s){
						$adfname = $s['fname'];
						$admname = $s['mname'];
						$adlname = $s['lname'];
						$adextname = $s['nameext'];
						$adhead = $s['type'];
					}

					if ($adextname == null){
						$names = "";
						$names .= convert_string('decrypt', $adfname)." ".convert_string('decrypt', $admname)." ".convert_string('decrypt', $adlname);
					}
						else{
						$names = "";
						$names .= convert_string('decrypt', $adfname)." ".convert_string('decrypt', $admname)." ".convert_string('decrypt', $adlname)." ".convert_string('decrypt', $adextname);
					}

					$description .= "Alumni ".$names." logged out on all devices!";
					$logtype = "Pre-register";

					DB::query("INSERT INTO alumni_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $adminids));

		header('location:../index.php');
	}

?>