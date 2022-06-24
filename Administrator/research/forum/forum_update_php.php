<?php
	ob_start();
	session_start();
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	
	//$connect = mysqli_connect("localhost", "root", "", "alumni");  
	if (isset($_POST['identifier'])){
		if (isset($_POST['adminid'])){
			if($_POST['identifier'] != '' && $_POST['adminid'] != ''){
				$forumtitle = $_POST['forum-title'];
				$forumdesc = $_POST['forum-desc'];
				$identifier = $_POST['identifier'];
				$adminid = $_POST['adminid'];
				
					DB::query('UPDATE forum_poll SET f_title=:forumtitle, f_desc=:forumdesc WHERE post_id=:identifier AND admin_id=:userid',
								array(':forumtitle'=>$forumtitle,':forumdesc'=>$forumdesc,':identifier'=>$identifier,':userid'=>$adminid));

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
					$description .= convert_string('decrypt', $adhead)." ".$names." updated forum ".$forumtitle." successfully!";
					$logtype = convert_string('encrypt', "Post Forum");

					DB::query("INSERT INTO admin_logs (log_type, description, date_time, admin_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => Login::isloggedin()));
						
					echo 'Data Updated';
					
				$fpost = DB::query('SELECT * FROM forum WHERE post_id = :forum_id', array(':forum_id' => $identifier));
		
				foreach($fpost as $f){
					$forumid = $f['forum_id'];
					$ftitle = $f['f_title'];
					$fdesc = $f['f_desc'];
					$datetime = $f['datetime'];
					$staff = $f['admin_id'];
				}
			}	
		}
	}
?>