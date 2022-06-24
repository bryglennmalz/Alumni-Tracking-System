<?php 
	require '../../php/myconnection.php';
	require '../../php/home-php.php';

	function clean_text($string){
		$string = trim($string);
		$string = stripslashes($string);
		$string = htmlspecialchars($string);
		return $string;
	}
	
	function convert_string($action, $string){
		$output = '';
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'eaiYYkYTysia2lnHiw0N0vx7t7a3kEJVLfbTKoQIx5o=';
		$secret_iv = 'eaiYYkYTysia2lnHiw0N0';
    
		// hash
		$key = hash('sha256', $secret_key);
		$initialization_vector = substr(hash('sha256', $secret_iv), 0, 16);
		
		if($string != ''){
			if($action == 'encrypt'){
				$output = openssl_encrypt($string, $encrypt_method, $key, 0, $initialization_vector);
				$output = base64_encode($output);
			} 
			if($action == 'decrypt'){
				$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $initialization_vector);
			}
		}
		return $output;
	}
	



	if (isset($_POST['adminids'])){ 

		$adminid = Login::isloggedin();

		if ($_POST['adminids'] == $adminid){
			
			$year = date('Y');
			$month = date('m');
			$day = date('d');
			$hour = date('H');
			$min = date('i');
			$sa = date('s');
			
			$identifiers = $year.$day.$month.$hour.$min.$adminid.$sa;
			
			$surveytitle = clean_text($_POST['surveytitle']);
			$ssdate = $_POST['ssdate'];
			$sstime = $_POST['sstime'];
			$sedate = $_POST['sedate'];
			$setime = $_POST['setime'];

			$ssdatetime = $ssdate." ".$sstime;
			$sedatetime = $sedate." ".$setime;
			
			$surveyQuestion = $_POST['surveyQuestion'];
			$questionNo = $_POST['questionNo'];
			$questionType = $_POST['questionType'];
			$answer = $_POST['answer'];
			$requireA = $_POST['requireA'];
			$userInput = $_POST['basic_checkbox_1'];

			//$answer = $_POST['answer'];

			
			DB::query('INSERT INTO alumnitracking.survey VALUES (\'\',:identifiers, :name, \'\', :opening_datetime, :end_datetime , Now(), :admin_id)', array(":identifiers"=> $identifiers, ":name" => $surveytitle, ":opening_datetime" => $ssdatetime, ":end_datetime" => $sedatetime, ":admin_id"=> $adminid));

			$description = 'Admin '. Login::isloggedin(). ' post a new survey. "'. $surveytitle .'".';

			DB::query("INSERT INTO alumnitracking.admin_logs (description, date_time, admin_id) VALUES (:description, NOW(), :admin_id)", array(":description" => $description, ":admin_id" => Login::isloggedin()));

			foreach ($surveyQuestion as $a => $c ){

				$year2 = "";
				$month2 = "";
				$day2 = "";
				$hour2 = "";
				$min2 = "";
				$sa2 = "";
				$identifiers2 = "";

				$year2 = date('Y');
				$month2 = date('m');
				$day2 = date('d');
				$hour2 = date('H');
				$min2 = date('i');
				$sa2 = date('s');
				
				$identifiers2 = $year2.$day2.$month2.$hour2.$min2.$adminid.$sa2;

				DB::query('INSERT INTO alumnitracking.survey_questions VALUES(\'\',:questionid, :questionNo, :surveyQuestion, \'\', :questionType, :requireA, :userInput, NOW(), :surveyid)', array(":questionid" => $identifiers2,":questionNo" => $questionNo[$a], ":surveyQuestion" => $surveyQuestion[$a], ":questionType" => $questionType[$a], ":requireA" => $requireA[$a], ":userInput" => $userInput, ":surveyid" => $identifiers));
				
				//$questid = DB::query('SELECT id FROM alumnitracking.survey_questions WHERE question = :surveyQuestion', array(':surveyQuestion' => $surveyQuestion[$a]))[0]['id'];

				/*if ($questionType == 3 OR $questionType == 4 OR $questionType == 5 OR $questionType == 6){
					foreach ($answer as $b => $d){
						DB::query("INSERT INTO atis.response_choice VALUES(\'\', :questionid , :answer)", array(":questionid" => $questid, ":answer" => $answer[$b]));
					}
				}*/	
			}
		}
		

			
		
		//header("Location: ../alumni-survey.php");
	}
?>