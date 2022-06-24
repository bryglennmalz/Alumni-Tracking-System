<?php
require '../../php/myconnection.php';
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$alumniid = $_POST['admin-id'];
		$fname = $_POST['f-name'];
		$mi = $_POST['mi'];
		$lname = $_POST['l-name'];
		$nameext = $_POST['ext-name'];
		$email = $_POST['email']; 
		$pword = $_POST['p-word'];
		$verified = 0;
		$head = 0;
		
		//If EMAIL is Valid FORMAT
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			
			if(!DB::query('SELECT id FROM alumni.staff WHERE id = :id', array(':id' => $alumniid))){			
				
				//if email exist
				if(!DB::query('SELECT email FROM alumni.staff WHERE email = :email', array(':email' => $email))){
					//echo 'email is valid';
								
					//Check Length of Password
					if(strlen($pword) >= 6 && strlen($pword) <= 32){
									
						//Update Data in table staff
						DB::query("INSERT INTO alumni.staff (id, fname,mname,lname,nameext,email,pword,verified,head) VALUES (:id, :fname, :mi, :lname, :nameext, :email, 
									:pword, :verified, :head)", array(":id"=>$alumniid, ":fname"=>$fname, ":mi"=>$mi, ":lname"=>$lname,
									"nameext"=>$nameext, ":email"=>$email, ":pword"=>password_hash($pword, PASSWORD_BCRYPT),":verified"=>$verified,":head"=>$head));
					}
					else if(strlen($pword) < 6) {
									
						echo 'Password is too short. Minimun of 6 characters.';
								
					}
					else if(strlen($pword) > 32) {
								
						echo 'Password is too short. Maximum of 32 characters.';
								
					}
				}
			}
			else{
				echo "Email in used.";
			}
		}
		else{
			echo 'Invalid email';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$alumniid = $_POST['admin-id'];
		$fname = $_POST['f-name'];
		$mi = $_POST['mi'];
		$lname = $_POST['l-name'];
		$nameext = $_POST['ext-name'];
		
		DB::query('UPDATE alumni.staff SET fname= :fname, mname=:mi, lname= :lname, nameext = :nameext WHERE id = :id',
					array(":fname"=>$fname, ":mi"=>$mi, ":lname"=>$lname,"nameext"=>$nameext, ":id"=>$alumniid));
		
		echo "Account has been updated!";					
	}
}

?>