<?php
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	
	if(isset($_POST["operation"])){
		if ($_POST["operation"] == "Add Job History"){
			$message = '';
			$error = '';

			$jobPos = convert_string('encrypt', clean_text($_POST['jobPos']));
			$compName = convert_string('encrypt', clean_text($_POST['compName']));
			$salRange = $_POST['salRange'];
			$empType = $_POST['empType'];
			$senLevel = $_POST['senLevel'];
			$mStatred = convert_string('encrypt', clean_text($_POST['mStatred']));
			$yrStarted = convert_string('encrypt', clean_text($_POST['yrStarted']));
			$mEnded = convert_string('encrypt', clean_text($_POST['mEnded']));
			$yrEnded = convert_string('encrypt', clean_text($_POST['yrEnded']));
			$locCityMun = $_POST['locCityMun'];
			$locProv = $_POST['locProv'];
			$locCountry = $_POST['locCountry'];
			$mComment = convert_string('encrypt', clean_text($_POST['mComment']));
			$alumniid = $_POST['alumniid'];

			$year = date('Y');
			$month = date('m');
			$day = date('d');
			$hour = date('H');
			$min = date('i');
			$sa = date('s');
			$uu = round(microtime(true) * 1000);
			$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$alumniid).$sa.$uu;	

			$loggedin = Login::isloggedin();

			if ($loggedin == $alumniid){

				if($_POST['mEnded'] == "Present" || $_POST['yrEnded'] == "Present"){
					$yearends = convert_string('encrypt', clean_text("Present"));
					$monthends = convert_string('encrypt', clean_text("Present"));
					DB::query('INSERT INTO alumnitracking.job_history VALUES (\'\', :job_hist_id, :compNamex, :jobPosx, :mStatredx, :yrStartedx, :mEndedx, :yrEndedx, :mCommentx, :salRangex, :empTypex, :senLevelx, :locCityMunx, :locProvx, :locCountryx, :alumniid)', array(':job_hist_id'=>$identifier, ':compNamex'=>$compName, ':jobPosx'=>$jobPos, ':mStatredx'=>$mStatred,':yrStartedx'=>$yrStarted, ':mEndedx'=>$monthends, ':yrEndedx'=>$yearends, ':mCommentx'=>$mComment, ':salRangex'=>$salRange, ':empTypex'=>$empType, ':senLevelx'=>$senLevel, ':locCityMunx'=>$locCityMun, ':locProvx'=>$locProv, ':locCountryx'=>$locCountry, ':alumniid'=>$alumniid));
				}
				else{
					DB::query('INSERT INTO alumnitracking.job_history VALUES (\'\', :job_hist_id, :compNamex, :jobPosx, :mStatredx, :yrStartedx, :mEndedx, :yrEndedx, :mCommentx, :salRangex, :empTypex, :senLevelx, :locCityMunx, :locProvx, :locCountryx, :alumniid)', array(':job_hist_id'=>$identifier, ':compNamex'=>$compName, ':jobPosx'=>$jobPos, ':mStatredx'=>$mStatred,':yrStartedx'=>$yrStarted, ':mEndedx'=>$mEnded, ':yrEndedx'=>$yrEnded, ':mCommentx'=>$mComment, ':salRangex'=>$salRange, ':empTypex'=>$empType, ':senLevelx'=>$senLevel, ':locCityMunx'=>$locCityMun, ':locProvx'=>$locProv, ':locCountryx'=>$locCountry, ':alumniid'=>$alumniid));

						

				}
						
					$description = "Alumni ". Login::isloggedin(). " added new Job History.";

					DB::query("INSERT INTO alumnitracking.alumni_logs (description, date_time, alumni_id) VALUES (:description, NOW(), :alumni_id)", array(":description" => $description, ":alumni_id" => Login::isloggedin()));

					
			}


		}
	}
?>