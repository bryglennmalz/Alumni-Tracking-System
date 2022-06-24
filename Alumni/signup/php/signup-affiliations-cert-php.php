<?php
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	
	if(isset($_POST["operation"])){
		if ($_POST["operation"] == "Add Certifications"){

			$certName =$_POST['certName'];
			$certAuth =$_POST['certAuth'];
			$mStatred =$_POST['mStarted'];
			$mEnded =$_POST['mEnded'];
			$yrStarted =$_POST['yrStarted'];
			$yrEnded =$_POST['yrEnded'];
			$certUrl =$_POST['certUrl'];
			$alumniid =$_POST['alumniid'];

			$loggedin = Login::isloggedin();

			if ($loggedin == $alumniid){

				if($certName != "" && $certAuth != "" && $mStatred != "" && $yrStarted != ""){

					foreach ($certName as $a => $c) {

						if ($mEnded[$a] == "No Expiration" || $yrEnded[$a] == "No Expiration"){
							$certNames = convert_string('encrypt', clean_text($certName[$a]));
							$certAuths = convert_string('encrypt', clean_text($certAuth[$a]));
							$mStatreds = convert_string('encrypt', clean_text($mStatred[$a]));
							$yrStarteds = convert_string('encrypt', clean_text($yrStarted[$a]));
							$mEndeds = convert_string('encrypt', clean_text("No Expiration"));
							$yrEndeds = convert_string('encrypt', clean_text("No Expiration"));
							$certUrls = convert_string('encrypt', clean_text($certUrl[$a]));

							$year = date('Y');
							$month = date('m');
							$day = date('d');
							$hour = date('H');
							$min = date('i');
							$sa = date('s');
							$uu = round(microtime(true) * 1000);
							$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$alumniid).$sa.$uu;	

							DB::query('INSERT INTO affiliations_certifications VALUES(\'\', :identifier, :certNames, :certAuths, :mStatreds, :yrStarteds, :mEndeds, :yrEndeds, :certUrls, :alumniid)', array(':identifier'=> $identifier, ':certNames'=> $certNames, ':certAuths'=> $certAuths, ':mStatreds'=> $mStatreds, ':yrStarteds'=> $yrStarteds, ':mEndeds'=> $mEndeds, ':yrEndeds'=> $yrEndeds, ':certUrls'=> $certUrls, ':alumniid'=> $alumniid));
						}
						else{
							$certNames = convert_string('encrypt', clean_text($certName[$a]));
							$certAuths = convert_string('encrypt', clean_text($certAuth[$a]));
							$mStatreds = convert_string('encrypt', clean_text($mStatred[$a]));
							$yrStarteds = convert_string('encrypt', clean_text($yrStarted[$a]));
							$mEndeds = convert_string('encrypt', clean_text($mEnded[$a]));
							$yrEndeds = convert_string('encrypt', clean_text($yrEnded[$a]));
							$certUrls = convert_string('encrypt', clean_text($certUrl[$a]));

							$year = date('Y');
							$month = date('m');
							$day = date('d');
							$hour = date('H');
							$min = date('i');
							$sa = date('s');
							$uu = round(microtime(true) * 1000);
							$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$alumniid).$sa.$uu;	

							DB::query('INSERT INTO affiliations_certifications VALUES(\'\', :identifier, :certNames, :certAuths, :mStatreds, :yrStarteds, :mEndeds, :yrEndeds, :certUrls, :alumniid)', array(':identifier'=> $identifier, ':certNames'=> $certNames, ':certAuths'=> $certAuths, ':mStatreds'=> $mStatreds, ':yrStarteds'=> $yrStarteds, ':mEndeds'=> $mEndeds, ':yrEndeds'=> $yrEndeds, ':certUrls'=> $certUrls, ':alumniid'=> $alumniid));
						}
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
					$description .= "Alumni ".$names." added Certification acquired!";
					$logtype = "Add Certifications";

					DB::query("INSERT INTO alumni_logs (log_type, description, date_time, alumni_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $alumniid));
				}
			}

			header('Location: ../signup-affiliations-honors-awards.php');
		}
	}
?>