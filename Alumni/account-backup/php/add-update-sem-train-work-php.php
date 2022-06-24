<?php
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	
	if(isset($_POST["operation"])){
		if ($_POST["operation"] == "Add Seminar, Training, and Workshop"){

			$stwName =$_POST['stwName'];
			$stwVenue =$_POST['stwVenue'];
			$stwMonth =$_POST['stwMonth'];
			$stwYear =$_POST['stwYear'];
			$stwType =$_POST['stwType'];
			$stwLevel =$_POST['stwLevel'];
			$stwComment =$_POST['stwComment'];
			$alumniid =$_POST['alumniid'];

			$loggedin = Login::isloggedin();

			if ($loggedin == $alumniid){

				if($stwName != "" && $stwVenue != "" && $stwType != "" && $stwLevel != ""){

						$stwNames = convert_string('encrypt', clean_text($stwName));
						$stwVenues = convert_string('encrypt', clean_text($stwVenue));
						$stwMonths = convert_string('encrypt', clean_text($stwMonth));
						$stwYears = convert_string('encrypt', clean_text($stwYear));
						$stwTypes = convert_string('encrypt', clean_text($stwType));
						$stwLevels = convert_string('encrypt', clean_text($stwLevel));
						$stwComments = convert_string('encrypt', clean_text($stwComment));

						$year = date('Y');
						$month = date('m');
						$day = date('d');
						$hour = date('H');
						$min = date('i');
						$sa = date('s');
						$uu = round(microtime(true) * 1000);
						$identifier = $year.$day.$month.$hour.$min.$alumniid.$sa.$uu;	

						DB::query('INSERT INTO alumnitracking.affiliation_sem_train_workshop VALUES(\'\', :identifier, :stwName, :stwVenue, :stwMonth, :stwYear, :stwComment, :stwType, :stwLevel, :alumniid)', array(':identifier'=> $identifier, ':stwName'=> $stwNames, ':stwVenue'=> $stwVenues, ':stwMonth'=> $stwMonths, ':stwYear'=> $stwYears, ':stwComment'=> $stwComments, ':stwType'=> $stwTypes, ':stwLevel'=> $stwLevels, ':alumniid'=> $alumniid));

						$description = "Alumni ". Login::isloggedin(). " added new seminar/training/workshop that he/she attended.";

						DB::query("INSERT INTO alumnitracking.alumni_logs (description, date_time, alumni_id) VALUES (:description, NOW(), :alumni_id)", array(":description" => $description, ":alumni_id" => Login::isloggedin()));

					echo "Seminar, Training, and Workshop saved!";
				}
				else{
					echo "wala";
				}
			}
			else{
				echo "wala haha";
			}
		}
	}
?>