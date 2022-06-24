<?php
	require "function.php";
	//require "myconnection.php";


	if($_POST['operation']){
		if($_POST['operation'] == "Pre Signup"){
			$message = '';
			$error = '';

			$alumniids = "";
			$fnames = "";
			$mis = "";
			$lnames = "";
			$extnames = "";
			$degrees = "";
			$majors = "";
			$yeargrads = "";
			$bmonths = "";
			$bdays = "";
			$byears = "";
			$sexs = "";
			$pass = "";
			$emailadd ="";
			$phoneNos ="";
			$alumniid2 = convert_string('encrypt', clean_text($_POST['alumID']));;

			//echo $alumniid2;

			//CHECK ALUMNI ID
			if(!DB::query('SELECT alumni.alumni_id FROM alumni WHERE alumni.alumni_id = :id', array(':id' => $alumniid2))){
				$error .= '<p class="text-danger">This ID does not exist in the database.</p>';
				//echo $error;
			}
			else{
				if(DB::query('SELECT alumni.alumni_id FROM alumni WHERE alumni.alumni_id = :id AND alumni.verified = 0', array(':id' => $alumniid2))){
					$alumniid = $alumniid2;
					//echo "ID exist";
				}
				else{
					$error .= '<p class="text-danger">This account has already been activated.</p>';
					//echo $error;
				}
				
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
			if(!DB::query('SELECT alumni.cel_no FROM alumni WHERE alumni.cel_no = :phoneNo', array(':phoneNo' => $_POST["phoneNo"]))){
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
						//echo $error;
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
				$vercode = convert_string('encrypt', clean_text($_POST['vercode']));
				$phoneNo = convert_string('encrypt', $phoneNos);
				$email = $emailadd;
				$verified = 0;
				$pword = clean_text($_POST['pword']);

				//input exist and match in alumni table
				if(DB::query('SELECT alumni_id, fname, mname, lname FROM alumni WHERE alumni_id = :alumniid AND fname = :fname AND mname = :mname AND lname = :lname', array(':alumniid' => $alumniid, ':fname' => $firstname, ':mname' => $middlename, ':lname' => $lastname))){

					//Update Data in table alumni
					DB::query('UPDATE alumni SET alumni.email = :email, alumni.pword = :pword, alumni.cel_no = :cel_no, alumni.vercode = :vercode WHERE alumni.alumni_id = :alumniid', array(':email' => $emailadd, ':pword' => password_hash($pword, PASSWORD_BCRYPT),':cel_no'=> $phoneNo, ':vercode'=> $vercode, ':alumniid' => $alumniid));

					$cstrong = True;
					$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
						
					DB::query('INSERT INTO alumni_logintokens VALUES (\'\', :token, :alumniid)', array(':token' =>sha1($token),':alumniid' => $alumniid));
						
					//validity  of token
					setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
					setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
					//header ("location: ../new-member-verification.php");
					echo "Successfully Signed up!";

				}
				else{
					echo "<p>Cannot found in the database.</p><br>";
				}

			}
			else{
				echo $error;
			}
		}
	}


?>