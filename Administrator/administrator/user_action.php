<?php 
	//user_action.php
	require '../php/myconnection.php';
	include('db.php');
	include('function.php');

	if(isset($_POST["operation"])){
		//FETCH ALL
		if($_POST["crud_action"] == 'fetch_all'){
		 
			$query = '';
			$output = array();
			//$order_column = array('first_name', 'last_name', 'nationality', 'email');

			$query .= "
						SELECT * FROM admins 
					";

			if(isset($_POST["search"]["value"])){
			   $query .= 'OR admin_id LIKE "%'.convert_string('encrypt', $_POST["search"]["value"]).'%" ';
			   $query .= 'WHERE fname LIKE "%'.convert_string('encrypt', $_POST["search"]["value"]).'%" ';
			   $query .= 'OR lname LIKE "%'.convert_string('encrypt', $_POST["search"]["value"]).'%" ';
			}

			if(isset($_POST["order"])){
					$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
			}
			else{
				$query .= 'ORDER BY admin_id DESC ';
			}

			if($_POST["length"] != -1){
				$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
			}

			$statement = $connect->prepare($query);
			$statement->execute();
			$result = $statement->fetchAll();
			$filtered_rows = $statement->rowCount();

			foreach($result as $row){
				$adid = "";
				$adfname = "";
				$admname = "";
				$adlname = "";
				$adextname = "";
				$adtype = "";
				$adhead = "";
				
				$adid = $row["admin_id"];
				$adfname = $row['fname'];
				$admname = $row['mname'];
				$adlname = $row['lname'];
				$adextname = $row['nameext'];
				$adtype = $row['verified'];
				$adhead = $row['head'];
				
				if ($adtype == 1){
					if($adhead == 1){
						$verifieds = "";
						$verifieds = "Verified, Head";
					} else {
						$verifieds = "";
						$verifieds = "Verified";
					}
				} else{
					$verifieds = "";
					$verifieds = "Unverified";
				}
																			
				if ($adextname == null){
					$names = "";
					$names = array($adfname , " " , $admname ," ", $adlname);
				}
					else{
					$names = "";
					$names = array($adfname , " " , $admname ," ", $adlname, " ", $adextname);
				}
				
				$sub_array = array();
				$sub_array[] = $adid;
				$sub_array[] = implode($names);
				$sub_array[] = $verifieds;
				$sub_array[] = "<button type='button' name='update' id='".$adid."' class='btn btn-warning btn-xs update'>Update</button> <button type='button' name='disable' id='".$adid."' class='btn btn-danger btn-xs disable'>Disable</button>";
				$data[] = $sub_array;
			}

			$data = array(
				"draw"    => intval($_POST["draw"]),
				"recordsTotal"  => $filtered_rows,
				"recordsFiltered" => get_total_all_records($connect),
				"data"    => $output
			);
		}
		//FETCH SINGLE
		elseif($_POST["crud_action"] == 'fetch_single'){
			$id = convert_string('decrypt', $_POST["id"]);
			$query = "
				SELECT * FROM atis.admins
				WHERE admin_id = '$id'
			";
  
			$statement = $connect->prepare($query);
			$statement->execute();
			$result = $statement->fetchAll();
			
			foreach($result as $row){
				
				$data["alumID"] = convert_string('decrypt', $row["admin_id"]);
				$data["fname"] = convert_string('decrypt', $row["fname"]);
				$data['mname'] = convert_string('decrypt', $row['mname']);
				$data["lname"] = convert_string('decrypt', $row["lname"]);
				$data['nameext'] = convert_string('decrypt', $row['nameext']);
				$data['email'] = convert_string('decrypt', $row['email']);
				$data['pword'] = convert_string('decrypt', $row['pword']);
			}
		}
		//DELETE
		elseif($_POST["crud_action"] == 'Delete'){
			$id = convert_string('decrypt', $_POST["id"]);
			$query = "
				SELECT * FROM atis.admins
				WHERE admin_id = '$id'
			";
			
			$statement = $connect->prepare($query);
			$statement->execute();
			$data = array(
			'message'  => '<div class="alert alert-success">User Deleted</div>'
			);
		}
		else{
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
			if(!DB::query('SELECT id FROM atis.admins WHERE admin_id = :id', array(':id' => $adminid))){
				$first_name = clean_text($_POST['admin-id']);
			}
			else{
				$error .= '<p class="text-danger">This ID has aleady an account existed in tha database.</p>';
			}
			
			//CHECK FIRST NAME
			if(empty($_POST["fname"])){
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
			if(empty($_POST["fname"])){
				$error .= '<p class="text-danger">First Name is Required</p>';
			}
			else{
				if (!preg_match("/^[a-zA-Z ]*$/",$_POST["mname"])){
					$error .= '<p class="text-danger">Only Alphabet allowed in First Name</p>';
				}
				else{
					$middle_name = clean_text($_POST["mi"]);
				}
			}
			
			//CHECK LAST NAME
			if(empty($_POST["lname"])){
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
  
			//CHECK NATIONALITY
			if(empty($_POST["nationality"])){
				$error .= '<p class="text-danger">Phone Number is Required</p>';
			}
			else{
				if (!preg_match("/^[0-9]*$/",$_POST["nationality"])){
					$error .= '<p class="text-danger">Only Numbers allowed in Phone</p>';
				}
				else{
					$phone = clean_text($_POST["nationality"]);
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
					if(!DB::query('SELECT id FROM atis.admins WHERE email = :email', array(':email' => $_POST["email"]))){
						$email_address = clean_text($_POST["email"]);
					}
					else{
						$error .= '<p class="text-danger">Email in used!</p>'; 
					}
				}
			}
			
			//CHECK LENGTH OF PASSWORD
			if(strlen($_POST["p-word") >= 6 && strlen($_POST["p-word") <= 32){
				$pass = clean_text($_POST["p-word"]);
			}
			else if(strlen($_POST["p-word") < 6) {
				echo 'Password is too short. Minimun of 6 characters.';
			}
			else if(strlen($_POST["p-word") > 32) {
				echo 'Password is too short. Maximum of 32 characters.';
			}
  
			if($error == ''){
				$adminid = convert_string('encrypt', $_POST['admin-id']);
				$fname = convert_string('encrypt', $first_name);
				$mi = convert_string('encrypt', $middle_name);
				$lname = convert_string('encrypt', $last_name);
				$nameext = convert_string('encrypt', $_POST['ext-name']);
				$email = convert_string('encrypt', $email_address); 
				$pword = $pass;
				$verified = 0;
				$vercode = convert_string('encrypt', rand(100000,500000));
				$date = 
				$head = 0;
				
				//ACTION IS ADD
				if($_POST["crud_action"] == "Add"){
					//Check Length of Password
						if(strlen($pword) >= 6 && strlen($pword) <= 32){
									
							//Update Data in table staff
							DB::query("INSERT INTO atis.admins (admin_id, fname,mname,lname,nameext,email,pword,vercode,verified,head) VALUES (:id, :fname, :mi, :lname, :nameext, :email, 
										:pword, :vercode, :verified, :head)", array(":id"=>$adminid, ":fname"=>$fname, ":mi"=>$mi, ":lname"=>$lname,
										"nameext"=>$nameext, ":email"=>$email, ":pword"=>password_hash($pword, PASSWORD_BCRYPT), ":vercode"=> $vercode,":verified"=>$verified,":head"=>$head));
									
							echo 'New admin account has been saved.';
						}
						
				}
			}
				
				//ACTION IS EDIT
				if($_POST["crud_action"] == "Edit"){
					$id = convert_string('decrypt', $_POST["id"]);
					
					DB::query('UPDATE atis.admins SET fname= :fname, mname=:mi, lname= :lname, nameext = :nameext WHERE admin_id = :id',
					array(":fname"=>$fname, ":mi"=>$mi, ":lname"=>$lname,"nameext"=>$nameext, ":id"=>$adminid));
		
					echo "Account has been updated!";					
					/*$query = "
						UPDATE atis.admins
						SET fname = '$fname', 
						lname = '$last_name', 
						nationality = '$phone', 
						email = '$email_address' 
						WHERE id = '$id'
					";
					$message = '<div class="alert alert-success">User Edited</div>';*/
				}
				
				/*$statement = $connect->prepare($query);
				$statement->execute();
				$result = $statement->fetchAll();
			
				if(isset($result)){
					$data = array(
						'error'   => $error,
						'message'  => $message
					);
				}*/
			}
			else{
				$data = array(
					'error'   => $error,
					'message'  => $message
				);
	   
			}
		}
		echo json_encode($data);
	}

?>