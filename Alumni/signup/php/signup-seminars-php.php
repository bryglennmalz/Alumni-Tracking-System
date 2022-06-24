<?php
	if(isset($_POST['submit-signup-seminars'])==true && empty($_POST['submit-signup-seminars'])==false){
		$semname = $_POST['sem-name'];
		$semvenue = $_POST['sem-venue'];
		$semmo = $_POST['sem-month'];
		$semyr = $_POST['sem-year'];
		
		$alumniid = Login::isloggedin();
			
		foreach($semname as $a => $c){
			
				//Update Data in table alumni
				DB::query('INSERT  INTO alumni.seminar VALUES(\'\', :semname, :semvenue, :semmo, :semyr, :userid)', 
							array(':semname' => $semname[$a], ':semvenue' => $semvenue[$a], ':semdate' => $semmo[$a], ":semyr" => $semyr, ':userid' => $alumniid));
		}
		
		header("Location: ../pages/signup-honors-awards.php");
	}
?>