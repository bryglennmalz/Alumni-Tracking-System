<?php
	//require "function.php";

	if (isset($_POST['verify'])){
		$code = $_POST['code'];
		$adminid=$_POST['adminid'];

		$codes = convert_string('encrypt', $code);
		$adminids = convert_string('encrypt', $adminid);

		if( DB::query('SELECT vercode FROM admin WHERE admin_id = :adminid AND vercode = :vercode', array(':adminid' => $adminid, ':vercode' => $codes))){

			DB::query('UPDATE admin SET verified = :verified, datetime_ver = Now() WHERE admin_id = :userid AND vercode = :vercode', array(':verified' => 1, ':userid' => $adminid, ':vercode' => $codes));

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

			$description .= convert_string('decrypt', $adhead)." ".$names." vrified account sucessully!";
			$logtype = "Login";

			DB::query("INSERT INTO admin_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $adminids));


			header('Location: dashboard/home.php');
		}
		else{
			echo "Invalid Code.";
		}
	}
?>
