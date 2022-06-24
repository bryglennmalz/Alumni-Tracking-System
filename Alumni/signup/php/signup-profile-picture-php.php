<?php
	if(isset($_POST['submit-signup-profile-picture'])==true && empty($_POST['submit-signup-profile-picture'])==false){
		$f_g_name = $_POST['f-g-name'];
		
		$alumniid = Login::isloggedin();
		
		
		//Update Data in table alumni
		//DB::query('UPDATE alumni.alumni SET f_g_name = :f_g_name, fg_occupation = :fg_occupation, mother_name = :mother_name, m_occupation = :m_occupation, answer1 = :answer1, 
		//		   answer2 = :answer2 WHERE id = :alumniid', array(':f_g_name' => $f_g_name, ':fg_occupation' => $fg_occupation, ':mother_name' => $mother_name, 
		//		  ':m_occupation' => $m_occupation, ':answer1' => $answer1, ':answer2' => $answer2, ':alumniid' => $alumniid));
		
		header("Location: ../pages/profile.php");
	}
?>