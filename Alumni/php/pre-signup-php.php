<?php

	//require 'myconnection.php';
	require "function.php";
	
	if (isset($_POST['createaccount'])){

		$message = '';
		$error = '';

		$alumniid2 = "";
		$first_name = "";
		$middle_name = "";
		$last_name = "";
		$pass = "";
		$emailadd ="";
		$phoneNos ="";
		$alumniid2 = convert_string('encrypt', clean_text($_POST['alumID']));;

		//echo $alumniid2;

		//CHECK ALUMNI ID
		if(!DB::query('SELECT alumni_id FROM alumni WHERE alumni.alumni_id = :id', array(':id' => $alumniid2))){
			$error .= '<p class="text-danger">This ID does not exist in the database.</p>';
			//echo $error;
		}

		//CHECK FIRST NAME
		if(empty($_POST["alumFname"])){
			$error .= '<p class="text-danger">First Name is Required</p>';
			//echo $error;
		}
		else{
			if (!preg_match("/^[a-zA-Z ]*$/",$_POST['alumFname'])){
				$error .= '<p class="text-danger">Only Alphabet allowed in First Name</p>';
				//echo $error;
			}
			else{
				$first_name = clean_text($_POST['alumFname']);
			}
		}
				
		//CHECK MIDDLE NAME
		if(empty($_POST["alumMI"])){
			$error .= '<p class="text-danger">Middle Name is Required</p>';
			//echo $error;
		}
		else{
			if (!preg_match("/^[a-zA-Z ]*$/",$_POST["alumMI"])){
				$error .= '<p class="text-danger">Only Alphabet allowed in Middle Name</p>';
				//echo $error;
			}
			else{
				$middle_name = clean_text($_POST["alumMI"]);
			}
		}
				
		//CHECK LAST NAME
		if(empty($_POST["alumLname"])){
			$error .= '<p class="text-danger">Last Name is Required</p>';
			//echo $error;
		}
		else{
			if (!preg_match("/^[a-zA-Z ]*$/",$_POST['alumLname'])){
				$error .= '<p class="text-danger">Only Alphabet allowed in Last Name</p>';
				//echo $error;
			}
			else{
				$last_name = clean_text($_POST['alumLname']);
			}
		}

		//CHECK ALUMNI Cellphone No
		if(!DB::query('SELECT cel_no FROM alumni WHERE alumni.cel_no = :phoneNo', array(':phoneNo' => $_POST["phoneNo"]))){
			$phoneNos = clean_text($_POST['phoneNo']);
		}
		else{
			$error .= '<p class="text-danger">This Cellphone is already been used.</p>';
				//echo $error;
			
		}

		//VALIDATE EMAIL
		if(empty($_POST["alumEmail"])){
			$error .= '<p class="text-danger">Email Address is Required</p>';
		}
		else{
			if (!filter_var($_POST["alumEmail"], FILTER_VALIDATE_EMAIL)){
				$error .= '<p class="text-danger">Invalid email format</p>'; 
				//echo $error;
			}
			else{
				$emailadd = convert_string('encrypt', clean_text($_POST["alumEmail"]));
				if(DB::query('SELECT email FROM alumni WHERE email = :email', array(':email' => $emailadd))){
					if(!DB::query('SELECT email FROM alumni WHERE email = :email AND alumni_id = :alumniid', array(':email' => $emailadd, ':alumniid'=>$alumniid2))){
						$error .= '<p class="text-danger">Email in used!</p>';
					}
				}
			}
		}
		
		//CHECK LENGTH OF PASSWORD
		if(strlen($_POST["pword"]) >= 6 && strlen($_POST["pword"]) <= 32){
			$pass = clean_text($_POST["pword"]);
		}
		else if(strlen($_POST["pword"]) < 6) {
			$error .= '<p class="text-danger">Password is too short. Minimun of 6 characters.</p>';
			echo $error;
		}
		else if(strlen($_POST["pword"]) > 32) {
			$error .= '<p class="text-danger">Password is too short. Maximum of 32 characters.</p>';
			echo $error;
		}

		if($error == ''){

			//$alumniid= "";
			$firstname = "";
			$middlename = "";
			$lastname = "";
			$extensionname = "";
			$degree = "";
			$majors = "";
			$birthmonth = "";
			$birthday = "";
			$birthyear = "";
			$sex2 = "";
			$schname = "";
			$email ="";
			$phoneNo="";

			
			$firstname = convert_string('encrypt', $first_name);
			$middlename = convert_string('encrypt', $middle_name);
			$lastname = convert_string('encrypt', $last_name);
			$extensionname = convert_string('encrypt', clean_text($_POST['alumExtname']));
			$birthmonth = convert_string('encrypt', clean_text($_POST['alumBmonth']));
			$birthday = convert_string('encrypt', clean_text($_POST['alumBday']));
			$birthyear = convert_string('encrypt', clean_text($_POST['alumByear']));
			$vercode = convert_string('encrypt', clean_text($_POST['vercode']));
			$phoneNo = convert_string('encrypt', $phoneNos);
			$email = $emailadd;
			$verified = 0;
			$pword = clean_text($_POST['pword']);

			//input exist and match in alumni table
			if(DB::query('SELECT alumni_id, fname, mname, lname FROM alumni WHERE alumni_id = :alumniid AND fname = :fname AND mname = :mname AND lname = :lname', array(':alumniid' => $alumniid2, ':fname' => $firstname, ':mname' => $middlename, ':lname' => $lastname))){

				if(DB::query('SELECT * FROM alumni WHERE alumni_id = :id AND verified = 0', array(':id' => $alumniid2))){
					//Update Data in table alumni
					DB::query('UPDATE alumni SET email = :email, pword = :pword, b_day = :bday, b_month = :bmonth, b_year = :byear, cel_no = :cel_no, vercode = :vercode WHERE alumni_id = :alumniid', array(':email' => $emailadd, ':pword' => password_hash($pword, PASSWORD_BCRYPT),':bday'=> $birthday, ':bmonth'=> $birthmonth, ':byear'=>$birthyear, ':cel_no'=> $phoneNo, ':vercode'=> $vercode, ':alumniid' => $alumniid2));

					$cstrong = True;
					$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
						
					DB::query('INSERT INTO alumni_logintokens VALUES (\'\', :token, :alumniid)', array(':token' =>sha1($token),':alumniid' => $alumniid2));
						
					//validity  of token
					setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
					setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

					$admin = DB::query('SELECT * FROM alumni WHERE alumni_id = :userid', array(':userid' => $alumniid2));

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

						$description = "";
						$log_type = "";
						$description .= "Alumni ".$names." sucessully pre-registered!";
						$logtype = "Pre-register";

						DB::query("INSERT INTO alumni_logs (log_type, description, date_time, alumni_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $alumniid2));

					header ("location: new-member-verification.php");

				}
				else{
					$error .= '<p class="text-danger">This account has already verified.</p>';
				}
			}
			else{
				$error .= '<p class="text-danger">Cannot found in the database.</p>';
			}

		}
		else{
			echo $error;
		}
	}
		
?>