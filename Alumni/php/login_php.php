<?php 
	require "function.php";
	require "myconnection.php";

	if (isset($_POST['operation'])){
		if($_POST['operation'] == "Login"){
			$alumniids = clean_text($_POST['alumniid']);
			$pword = $_POST['pass'];
			$verified = 1;

			$alumniid = convert_string('encrypt', $alumniids);
		
			if(DB::query('SELECT alumni_id FROM alumnitracking.alumni WHERE alumni_id = :alumniid', array(':alumniid' => $alumniid))){
					
				if (DB::query('SELECT verified FROM alumnitracking.alumni WHERE alumni_id = :alumniid AND verified = :verified', array(':alumniid' => $alumniid, ':verified' => $verified))){
					
					//verify correct account password
					if (password_verify($pword, DB::query('SELECT pword FROM alumnitracking.alumni WHERE alumni_id = :alumniid', array(':alumniid' => $alumniid))[0]['pword'])){
						
						$cstrong = True;
						$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
						
						DB::query('INSERT INTO alumni_logintokens VALUES (\'\', :token, :alumniid)', array(':token' =>sha1($token),':alumniid' => $alumniid));
						
						//validity  of token
						setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
						setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
						
						echo "Successfully loged in.";
						//header("location: ../home.php");
					}
					else{
						echo 'Incorrect Alumni ID and/or Password.';
					}
				}
				else{
					//verify correct account password
					if (password_verify($pword, DB::query('SELECT pword FROM alumnitracking.alumni WHERE alumni_id = :alumniid', array(':alumniid' => $alumniid))[0]['pword'])){
						
						$cstrong = True;
						$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
						
						DB::query('INSERT INTO alumni_logintokens VALUES (\'\', :token, :alumniid)', array(':token' =>sha1($token),':alumniid' => $alumniid));
						
						//validity  of token
						setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
						setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
						
						//header("location: .verified.php");
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
	}

?>

