<?php

	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	//Query Alumni Name
	//$user_name = DB::query('SELECT * FROM alumni.staff WHERE id = :userid', array(':userid' => $userid));

	if (isset($_POST['user_id'])){
		if (isset($_POST['operation'])){

			$userid = Login::isloggedin();
			if ($_POST['operation'] == "Add Poll" && $_POST['user_id'] == $userid){
				$ptitle = $_POST['poll-title'];
				$date_end1 = $_POST['date'];
				$date_end2 = $_POST['time'];
				$type = $_POST['type'];

				$year = date('Y');
				$month = date('m');
				$day = date('d');
				$hour = date('H');
				$min = date('i');
				$sa = date('s');

				$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$userid).$sa;
				$datetime_end = $date_end1." ".$date_end2;
				$pchoice = $_POST['choice'];

				DB::query('INSERT INTO forum_poll (post_id, f_title, datetime_post, admin_id, datetime_end, type) VALUES (:identifier, :ptitle, Now(), :userid, :date_end2 , :type)', array(':identifier'=> $identifier, ':ptitle' => $ptitle, ':userid' => $userid, ':date_end2' => $datetime_end, ':type' => $type));

				foreach ($pchoice as $a => $c){
					DB::query('INSERT INTO `poll_choices` VALUES(\'\', :pollid, :choice)', array(':pollid' => $identifier, ':choice' => $pchoice[$a]));
				}


				$admin = DB::query('SELECT * FROM admin WHERE admin_id = :userid', array(':userid' => Login::isloggedin()));

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
						$adhead = $s['type'];
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
					$description .= convert_string('decrypt', $adhead)." ".$names." added new poll".$ptitle." successfully!";
					$logtype = "Post Poll";

					DB::query("INSERT INTO admin_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => Login::isloggedin()));


				echo "New poll has successfully posted!";
			}
		}
	}

	/*if (isset($_POST['submit'])){
		$ptitle = $_POST['poll-title'];
		$date_end1 = $_POST['date'];
		$date_end2 = $_POST['time'];
		$userid = Login::isloggedin();

		$year = date('Y');
		$month = date('m');
		$day = date('d');
		$hour = date('H');
		$min = date('i');
		$sa = date('s');

		$identifier = $year.$day.$month.$hour.$min.$userid.$sa;
		$pchoice = $_POST['choice'];

		DB::query('INSERT INTO atis.poll VALUES (\'\',:identifier, :ptitle, Now(), :date_end1, :date_end2 , :userid)', array(':identifier'=> $identifier,
					 ':ptitle' => $ptitle, ':date_end1' => $date_end1, ':date_end2' => $date_end2, ':userid' => $userid));

		foreach ($pchoice as $a => $c){
			DB::query('INSERT INTO atis.`poll_choices` VALUES(\'\', :pollid, :choice)', array(':pollid' => $identifier, ':choice' => $pchoice[$a]));
		}

		echo "New poll has successfully posted!";

		$polls = DB::query('SELECT * FROM atis.poll ORDER BY poll.`datetime_post` DESC');
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
