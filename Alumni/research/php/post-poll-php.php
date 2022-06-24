<?php
	
	//Query Alumni Name
	//$user_name = DB::query('SELECT * FROM alumni.staff WHERE id = :userid', array(':userid' => $userid));

	if (isset($_POST['submit'])){
		$ptitle = $_POST['poll-title'];
		$date_end1 = $_POST['date'];
		$date_end2 = $_POST['time'];
			
			$date = array($date_end1 , " " , $date_end2);
			
		$pchoice = $_POST['choice'];

		$userid = Login::isloggedin();
	
		DB::query('INSERT INTO alumni.poll VALUES (\'\',:userid, :ptitle, Now(), :date_end )', array(':userid' => $userid, 
					':ptitle' => $ptitle, ':date_end' => implode($date)));
		
		$polls = DB::query('SELECT * FROM alumni.poll WHERE poll.`poll-title` = :ptitle', array(':ptitle' => $ptitle));
		$pollid="";
		foreach ($polls as $pc) {
			$pollid = $pc['poll-id'];
		}

		foreach ($pchoice as $a => $c){
			DB::query('INSERT INTO alumni.`poll-choice` VALUES(\'\', :pollid, :choice)', array(':pollid' => $pollid, ':choice' => $pchoice[$a]));
		}

			//echo ;
		$f_post = "";
										foreach($polls as $p){
								
											$pollid = $p['poll-id'];
											$sataffid = $p['staff-id'];
											$polltitle = $p['poll-title'];
											$datepost = $p['date-post'];
											$dateend = $p['date-end'];
											
												//Number of poll votes query
												$cntvotes =("SELECT poll.`poll-id` FROM alumni.`forum-react` WHERE `forum-react`.forum_id = :pollid");
												
												$pdo_cntVotes_Res = $pdoConnect ->prepare($cntvotes);
												$pdoExec = $pdo_cntVotes_Res -> execute(array(':pollid' => $id));
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
		
	}


?>