<?php

	require "function.php";

	if (isset($_POST['login'])){
		$adminid = clean_text($_POST['adminid']);
		$pword = $_POST['pword'];
		$verified = 1;

		$adminids = convert_string('encrypt', $adminid);

		if(DB::query('SELECT admin_id FROM admin WHERE admin_id = :adminid', array(':adminid' => $adminids))){

			if (DB::query('SELECT verified FROM admin WHERE admin_id = :adminid AND verified = :verified', array(':adminid' => $adminids, ':verified' => $verified))){

				//verify correct account password
				if (password_verify($pword, DB::query('SELECT pword FROM admin WHERE admin_id = :adminid', array(':adminid' => $adminids))[0]['pword'])){

					$cstrong = True;
					$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

					DB::query('INSERT INTO admin_logintokens VALUES (\'\', :token, :adminid)', array(':token' =>sha1($token),':adminid' => $adminids));

					//validity  of token
					setcookie("SNID_ADMIN", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
					setcookie("SNID_AD", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

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

					$description .= convert_string('decrypt', $adhead)." ".$names." logedin sucessully!";
					$logtype = "Login";

					DB::query("INSERT INTO admin_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $adminids));

					header("location: dashboard/home.php");
				}
				else{
					echo 'Incorrect Alumni ID and/or Password.';
				}
			}
			else{
				//verify correct account password
				if (password_verify($pword, DB::query('SELECT pword FROM admin WHERE admin_id = :adminid', array(':adminid' => $adminids))[0]['pword'])){

					$cstrong = True;
					$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

					DB::query('INSERT INTO admin_logintokens VALUES (\'\', :token, :adminid)', array(':token' =>sha1($token),':adminid' => $adminids));

					//validity  of token
					setcookie("SNID_ADMIN", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
					setcookie("SNID_AD", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);


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
						$names = array(convert_string('decrypt', $adfname) , " " , convert_string('decrypt', $admname) ," ", convert_string('decrypt', $adlname));
					}
						else{
						$names = "";
						$names = array(convert_string('decrypt', $adfname) , " " , convert_string('decrypt', $admname) ," ", convert_string('decrypt', $adlname), " ", convert_string('decrypt', $adextname));
					}

					$description .= convert_string('decrypt', $adhead)." ".$names." logedin sucessully!";
					$logtype = convert_string('encrypt', "Login");

					DB::query("INSERT INTO admin_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $adminids));

					header("location: verified.php");
					//header("location: verified.php");
				}
				else{
					echo 'Incorrect Alumni ID and/or Password.';
				}
			}
		}
		else{
			echo 'Alumni ID does not registered';
		}
	}
?>
