<?php
	require "function.php";
	//require "myconnection.php";
	
	if (isset($_POST['login'])){
		$alumniids = clean_text($_POST['alumniid']);
		$pword = $_POST['pass'];
		$verified = 1;

		$alumniid = convert_string('encrypt', $alumniids);
		
		if(DB::query('SELECT alumni_id FROM alumni WHERE alumni_id = :alumniid', array(':alumniid' => $alumniid))){
				
			if (DB::query('SELECT verified FROM alumni WHERE alumni_id = :alumniid AND verified = :verified', array(':alumniid' => $alumniid, ':verified' => $verified))){
				
				//verify correct account password
				if (password_verify($pword, DB::query('SELECT pword FROM alumni WHERE alumni_id = :alumniid', array(':alumniid' => $alumniid))[0]['pword'])){
					
					$cstrong = True;
					$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
					
					DB::query('INSERT INTO alumni_logintokens VALUES (\'\', :token, :alumniid)', array(':token' =>sha1($token),':alumniid' => $alumniid));
					
					//validity  of token
					setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
					setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

					$admin = DB::query('SELECT * FROM alumni WHERE alumni_id = :userid', array(':userid' => $alumniid));

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

					$description .= "Alumni ".$names." logedin sucessully!";
					$logtype = "Login";

					DB::query("INSERT INTO alumni_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $alumniid));
					
					header("location: home.php");
				}
				else{
					echo 'Incorrect Alumni ID and/or Password.';
				}
			}
			else{
				//verify correct account password
				if (password_verify($pword, DB::query('SELECT pword FROM alumni WHERE alumni_id = :alumniid', array(':alumniid' => $alumniid))[0]['pword'])){
					
					$cstrong = True;
					$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
					
					DB::query('INSERT INTO alumni_logintokens VALUES (\'\', :token, :alumniid)', array(':token' =>sha1($token),':alumniid' => $alumniid));
					
					//validity  of token
					setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
					setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

					$admin = DB::query('SELECT * FROM alumni WHERE alumni_id = :userid', array(':userid' => $alumniid));

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
					$description .= "Alumni ".$names." logedin sucessully!";
					$logtype = "Login";

					DB::query("INSERT INTO alumni_logs (log_type, description, date_time, alumni_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $alumniid));
					
					header("location: new-member-verification.php");
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