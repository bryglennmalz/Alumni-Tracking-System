<?php
	ob_start();
	session_start();
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	
	$connect = mysqli_connect("localhost", "root", "", "alumnet");  
	
	if (isset($_POST['postid'])){
		$fpost="";
		$forumid="";
		$ftitle="";
		$staff="";
		$type="";
		
		$fpost = DB::query('SELECT * FROM forum_poll WHERE post_id = :postid', array(":postid"=> $_POST['postid']));
			foreach($fpost as $f){
				$forumid = $f['post_id'];
				$ftitle = $f['f_title'];
	            $staff = $f['admin_id'];
	            $type = $f['type'];
			}
		//Delete Comment
			DB::query("DELETE FROM forum_comment WHERE post_id = :id", array(":id"=>$_POST['postid']));

		//Delete likes
			DB::query("DELETE FROM forum_react WHERE post_id = :id", array(":id"=>$_POST['postid']));

		if($type == "Poll"){
			//Delete poll votes if TYPE is POLL
				DB::query("DELETE FROM poll_votes WHERE post_id = :id", array(":id"=>$_POST['postid']));
			//Delete poll choice if TYPE is POLL
				DB::query("DELETE FROM poll_choices WHERE post_id = :id", array(":id"=>$_POST['postid']));
		}
		
		//Delete forum or poll
		DB::query("DELETE FROM forum_poll WHERE post_id = :id",array(":id"=>$_POST['postid']));
		
		
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
					$description .= convert_string('decrypt', $adhead)." ".$names." has deleted ".$type." ".$ftitle." successfully!";
					$logtype = convert_string('encrypt', "Delete ".$type);

					DB::query("INSERT INTO admin_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => Login::isloggedin()));

		
		//header("location:forum-corner.php");
		echo "This post has been deleted.";
	}
?>