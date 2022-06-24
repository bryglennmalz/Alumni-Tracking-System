<?php

	//$userid = Login::isloggedin();
	
	//Query Alumni Name
	//$user_name = DB::query('SELECT * FROM alumni.staff WHERE id = :userid', array(':userid' => $userid));

	if (isset($_POST['AlumniSave'])){
		$alumniid = $_POST['alumni-id'];
		$fname = $_POST['f-name'];
		$mi = $_POST['mi'];
		$lname = $_POST['l-name'];
		$extname = $_POST['ext-name'];
		$degree = $_POST['degree'];
		$major = $_POST['major'];
		$yeargrad = $_POST['yeargrad'];
		$bmonth = $_POST['BMonth'];
		$bday = $_POST['BDay'];
		$byear = $_POST['BYear'];
		$verified = 0;
		$schname = "Central Mindanao University";
		
		
		$loggedin = Login::isloggedin();
		
		/*if( strlen($forumdesc) > 5000 || strlen($forumdesc) <1 ){
			die (incorrect lenght!);
		}*/
		
		if (DB::query('SELECT id FROM alumni.alumni WHERE id = :alumniid', array(':alumniid' => $alumniid))){
			echo "This information has already been saved.";
			
		}else{
			DB::query('INSERT INTO alumni.alumni VALUES (:alumniid,:fname, :mi, :lname, :extname, /'/', /'/', /'/', /'/', /'/', /'/', :bday, :bmonth, :byear,
					   /'/', /'/', /'/', /'/', /'/', /'/', /'/', /'/', /'/', /'/', /'/', :verified, /'/')',
					array(':alumniid' => $alumniid, ':fname' => $fname, ':mi' => $mi, ':lname' => $lname, ':extname' => $extname, ':bday' => $bday,
						  ':bmonth' => $bmonth, ':byear' => $byear, ':verified' => $verified));
		
			DB::query('INSERT INTO alumni.education VALUES (/'/',:schname, :progstudied, :progmajor, /'/', :yeargrad, /'/', :alumniid )', array(':schname' => $schname,
					':degree' => $degree,':major' => $major,':yeargrad' => $yeargrad,':alumniid' => $alumniid));
		}
		

		$alumni_lists = "";
		foreach($n_alumni as $st){
			$adid = $st['id'];
			$adfname = $st['fname'];
			$admname = $st['mi'];
			$adlname = $st['lname'];
			$adextname = $st['nameext'];
			$adtype = $st['verified'];
			$progstudied = $st['progstudied'];
			$progmajor = $st['progmajor'];
			$yeargrad = $st['yeargrad'];	
																
			if ($adtype == 1){
				$verifieds = "";
				$verifieds = "Verified";
			} else{
				$verifieds = "";
				$verifieds = "Unverified";
			}
																
			if ($adextname == null){
				$names = "";
				$names = array($adfname , " " , $admname ," ", $adlname);
			}
			else{
				$names = "";
				$names = array($adfname , " " , $admname ," ", $adlname, " ", $adextname);
			}
															
			if ($progmajor == null){
				$degree = array($progstudied);
			} else {
				$degree = array($progstudied, " - ", $progmajor);
			}
			$alumni_lists .= "<tr>
							<td>". $adid ."</td>
							<td>". implode($names) ."</td>
							<td>". implode($degree) ."</td>
							<td>". $yeargrad ."</td>
							<td>". $verifieds ."</td>
							<td class='text-nowrap text-center'>
								<a href='#' data-toggle='tooltip' data-original-title='Edit'> <i class='fa fa-pencil text-inverse m-r-10'></i> </a>
								<a href='#' data-toggle='tooltip' data-original-title='Close'> <i class='fa fa-close text-danger'></i> </a>
							</td>
						</tr>";
        }
		
	}


?>