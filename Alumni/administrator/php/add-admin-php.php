<?php

	//$userid = Login::isloggedin();
	
	if (isset($_POST['AdminSave'])){
		$adminid = $_POST['admin-id'];
		$afname = $_POST['f-name'];
		$ami = $_POST['mi'];
		$alname = $_POST['l-name'];
		$anameext = $_POST['ext-name'];
		$email = $_POST['email'];
		$password = $_POST['p-word'];
		$verified = 0;
	
		$loggedin = Login::isloggedin();
		
		//Check ADMIN ID EXIST
		if (!DB::query('SELECT id FROM alumni.staff WHERE id = :adminid', array(':adminid' => $adminid))){
			
			//If EMAIL is Valid FORMAT
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
							
				//Check Length of Password
				if(strlen($password) >= 6 && strlen($password) <= 32){
								
					//Add New Admin Account
					DB::query('INSERT INTO alumni.staff VALUES (:adminid, :afname, :ami, :alname, :anameext, :email, :password, :verified)', 
							   array(':adminid' => $adminid, ':afname' => $afname, ':ami' => $ami, ':alname' => $alname, 
							   ':anameext' => $anameext, ':email' => $email, ':password' => password_hash($password, PASSWORD_BCRYPT), ':verified' => $verified));

							   
					$forum = DB::query("SELECT * FROM alumni.staff");
					$staff_lists = "";
					foreach($staffs as $st){
						
						if ($atype == 1){
							$verifieds = "";
							$verifieds = "Verified";
						} else{
							$verifieds = "";
							$verifieds = "Unverified";
						}
															
						$staff_lists .= "
										<tr>
											<td>". $aid ."</td>
											<td>". $afname ." ". $amname ." ". $alname .", ". $aextname ."</td>
											<td>". $verifieds ."</td>
											<td class='text-nowrap text-center'>
												<a href='#' data-toggle='tooltip' data-original-title='Edit'> <i class='fa fa-pencil text-inverse m-r-10'></i> </a>
												<a href='#' data-toggle='tooltip' data-original-title='Close'> <i class='fa fa-close text-danger'></i> </a>
											</td>
										</tr>";
					}
				}
				else if(strlen($password) < 6) {
					echo 'Password is too short. Minimun of 6 characters.';
				}
				else if(strlen($password) > 32) {
					echo 'Password is too long. Maximum of 32 characters.';
				}
			}
			else{
				echo "Email in used.";
			}
		}
		else{
			echo "This ID has already been used. This new account won't be save.";
		}
		
		//echo $f_post;
	}


?>