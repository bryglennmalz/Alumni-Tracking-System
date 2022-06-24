<?php
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	
	if(isset($_POST["operation"])){
		if ($_POST["operation"] == "Update Educ"){
			$message = '';
			$error = '';
			$is_new_system = '';

			$alumniid = $_POST['alumniid'];  

			$elemSchName = convert_string('encrypt', clean_text($_POST['elemSchName']));
			$elemYrGrad = convert_string('encrypt', clean_text($_POST['elemYrGrad']));
			$elemComment = convert_string('encrypt', clean_text($_POST['elemComment']));
			$eEducLevel = convert_string('encrypt', clean_text($_POST['eEducLevel']));

			/*echo convert_string('decrypt',$elemSchName)." ";
			echo convert_string('decrypt',$elemYrGrad)." ";
			echo convert_string('decrypt',$elemComment)." ";
			echo convert_string('decrypt',$eEducLevel)." ";
			echo "<hr>";*/
			

			//$schName = convert_string('encrypt', clean_text($_POST['schName']));
			//$yrGrad = convert_string('encrypt', clean_text($_POST['yrGrad']));
			//$comment = convert_string('encrypt', clean_text($_POST['comment']));
			//$educLevel = convert_string('encrypt', clean_text($_POST['educLevel']));
			//$educId = $_POST['educId'];


			$loggedin = Login::isloggedin();

			if ($loggedin == $alumniid){

				$year = date('Y');
				$month = date('m');
				$day = date('d');
				$hour = date('H');
				$min = date('i');
				$sa = date('s');
				$uu = round(microtime(true) * 1000);
				$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$alumniid).$sa.$uu;	

				//ADD ELEMENTARY
				DB::query('INSERT INTO educations VALUES(\'\', :educ_id, :sch_name, :educ_level, \'\', \'\', \'\', :year_grad, :comments, :alumniid)', array(':educ_id'=> $identifier,':sch_name'=> $elemSchName,':educ_level'=> $eEducLevel,':year_grad'=> $elemYrGrad,':comments'=> $elemComment,':alumniid'=> $alumniid));

				if(isset($_POST['is_new_system'])){
					$is_new_system = $_POST['is_new_system'];
				} else{
					$is_new_system = "0";
				}
				


				if($is_new_system == "1"){
					$jhSchName = convert_string('encrypt', clean_text($_POST['jhSchName']));
					$jhYrGrad = convert_string('encrypt', clean_text($_POST['jhYrGrad']));
					$jhComment = convert_string('encrypt', clean_text($_POST['jhComment']));
					$jhEducLevel = convert_string('encrypt', clean_text($_POST['jhEducLevel']));

					/*echo convert_string('decrypt',$jhSchName)." ";
					echo convert_string('decrypt',$jhYrGrad)." ";
					echo convert_string('decrypt',$jhComment)." ";
					echo convert_string('decrypt',$jhEducLevel)." ";
					echo "<br>";*/

					$year2 = date('Y');
					$month2 = date('m');
					$day2 = date('d');
					$hour2 = date('H');
					$min2 = date('i');
					$sa2 = date('s');
					$uu2 = round(microtime(true) * 1000);
					$identifier2 = $year2.$day2.$month2.$hour2.$min2.convert_string('decrypt',$alumniid).$sa2.$uu2;	

					//ADD Junior High
					DB::query('INSERT INTO educations VALUES(\'\', :educ_id, :sch_name, :educ_level, \'\', \'\', \'\', :year_grad, :comments, :alumniid)', array(':educ_id'=> $identifier2,':sch_name'=> $jhSchName,':educ_level'=> $jhEducLevel,':year_grad'=> $jhYrGrad,':comments'=> $jhComment,':alumniid'=> $alumniid));

					$shSchName = convert_string('encrypt', clean_text($_POST['shSchName']));
					$shYrGrad = convert_string('encrypt', clean_text($_POST['shYrGrad']));
					$shComment = convert_string('encrypt', clean_text($_POST['shComment']));
					$shEducLevel = convert_string('encrypt', clean_text($_POST['shEducLevel']));

					/*echo convert_string('decrypt',$shSchName)." ";
					echo convert_string('decrypt',$shYrGrad)." ";
					echo convert_string('decrypt',$shComment)." ";
					echo convert_string('decrypt',$shEducLevel)." ";
					echo "<hr>";*/

					$year3 = date('Y');
					$month3 = date('m');
					$day3 = date('d');
					$hour3 = date('H');
					$min3 = date('i');
					$sa3 = date('s');
					$uu3 = round(microtime(true) * 1000);
					$identifier3 = $year3.$day3.$month3.$hour3.$min3.convert_string('decrypt',$alumniid).$sa3.$uu3;

					//ADD Senior High
					DB::query('INSERT INTO educations VALUES(\'\', :educ_id, :sch_name, :educ_level, \'\', \'\', \'\', :year_grad, :comments, :alumniid)', array(':educ_id'=> $identifier3,':sch_name'=> $shSchName,':educ_level'=> $shEducLevel,':year_grad'=> $shYrGrad,':comments'=> $shComment,':alumniid'=> $alumniid));

				}
				else {
					$oSchName = convert_string('encrypt', clean_text($_POST['oSchName']));
					$oYrGrad = convert_string('encrypt', clean_text($_POST['oYrGrad']));
					$oComment = convert_string('encrypt', clean_text($_POST['oComment']));
					$oEducLevel = convert_string('encrypt', clean_text($_POST['oEducLevel']));

					/*echo convert_string('decrypt',$oSchName)." ";
					echo convert_string('decrypt',$oYrGrad)." ";
					echo convert_string('decrypt',$oComment)." ";
					echo convert_string('decrypt',$oEducLevel)." ";
					echo "<hr>";*/

					$year4 = date('Y');
					$month4 = date('m');
					$day4 = date('d');
					$hour4 = date('H');
					$min4 = date('i');
					$sa4 = date('s');
					$uu4 = round(microtime(true) * 1000);
					$identifier4 = $year4.$day4.$month4.$hour4.$min4.convert_string('decrypt',$alumniid).$sa4.$uu4;	

					//ADD Secondary
					DB::query('INSERT INTO educations VALUES(\'\', :educ_id, :sch_name, :educ_level, \'\', \'\', \'\', :year_grad, :comments, :alumniid)', array(':educ_id'=> $identifier4,':sch_name'=> $oSchName,':educ_level'=> $oEducLevel,':year_grad'=> $oYrGrad,':comments'=> $oComment,':alumniid'=> $alumniid));
				}

				$cSchNames = $_POST['cSchName'];
				$cDegLevels = $_POST['cDegLevel'];
				$cYrGrads = $_POST['cYrGrad'];
				$cprogStudieds = $_POST['cStudied'];
				$cprogMajors = $_POST['cMajor'];
				$cComments = $_POST['cComment'];
				$cEducLevels = $_POST['cEducLevel'];

				foreach($cSchNames as $a => $c){
					$mSchName = convert_string('encrypt', clean_text($cSchNames[$a]));
					$mDegLevel = convert_string('encrypt', clean_text($cDegLevels[$a]));
					$mYrGrad = convert_string('encrypt', clean_text($cYrGrads[$a]));
					$progStudied = convert_string('encrypt', clean_text($cprogStudieds[$a]));
					$progMajor = convert_string('encrypt', clean_text($cprogMajors[$a]));
					$mComment = convert_string('encrypt', clean_text($cComments[$a]));
					$mEducLevel = convert_string('encrypt', clean_text($cEducLevels[$a]));

					/*echo convert_string('decrypt',$mSchName)." ";
					echo convert_string('decrypt',$mDegLevel)." ";
					echo convert_string('decrypt',$mYrGrad)." ";
					echo convert_string('decrypt',$progStudied)." ";
					echo convert_string('decrypt',$mComment)." ";
					echo convert_string('decrypt',$mEducLevel)." ";
					echo "<br>";*/


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

					DB::query('INSERT INTO educations VALUES (\'\', :educ_id, :sch_name, :educ_level, :deg_level, :prog_studied, :prog_major, :year_grad, :comments, :alumniid)', array(':educ_id'=> $identifier5, ':sch_name'=> $mSchName, ':educ_level'=> $mEducLevel, ':deg_level' => $mDegLevel, ':prog_studied' => $progStudied, ':prog_major' => $progMajor, ':year_grad'=> $mYrGrad, ':comments'=> $mComment, ':alumniid' => $alumniid));
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
					$description .= "Alumni ".$names." updated Educational Background!";
					$logtype = "Update Educational Background";

					DB::query("INSERT INTO alumni_logs (log_type, description, date_time, alumni_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $alumniid));


				
				//Query Alumni Name
				$userx = DB::query('SELECT * FROM alumni WHERE alumni_id = :userid', array(':userid' => Login::isloggedin()));
				$emp_stat = "";
				
				foreach($userx as $u){
					$emp_stat = $u['emp_stat'];
				}

				if($emp_stat == convert_string('encrypt',"Unemployed ever since")){
					header('Location: ../signup-affiliations-organizations.php');
				}
				else{
					header('Location: ../signup-job-history.php');
				}

				

			}
		}
	}
?>