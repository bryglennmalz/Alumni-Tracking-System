<?php
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';
	
	if(isset($_POST["operation"])){
		if ($_POST["operation"] == "Add Honors or Awards"){
			$haName =$_POST['haName'];
			$haAssoc =$_POST['haAssoc'];
			$haIssuer =$_POST['haIssuer'];
			$haMonth =$_POST['haMonth'];
			$haYear =$_POST['haYear'];
			$haComment =$_POST['haComment'];
			$alumniid =$_POST['alumniid'];

			$loggedin = Login::isloggedin();

			if ($loggedin == $alumniid){

				foreach ($haName as $a => $c) {
					$haNames = convert_string('encrypt', clean_text($haName[$a]));
					$haAssocs = convert_string('encrypt', clean_text($haAssoc[$a]));
					$haIssuers = convert_string('encrypt', clean_text($haIssuer[$a]));
					$haMonths = convert_string('encrypt', clean_text($haMonth[$a]));
					$haYears = convert_string('encrypt', clean_text($haYear[$a]));
					$haComments = convert_string('encrypt', clean_text($haComment[$a]));


					$year = date('Y');
					$month = date('m');
					$day = date('d');
					$hour = date('H');
					$min = date('i');
					$sa = date('s');
					$uu = round(microtime(true) * 1000);
					$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$alumniid).$sa.$uu;	


					DB::query('INSERT INTO affiliations_honors_awards VALUES(\'\', :identifier, :haNames, :haAssocs, :haIssuers, :haMonths, :haYears, :haComments, :alumniid)', array(':identifier'=> $identifier, ':haNames'=> $haNames, ':haAssocs'=> $haAssocs, ':haIssuers'=> $haIssuers, ':haMonths'=> $haMonths, ':haYears'=> $haYears, ':haComments'=> $haComments, ':alumniid'=> $alumniid));
				}

				$admin = DB::query('SELECT * FROM alumni WHERE alumni_id = :userid', array(':userid' => $alumniid));

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
					$description .= "Alumni ".$names." added Honors and Awards!";
					$logtype = "Add Honors and Awards";

					DB::query("INSERT INTO alumni_logs (log_type, description, date_time, alumni_id) VALUES (:log_type, :description, NOW(), :admin_id)", array(":log_type"=> $logtype,":description" => $description, ":admin_id" => $alumniid));

				header('Location: ../signup-others.php');
				
			}
		}
	}
?>