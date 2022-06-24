<?php

	//$userid = Login::isloggedin();
	
	//Query Alumni Name
	//$user_name = DB::query('SELECT * FROM alumni.staff WHERE id = :userid', array(':userid' => $userid));

	if (isset($_POST['ForumPost'])){
		$forumtitle = $_POST['forum-title'];
		$forumdesc = $_POST['forum-desc'];
	
		$loggedin = Login::isloggedin();
		
		/*if( strlen($forumdesc) > 5000 || strlen($forumdesc) <1 ){
			die (incorrect lenght!);
		}*/
			DB::query('INSERT INTO forum VALUES (\'\',:userid, :forumtitle, :forumdesc, NOW())',
					array(':userid' => $loggedin, ':forumtitle' => $forumtitle, ':forumdesc' => $forumdesc));
		
		
		
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
	}


?>