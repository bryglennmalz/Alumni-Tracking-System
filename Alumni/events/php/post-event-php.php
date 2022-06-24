<?php
	
	if (isset($_POST['EventPost'])){
		$eventtitle = $_POST['event-title'];
		$eventdate = $_POST['date'];
		$eventtime = $_POST['time'];
		$eventloc = $_POST['event-loc'];
		$eventdesc = $_POST['event-desc'];
		//$image = $_POST['event-pic'];
	
		$userid = Login::isloggedin();
	
		DB::query('INSERT INTO events VALUES (\'\', :eventtitle, :eventdate, :eventtime, :eventloc, :eventdesc, :image, NOW(), :userid)',
					array(':eventtitle' => $eventtitle, ':eventdate' => $eventdate, ':eventtime' => $eventtime, ':eventloc' => $eventloc, 
					':eventdesc' => $eventdesc,  ':image' => $image, ':userid' => $userid));
			//echo ;
		
		$event = DB::query('SELECT * FROM events ORDER BY events.`datetime` DESC');
		$ev_post = "";
		foreach($event as $ev){
			//Number of Attendees query
			$cntGoing =("SELECT event_come.`e-come-id` FROM event_come WHERE event_come.`event-id` = :eventid");
											
			$pdo_cntGoing_Res = $pdoConnect ->prepare($cntGoing);
			$pdoExec = $pdo_cntGoing_Res -> execute(array(':eventid' => $eventid));
			$pdo_event_going = $pdo_cntGoing_Res->rowCount();
											
			//Number of Undecided query
			$cntMaybe =("SELECT event_maybe.`e-come-id` FROM event_maybe WHERE event_maybe.`event-id` = :eventid");
											
			$pdo_cntMaybe_Res = $pdoConnect ->prepare($cntMaybe);
			$pdoExec = $pdo_cntMaybe_Res -> execute(array(':eventid' => $eventid));
			$pdo_event_maybe = $pdo_cntMaybe_Res->rowCount();
											
			//Number of Not Now query
			$cntNo =("SELECT event_no.`e-no-id` FROM event_no WHERE event_no.`event-id` = :eventid");
											
			$pdo_cntNo_Res = $pdoConnect ->prepare($cntNo);
			$pdoExec = $pdo_cntNo_Res -> execute(array(':eventid' => $eventid));
			$pdo_event_no = $pdo_cntNo_Res->rowCount();
											
			$ev_post .= "<a href='forum.php?forumid=".$id."' method='POST'>
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
																				- ".$pdo_event_going." <i class='material-icons'>thumb_up</i> -
																				- ".$pdo_event_maybe." <i class='material-icons'>thumb_up</i> -
																				- ".$pdo_event_no." <i class='material-icons'>thumb_up</i>
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