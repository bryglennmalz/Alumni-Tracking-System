<?php

if (Login::isloggedin()){
		
	if (isset($_POST['confirmNewP'])){
	
		$oldpword = $_POST['oldpword'];
		$newpword = $_POST['newpword'];
		$newpword2 = $_POST['newpword2'];
		$alumniid = Login::isloggedin();
		
		if (password_verify($oldpword, DB::query('SELECT pword FROM alumni.alumni WHERE id = :alumniid', array(':alumniid' => $alumniid))[0]['pword'])){
			
			if ($newpword == $newpword2){
				
				if(strlen($newpword) >= 6 && strlen($newpword) <= 32){
					
					DB::query('UPDATE alumni.alumni SET pword = :newpword WHERE id = :alumniid', array(':alumniid' => $alumniid, ':newpword' => password_hash($newpword, PASSWORD_BCRYPT)));
					
					echo 'New password saved.';
				}
				else if(strlen($newpword) < 6) {
								
					echo 'Password is too short. Minimun of 6 characters.';
							
				}
				else if(strlen($newpword) > 32) {
							
					echo 'Password is too short. Maximum of 32 characters.';
							
				}
			}
			else{
				echo 'Password Don\'t match.';
			}
		}
		else{
			echo 'Incorrect password.';
		}
	}
}
?>