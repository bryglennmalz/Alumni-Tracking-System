<?php

	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';

	if (isset($_POST['EventPost'])){
		$eventtitle = $_POST['event-title'];
		$eventdate = $_POST['date'];
		$eventtime = $_POST['time'];
		$eventloc = $_POST['event-loc'];
		$eventdesc = $_POST['event-desc'];
		//$image = $_POST['event-pic'];
		$userid = Login::isloggedin();

		$year = date('Y');
		$month = date('m');
		$day = date('d');
		$hour = date('H');
		$min = date('i');
		$sa = date('s');
		$identifier = $year.$day.$month.$hour.$min.$userid.$sa;


		DB::query('INSERT INTO events VALUES (\'\', :event_id, :eventtitle, :eventdate, :eventtime, :eventloc, :eventdesc, \'\', NOW(), :userid)',
					array(':event_id' => $identifier,':eventtitle' => $eventtitle, ':eventdate' => $eventdate, ':eventtime' => $eventtime, ':eventloc' => $eventloc,
					':eventdesc' => $eventdesc, ':userid' => $userid));

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
							$description .= convert_string('decrypt', $adhead)." ".$names." added event ".$eventtitle." successfully!";
							$logtype = "Post Event";

							DB::query("INSERT INTO admin_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => Login::isloggedin()));

		echo "Event successfully posted!";

		$event = DB::query('SELECT * FROM events ORDER BY events.`event_date` AND event_time DESC');
		$ev_post = "";
		foreach($event as $ev){
			$eventid = $ev['event_id'];
			$eventtitle = $ev['event_title'];
			$eventdate = $ev['event_date'];
			$eventtime = $ev['event_time'];
			$eventloc = $ev['event_loc'];
			$eventdesc = $ev['event_desc'];
			$banner = $ev['image'];
			$datetime = $ev['datetime'];
			$staff = $ev['admin_id'];

											//Number of likes query
											$remarks = "Going";
											$remarks2 = "Interested";
											$remarks3 = "Not Now";

											//Number of Goers query
											$cntgoing =("SELECT `e_vote`.e_vote_id FROM alumnitracking.`e_vote` WHERE `e_vote`.event_id = :fid AND remarks =:remarks");

											$pdo_cntGoing_Res = $pdoConnect ->prepare($cntgoing);
											$pdoExec = $pdo_cntGoing_Res -> execute(array(':fid' => $eventid, ':remarks' => $remarks));
											$pdo_cntgoings = $pdo_cntGoing_Res->rowCount();

											//Number of Undecided query
											$cntinterested =("SELECT `e_vote`.e_vote_id FROM alumnitracking.`e_vote` WHERE `e_vote`.event_id = :fid AND remarks =:remarks");

											$pdo_cntInterested_Res = $pdoConnect ->prepare($cntinterested);
											$pdoExec = $pdo_cntInterested_Res -> execute(array(':fid' => $eventid, ':remarks' => $remarks2));
											$pdo_cntinteresteds = $pdo_cntInterested_Res->rowCount();

											//Number of Not Now query
											$cntnotnow =("SELECT `e_vote`.e_vote_id FROM alumnitracking.`e_vote` WHERE `e_vote`.event_id = :fid AND remarks =:remarks");

											$pdo_cntNotNow_Res = $pdoConnect ->prepare($cntnotnow);
											$pdoExec = $pdo_cntNotNow_Res -> execute(array(':fid' => $eventid, ':remarks' => $remarks3));
											$pdo_cntnotnows = $pdo_cntNotNow_Res->rowCount();

										$ev_post .= "<a href='event.php?eventid=".$eventid."' method='POST'>
														<div class='card'>
															<div class='card-body'>
																<div>
																	<table>
																		<tbody>
																			<tr>
																				<td>
																					<h3 class='card-title'>".$eventtitle."</h3>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					".$eventloc."
																				</td>
																			</tr>
																			<tr>
																				<td>
																					".date('F d, Y', strtotime($eventdate))." ".date('h:i A', strtotime($eventtime))."
																				</td>
																			</tr>
																		</tbody>
																	</table>
																	<hr>
																	<footer class='text-right'>
																		<p>
																			<small>
																				- ".$pdo_cntgoings." <i class='mdi mdi mdi-walk'></i> &nbsp&nbsp
																				- ".$pdo_cntinteresteds." <i class='mdi mdi-star'></i> &nbsp&nbsp
																				- ".$pdo_cntnotnows." <i class='mdi mdi-close'></i>
																			</small>
																		</p>
																	</footer>
																</div>
															</div>
														</div>
													</a>";
										}

			//echo $ev_post;
	}



?>
