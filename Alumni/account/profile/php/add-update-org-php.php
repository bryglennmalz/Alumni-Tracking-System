<?php
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	
	if(isset($_POST["operation"])){
		if ($_POST["operation"] == "Add Organization"){
			$message = '';
			$error = '';

			$orgName = $_POST['orgName'];
			$orgPos = $_POST['orgPos'];
			$mStatred = $_POST['orgMStatred'];
			$mEnded = $_POST['orgMEnded'];
			$yrStarted = $_POST['orgYrStarted'];
			$yrEnded = $_POST['orgYrStarted'];
			$orgComment = $_POST['orgComment'];
			$alumniid = $_POST['alumniid'];

			$loggedin = Login::isloggedin();

			if ($loggedin == $alumniid){

				if($orgName != "" && $orgPos != ""){

						if($mEnded == "Present" || $yrEnded == "Present"){
							$orgNames = convert_string('encrypt', clean_text($orgName));
							$orgPoss = convert_string('encrypt', clean_text($orgPos));
							$mStatreds = convert_string('encrypt', clean_text($mStatred));
							$mEndeds = convert_string('encrypt', clean_text("Present"));
							$yrStarteds = convert_string('encrypt', clean_text($yrStarted));
							$yrEndeds = convert_string('encrypt', clean_text("Present"));
							$orgComments = convert_string('encrypt', clean_text($orgComment));

							$year = date('Y');
							$month = date('m');
							$day = date('d');
							$hour = date('H');
							$min = date('i');
							$sa = date('s');
							$uu = round(microtime(true) * 1000);
							$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$alumniid).$sa.$uu;	

							DB::query('INSERT INTO alumnitracking.affiliations_organizations VALUES(\'\', :identifier, :orgName, :orgPos, :mStatred, :yrStarted, :mEnded, :yrEnded, :orgComment, :alumniid)', array(':identifier'=> $identifier,':orgName'=> $orgNames,':orgPos'=> $orgPoss,':mStatred'=> $mStatreds,':yrStarted'=> $yrStarteds,':mEnded'=> $mEndeds, ':yrEnded'=> $yrEndeds,':orgComment'=> $orgComments, ':alumniid'=> $alumniid));
						}
						else{
							$orgNames = convert_string('encrypt', clean_text($orgName));
							$orgPoss = convert_string('encrypt', clean_text($orgPos));
							$mStatreds = convert_string('encrypt', clean_text($mStatred));
							$mEndeds = convert_string('encrypt', clean_text($mEnded));
							$yrStarteds = convert_string('encrypt', clean_text($yrStarted));
							$yrEndeds = convert_string('encrypt', clean_text($yrEnded));
							$orgComments = convert_string('encrypt', clean_text($orgComment));

							$year = date('Y');
							$month = date('m');
							$day = date('d');
							$hour = date('H');
							$min = date('i');
							$sa = date('s');
							$uu = round(microtime(true) * 1000);
							$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$alumniid).$sa.$uu;	

							DB::query('INSERT INTO alumnitracking.affiliations_organizations VALUES(\'\', :identifier, :orgName, :orgPos, :mStatred, :yrStarted, :mEnded, :yrEnded, :orgComment, :alumniid)', array(':identifier'=> $identifier,':orgName'=> $orgNames,':orgPos'=> $orgPoss,':mStatred'=> $mStatreds,':yrStarted'=> $yrStarteds,':mEnded'=> $mEndeds, ':yrEnded'=> $yrEndeds,':orgComment'=> $orgComments, ':alumniid'=> $alumniid));
						}

						

						$description = "Alumni ". Login::isloggedin(). " added new organization.";

						DB::query("INSERT INTO alumnitracking.alumni_logs (description, date_time, alumni_id) VALUES (:description, NOW(), :alumni_id)", array(":description" => $description, ":alumni_id" => Login::isloggedin()));
					
					echo "Organization saved.";
				}

			}
			//header('Location: ../signup-affiliations-seminars-training-workshop.php');

		}
		if ($_POST["operation"] == "Edit Organization"){
			$message = '';
			$error = '';

			$orgName = $_POST['eorgName'];
			$orgPos = $_POST['eorgPos'];
			$mStatred = $_POST['eorgMStatred'];
			$mEnded = $_POST['eorgMEnded'];
			$yrStarted = $_POST['eorgYrStarted'];
			$yrEnded = $_POST['eorgYrStarted'];
			$orgComment = $_POST['eorgComment'];
			$alumniid = $_POST['ealumniid'];
			$orgid = $_POST['eorgid'];

			$loggedin = Login::isloggedin();

			if ($loggedin == $alumniid){

				if($orgName != "" && $orgPos != ""){

						if($mEnded == "Present" || $yrEnded == "Present"){
							$orgNames = convert_string('encrypt', clean_text($orgName));
							$orgPoss = convert_string('encrypt', clean_text($orgPos));
							$mStatreds = convert_string('encrypt', clean_text($mStatred));
							$mEndeds = convert_string('encrypt', clean_text("Present"));
							$yrStarteds = convert_string('encrypt', clean_text($yrStarted));
							$yrEndeds = convert_string('encrypt', clean_text("Present"));
							$orgComments = convert_string('encrypt', clean_text($orgComment));


							DB::query('UPDATE affiliations_organizations SET WHERE org_id=:orgid AND alumni_id=:alumniid', array(':orgName'=> $orgNames,':orgPos'=> $orgPoss,':mStatred'=> $mStatreds,':yrStarted'=> $yrStarteds,':mEnded'=> $mEndeds, ':yrEnded'=> $yrEndeds,':orgComment'=> $orgComments,':orgid'=>$orgid, ':alumniid'=> $alumniid));
						}
						else{
							$orgNames = convert_string('encrypt', clean_text($orgName));
							$orgPoss = convert_string('encrypt', clean_text($orgPos));
							$mStatreds = convert_string('encrypt', clean_text($mStatred));
							$mEndeds = convert_string('encrypt', clean_text($mEnded));
							$yrStarteds = convert_string('encrypt', clean_text($yrStarted));
							$yrEndeds = convert_string('encrypt', clean_text($yrEnded));
							$orgComments = convert_string('encrypt', clean_text($orgComment));

							DB::query('UPDATE affiliations_organizations SET WHERE org_id=:orgid AND alumni_id=:alumniid', array(':orgName'=> $orgNames,':orgPos'=> $orgPoss,':mStatred'=> $mStatreds,':yrStarted'=> $yrStarteds,':mEnded'=> $mEndeds, ':yrEnded'=> $yrEndeds,':orgComment'=> $orgComments,':orgid'=>$orgid, ':alumniid'=> $alumniid));
						}

						

						$description = "Alumni ". Login::isloggedin(). " added new organization.";

						DB::query("INSERT INTO alumnitracking.alumni_logs (description, date_time, alumni_id) VALUES (:description, NOW(), :alumni_id)", array(":description" => $description, ":alumni_id" => Login::isloggedin()));
					
					echo "Organization updated.";
				}

			}
			//header('Location: ../signup-affiliations-seminars-training-workshop.php');

		}

	}

?>