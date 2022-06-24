<?php
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	
	if(isset($_POST["operation"])){
		if ($_POST["operation"] == "Add Education"){
			$mSchName = convert_string('encrypt', clean_text($_POST['mSchName']));
			$mDegLevel = convert_string('encrypt', clean_text($_POST['mDegLevel']));
			$mYrGrad = convert_string('encrypt', clean_text($_POST['mYrGrad']));
			$progStudied = convert_string('encrypt', clean_text($_POST['mStudied']));
			$progMajor = convert_string('encrypt', clean_text($_POST['mMajor']));
			$mComment = convert_string('encrypt', clean_text($_POST['mComment']));
			$mEducLevel = convert_string('encrypt', clean_text($_POST['mEducLevel']));
			
			$alumniid = $_POST['alumniid']; 
			$loggedin = Login::isloggedin();

			if ($loggedin == $alumniid){
				$year5 = "";
					$month5 = "";
					$day5 = "";
					$hour5 = "";
					$min5 = "";
					$sa5 = "";
					$uu5 = "";
					$identifier5 = "";	

					$year5 = date('Y');
					$month5 = date('m');
					$day5 = date('d');
					$hour5 = date('H');
					$min5 = date('i');
					$sa5 = date('s');
					$uu5 = round(microtime(true) * 1000);
					$identifier5 = $year5.$day5.$month5.$hour5.$min5.convert_string('decrypt',$alumniid).$sa5.$uu5;	

					DB::query('INSERT INTO alumnitracking.educations VALUES (\'\', :educ_id, :sch_name, :educ_level, :deg_level, :prog_studied, :prog_major, :year_grad, :comments, :alumniid)', array(':educ_id'=> $identifier5, ':sch_name'=> $mSchName, ':educ_level'=> $mEducLevel, ':deg_level' => $mDegLevel, ':prog_studied' => $progStudied, ':prog_major' => $progMajor, ':year_grad'=> $mYrGrad, ':comments'=> $mComment, ':alumniid' => $alumniid)); 

					$description = "Alumni ". Login::isloggedin(). " updated his Eduacational Background.";

					DB::query("INSERT INTO alumnitracking.alumni_logs (description, date_time, alumni_id) VALUES (:description, NOW(), :alumni_id)", array(":description" => $description, ":alumni_id" => Login::isloggedin()));

					echo "This information has been successfully added.";
			}
			
		}
	}

	if(isset($_POST["operation"])){
		if ($_POST["operation"] == "Update Education"){
			$mSchNames = convert_string('encrypt', clean_text($_POST['mSchName']));
			$mDegLevels = convert_string('encrypt', clean_text($_POST['mDegLevel']));
			$mYrGrads = convert_string('encrypt', clean_text($_POST['mYrGrad']));
			$progStudieds = convert_string('encrypt', clean_text($_POST['mStudied']));
			$progMajors = convert_string('encrypt', clean_text($_POST['mMajor']));
			$mComments = convert_string('encrypt', clean_text($_POST['mComment']));
			$mEducLevels = convert_string('encrypt', clean_text($_POST['mEducLevel']));
			
			$alumniid = $_POST['alumniid']; 
			$loggedin = Login::isloggedin();

			if ($loggedin == $alumniid){

				if($_POST['mEducLevel'] == "Elementary"){
					DB::query('UPDATE SET sch_name=:sch_name, educ_level=:educ_level, year_grad=:year_grad, :comments WHERE educ_id=:educ_id AND alumni_id=:alumniid', array( ':sch_name'=> $mSchName, ':educ_level'=> $mEducLevel, ':year_grad'=> $elemYrGrad, ':comments'=> $elemComment,':educ_id'=> $identifier5, ':alumniid' => $alumniid));
				}
				else if($_POST['mEducLevel'] == "Secondary"){
					DB::query('UPDATE SET sch_name=:sch_name, educ_level=:educ_level, year_grad=:year_grad, :comments WHERE educ_id=:educ_id AND alumni_id=:alumniid', array( ':sch_name'=> $mSchName, ':educ_level'=> $mEducLevel, ':year_grad'=> $elemYrGrad, ':comments'=> $elemComment,':educ_id'=> $identifier5, ':alumniid' => $alumniid));
				}
				else if ($_POST['mEducLevel'] == "Tertiary"){
					DB::query('UPDATE SET sch_name=:sch_name, educ_level=:educ_level, deg_level=:deg_level, prog_studied=:prog_studied, prog_major=:prog_major, year_grad=:year_grad, :comments WHERE educ_id=:educ_id AND alumni_id=:alumniid', array( ':sch_name'=> $mSchName, ':educ_level'=> $mEducLevel, ':deg_level' => $mDegLevel, ':prog_studied' => $progStudied, ':prog_major' => $progMajor, ':year_grad'=> $elemYrGrad, ':comments'=> $elemComment,':educ_id'=> $identifier5, ':alumniid' => $alumniid));
				}


				$description = "Alumni ". Login::isloggedin(). " updated his Eduacational Background.";

				DB::query("INSERT INTO alumnitracking.alumni_logs (description, date_time, alumni_id) VALUES (:description, NOW(), :alumni_id)", array(":description" => $description, ":alumni_id" => Login::isloggedin()));

				echo "This information has been successfully added.";
			}

		}
	}
?>