<?php
	ob_start();
	session_start();
	
	require '../../php/myconnection.php';
    require '../../php/home-php.php';
    require '../../php/function.php';


	$userid = Login::isloggedin();
	
	//Query Alumni Name
	//$user_name = DB::query('SELECT * FROM alumni.staff WHERE id = :userid', array(':userid' => $userid));

	if (isset($_POST['ucoperation'])){
		if($_POST['ucoperation'] == "Update Comment Post"){
			$ufcomment = $_POST['ufcomment'];
			$forum_id = $_POST['u_forumid'];
			$user_id = $_POST['uuserid'];
			$uforumcommentid = $_POST['uforumcommentid'];

			DB::query('UPDATE alumnitracking.forum_comment SET comment_text = :comment WHERE f_comment_id = :uforumcommentid AND forum_id = :forum_id AND alumni_id = :alumni_id', array(':comment'=> $ufcomment,':uforumcommentid'=>$uforumcommentid, ':forum_id'=> $forum_id,  ':alumni_id'=> $user_id));

			echo "Comment updated";
		}

		
	
		/*if( strlen($forumdesc) > 5000 || strlen($forumdesc) <1 ){
			die (incorrect lenght!);
		}*/
			
		
		/*$fc_commentss = DB::query("SELECT alumni.alumni_id AS fc_id, alumni.fname AS fc_fname, alumni.mname AS fc_mi, alumni.lname AS fc_lname, alumni.nameext AS fc_nameext, `forum_comment`.`comment_text` AS fc_commments, `forum_comment`.`datetime` AS fc_datetime FROM  forum INNER JOIN forum_comment ON forum.forum_id = forum_comment.`forum_id` INNER JOIN alumni ON forum_comment.`alumni_id` = alumni.alumni_id WHERE  `forum_comment`.`forum_id` = :fid AND `forum_comment`.`alumni_id` = alumni.alumni_id", array(':fid' => $forum_id));
		$fc_alumni = "";
		foreach($fc_commentss as $f_c){
			$fc_alumni.="<li class='media row'>
							<img class='d-flex mr-3' src='../../assets/images/users/1.jpg' width='60' alt='Generic placeholder image'>
							<div class='media-body'>
								<h5 class='mt-0 mb-1'><b>". $fc_fname ." ". $fc_mi .". ". $fc_lname ." ". $fc_nameext."</b></h5>
								<small><h6>". date('F d, Y  h:i A', strtotime($fc_datetime)) ." <br></h6></small>
								". $fc_comment."
								<small><h6><br><a id='reply' class='reply' href='#'><b>Reply</b></a> &nbsp <a href='#'>Edit</a> &nbsp <a href='#'>Delete</a></h6></small>
								<form action='#' class='form-horizontal form-bordered' method='post''>
									<div class='form-group'>
										<div class='col-md-12 row'>
											<div class='col-md-11'>
												<textarea class='form-control' placeholder='Reply...' name='f-reply' rows='3%' cols='100%'></textarea>
												<input type='hidden' name='user-id' class='form-control' value='". $alid. "' required/>
												<input type='hidden' name='pforum-id' class='form-control' value='".$forumid."' required/>
											</div>
											<div class='col-md-1'>
												<button type='submit' class='btn btn-success waves-effect'  name='ForumReplyPost'>Reply</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</li>";
		}*/
		
		//echo $f_post;
	}


?>