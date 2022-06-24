<?php
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	
	if(isset($_POST["operation"])){
		if ($_POST["operation"] == "Add Honors and Awards"){
			$haName =$_POST['haName'];
			$haAssoc =$_POST['haAssoc'];
			$haIssuer =$_POST['haIssuer'];
			$haMonth =$_POST['haMonth'];
			$haYear =$_POST['haYear'];
			$haComment =$_POST['haComment'];
			$alumniid =$_POST['alumniid'];

			$loggedin = Login::isloggedin();

			if ($loggedin == $alumniid){
 
					$haNames = convert_string('encrypt', clean_text($haName));
					$haAssocs = convert_string('encrypt', clean_text($haAssoc));
					$haIssuers = convert_string('encrypt', clean_text($haIssuer));
					$haMonths = convert_string('encrypt', clean_text($haMonth));
					$haYears = convert_string('encrypt', clean_text($haYear));
					$haComments = convert_string('encrypt', clean_text($haComment));


					$year = date('Y');
					$month = date('m');
					$day = date('d');
					$hour = date('H');
					$min = date('i');
					$sa = date('s');
					$uu = round(microtime(true) * 1000);
					$identifier = $year.$day.$month.$hour.$min.$alumniid.$sa.$uu;	


					DB::query('INSERT INTO alumnitracking.affiliations_honors_awards VALUES(\'\', :identifier, :haNames, :haAssocs, :haIssuers, :haMonths, :haYears, :haComments, :alumniid)', array(':identifier'=> $identifier, ':haNames'=> $haNames, ':haAssocs'=> $haAssocs, ':haIssuers'=> $haIssuers, ':haMonths'=> $haMonths, ':haYears'=> $haYears, ':haComments'=> $haComments, ':alumniid'=> $alumniid));

					$description = "Alumni ". Login::isloggedin(). " added new seminar/training/workshop that he/she attended.";

						DB::query("INSERT INTO alumnitracking.alumni_logs (description, date_time, alumni_id) VALUES (:description, NOW(), :alumni_id)", array(":description" => $description, ":alumni_id" => Login::isloggedin()));

					echo "Honors/Award saved";
				//header('Location: ../signup-affiliations-others.php');
				
			}
		}
		else if ($_POST["operation"] == "Edit Honors and Awards"){
			$haName =$_POST['ehaName'];
			$haAssoc =$_POST['ehaAssoc'];
			$haIssuer =$_POST['ehaIssuer'];
			$haMonth =$_POST['ehaMonth'];
			$haYear =$_POST['ehaYear'];
			$haComment =$_POST['ehaComment'];
			$alumniid =$_POST['ealumniid'];
			$alumniid =$_POST['ehaid'];

			$loggedin = Login::isloggedin();

			if ($loggedin == $alumniid){
 
					$haNames = convert_string('encrypt', clean_text($haName));
					$haAssocs = convert_string('encrypt', clean_text($haAssoc));
					$haIssuers = convert_string('encrypt', clean_text($haIssuer));
					$haMonths = convert_string('encrypt', clean_text($haMonth));
					$haYears = convert_string('encrypt', clean_text($haYear));
					$haComments = convert_string('encrypt', clean_text($haComment));


					$year = date('Y');
					$month = date('m');
					$day = date('d');
					$hour = date('H');
					$min = date('i');
					$sa = date('s');
					$uu = round(microtime(true) * 1000);
					$identifier = $year.$day.$month.$hour.$min.$alumniid.$sa.$uu;	

					DB::query('UPDATE affiliations_honors_awards SET ha_name= :haNames, associated= :haAssocs, issuer=:haIssuers, month=:haMonths, year=:haYears, ha_comment=:haComments WHERE ha_id=:haid AND alumni_id=:alumniid', array(':haNames'=> $haNames, ':haAssocs'=> $haAssocs, ':haIssuers'=> $haIssuers, ':haMonths'=> $haMonths, ':haYears'=> $haYears, ':haComments'=> $haComments, ':haid'=>$haid, ':alumniid'=> $alumniid));

					$description = "Alumni ". Login::isloggedin(). " added new seminar/training/workshop that he/she attended.";

						DB::query("INSERT INTO alumnitracking.alumni_logs (description, date_time, alumni_id) VALUES (:description, NOW(), :alumni_id)", array(":description" => $description, ":alumni_id" => Login::isloggedin()));

					echo "Honors/Award saved";
				//header('Location: ../signup-affiliations-others.php');
				
			}
		}
	}
?>