<?php
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	
	if(isset($_POST["operation"])){
		if ($_POST["operation"] == "Add Organizations"){
			$message = '';
			$error = '';

			$orgName = $_POST['orgName'];
			$orgPos = $_POST['orgPos'];
			$mStatred = $_POST['mStatred'];
			$mEnded = $_POST['mEnded'];
			$yrStarted = $_POST['yrStarted'];
			$yrEnded = $_POST['yrEnded'];
			$orgComment = $_POST['orgComment'];
			$alumniid = $_POST['alumniid'];

			$loggedin = Login::isloggedin();

			if ($loggedin == $alumniid){

				if($orgName != "" && $orgPos != ""){

					foreach ($orgName as $a => $c) {

						//echo $mEnded[$a];
						//echo $yrEnded[$a];

						if($mEnded[$a] == "Present" || $yrEnded[$a] == "Present"){
							$orgNames = convert_string('encrypt', clean_text($orgName[$a]));
							$orgPoss = convert_string('encrypt', clean_text($orgPos[$a]));
							$mStatreds = convert_string('encrypt', clean_text($mStatred[$a]));
							$mEndeds = convert_string('encrypt', clean_text("Present"));
							$yrStarteds = convert_string('encrypt', clean_text($yrStarted[$a]));
							$yrEndeds = convert_string('encrypt', clean_text("Present"));
							$orgComments = convert_string('encrypt', clean_text($orgComment[$a]));

							$year = date('Y');
							$month = date('m');
							$day = date('d');
							$hour = date('H');
							$min = date('i');
							$sa = date('s');
							$uu = round(microtime(true) * 1000);
							$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$alumniid).$sa.$uu;	

							DB::query('INSERT INTO affiliations_organizations VALUES(\'\', :identifier, :orgName, :orgPos, :mStatred, :yrStarted, :mEnded, :yrEnded, :orgComment, :alumniid)', array(':identifier'=> $identifier,':orgName'=> $orgNames,':orgPos'=> $orgPoss,':mStatred'=> $mStatreds,':yrStarted'=> $yrStarteds,':mEnded'=> $mEndeds, ':yrEnded'=> $yrEndeds,':orgComment'=> $orgComments, ':alumniid'=> $alumniid));

							//echo $orgName[$a]," ", $orgPos[$a], $mStatred[$a]," ", $yrStarted[$a], convert_string('decrypt',$mEndeds)," ", convert_string('decrypt',$yrEndeds), " ", $orgComment[$a];
						}
						else{
							$orgNames = convert_string('encrypt', clean_text($orgName[$a]));
							$orgPoss = convert_string('encrypt', clean_text($orgPos[$a]));
							$mStatreds = convert_string('encrypt', clean_text($mStatred[$a]));
							$mEndeds = convert_string('encrypt', clean_text($mEnded[$a]));
							$yrStarteds = convert_string('encrypt', clean_text($yrStarted[$a]));
							$yrEndeds = convert_string('encrypt', clean_text($yrEnded[$a]));
							$orgComments = convert_string('encrypt', clean_text($orgComment[$a]));

							$year = date('Y');
							$month = date('m');
							$day = date('d');
							$hour = date('H');
							$min = date('i');
							$sa = date('s');
							$uu = round(microtime(true) * 1000);
							$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$alumniid).$sa.$uu;	

							DB::query('INSERT INTO affiliations_organizations VALUES(\'\', :identifier, :orgName, :orgPos, :mStatred, :yrStarted, :mEnded, :yrEnded, :orgComment, :alumniid)', array(':identifier'=> $identifier,':orgName'=> $orgNames,':orgPos'=> $orgPoss,':mStatred'=> $mStatreds,':yrStarted'=> $yrStarteds,':mEnded'=> $mEndeds, ':yrEnded'=> $yrEndeds,':orgComment'=> $orgComments, ':alumniid'=> $alumniid));

							//echo $orgName[$a]," ", $orgPos[$a], $mStatred[$a]," ", $yrStarted[$a], $mEnded[$a]," ", $yrEnded[$a], " ", $orgComment[$a];
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
					$description .= "Alumni ".$names." added Organization information!";
					$logtype = "Add Organization";

					DB::query("INSERT INTO alumni_logs (log_type, description, date_time, alumni_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $alumniid));
				}

			}
			header('Location: ../signup-affiliations-seminars-trainings-workshops.php');

		}

	}

?>