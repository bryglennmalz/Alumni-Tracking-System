<?php 
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
    require '../../php/function.php';
	
	if (isset($_POST['operation'])){ 
		if($_POST['operation'] == "Add Survey"){

				$adminid = Login::isloggedin();

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
					$description = $_POST['description'];
					$surveyid = $_POST['surveyid'];

					$ssdatetime = $ssdate." ".$sstime;
					$sedatetime = $sedate." ".$setime;

					//$answer = $_POST['answer'];

					
					DB::query('INSERT INTO survey VALUES (\'\',:identifiers, :name, \'\', :opening_datetime, :end_datetime , Now(), :admin_id, :description)', array(":identifiers"=> $identifiers, ":name" => $surveytitle, ":opening_datetime" => $ssdatetime, ":end_datetime" => $sedatetime, ":admin_id"=> $adminid, ":description"=> $description));

					$description2 = 'Admin '. Login::isloggedin(). ' post a new survey. "'. $surveytitle .'".';

					DB::query("INSERT INTO admin_logs (description, date_time, admin_id) VALUES (:description, NOW(), :admin_id)", array(":description" => $description2, ":admin_id" => Login::isloggedin()));

					echo "Survey Saved!";
					header("Location: ../survey.php?surveyid='".convert_string('encrypt', $identifiers)."'");

		}
		else if ($_POST['operation'] == "Update Survey") {
			$adminid = Login::isloggedin();

			$surveytitle = clean_text($_POST['surveytitle']);
			$ssdate = $_POST['ssdate'];
			$sstime = $_POST['sstime'];
			$sedate = $_POST['sedate'];
			$setime = $_POST['setime'];
			$description = $_POST['description'];
			$surveyid = $_POST['surveyid'];

			$ssdatetime = $ssdate." ".$sstime;
			$sedatetime = $sedate." ".$setime;

			DB::query('UPDATE survey SET name=:surveytitle, updated=Now(), datetime_start=:ssdatetime, datetime_end=:sedatetime, description=:description WHERE survey_id = :surveyid', array(":surveytitle" => $surveytitle, ":ssdatetime" => $ssdatetime, ":sedatetime" => $sedatetime, ":description"=> $description, ":surveyid"=> $surveyid));

			$description2 = 'Admin '. Login::isloggedin(). ' updated the survey. "'. $surveytitle .'".';

			DB::query("INSERT INTO admin_logs (description, date_time, admin_id) VALUES (:description, NOW(), :admin_id)", array(":description" => $description2, ":admin_id" => Login::isloggedin()));

			echo "Survey Updated!";
			header("Location: ../survey.php?surveyid='".convert_string('encrypt', $identifiers)."'");

		}
	}



	
?>