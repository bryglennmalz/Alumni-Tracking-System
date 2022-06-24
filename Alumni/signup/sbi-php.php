<?php 
	require '../../php/myconnection.php';
	
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
	
	if($isset($_POST['SubmitBI'])){
		$alumniid = Login::isloggedin();
		
		$phoneNo = convert_string('encrypt',clean_text($_POST['phoneNo']));
		$telephoneNo = convert_string('encrypt',clean_text($_POST['telephoneNo']));
		$googlePlus = convert_string('encrypt',clean_text($_POST['googlePlus']));
		$facebook = convert_string('encrypt',clean_text($_POST['facebook']));
		$instagram = convert_string('encrypt',clean_text($_POST['instagram']));
		$linkedin = convert_string('encrypt',clean_text($_POST['linkedin']));
		$twitter = convert_string('encrypt',clean_text($_POST['twitter']));
		$website = convert_string('encrypt',clean_text($_POST['website']));
		
		$hOther = $_POST['hOther'];
		$hCityMun = $_POST['hCityMun'];
		$hProvinceState = $_POST['hProvinceState'];
		$hCountry = $_POST['hCountry'];
		$hZipCode = $_POST['hZipCode']);
		$cOther = $_POST['cOther']);
		$cCityMun = $_POST['cCityMun']);
		$cProvinceState = $_POST['cProvinceState']);
		$cCountry = $_POST['cCountry']);
		$cZipCode = $_POST['cZipCode']);
		
		$language = convert_string('encrypt',clean_text($_POST['language']));
		$langProf = convert_string('encrypt',clean_text($_POST['langProf']));
		$skill = convert_string('encrypt',clean_text($_POST['skill']));
		$skillProf = convert_string('encrypt',clean_text($_POST['skillProf']));
		
		$civilStat = convert_string('encrypt',clean_text($_POST['civilStat']));
		$nationality = convert_string('encrypt',clean_text($_POST['nationality']));
		$ethnicity = convert_string('encrypt',clean_text($_POST['ethnicity']));
		$religion = convert_string('encrypt',clean_text($_POST['religion']));
		$fathername = convert_string('encrypt',clean_text($_POST['fathername']));
		$mothername = convert_string('encrypt',clean_text($_POST['mothername']));
		$motherocc = convert_string('encrypt',clean_text($_POST['motherocc']));
		$answer1 = convert_string('encrypt',clean_text($_POST['answer1']));
		$answer2 = convert_string('encrypt',clean_text($_POST['answer2']));
		
		DB::query('UPDATE alumni.alumni SET civil_stat = :civilStat, ethnicity = :ethnicity, nationality = :nationality, 
				   religion = :religion, cel_no = :cel_no, telno = :tel_no WHERE id = :alumniid', array(':civil_stat' => $civilStat,
				   ':ethnicity' => $ethnicity, ':nationality' => $nationality, ':employstat' => $employstat, ':religion' => $religion, 
				   ':cel_no' => $phoneNo, ':tel_no'=> $tel_no, ':alumniid' => $alumniid));
		
		header("Location: ../signup/signup-education.php");
	}
?>