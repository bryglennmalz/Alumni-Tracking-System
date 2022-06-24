<?php
	
	if(isset($_POST['ChangePassword'])){
		$alumniids = $_POST['user_id'];
		$oldPassword = $_POST['oldPassword'];
		$newPassword2 = clean_text($_POST['newPassword2']);

		//CHECK LENGTH OF new PASSWORD
		if(strlen($_POST["newPassword"]) >= 6 && strlen($_POST["newPassword"]) <= 32){
			$newPassword = clean_text($_POST["newPassword"]);
		}
		else if(strlen($_POST["newPassword"]) < 6) {
			echo '<p class="text-danger">New password is too short. Minimun of 6 characters.</p>';
		}
		else if(strlen($_POST["newPassword"]) > 32) {
			echo '<p class="text-danger">New password is too long. Maximum of 32 characters.</p>';
		}


		//check if password is correct
		if (password_verify($oldPassword, DB::query('SELECT pword FROM alumni WHERE alumni_id = :alumniid', array(':alumniid' => $alumniids))[0]['pword'])){

			//check if two new password matches
			if($newPassword!=$oldPassword){

				//check if two new password matches
				if($newPassword==$newPassword2){

					DB::query('UPDATE alumni SET pword = :pword WHERE alumni_id=:alumni_id', array(':pword' => password_hash($newPassword, PASSWORD_BCRYPT), ':alumni_id'=> $alumniids));

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
						$description .= "Alumni ".$names." changed password sucessully!";
						$logtype = "Change Email";

						DB::query("INSERT INTO alumni_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $alumniids));

					echo '<p class="text-danger">Account Password has been updated.</p>';
				}
				else{
					echo "<p class='text-danger'>New password doesn't match!</p>";
				}

			}
			else{
				echo '<p class="text-danger">Please enter new password.</p>';
			}

		}
		else{
			echo '<p class="text-danger">Wrong Password.</p>';
		}
	}

?>