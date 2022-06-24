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
	
	if (isset($_POST['operation'])){ 
		if ($_POST['operation'] == "Update Survey") {
			$adminid = Login::isloggedin();

			$surveytitle = clean_text($_POST['surveytitle']);
			$ssdate = $_POST['ssdate'];
			$sstime = $_POST['sstime'];
			$sedate = $_POST['sedate'];
			$setime = $_POST['setime'];
			$description = $_POST['description'];

			$ssdatetime = $ssdate." ".$sstime;
			$sedatetime = $sedate." ".$setime;

			DB::query('UPDATE survey SET name=:surveytitle, updated=Now(), datetime_start=:ssdatetime, datetime_end=:sedatetime, description=:description WHERE survey_id = :surveyid', array(":surveytitle" => $surveytitle, ":ssdatetime" => $ssdatetime, ":sedatetime" => $sedatetime, ":description"=> $description, ":surveyid"=> $surveyid));

			$description2 = 'Admin '. Login::isloggedin(). ' updated the survey. "'. $surveytitle .'".';

			DB::query("INSERT INTO alumnitracking.admin_logs (description, date_time, admin_id) VALUES (:description, NOW(), :admin_id)", array(":description" => $description2, ":admin_id" => Login::isloggedin()));

			echo "Survey Updated!";
			header("Location: ../survey.php?surveyid='".$surveyid."'");

		}
	}



	
?>