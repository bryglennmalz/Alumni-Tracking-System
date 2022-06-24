<?php
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	require '../../php/function.php';

	if(isset($_POST['operation'])){
		if($_POST['operation'] == "Add Career"){
			$jobName =$_POST['jobName'];
			$compName =$_POST['compName'];
			$compLoc =$_POST['compLoc'];
			$jobDesc =$_POST['jobDesc'];
			$jobReq =$_POST['jobReq'];
			$comCel =$_POST['comCel'];
			$comTel =$_POST['comTel'];
			$compEmail =$_POST['compEmail'];
			$compWeb =$_POST['compWeb'];
			$compOver =$_POST['compOver'];
			$user_id =$_POST['user_id'];


			if($_POST['salRange'] == "Select salary range"){
				$salRange = "";
			} 
			else{
				$salRange =$_POST['salRange'];
			}
			if($_POST['empType'] == "Select employment type"){
				$empType = "";
			} 
			else{
				$empType =$_POST['empType'];
			}
			if($_POST['senLevel'] == "Select seniority level"){
				$senLevel = "";
			} 
			else{
				$senLevel =$_POST['senLevel'];
			}

			$year = date('Y');
			$month = date('m');
			$day = date('d');
			$hour = date('H');
			$min = date('i');
			$sa = date('s');
			$uu = round(microtime(true) * 1000);
			$identifier = $year.$day.$month.$hour.$min.convert_string('decrypt',$user_id).$sa.$uu;	

			if(!empty($_FILES['cpBanner']['tmp_name']) && file_exists($_FILES['cpBanner']['tmp_name'])){
				$image = addslashes(file_get_contents($_FILES['cpBanner']['tmp_name']));

				DB::query('INSERT INTO alumnitracking.job_post (job_post_id, position, comp_name, comp_loc, job_desc, job_req, comp_overview, email, cell_no, tel_no, website, emp_type, senior_level, sal_range, banner, alumni_id, date_time) VALUES (:job_pos_id, :position, :comp_name, :comp_loc, :job_desc, :job_req, :comp_overview, :email, :cell_no, :tel_no, :website, :emp_type, :senior_level, :sal_range, :banner, :alumni_id, Now())', array(':job_pos_id' => $identifier, ':position' =>$jobName, ':comp_name'=>$compName, ':comp_loc'=>$compLoc, ':job_desc'=>$jobDesc, ':job_req'=>$jobReq, ':comp_overview'=>$compOver, ':email'=>$compEmail, ':cell_no'=>$comCel, ':tel_no'=>$comTel, ':website'=>$compWeb, ':emp_type'=>$empType, ':senior_level'=>$senLevel, ':sal_range'=>$salRange,':banner'=> addslashes(file_get_contents($_FILES['cpBanner']['tmp_name'])), ':alumni_id'=>$user_id));

				echo "Career successfully posted";
			}
			else{
				DB::query('INSERT INTO alumnitracking.job_post (job_post_id, position, comp_name, comp_loc, job_desc, job_req, comp_overview, email, cell_no, tel_no, website, emp_type, senior_level, sal_range, alumni_id, date_time) VALUES (:job_pos_id, :position, :comp_name, :comp_loc, :job_desc, :job_req, :comp_overview, :email, :cell_no, :tel_no, :website, :emp_type, :senior_level, :sal_range, :alumni_id, Now())', array(':job_pos_id' => $identifier, ':position' =>$jobName, ':comp_name'=>$compName, ':comp_loc'=>$compLoc, ':job_desc'=>$jobDesc, ':job_req'=>$jobReq, ':comp_overview'=>$compOver, ':email'=>$compEmail, ':cell_no'=>$comCel, ':tel_no'=>$comTel, ':website'=>$compWeb, ':emp_type'=>$empType, ':senior_level'=>$senLevel, ':sal_range'=>$salRange, ':alumni_id'=>$user_id));

				echo "Career successfully posted";
			}
				//echo '<img src="data:image/jpeg;base64,'.base64_encode($cpBanner).'" class="img-thumbnail">';
		}

	}

	if(isset($_POST['uoperation'])){
		if($_POST['uoperation'] == "Update Career"){
			$ujobid =$_POST['ujobid'];
			$ujobName =$_POST['ujobName'];
			$ucompName =$_POST['ucompName'];
			$ucompLoc =$_POST['ucompLoc'];
			$ujobDesc =$_POST['ujobDesc'];
			$ujobReq =$_POST['ujobReq'];
			$ucomCel =$_POST['ucomCel'];
			$ucomTel =$_POST['ucomTel'];
			$ucompEmail =$_POST['ucompEmail'];
			$ucompWeb =$_POST['ucompWeb'];
			$ucompOver =$_POST['ucompOver'];
			$uuser_id =$_POST['uuser_id'];


			if($_POST['usalRange'] == "Select salary range"){
				$usalRange = "";
			} 
			else{
				$usalRange =$_POST['usalRange'];
			}
			if($_POST['uempType'] == "Select employment type"){
				$uempType = "";
			} 
			else{
				$uempType =$_POST['uempType'];
			}
			if($_POST['usenLevel'] == "Select seniority level"){
				$usenLevel = "";
			} 
			else{
				$usenLevel =$_POST['usenLevel'];
			}	

			if(!empty($_FILES['ucpBanner']['tmp_name']) && file_exists($_FILES['ucpBanner']['tmp_name'])){
				$image = addslashes(file_get_contents($_FILES['cpBanner']['tmp_name']));

				DB::query('UPDATE alumnitracking.job_post SET position=:position, comp_name=:comp_name, comp_loc=:comp_loc, job_desc=:job_desc, job_req=:job_req, comp_overview=:comp_overview, email=:email, cell_no=:cell_no, tel_no=:tel_no, website=:website, emp_type=:emp_type, senior_level=:senior_level, sal_range=:sal_range, banner=:banner WHERE alumni_id=:alumni_id AND job_post_id=:job_pos_id', array(':position' =>$ujobName, ':comp_name'=>$ucompName, ':comp_loc'=>$ucompLoc, ':job_desc'=>$ujobDesc, ':job_req'=>$ujobReq, ':comp_overview'=>$ucompOver, ':email'=>$ucompEmail, ':cell_no'=>$ucomCel, ':tel_no'=>$ucomTel, ':website'=>$ucompWeb, ':emp_type'=>$uempType, ':senior_level'=>$usenLevel, ':sal_range'=>$usalRange,':banner'=> addslashes(file_get_contents($_FILES['ucpBanner']['tmp_name'])), ':alumni_id'=>$uuser_id, ':job_pos_id' => $ujobid));

				echo "Career successfully posted";
			}
			else{
				DB::query('UPDATE alumnitracking.job_post SET position=:position, comp_name=:comp_name, comp_loc=:comp_loc, job_desc=:job_desc, job_req=:job_req, comp_overview=:comp_overview, email=:email, cell_no=:cell_no, tel_no=:tel_no, website=:website, emp_type=:emp_type, senior_level=:senior_level, sal_range=:sal_range WHERE alumni_id=:alumni_id AND job_post_id=:job_pos_id', array(':position' =>$ujobName, ':comp_name'=>$ucompName, ':comp_loc'=>$ucompLoc, ':job_desc'=>$ujobDesc, ':job_req'=>$ujobReq, ':comp_overview'=>$ucompOver, ':email'=>$ucompEmail, ':cell_no'=>$ucomCel, ':tel_no'=>$ucomTel, ':website'=>$ucompWeb, ':emp_type'=>$uempType, ':senior_level'=>$usenLevel, ':sal_range'=>$usalRange, ':alumni_id'=>$uuser_id, ':job_pos_id' => $ujobid));

				echo "Career successfully posted";
			}
				//echo '<img src="data:image/jpeg;base64,'.base64_encode($cpBanner).'" class="img-thumbnail">';
		}

	}

?>