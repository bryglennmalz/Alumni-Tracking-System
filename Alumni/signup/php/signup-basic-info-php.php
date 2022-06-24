<?php
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	
	if(isset($_POST["operation"])){
		if ($_POST["operation"] == "Update Basic Info"){
			$message = '';
			$error = '';

			$alumniid = convert_string('encrypt', clean_text($_POST['alumniId']));
			$firstName = convert_string('encrypt', clean_text($_POST['firstName']));
			$middleInitial = convert_string('encrypt', clean_text($_POST['middleInitial']));
			$lastName = convert_string('encrypt', clean_text($_POST['lastName']));
			$extName = convert_string('encrypt', clean_text($_POST['extName']));
			$sex = convert_string('encrypt', clean_text($_POST['sex']));
			$emailAddress = convert_string('encrypt', clean_text($_POST['emailAddress']));
			$phoneNo = convert_string('encrypt', clean_text($_POST['phoneNo']));

			$civilStat = convert_string('encrypt', clean_text($_POST['civilStat']));
			$nationality = convert_string('encrypt', clean_text($_POST['nationality']));
			$ethnicity = convert_string('encrypt', clean_text($_POST['ethnicity']));
			$religion = convert_string('encrypt', clean_text($_POST['religion']));
			$empstat = convert_string('encrypt', clean_text($_POST['empstat']));
			
			$telephoneNo = convert_string('encrypt', clean_text($_POST['telephoneNo']));
			$googlePlus = convert_string('encrypt', clean_text($_POST['googlePlus']));
			$facebook = convert_string('encrypt', clean_text($_POST['facebook']));
			$instagram = convert_string('encrypt', clean_text($_POST['instagram']));
			$linkedin = convert_string('encrypt', clean_text($_POST['linkedin']));
			$twitter = convert_string('encrypt', clean_text($_POST['twitter']));
			$website = convert_string('encrypt', clean_text($_POST['website']));

			$hother = convert_string('encrypt', clean_text($_POST['h_other']));
			$hcityMun = $_POST['h_cityMun'];
			$hprovinceState = $_POST['h_province'];
			$hcountry = $_POST['h_country'];
			$hzipCode = convert_string('encrypt', clean_text($_POST['h_zipCode']));
			$htype = convert_string('encrypt', clean_text("Home Address"));

			$cother = convert_string('encrypt', clean_text($_POST['c_other']));
			$ccityMun = $_POST['c_cityMun'];
			$cprovinceState = $_POST['c_province'];
			$ccountry = $_POST['c_country'];
			$czipCode = convert_string('encrypt', clean_text($_POST['c_zipCode']));
			$ctype = convert_string('encrypt', clean_text("Current Address"));
			
			$languages = $_POST['language'];
			$langProfs = $_POST['langProf'];
			$skills = $_POST['skill'];
			$skillProfs = $_POST['skillProf'];

			$fathername = convert_string('encrypt', clean_text($_POST['fathername']));
			$fatherocc = convert_string('encrypt', clean_text($_POST['fatherocc']));
			$mothername = convert_string('encrypt', clean_text($_POST['mothername']));
			$motherocc = convert_string('encrypt', clean_text($_POST['motherocc']));
			$answer1 = convert_string('encrypt', clean_text($_POST['answer1']));
			$answer2 = convert_string('encrypt', clean_text($_POST['answer2']));

			$loggedin = Login::isloggedin();

			if ($loggedin == $alumniid){
				$h_region = DB::query('SELECT * FROM address_province WHERE ps_id = :psid',array(':psid' => $hprovinceState));
				foreach ($h_region as $hr) {
					$hregion = $hr['reg_id']; 
				}
				$c_region = DB::query('SELECT * FROM address_province WHERE ps_id = :psid',array(':psid' => $cprovinceState));
				foreach ($c_region as $cr) {
					$cregion = $cr['reg_id']; 
				}

				//info
				DB::query('UPDATE alumni SET emp_stat=:emp_stat, civil_stat=:civil_stat, ethnicity=:ethnicity, nationality=:nationality, sex=:sex, tel_no=:tel_no, fg_name=:fg_name, fg_occupation=:fg_occupation, m_name=:m_name, m_occupation=:m_occupation, religion=:religion, answer1=:answer1, answer2=:answer2 WHERE alumni_id = :alumniid', array(':emp_stat' => $empstat, ':civil_stat' => $civilStat, ':ethnicity' => $ethnicity, ':nationality' => $nationality,':sex'=>$sex, ':tel_no' => $telephoneNo, ':fg_name' => $fathername, ':fg_occupation' => $fatherocc, ':m_name' => $mothername, ':m_occupation' => $motherocc, ':religion' => $religion, ':answer1' => $answer1, ':answer2' => $answer2, ':alumniid' => $alumniid));

				//links
				DB::query('UPDATE alumni SET fb=:fb, google=:google, ig=:instagram, linkedin=:linkedin, twitter=:twitter, website=:website WHERE alumni_id = :alumniid', array(':fb' => $facebook,':google' => $googlePlus,':instagram' => $instagram, ':linkedin' => $linkedin,':twitter' => $twitter,':website' => $website, ':alumniid' => $alumniid));

				//address
				DB::query('UPDATE alumni SET home_other=:haddress, home_cm_id=:hcitymun, home_prov_id=:hprovince, home_reg_id=:hregion, home_c_id=:hcountry, home_zip=:hzip, current_other=:caddress, current_cm_id=:ccitymun, current_prov_id=:cprovince, current_reg_id=:cregion, current_c_id=:ccountry, current_zip=:czip WHERE alumni_id = :alumniid', array(':haddress'=> $hother, ':hcountry'=> $hcountry, ':hregion'=> $hregion, ':hprovince'=> $hprovinceState, 'hcitymun'=> $hcityMun, ':hzip'=> $hzipCode, ':caddress'=> $cother, ':ccountry'=> $ccountry, ':cregion'=> $cregion, ':cprovince'=> $cprovinceState, ':ccitymun'=> $ccityMun, ':czip'=> $czipCode, ':alumniid' => $alumniid));
				

				

				//DB::query('INSERT INTO alumnittracking.social_site (\'\', fb, google, ig, linkedin, twitter, website, alumniid) VALUES (:fb, :google, :instagram, :linkedin, :twitter, :website, :alumniid)', array(':fb' => $facebook,':google' => $googlePlus,':instagram' => $instagram,':linkedin' => $linkedin,':twitter' => $twitter,':website' => $website,':alumniid' => $alumniid));

				foreach($skills as $a => $c){
					DB::query('INSERT INTO alumni_skills VALUES(\'\', :skill, :profeciency, :alumniid)', array(':skill' => convert_string('encrypt',clean_text($skills[$a])), ':profeciency' => convert_string('encrypt', clean_text($skillProfs[$a])), ':alumniid' => $alumniid));
					
				}

				foreach($languages as $b => $d){
					DB::query('INSERT INTO alumni_languages VALUES(\'\', :language, :profeciency, :alumniid)', array(':language' => convert_string('encrypt', clean_text($languages[$b])), ':profeciency' => convert_string('encrypt', clean_text($langProfs[$b])), ':alumniid' => $alumniid));
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

					$description .= "Alumni ".$names." updated Basic Information!";
					$logtype = "Update Basic Information";

					DB::query("INSERT INTO alumni_logs (log_type, description, date_time, alumni_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $alumniid));

				
				header('Location: ../signup-educational-background.php');

			}
		}
	}
?>