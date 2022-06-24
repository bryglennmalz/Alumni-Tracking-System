<?php
	$userid = Login::isloggedin();
	
	
	if (isset($_GET['alumniid'])){
		
		//Query Alumni Name
		$user_name = DB::query('SELECT * FROM alumni WHERE id = :userid', array(':userid' => $userid));
		
		$id = "";
		$fname = "";
		$mname = "";
		$lname = "";
		$extname = "";
		$civilstatus = "";
		$employstat = "";
		$ethnicity = "";
		$nationality = "";
		$bday = "";
		$bmonth = "";
		$byear = "";
		$gender = "";
		$religion = "";
		
		$cphone ="";
		$tel_no = "";
		$email = "";

		$fb = "";
		$ig = "";
		$twitter = "";
		$linkedin = "";
		$google = "";
		$website ="";
		
		foreach($user_name as $u){
			$fname = $u['fname'];
			$mname = $u['mi'];
			$lname = $u['lname'];
			$extname = $u['nameext'];
			
			$civilstatus = $u['civilstatus'];
			$employstat = $u['employstat'];
			$ethnicity = $u['ethnicity'];
			$nationality = $u['nationality'];
			$bday = $u['bday'];
			$bmonth = $u['bmonth'];
			$byear = $u['byear'];
			$gender = $u['sex'];
			$religion = $u['religion'];
			
			$cphone = $u['cphone'];
			$tel_no = $u['telno'];
			$email = $u['email'];

			$fb = $usm['fb'];
			$ig = $usm['ig'];
			$twitter = $usm['twitter'];
			$linkedin = $usm['linkedin'];
			$google = $usm['google'];
			$website = $usm['website'];
		}
		
		//Query skills
		$user_skills = DB::query('SELECT * FROM skills WHERE alumni_id = :userid', array(':userid' => $userid));
		
		$skill = "";
		$proficiency ="";
		
		//Query Language
		$user_language = DB::query('SELECT * FROM languages WHERE alumni_id = :userid', array(':userid' => $userid));
		
		$langprof ="";
		$language = "";
		
		//Query Teritary
		$user_education = DB::query('SELECT * FROM education WHERE userid = :userid ORDER BY yeargrad DESC', array(':userid' => $userid));
		
		$educ_id = "";
		$schname = "";
		$progstudied = "";
		$progmajor = "";
		$yeargrad = "";
		$yearstart = "";
		$comments = "";
		
		//Query job-hist
		$user_job_hist = DB::query('SELECT * FROM jobhistory WHERE alumni_id = :userid', array(':userid' => $userid));
		
		$jh_id ="";
		$jhname = "";
		$jsaddress = "";
		$position = "";
		$salary = "";
		$bistype = "";
		$mostart = "";
		$yrstart = "";
		$moend = "";
		$yrend = "";
		
		//Query Certification
		$user_cert_cnt = DB::query('SELECT COUNT(id) FROM certification WHERE alumni_id = :userid', array(':userid' => $userid));
		$user_cert = DB::query('SELECT * FROM certification WHERE alumniid = :userid', array(':userid' => $userid));
		
		$cert_id = "";
		$cert_name = "";
		$cert_authority = "";
		$from_mo = "";
		$from_yr = "";
		$to_mo = "";
		$to_yr = "";
		$url = "";
		
		//Query Honors Awards
		$user_h_a_cnt = DB::query('SELECT COUNT(id) FROM honorsawards WHERE alumni_id = :userid', array(':userid' => $userid));
		$user_h_a = DB::query('SELECT * FROM honorsawards WHERE alumniid = :userid', array(':userid' => $userid));
		
		$h_a_id = "";
		$h_a_name = "";
		$h_a_assoc = "";
		$h_a_issuer = "";
		$mo = "";
		$yr = "";
		
		//Query Organization
		$user_org_cnt = DB::query('SELECT COUNT(id) FROM organizations WHERE alumni_id = :userid', array(':userid' => $userid));
		$user_org = DB::query('SELECT * FROM organizations WHERE alumniid = :userid', array(':userid' => $userid));
		
		$org_id = "";
		$org_name = "";
		$org_pos = "";
		$org_from_mo = "";
		$org_from_yr = "";
		$org_to_mo = "";
		$org_to_yr = "";
		$org_comment = "";
		
		//Query Seminar
		$user_sem_cnt = DB::query('SELECT COUNT(id) FROM seminar WHERE alumni_id = :userid', array(':userid' => $userid));
		$user_sem = DB::query('SELECT * FROM seminar WHERE alumni_id = :userid', array(':userid' => $userid));
		
		$sem_id = "";
		$sem_name = "";
		$sem_venue = "";
		$sem_mo = "";
		$sem_yr = "";
		
		
		
		
	}
	
?>