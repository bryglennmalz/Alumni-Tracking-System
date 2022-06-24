<?php
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	
	if(isset($_POST["operation"])){
		if ($_POST["operation"] == "Update Educ"){
			$message = '';
			$error = '';

			$jobPos = $_POST['jobPos'];
			$compName = $_POST['compName'];
			$salRange = $_POST['salRange'];
			$empType = $_POST['empType'];
			$senLevel = $_POST['senLevel'];
			$mStatred = $_POST['mStatred'];
			$mEnded = $_POST['mEnded'];
			$yrStarted = $_POST['yrStarted'];
			$yrEnded = $_POST['yrEnded'];
			$locCityMun = $_POST['locCityMun'];
			$locProv = $_POST['locProv'];
			$locCountry = $_POST['locCountry'];
			$mComment = $_POST['mComment'];
			$alumniid = $_POST['alumniid'];

			$loggedin = Login::isloggedin();

			if ($loggedin == $alumniid){

				foreach($jobPos as $a => $c){

					$identifier="";

					//echo $mEnded[$a];
					//echo $yrEnded[$a];

					if($mEnded[$a] == "Present" || $yrEnded[$a] == "Present"){

						$jobPosx = convert_string('encrypt', clean_text($jobPos[$a]));
						$compNamex = convert_string('encrypt', clean_text($compName[$a]));
						$salRangex = convert_string('encrypt', clean_text($salRange[$a]));
						$empTypex = convert_string('encrypt', clean_text($empType[$a]));
						$senLevelx = convert_string('encrypt', clean_text($senLevel[$a]));
						$mStatredx = convert_string('encrypt', clean_text($mStatred[$a]));
						$mEndedx = convert_string('encrypt', clean_text("Present"));
						$yrStartedx = convert_string('encrypt', clean_text($yrStarted[$a]));
						$yrEndedx = convert_string('encrypt', clean_text("Present"));
						$locCityMunx = $locCityMun[$a];
						$locProvx = $locProv[$a];
						$locCountryx = $locCountry[$a];
						$mCommentx = convert_string('encrypt', clean_text($mComment[$a]));

						$year = date('Y');
						$month = date('m');
						$day = date('d');
						$hour = date('H');
						$min = date('i');
						$sa = date('s');
						$uu = round(microtime(true) * 1000);
						$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$alumniid).$sa.$uu;	

						if($locCityMunx != "" && $locProvx != ""){
							DB::query('INSERT INTO job_history (job_hist_id, company, position, mo_start, yr_start, mo_end, yr_end, comments, salary_range, emp_type, senior_level, cm_id, ps_id, c_id, alumni_id) VALUES ( :job_hist_id, :compNamex, :jobPosx, :mStatredx, :yrStartedx, :mEndedx, :yrEndedx, :mCommentx, :salRangex, :empTypex, :senLevelx, :locCityMunx, :locProvx, :locCountryx, :alumniid)', array(':job_hist_id'=>$identifier, ':compNamex'=>$compNamex, ':jobPosx'=>$jobPosx, ':mStatredx'=>$mStatredx,':yrStartedx'=>$yrStartedx, ':mEndedx'=>$mEndedx, ':yrEndedx'=>$yrEndedx, ':mCommentx'=>$mCommentx, ':salRangex'=>$salRangex, ':empTypex'=>$empTypex, ':senLevelx'=>$senLevelx, ':locCityMunx'=>$locCityMunx, ':locProvx'=>$locProvx, ':locCountryx'=>$locCountryx, ':alumniid'=>$alumniid));
						}
						else if($locCityMuns == "" && $locProvs != ""){
							DB::query('INSERT INTO job_history (job_hist_id, company, position, mo_start, yr_start, mo_end, yr_end, comments, salary_range, emp_type, senior_level, ps_id, c_id, alumni_id) VALUES ( :job_hist_id, :compNamex, :jobPosx, :mStatredx, :yrStartedx, :mEndedx, :yrEndedx, :mCommentx, :salRangex, :empTypex, :senLevelx, :locCityMunx, :locProvx, :locCountryx, :alumniid)', array(':job_hist_id'=>$identifier, ':compNamex'=>$compNamex, ':jobPosx'=>$jobPosx, ':mStatredx'=>$mStatredx,':yrStartedx'=>$yrStartedx, ':mEndedx'=>$mEndedx, ':yrEndedx'=>$yrEndedx, ':mCommentx'=>$mCommentx, ':salRangex'=>$salRangex, ':empTypex'=>$empTypex, ':senLevelx'=>$senLevelx, ':locProvx'=>$locProvx, ':locCountryx'=>$locCountryx, ':alumniid'=>$alumniid));
						}
						else if($locCityMuns == "" && $locProvs == ""){
							DB::query('INSERT INTO job_history (job_hist_id, company, position, mo_start, yr_start, mo_end, yr_end, comments, salary_range, emp_type, senior_level, c_id, alumni_id) VALUES ( :job_hist_id, :compNamex, :jobPosx, :mStatredx, :yrStartedx, :mEndedx, :yrEndedx, :mCommentx, :salRangex, :empTypex, :senLevelx, :locCityMunx, :locProvx, :locCountryx, :alumniid)', array(':job_hist_id'=>$identifier, ':compNamex'=>$compNamex, ':jobPosx'=>$jobPosx, ':mStatredx'=>$mStatredx,':yrStartedx'=>$yrStartedx, ':mEndedx'=>$mEndedx, ':yrEndedx'=>$yrEndedx, ':mCommentx'=>$mCommentx, ':salRangex'=>$salRangex, ':empTypex'=>$empTypex, ':senLevelx'=>$senLevelx, ':locCountryx'=>$locCountryx, ':alumniid'=>$alumniid));
						}
					}
					else{
						$jobPoss = convert_string('encrypt', clean_text($jobPos[$a]));
						$compNames = convert_string('encrypt', clean_text($compName[$a]));
						$salRanges = convert_string('encrypt', clean_text($salRange[$a]));
						$empTypes = convert_string('encrypt', clean_text($empType[$a]));
						$senLevels = convert_string('encrypt', clean_text($senLevel[$a]));
						$mStatreds = convert_string('encrypt', clean_text($mStatred[$a]));
						$mEndeds = convert_string('encrypt', clean_text($mEnded[$a]));
						$yrStarteds = convert_string('encrypt', clean_text($yrStarted[$a]));
						$yrEndeds = convert_string('encrypt', clean_text($yrEnded[$a]));
						$locCityMuns = $locCityMun[$a];
						$locProvs = $locProv[$a];
						$locCountrys = $locCountry[$a];
						$mComments = convert_string('encrypt', clean_text($mComment[$a]));

						$year = date('Y');
						$month = date('m');
						$day = date('d');
						$hour = date('H');
						$min = date('i');
						$sa = date('s');
						$uu = round(microtime(true) * 1000);
						$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$alumniid).$sa.$uu;	

						if($locCityMuns != "" && $locProvs != ""){
							DB::query('INSERT INTO job_history (job_hist_id, company, position, mo_start, yr_start, mo_end, yr_end, comments, salary_range, emp_type, senior_level, cm_id, ps_id, c_id, alumni_id) VALUES (:job_hist_id, :compNamex,:jobPosx, :mStatredx, :yrStartedx, :mEndedx, :yrEndedx, :mCommentx, :salRangex, :empTypex, :senLevelx, :locCityMunx, :locProvx, :locCountryx, :alumniid)',  array(':job_hist_id' => $identifier, ':compNamex' => $compNames, ':jobPosx' => $jobPoss, ':mStatredx' => $mStatreds,':yrStartedx' => $yrStarteds, ':mEndedx' => $mEndeds, ':yrEndedx' => $yrEndeds, ':mCommentx' => $mComments, ':salRangex' => $salRanges, ':empTypex' => $empTypes, ':senLevelx' => $senLevels, ':locCityMunx' => $locCityMuns, ':locProvx' => $locProvs, ':locCountryx' => $locCountrys, ':alumniid' => Login::isloggedin()));
						}
						else if($locCityMuns == "" && $locProvs != ""){
							DB::query('INSERT INTO job_history (job_hist_id, company, position, mo_start, yr_start, mo_end, yr_end, comments, salary_range, emp_type, senior_level, ps_id, c_id, alumni_id) VALUES (:job_hist_id, :compNames, :jobPoss, :mStatreds, :yrStarteds, :mEndeds, :yrEndeds, :mComments, :salRanges, :empTypes, :senLevels, :locProvs, :locCountrys, :alumniid)',  array(':job_hist_id' => $identifier, ':compNames' => $compNames, ':jobPoss' => $jobPoss, ':mStatreds' => $mStatreds,':yrStarteds' => $yrStarteds, ':mEndeds' => $mEndeds, ':yrEndeds' => $yrEndeds, ':mComments' => $mComments, ':salRanges' => $salRanges, ':empTypes' => $empTypes, ':senLevels' => $senLevels, ':locProvs' => $locProvs, ':locCountrys' => $locCountrys, ':alumniid' => Login::isloggedin()));
						}

						else if($locCityMuns == "" && $locProvs == ""){
							DB::query('INSERT INTO job_history (job_hist_id, company, position, mo_start, yr_start, mo_end, yr_end, comments, salary_range, emp_type, senior_level, c_id, alumni_id) VALUES (:job_hist_id, :compNamex,:jobPosx, :mStatredx, :yrStartedx, :mEndedx, :yrEndedx, :mCommentx, :salRangex, :empTypex, :senLevelx, :locCountryx, :alumniid)',  array(':job_hist_id' => $identifier, ':compNamex' => $compNames, ':jobPosx' => $jobPoss, ':mStatredx' => $mStatreds,':yrStartedx' => $yrStarteds, ':mEndedx' => $mEndeds, ':yrEndeds' => $yrEndeds, ':mCommentx' => $mComments, ':salRangex' => $salRanges, ':empTypex' => $empTypes, ':senLevelx' => $senLevels, ':locCountryx' => $locCountrys, ':alumniid' => Login::isloggedin()));
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
					$description .= "Alumni ".$names." added Job History Information!";
					$logtype = "Update Job History";

					DB::query("INSERT INTO alumni_logs (log_type, description, date_time, alumni_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $alumniid));

				}

					header('Location: ../signup-affiliations-organizations.php');
					
			}


		}
	}
?>