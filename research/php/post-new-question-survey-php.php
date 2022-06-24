<?php
	
	//Query Alumni Name
	//$user_name = DB::query('SELECT * FROM alumni.staff WHERE id = :userid', array(':userid' => $userid));
	

	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';

	if (isset($_POST['user_id'])){
		if (isset($_POST['operation'])){

			$userid = Login::isloggedin();
			if ($_POST['operation'] == "Add Survey Question" && $_POST['user_id'] == $userid){

				$identifier ="";
				$year="";
				$month = "";
				$day = "";
				$hour = "";
				$min = "";
				$sa = "";

				$surveyQuestion = $_POST['surveyQuestion'];
				$questionNo = $_POST['questionNo'];
				$questionType = $_POST['questionType'];

				if(isset($_POST['requireA'])){
					$requireA = $_POST['requireA'];
				} else{
					$requireA = "0";
				}

				$year = date('Y');
				$month = date('m');
				$day = date('d');
				$hour = date('H');
				$min = date('i');
				$sa = date('s');
				
				$surveyid = $_POST['survey-id'];
				$surveytitle = $_POST['survey-name'];
				$identifier = $year.$day.$month.$hour.$min.$surveyid.$sa;	
				$choices = $_POST['answer'];

				DB::query('INSERT INTO survey_questions VALUES(\'\',:questionid, :questionNo, :surveyQuestion, \'\', :questionType, :requireA, Now(), :surveyid)', array(":questionid" => $identifier, ":questionNo" => $questionNo, ":surveyQuestion" => $surveyQuestion, ":questionType" => $questionType, ":requireA" => $requireA, ":surveyid" => $surveyid));

				$description = 'Admin '. Login::isloggedin(). ' post a new question in survey named "'. $surveytitle .'".';

				DB::query("INSERT INTO admin_logs (description, date_time, admin_id) VALUES (:description, NOW(), :admin_id)", array(":description" => $description, ":admin_id" => Login::isloggedin()));

				if(isset($_POST['answer'])){
					$answer = $_POST['answer'];
					foreach ($answer as $a => $c){
						DB::query("INSERT INTO survey_question_choices VALUES(\"\" , :answer, :questionid)", array(":answer" => $answer[$a], ":questionid" => $identifier));
					}
				}
				

				echo "New survey question has successfully posted!";
				header("Location: ../survey.php?surveyid='".convert_string('encrypt', $surveyid)."'");
			}
		}
	}

	/*if (isset($_POST['questionSave'])){

		$surveyQuestion = $_POST['surveyQuestion'];
		$questionNo = $_POST['questionNo'];
		$questionType = $_POST['questionType'];
		$answer = $_POST['answer'];
		$requireA = $_POST['requireA'];
		$userInput = $_POST['basic_checkbox_1'];
		$userid = Login::isloggedin();	
			
		$year = date('Y');
		$month = date('m');
		$day = date('d');
		$hour = date('H');
		$min = date('i');
		$sa = date('s');
		
		$identifiers = $_POST['survey-id'];
		$surveytitle = $_POST['surveyname'];
		$identifier = $year.$day.$month.$hour.$min.$userid.$sa;	
		$choices = $_POST['answer'];

		echo $surveyQuestion;
	
		DB::query("INSERT INTO atis.survey_questions VALUES(\'\',:questionNo, :surveyQuestion, Now(), :questionType, :requireA, :surveyid, :userInput)", array(":questionNo" => $questionNo[$a], ":surveyQuestion" => $surveyQuestion[$a], ":questionType" => $questionType[$a], ":requireA" => $requireA[$a], ":surveyid" => $identifiers, ":userInput" => $userInput));

			$description = 'Admin '. Login::isloggedin(). ' post a new question in survey named "'. $surveytitle .'".';

			DB::query("INSERT INTO atis.admin_logs (description, date_time, admin_id) VALUES (:description, NOW(), :admin_id)", array(":description" => $description, ":admin_id" => Login::isloggedin()));

		foreach ($answer as $a => $c){
				DB::query("INSERT INTO atis.response_choice VALUES(\'\', :questionid , :answer)", array(":questionid" => $questid, ":answer" => $answer[$b]));
			}

		echo "New poll has successfully posted!";
		
		/*$polls = DB::query('SELECT * FROM atis.poll ORDER BY poll.`datetime_post` DESC');
		$f_post = "";
			foreach($polls as $p){
				$pollid = $p['poll_id'];
				$polltitle = $p['question'];
				$datepost = $p['datetime_post'];
				$dateend = $p['date_end'];							
				$sataffid = $p['admin_id'];
											
				//Number of poll votes query
				$cntvotes =("SELECT poll.`poll_id` FROM atis.`poll` WHERE `poll`.poll_id = :pollid");
												
				$pdo_cntVotes_Res = $pdoConnect ->prepare($cntvotes);
				$pdoExec = $pdo_cntVotes_Res -> execute(array(':pollid' => $pollid));
				$pdo_forum_votes = $pdo_cntVotes_Res->rowCount();
								
				$f_post .= "<a href='poll.php?pollid=".$pollid."' method='POST'>
								<div class='card'>
									<div class='card-body'>
										<div>
											<h4 class='card-title'>".$polltitle."</h4>
																	
											<hr>
											<footer class='text-right'>
												<p>
													<small>
														- ".$pdo_forum_votes." <i class='material-icons'>mdi-poll-box</i> -
														&nbsp &nbsp &nbsp &nbsp - Poll Posted ".date('F d, Y  h:i A', strtotime($datepost))."
													</small>
												</p>
											</footer>
										</div>
									</div>
								</div>
							</a>"; 
			}
		
	}*/


?>