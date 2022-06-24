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
		$alumniids = '';
		$first_name = '';
		$middle_name = '';
		$last_name = '';
		$email = '';
		$pass = '';
		$email_address = '';

		//CHECK ADMIN ID
		if(!DB::query('SELECT id FROM admin WHERE admin_id = :id', array(':id' => $_POST['alumni-id']))){
			$alumniids = clean_text($_POST['alumni-id']);
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

			$alumniid = '';
			$fname = '';
			$mi = '';
			$lname = '';
			$email = '';
			$pword = '';
			$verified = '';
			$vercode = '';
			$type = '';

			$alumniid = convert_string('encrypt', $alumniids);
			$fname = convert_string('encrypt', $first_name);
			$mi = convert_string('encrypt', $middle_name);
			$lname = convert_string('encrypt', $last_name);
			$nameext = convert_string('encrypt', $_POST['ext-name']);
			$verified = convert_string('encrypt', "Unverify");

			//echo $adminid, " ", $fname, " ", $mi, " ", $lname, " ", $nameext, " ", $email, " ", $vercode;
			//ADD QUERY
			DB::query("INSERT INTO alumni (alumni_id, fname,mname,lname,nameext,verified) VALUES (:id, :fname, :mi, :lname, :nameext, :verified)", array(":id"=>$alumniid, ":fname"=>$fname, ":mi"=>$mi, ":lname"=>$lname, "nameext"=>$nameext, ":verified"=>$verified));


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
					$description .= convert_string('decrypt', $adhead)." ".$names." added Alumnous/Alumna ".$names2." successfully!";
					$logtype = "Add Alumni";

					DB::query("INSERT INTO admin_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => Login::isloggedin()));
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
			$nameext = convert_string('encrypt', $_POST['ext-name']);


			//echo $adminid, " ", $fname, " ", $mi, " ", $lname, " ", $nameext, " ", $email, " ", $vercode;
			//ADD QUERY
			//UPDATE QUERY
			DB::query('UPDATE admin SET fname= :fname, mname=:mi, lname= :lname, nameext = :nameext WHERE admin_id = :id',
					array(":fname"=>$fname, ":mi"=>$mi, ":lname"=>$lname,"nameext"=>$nameext, ":id"=>$admin_ids));

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
					$description .= convert_string('decrypt', $adhead)." ".$names." updated Alumnous/Alumna ".$names2." successfully!";
					$logtype = convert_string('encrypt', "Update Alumni");

					DB::query("INSERT INTO admin_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => Login::isloggedin()));
			echo 'Admin account has been updated.';
		}
	}
}

?>
