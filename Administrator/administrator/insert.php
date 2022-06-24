<?php
require '../php/myconnection.php';
require '../php/home-php.php';
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add"){
		$message = '';
		$error = '';
		$admin_ids = '';
		$first_name = '';
		$middle_name = '';
		$last_name = '';
		$email = '';
		$pass = '';
		$email_address = '';

		//CHECK ADMIN ID
		if(!DB::query('SELECT id FROM alumni WHERE alumni_id = :id', array(':id' => $_POST['admin-id']))){
			$admin_ids = clean_text($_POST['admin-id']);
			}
		else{
			$error .= '<p class="text-danger">This ID has aleady an account existed in the database.</p>';
		}

		//CHECK FIRST NAME
		if(empty($_POST["f-name"])){
			$error .= '<p class="text-danger">First Name is Required</p>';
		}
		else{
			if (!preg_match("/^[a-zA-Z ]*$/",$_POST['f-name'])){
				$error .= '<p class="text-danger">Only Alphabet allowed in First Name</p>';
			}
			else{
				$first_name = clean_text($_POST['f-name']);
			}
		}

		//CHECK MIDDLE NAME
		if(empty($_POST["mi"])){
			$error .= '<p class="text-danger">First Name is Required</p>';
		}
		else{
			if (!preg_match("/^[a-zA-Z ]*$/",$_POST["mi"])){
				$error .= '<p class="text-danger">Only Alphabet allowed in First Name</p>';
			}
			else{
				$middle_name = clean_text($_POST["mi"]);
			}
		}

		//CHECK LAST NAME
		if(empty($_POST["l-name"])){
			$error .= '<p class="text-danger">Last Name is Required</p>';
		}
		else{
			if (!preg_match("/^[a-zA-Z ]*$/",$_POST['l-name'])){
				$error .= '<p class="text-danger">Only Alphabet allowed in Last Name</p>';
			}
			else{
				$last_name = clean_text($_POST['l-name']);
			}
		}

		//VALIDATE EMAIL
		if(empty($_POST["email"])){
			$error .= '<p class="text-danger">Email Address is Required</p>';
		}
		else{
			if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
				$error .= '<p class="text-danger">Invalid email format</p>';
			}
			else{
				if(!DB::query('SELECT id FROM alumnitracking.admin WHERE email = :email', array(':email' => $_POST["email"]))){
					$email_address = clean_text($_POST["email"]);
				}
				else{
					$error .= '<p class="text-danger">Email in used!</p>';
				}
			}
		}

		//CHECK LENGTH OF PASSWORD
		if(strlen($_POST["p-word"]) >= 6 && strlen($_POST["p-word"]) <= 32){
			$pass = clean_text($_POST["p-word"]);
		}
		else if(strlen($_POST["p-word"]) < 6) {
			$error .= '<p class="text-danger">Password is too short. Minimun of 6 characters.</p>';
		}
		else if(strlen($_POST["p-word"]) > 32) {
			$error .= '<p class="text-danger">Password is too short. Maximum of 32 characters.</p>';
		}


		//echo $admin_ids, " ", $first_name, " ", $middle_name, " ", $last_name, " ", $email_address, " ", $pass;

		if($error == ''){

			$adminid = '';
			$fname = '';
			$mi = '';
			$lname = '';
			$email = '';
			$pword = '';
			$verified = '';
			$vercode = '';
			$type = '';

			$adminid = convert_string('encrypt', $admin_ids);
			$fname = convert_string('encrypt', $first_name);
			$mi = convert_string('encrypt', $middle_name);
			$lname = convert_string('encrypt', $last_name);
			$nameext = convert_string('encrypt', $_POST['ext-name']);
			$email = convert_string('encrypt', $email_address);
			$pword = $pass;
			$verified = 0;
			$vercode = convert_string('encrypt', rand(100000,500000));
			$type = convert_string('encrypt', clean_text($_POST["admin-type"]));

			//echo $adminid, " ", $fname, " ", $mi, " ", $lname, " ", $nameext, " ", $email, " ", $vercode;
			//ADD QUERY
			DB::query("INSERT INTO admin (admin_id, fname,mname,lname,nameext,email,pword,vercode,verified,type) VALUES (:id, :fname, :mi, :lname, :nameext, :email, :pword, :vercode, :verified, :type)", array(":id"=>$adminid, ":fname"=>$fname, ":mi"=>$mi, ":lname"=>$lname,
				"nameext"=>$nameext, ":email"=>$email, ":pword"=>password_hash($pword, PASSWORD_BCRYPT), ":vercode"=> $vercode,":verified"=>$verified,":type"=>$type));


			$admin = DB::query('SELECT * FROM admin WHERE admin_id = :userid', array(':userid' => Login::isloggedin()));

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

					if ($nameext == null){
						$names2 = "";
						$names2 .= $first_name." ".$middle_name." ".$last_name;
					}
						else{
						$names2 = "";
						$names2 .= $first_name." ".$middle_name." ".$last_name." ".$_POST['ext-name'];
					}
					$description ="";
					$description .= convert_string('decrypt', $adhead)." ".$names." added ".$names2." as ".convert_string('decrypt', $type)." successfully!";
					$logtype = "New ".$type;

					DB::query("INSERT INTO admin_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> implode($logtype),":description" => $description, ":admin_id" => Login::isloggedin()));
			echo 'New admin account has been saved.';
		}
	}
	elseif($_POST["operation"] == "Edit"){
		$message = '';
		$error = '';
		$admin_ids = '';
		$first_name = '';
		$middle_name = '';
		$last_name = '';

		//CHECK ADMIN ID
		if(!DB::query('SELECT id FROM admin WHERE admin_id = :id', array(':id' => $_POST['admin-id']))){
			$admin_ids = clean_text($_POST['admin-id']);
			}
		else{
			$error .= '<p class="text-danger">This ID has aleady an account existed in the database.</p>';
		}

		//CHECK FIRST NAME
		if(empty($_POST["f-name"])){
			$error .= '<p class="text-danger">First Name is Required</p>';
		}
		else{
			if (!preg_match("/^[a-zA-Z ]*$/",$_POST['f-name'])){
				$error .= '<p class="text-danger">Only Alphabet allowed in First Name</p>';
			}
			else{
				$first_name = clean_text($_POST['f-name']);
			}
		}

		//CHECK MIDDLE NAME
		if(empty($_POST["mi"])){
			$error .= '<p class="text-danger">First Name is Required</p>';
		}
		else{
			if (!preg_match("/^[a-zA-Z ]*$/",$_POST["mi"])){
				$error .= '<p class="text-danger">Only Alphabet allowed in First Name</p>';
			}
			else{
				$middle_name = clean_text($_POST["mi"]);
			}
		}

		//CHECK LAST NAME
		if(empty($_POST["l-name"])){
			$error .= '<p class="text-danger">Last Name is Required</p>';
		}
		else{
			if (!preg_match("/^[a-zA-Z ]*$/",$_POST['l-name'])){
				$error .= '<p class="text-danger">Only Alphabet allowed in Last Name</p>';
			}
			else{
				$last_name = clean_text($_POST['l-name']);
			}
		}


		//echo $admin_ids, " ", $first_name, " ", $middle_name, " ", $last_name, " ", $email_address, " ", $pass;

		if($error == ''){

			$adminid = '';
			$fname = '';
			$mi = '';
			$lname = '';

			$adminid = convert_string('encrypt', $admin_ids);
			$fname = convert_string('encrypt', $first_name);
			$mi = convert_string('encrypt', $middle_name);
			$lname = convert_string('encrypt', $last_name);
			$nameext = convert_string('encrypt', $_POST['ext-name']);
			$type = convert_string('encrypt', clean_text($_POST["admin-type"]));


			//echo $adminid, " ", $fname, " ", $mi, " ", $lname, " ", $nameext, " ", $email, " ", $vercode;
			//ADD QUERY
			//UPDATE QUERY
			DB::query('UPDATE admin SET fname= :fname, mname=:mi, lname= :lname, nameext = :nameext WHERE admin_id = :id',
					array(":fname"=>$fname, ":mi"=>$mi, ":lname"=>$lname,"nameext"=>$nameext, ":id"=>$admin_ids));

			//ADD LOGS
			$admin = DB::query('SELECT * FROM admin WHERE admin_id = :userid', array(':userid' => Login::isloggedin()));

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

					if ($nameext == null){
						$names2 = "";
						$names2 .= $first_name." ".$middle_name." ".$last_name;
					}
						else{
						$names2 = "";
						$names2 .= $first_name." ".$middle_name." ".$last_name." ".$_POST['ext-name'];
					}
					$description = "";
					$description .= convert_string('decrypt', $adhead)." ".$names." updated ".$names2."information successfully!";
					$logtype = "New ".convert_string('decrypt', $type);

					DB::query("INSERT INTO admin_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> implode($logtype),":description" => $description, ":admin_id" => Login::isloggedin()));
			echo 'Admin account has been updated.';
		}
	}
}

?>
