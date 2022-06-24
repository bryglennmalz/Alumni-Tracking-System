<?php
	
	if (isset($_POST['verify'])){
		$code = clean_text($_POST['code']);
		$id = $_POST['alumniid'];

		$codes = convert_string('encrypt', $code);
		$alumniids = convert_string('encrypt', $id);

		//echo $codes;
		
		if(DB::query('SELECT * FROM alumni WHERE alumni_id = :alumniid AND vercode = :vercode', array(':alumniid' => $alumniids, ':vercode' => $codes))){

			//echo "lab";
			
			DB::query('UPDATE alumni SET verified = :verified, datetime_ver = Now() WHERE alumni_id = :userid AND vercode = :vercode', array(':verified' => 1, ':userid' => $alumniids, ':vercode' => $codes));

			$admin = DB::query('SELECT * FROM alumni WHERE alumni_id = :userid', array(':userid' => $alumniids));

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
					}

					if ($adextname == null){
						$names = "";
						$names .= convert_string('decrypt', $adfname)." ".convert_string('decrypt', $admname)." ".convert_string('decrypt', $adlname);
					}
						else{
						$names = "";
						$names .= convert_string('decrypt', $adfname)." ".convert_string('decrypt', $admname)." ".convert_string('decrypt', $adlname)." ".convert_string('decrypt', $adextname);
					}
					$description="";
					$logtype="";
					$description .= "Alumni ".$names." activated the account sucessully!";
					$logtype = "Login";

					DB::query("INSERT INTO alumni_logs (log_type, description, date_time, alumni_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $alumniids));
			
			header('Location: signup/signup-basic-information.php');
		}
		else{
			echo '<p class="text-danger">Code is incorret.</p>';
		}
	}
?>