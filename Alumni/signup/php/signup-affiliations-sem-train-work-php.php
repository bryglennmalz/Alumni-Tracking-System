<?php
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	
	if(isset($_POST["operation"])){
		if ($_POST["operation"] == "Add SemTrainWork"){

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

					foreach ($stwName as $a => $c) {

						$stwNames = convert_string('encrypt', clean_text($stwName[$a]));
						$stwVenues = convert_string('encrypt', clean_text($stwVenue[$a]));
						$stwMonths = convert_string('encrypt', clean_text($stwMonth[$a]));
						$stwYears = convert_string('encrypt', clean_text($stwYear[$a]));
						$stwTypes = convert_string('encrypt', clean_text($stwType[$a]));
						$stwLevels = convert_string('encrypt', clean_text($stwLevel[$a]));
						$stwComments = convert_string('encrypt', clean_text($stwComment[$a]));

						$year = date('Y');
						$month = date('m');
						$day = date('d');
						$hour = date('H');
						$min = date('i');
						$sa = date('s');
						$uu = round(microtime(true) * 1000);
						$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$alumniid).$sa.$uu;	

						DB::query('INSERT INTO affiliation_sem_train_workshop VALUES(\'\', :identifier, :stwName, :stwVenue, :stwMonth, :stwYear, :stwComment, :stwType, :stwLevel, :alumniid)', array(':identifier'=> $identifier, ':stwName'=> $stwNames, ':stwVenue'=> $stwVenues, ':stwMonth'=> $stwMonths, ':stwYear'=> $stwYears, ':stwComment'=> $stwComments, ':stwType'=> $stwTypes, ':stwLevel'=> $stwLevels, ':alumniid'=> $alumniid));
					}

					$admin = DB::query('SELECT * FROM alumni WHERE alumni_id = :userid', array(':userid' => $alumniid));

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
					}

					if ($adextname == null){
						$names = "";
						$names .= convert_string('decrypt', $adfname)." ".convert_string('decrypt', $admname)." ".convert_string('decrypt', $adlname);
					}
						else{
						$names = "";
						$names .= convert_string('decrypt', $adfname)." ".convert_string('decrypt', $admname)." ".convert_string('decrypt', $adlname)." ".convert_string('decrypt', $adextname);
					}
					$description ="";
					$description .= "Alumni ".$names." added Seminar, Training, and Workshop attended!";
					$logtype = "Add Seminar, Training, and Workshop";

					DB::query("INSERT INTO alumni_logs (log_type, description, date_time, alumni_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $alumniid));
				}
			}

			header('Location: ../signup-affiliations-certifications.php');
		}
	}
?>