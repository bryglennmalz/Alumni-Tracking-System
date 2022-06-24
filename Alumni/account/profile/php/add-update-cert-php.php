<?php
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	
	if(isset($_POST["operation"])){
		if ($_POST["operation"] == "Add Certifications"){

			$certName =$_POST['certName'];
			$certAuth =$_POST['certAuth'];
			$mStatred =$_POST['mCert'];
			$mEnded =$_POST['mExpire'];
			$yrStarted =$_POST['yrCert'];
			$yrEnded =$_POST['yrExpire'];
			$certUrl =$_POST['certUrl'];
			$alumniid =$_POST['alumniid'];

			$loggedin = Login::isloggedin();

			if ($loggedin == $alumniid){

				

						if ($mEnded == "No Expiration" || $yrEnded == "No Expiration"){
							$certNames = convert_string('encrypt', clean_text($certName));
							$certAuths = convert_string('encrypt', clean_text($certAuth));
							$mStatreds = convert_string('encrypt', clean_text($mStatred));
							$yrStarteds = convert_string('encrypt', clean_text($yrStarted));
							$mEndeds = convert_string('encrypt', clean_text("No Expiration"));
							$yrEndeds = convert_string('encrypt', clean_text("No Expiration"));
							$certUrls = convert_string('encrypt', clean_text($certUrl));

							$year = date('Y');
							$month = date('m');
							$day = date('d');
							$hour = date('H');
							$min = date('i');
							$sa = date('s');
							$uu = round(microtime(true) * 1000);
							$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$alumniid).$sa.$uu;	

							DB::query('INSERT INTO alumnitracking.affiliations_certifications VALUES(\'\', :identifier, :certNames, :certAuths, :mStatreds, :yrStarteds, :mEndeds, :yrEndeds, :certUrls, :alumniid)', array(':identifier'=> $identifier, ':certNames'=> $certNames, ':certAuths'=> $certAuths, ':mStatreds'=> $mStatreds, ':yrStarteds'=> $yrStarteds, ':mEndeds'=> $mEndeds, ':yrEndeds'=> $yrEndeds, ':certUrls'=> $certUrls, ':alumniid'=> $alumniid));
						}
						else{
							$certNames = convert_string('encrypt', clean_text($certName));
							$certAuths = convert_string('encrypt', clean_text($certAuth));
							$mStatreds = convert_string('encrypt', clean_text($mStatred));
							$yrStarteds = convert_string('encrypt', clean_text($yrStarted));
							$mEndeds = convert_string('encrypt', clean_text($mEnded));
							$yrEndeds = convert_string('encrypt', clean_text($yrEnded));
							$certUrls = convert_string('encrypt', clean_text($certUrl));

							$year = date('Y');
							$month = date('m');
							$day = date('d');
							$hour = date('H');
							$min = date('i');
							$sa = date('s');
							$uu = round(microtime(true) * 1000);
							$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$alumniid).$sa.$uu;	

							DB::query('INSERT INTO alumnitracking.affiliations_certifications VALUES(\'\', :identifier, :certNames, :certAuths, :mStatreds, :yrStarteds, :mEndeds, :yrEndeds, :certUrls, :alumniid)', array(':identifier'=> $identifier, ':certNames'=> $certNames, ':certAuths'=> $certAuths, ':mStatreds'=> $mStatreds, ':yrStarteds'=> $yrStarteds, ':mEndeds'=> $mEndeds, ':yrEndeds'=> $yrEndeds, ':certUrls'=> $certUrls, ':alumniid'=> $alumniid));
						}

						

						$description = "Alumni ". Login::isloggedin(). " added new seminar/training/workshop that he/she attended.";

						DB::query("INSERT INTO alumnitracking.alumni_logs (description, date_time, alumni_id) VALUES (:description, NOW(), :alumni_id)", array(":description" => $description, ":alumni_id" => Login::isloggedin()));


						echo "New Certification has been saved!";
				}
			

			//header('Location: ../signup-affiliations-honors-awards.php');
		}

		if ($_POST["operation"] == "Edit Certifications"){

			$certName =$_POST['ecertName'];
			$certAuth =$_POST['ecertAuth'];
			$mStatred =$_POST['emCert'];
			$mEnded =$_POST['emExpire'];
			$yrStarted =$_POST['eyrCert'];
			$yrEnded =$_POST['eyrExpire'];
			$certUrl =$_POST['ecertUrl'];
			$alumniid =$_POST['ealumniid'];
			$certid =$_POST['ecertid'];

			$loggedin = Login::isloggedin();

			if ($loggedin == $alumniid){

				

						if ($mEnded == "No Expiration" || $yrEnded == "No Expiration"){
							$certNames = convert_string('encrypt', clean_text($certName));
							$certAuths = convert_string('encrypt', clean_text($certAuth));
							$mStatreds = convert_string('encrypt', clean_text($mStatred));
							$yrStarteds = convert_string('encrypt', clean_text($yrStarted));
							$mEndeds = convert_string('encrypt', clean_text("No Expiration"));
							$yrEndeds = convert_string('encrypt', clean_text("No Expiration"));
							$certUrls = convert_string('encrypt', clean_text($certUrl));

							$year = date('Y');
							$month = date('m');
							$day = date('d');
							$hour = date('H');
							$min = date('i');
							$sa = date('s');
							$uu = round(microtime(true) * 1000);
							$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$alumniid).$sa.$uu;	

							DB::query('UPDATE affiliations_certifications SET cert_name=:certNames, cert_authority=:certAuths, from_month=:mStatreds, from_year=:yrStarteds, to_month=:mEndeds, to_year=:yrEndeds, url=:certUrls WHERE cert_id=:certid AND alumniid=:alumniid', array(':certNames'=> $certNames, ':certAuths'=> $certAuths, ':mStatreds'=> $mStatreds, ':yrStarteds'=> $yrStarteds, ':mEndeds'=> $mEndeds, ':yrEndeds'=> $yrEndeds, ':certUrls'=> $certUrls, ':certid'=>$certid, ':alumniid'=> $alumniid));

						}
						else{
							$certNames = convert_string('encrypt', clean_text($certName));
							$certAuths = convert_string('encrypt', clean_text($certAuth));
							$mStatreds = convert_string('encrypt', clean_text($mStatred));
							$yrStarteds = convert_string('encrypt', clean_text($yrStarted));
							$mEndeds = convert_string('encrypt', clean_text($mEnded));
							$yrEndeds = convert_string('encrypt', clean_text($yrEnded));
							$certUrls = convert_string('encrypt', clean_text($certUrl));

							$year = date('Y');
							$month = date('m');
							$day = date('d');
							$hour = date('H');
							$min = date('i');
							$sa = date('s');
							$uu = round(microtime(true) * 1000);
							$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$alumniid).$sa.$uu;	

							DB::query('UPDATE affiliations_certifications SET cert_name=:certNames, cert_authority=:certAuths, from_month=:mStatreds, from_year=:yrStarteds, to_month=:mEndeds, to_year=:yrEndeds, url=:certUrls WHERE cert_id=:certid AND alumniid=:alumniid', array(':certNames'=> $certNames, ':certAuths'=> $certAuths, ':mStatreds'=> $mStatreds, ':yrStarteds'=> $yrStarteds, ':mEndeds'=> $mEndeds, ':yrEndeds'=> $yrEndeds, ':certUrls'=> $certUrls, ':certid'=>$certid, ':alumniid'=> $alumniid));
						}

						

						$description = "Alumni ". Login::isloggedin(). " added new seminar/training/workshop that he/she attended.";

						DB::query("INSERT INTO alumnitracking.alumni_logs (description, date_time, alumni_id) VALUES (:description, NOW(), :alumni_id)", array(":description" => $description, ":alumni_id" => Login::isloggedin()));


						echo "New Certification has been saved!";
				}
			

			//header('Location: ../signup-affiliations-honors-awards.php');
		}
	}
?>