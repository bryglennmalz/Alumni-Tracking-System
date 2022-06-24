<?php

	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	//$userid = Login::isloggedin();


	if (isset($_POST['operation2'])){
		$loggedin = Login::isloggedin();
		if($_POST['operation2'] == "Add Forum"){

			$forumtitle = $_POST['forum-title'];
			$forumdesc = $_POST['forum-desc'];
			$type = $_POST['type'];

			//$loggedin = Login::isloggedin();

			//echo $forumtitle;

			$year = date('Y');
			$month = date('m');
			$day = date('d');
			$hour = date('H');
			$min = date('i');
			$sa = date('s');

			$identifiers = $year.$day.$month.$hour.$min.convert_string('decrypt', $loggedin).$sa;

			$token = bin2hex(openssl_random_pseudo_bytes(255, $identifier));

			/*if( strlen($forumdesc) > 5000 || strlen($forumdesc) <1 ){
				die (incorrect lenght!);
			}*/
			DB::query('INSERT INTO forum_poll (post_id, f_title, f_desc, datetime_post, admin_id, type) VALUES (:identifier, :forumtitle, :forumdesc, NOW(), :userid, :type)', array(':identifier'=> $identifiers, ':forumtitle' => $forumtitle, ':forumdesc' => $forumdesc, ':userid' => $loggedin, ':type'=> $type));


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
					$description .= convert_string('decrypt', $adhead)." ".$names." added forum ".$forumtitle." successfully!";
					$logtype = "Post Forum";

					DB::query("INSERT INTO admin_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => Login::isloggedin()));


			echo "New forum has successfully posted!";

			$forum = DB::query('SELECT * from forum_poll ORDER BY datetime_post DESC');
			$f_post = "";
			foreach($forum as $f){
				$datetime = $f['datetime'];
				$f_post .= "<div class='tab-content'>
								<div role='tabpanel' class='tab-pane animated fadeInRight active' id='home_animation_2'>
									<div class='card'>

										<div class='body'>
											<blockquote>
												<p>".$f['forumtitle']."</p>

												<footer class='text-right'>
													<i class='material-icons'>thumb_up</i> -
													<i class='material-icons'>comment</i> -"
													.date('F d, Y  h:i a', strtotime($datetime)).
												"</footer>
											</blockquote>
										</div>

									</div>
								</div>
							</div>";
	        }

			//echo $f_post;

			header("location:forum-corner.php");
		}
	}


	/*if (isset($_POST['ForumPost'])){
		$forumtitle = $_POST['forum-title'];
		$forumdesc = $_POST['forum-desc'];

		$loggedin = Login::isloggedin();

		$year = date('Y');
		$month = date('m');
		$day = date('d');
		$hour = date('H');
		$min = date('i');
		$sa = date('s');

		$identifiers = $year.$day.$month.$hour.$min.convert_string('decrypt', $loggedin).$sa;

		$token = bin2hex(openssl_random_pseudo_bytes(255, $identifier));

		/*if( strlen($forumdesc) > 5000 || strlen($forumdesc) <1 ){
			die (incorrect lenght!);
		}*/
			/*DB::query('INSERT INTO forum VALUES (\'\',:identifier, :forumtitle, :forumdesc, NOW(), :userid)',
					array(':identifier'=> $identifiers, ':forumtitle' => $forumtitle, ':forumdesc' => $forumdesc, ':userid' => $loggedin));

		$description = 'Admin '. Login::isloggedin(). ' post a new forum. "'. $forumtitle .'".';

			DB::query("INSERT INTO atis.admin_logs (description, date_time, admin_id) VALUES (:description, NOW(), :admin_id)", array(":description" => $description, ":admin_id" => Login::isloggedin()));

		echo "New forum has successfully posted!";

		$forum = DB::query('SELECT * from alumni.forum ORDER BY datetime DESC');
		$f_post = "";
		foreach($forum as $f){
			$f_post .= "<div class='tab-content'>
							<div role='tabpanel' class='tab-pane animated fadeInRight active' id='home_animation_2'>
								<div class='card'>

									<div class='body'>
										<blockquote>
											<p>".$f['forumtitle']."</p>

											<footer class='text-right'>
												<i class='material-icons'>thumb_up</i> -
												<i class='material-icons'>comment</i> -"
												.date('F d, Y  h:i a', strtotime($datetime)).
											"</footer>
										</blockquote>
									</div>

								</div>
							</div>
						</div>";
        }

		//echo $f_post;

		header("location:forum-corner.php");
	}*/


?>
