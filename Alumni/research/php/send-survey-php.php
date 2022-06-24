<?php
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	
	if(isset($_POST["operation"])){
		if ($_POST["operation"] == "Send Answer Survey"){ echo "hey yeyey";

			$alumniid =$_POST['alumniid'];
			$loggedin = Login::isloggedin();

			if($alumniid == $loggedin){
				$i = 1;
				$survey_id = $_POST['surveyid'];
				$ordre =$_POST['order'];

				//echo $survey_id;
				$maxOrderNo = DB::query('SELECT MAX(order_no) FROM survey_questions WHERE survey_id = :id', array(':id'=> $survey_id));
				foreach ($maxOrderNo as $mn) {
					$max = $mn['MAX(order_no)'];
				}

				foreach ($ordre as $a => $c){
					$order= clean_text($ordre[$a]);
					$question_id = $_POST['qid'.$order.''];
					$questtype_id = $_POST['qtype'.$order.''];

					echo $questtype_id;

					//SAVE YES OR NO
					if($questtype_id == 1){
						if(isset($_POST['yesno'.$order.'']) != ""){
							if($_POST['yesno'.$order.''] != ""){
								DB::query('INSERT INTO alumni_survey_answer VALUES(\'\', :surveyid, :questionid, :alumniid, :answer)',array(':surveyid'=>$survey_id,':questionid'=>$question_id,':alumniid'=>$alumniid,':answer'=>$_POST['yesno'.$order.'']));
							}
						}
					}
					//SAVE OPINION
					else if($questtype_id == 2){
						if(isset($_POST['opinion'.$order.''])){
							if($_POST['opinion'.$order.''] != ""){
								DB::query('INSERT INTO alumni_survey_answer VALUES(\'\', :surveyid, :questionid, :alumniid, :answer)',array(':surveyid'=>$survey_id,':questionid'=>$question_id,':alumniid'=>$alumniid,':answer'=>$_POST['opinion'.$order.'']));
							}
						} 
					}
					//SAVE ONE ANSWER
					else if($questtype_id == 3){
						if(isset($_POST['oneans'.$order.''])){
							if($_POST['oneans'.$order.''] != ""){
								DB::query('INSERT INTO alumni_survey_answer VALUES(\'\', :surveyid, :questionid, :alumniid, :answer)',array(':surveyid'=>$survey_id,':questionid'=>$question_id,':alumniid'=>$alumniid,':answer'=>$_POST['oneans'.$order.'']));
							}
						} 
					} 
					//SAVE ONE OR MORE ANSWER
					else if($questtype_id == 4){
						if(isset($_POST['moreans'.$order.''])){
							foreach ($_POST['moreans'.$order.''] as $b => $d){
								if($_POST['moreans'.$order.''][$b] != ""){
								DB::query('INSERT INTO alumni_survey_answer VALUES(\'\', :surveyid, :questionid, :alumniid, :answer)',array(':surveyid'=>$survey_id,':questionid'=>$question_id,':alumniid'=>$alumniid,':answer'=>$_POST['moreans'.$order.''][$b]));
								}
							}
						} 
					}
					//SAVE ONE ANSWER ALSO USER INPUT
					else if($questtype_id == 5){
						if(isset($_POST['oneinput'.$order.''])){
							if($_POST['oneinput'.$order.''] == 1){
								if(isset($_POST['oneinputt'.$order.''])){
									if($_POST['oneinputt'.$order.''] != ""){
										DB::query('INSERT INTO alumni_survey_answer VALUES(\'\', :surveyid, :questionid, :alumniid, :answer)',array(':surveyid'=>$survey_id,':questionid'=>$question_id,':alumniid'=>$alumniid,':answer'=>$_POST['oneinputt'.$order.'']));
									}
								}
							}
							else{
								DB::query('INSERT INTO alumni_survey_answer VALUES(\'\', :surveyid, :questionid, :alumniid, :answer)',array(':surveyid'=>$survey_id,':questionid'=>$question_id,':alumniid'=>$alumniid,':answer'=>$_POST['oneinput'.$order.'']));
							}
						} 
					}
					//SAVE ONE OR MORE ANSWER ALSO USER INPUT
					else if($questtype_id == 6){
						if(isset($_POST['moreinput'.$order.''])){
							foreach ($_POST['moreinput'.$order.''] as $x => $z){
								if ($_POST['moreinput'.$order.''][$x] != "1"){
									DB::query('INSERT INTO alumni_survey_answer VALUES(\'\', :surveyid, :questionid, :alumniid, :answer)',array(':surveyid'=>$survey_id,':questionid'=>$question_id,':alumniid'=>$alumniid,':answer'=>$_POST['moreinput'.$order.''][$x]));
								}
								else if($_POST['moreinput'.$order.''][$x] == "1"){
									if(isset($_POST['moreinputt'.$order.''])){
										if($_POST['moreinputt'.$order.''] != ""){
											DB::query('INSERT INTO alumni_survey_answer VALUES(\'\', :surveyid, :questionid, :alumniid, :answer)',array(':surveyid'=>$survey_id,':questionid'=>$question_id,':alumniid'=>$alumniid,':answer'=>$_POST['moreinputt'.$order.'']));
										}
									}
								}
							}
						} 
					}

				} echo "saved";


				/*for ($i=1; $i < $max; $i++) { 
					$question_id = $_POST['qid'.$i.''];
					$questtype_id = $_POST['qtype'.$i.''];

					//SAVE YES OR NO
					if($questtype_id == 1){
						if(isset($_POST['yesno'.$i.''])){
							DB::query('INSERT INTO alumni_survey_answer VALUES(\'\', :surveyid, :questionid, :alumniid, :answer)',array(':surveyid'=>$survey_id,':questionid'=>$question_id,':alumniid'=>$alumniid,':answer'=>$_POST['yesno'.$i.'']));
						} echo "1 save <br>";
					}
					//SAVE OPINION
					else if($questtype_id == 2){
						if(isset($_POST['opinion'.$i.''])){
							DB::query('INSERT INTO alumni_survey_answer VALUES(\'\', :surveyid, :questionid, :alumniid, :answer)',array(':surveyid'=>$survey_id,':questionid'=>$question_id,':alumniid'=>$alumniid,':answer'=>$_POST['opinion'.$i.'']));
						} echo "2 save <br>";
					}
					//SAVE ONE ANSWER
					else if($questtype_id == 3){
						if(isset($_POST['oneans'.$i.''])){
							DB::query('INSERT INTO alumni_survey_answer VALUES(\'\', :surveyid, :questionid, :alumniid, :answer)',array(':surveyid'=>$survey_id,':questionid'=>$question_id,':alumniid'=>$alumniid,':answer'=>$_POST['oneans'.$i.'']));
						} echo "3 save <br>";
					} 
					//SAVE ONE OR MORE ANSWER
					else if($questtype_id == 4){
						if(isset($_POST['moreans'.$i.''])){
							foreach ($_POST['moreans'.$i.''] as $b => $d){
								DB::query('INSERT INTO alumni_survey_answer VALUES(\'\', :surveyid, :questionid, :alumniid, :answer)',array(':surveyid'=>$survey_id,':questionid'=>$question_id,':alumniid'=>$alumniid,':answer'=>$_POST['moreans'.$i.''][$b]));
							}
						} echo "4 save <br>";
					}
					//SAVE ONE ANSWER ALSO USER INPUT
					else if($questtype_id == 5){
						if(isset($_POST['oneinput'.$i.''])){
							if($_POST['oneinput'.$i.''] == 1){
								DB::query('INSERT INTO alumni_survey_answer VALUES(\'\', :surveyid, :questionid, :alumniid, :answer)',array(':surveyid'=>$survey_id,':questionid'=>$question_id,':alumniid'=>$alumniid,':answer'=>$_POST['oneinputt'.$i.'']));
							}
							else{
								DB::query('INSERT INTO alumni_survey_answer VALUES(\'\', :surveyid, :questionid, :alumniid, :answer)',array(':surveyid'=>$survey_id,':questionid'=>$question_id,':alumniid'=>$alumniid,':answer'=>$_POST['oneinput'.$i.'']));
							}echo "5A save <br>";
						} 
					}
					//SAVE ONE OR MORE ANSWER ALSO USER INPUT
					else if($questtype_id == 6){
						if(isset($_POST['moreinput'.$i.''])){
							foreach ($_POST['moreinput'.$i.''] as $b => $d){
								DB::query('INSERT INTO alumni_survey_answer VALUES(\'\', :surveyid, :questionid, :alumniid, :answer)',array(':surveyid'=>$survey_id,':questionid'=>$question_id,':alumniid'=>$alumniid,':answer'=>$_POST['moreinput'.$i.''][$b]));
							}
						} echo "4 save <br>";
					}

					
				}*/
			}
			
		}
	}

?>