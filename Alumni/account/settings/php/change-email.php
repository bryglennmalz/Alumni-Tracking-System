<?php

	if (isset($_POST['ChangeEmail'])){
		$alumniids = $_POST['user_id'];
		$oldEmail = $_POST['oldEmail'];
		$newEmail = $_POST['newEmail'];
		$password = $_POST['password'];

		//check if old email is for the certain user
		if(DB::query('SELECT email FROM alumni WHERE alumni_id = :alumniid AND email = :oldEmail', array(':alumniid' => $alumniids, ':oldEmail' => convert_string('encrypt', $oldEmail)))){

			//check if new email is already existed
			if(!DB::query('SELECT email FROM alumni WHERE email = :newEmail', array(':newEmail' => convert_string('encrypt', $newEmail)))){

				//check if password is correct
				if (password_verify($password, DB::query('SELECT pword FROM alumni WHERE alumni_id = :alumniid', array(':alumniid' => $alumniids))[0]['pword'])){

					DB::query('UPDATE alumni SET email = :email WHERE alumni_id=:alumni_id', array(':email' => convert_string('encrypt', clean_text($newEmail)), ':alumni_id'=> $alumniids));

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

					$description="";
					$description .= "Alumni ".$names." changed email sucessully!";
					$logtype = "Change Email";

					DB::query("INSERT INTO alumni_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $alumniids));

					echo '<p class="text-primary">You have successully changed your email.</p>';
				}
				else{
					echo '<p class="text-danger">Wrong email or password.</p>';
				}
			}
			else{
				echo '<p class="text-danger">This email is already existed.</p>';
			}
		}
		else{
			echo '<p class="text-danger">This is not your email.</p>';
		}
	}
?>