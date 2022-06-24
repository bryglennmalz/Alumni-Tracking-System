<?php
	if(isset($_POST['submit-signup-organization'])==true && empty($_POST['submit-signup-organization'])==false){
		$orgname = $_POST['org-name'];
		$position = $_POST['position'];
		$mostarted = $_POST['org-month-start'];
		$yearstarted = $_POST['org-year-start'];
		$moend = $_POST['org-month-end'];
		$yearend = $_POST['org-year-end'];
		$comments = $_POST['org-comment'];
		
		$alumniid = Login::isloggedin();
			
		foreach($orgname as $a => $c){
			
			if ($yearend[$a] >= $yearstarted[$a]){
				//Update Data in table alumni
				DB::query('INSERT  INTO alumni.organizations VALUES(\'\', :orgname, :position, :mostarted, :yearstarted, :moend, :yearend, :comments, :userid)', 
							array(':orgname' => $orgname[$a], ':position' => $position[$a], ':mostarted' => $mostarted[$a], ':yearstarted' => $yearstarted[$a],
								  ':moend' => $moend[$a], ':yearend' => $yearend[$a],':comments' => $comments[$a], ':userid' => $alumniid));
			}
			else{
				echo "Error.";
				die;
			}
		}
		
		header("Location: ../pages/signup-certifications.php");
	}
?>