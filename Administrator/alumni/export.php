<?php  
	//export.php  

	require '../php/myconnection.php';
	require '../php/home-php.php';

	$schname = "Central Mindanao University";

	$connect = mysqli_connect("localhost", "root", "", "atis");
	$output = '';
	$outputs = '';
	if(isset($_POST["export"]))
	{
		$querys = DB::query("SELECT alumni.alumni_id AS id, alumni.fname AS fname, alumni.mname AS mname, alumni.lname AS lname, alumni.nameext AS nameext, alumni.verified AS verified,
					 educations.prog_studied AS progstudied, educations.prog_major AS progmajor, educations.year_grad AS yeargrad
					FROM atis.alumni INNER JOIN atis.educations ON alumni.alumni_id=educations.alumni_id WHERE educations.sch_name = :schname", array(":schname"=> $schname));
	 
		include('db.php');
		
		$statement = $connection->prepare("SELECT * FROM atis.educations INNER JOIN atis.alumni ON educations.alumni_id=alumni.alumni_id WHERE educations.sch_name = :schname");
		$statement->execute(array(":schname" => $schname));
		$result = $statement->fetchAll();
		return $statement->rowCount();
		
		if ($statement > 0){
			
			$outputs .="
						<table class='table' bordered='1'>
							<tr>  
									<th>Alumni ID </th>  
									<th>Fullname</th>  
									<th>Degree</th>  
									<th>Yr. Grad. Code</th>
									<th>Remarks</th>
							</tr>
			";
			
			foreach($querys as $row)
			{
				$adid = "";
				$adfname = "";
				$admname = "";
				$adlname = "";
				$adextname = "";
				$adtype = "";
				$progstudied = "";
				$progmajor = "";
				$yeargrad = "";
				
				$adid = $row["id"];
				$adfname = $row['fname'];
				$admname = $row['mname'];
				$adlname = $row['lname'];
				$adextname = $row['nameext'];
				$adtype = $row['verified'];
				$progstudied = $row['progstudied'];
				$progmajor = $row['progmajor'];
				$yeargrad = $row['yeargrad'];
				
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
					$degrees = "";
					$degrees = array($progstudied);
				} else {
					$degrees = "";
					$degrees = array($progstudied, " major in ", $progmajor);
				}
				
				$outputs .="
							<tr>
								<td>".$adid."</td>  
								<td>".implode($names)."</td>  
								<td>".implode($degrees)."</td> 
								<td>".$yeargrad."</td>  
								<td>".$verifieds."</td>
							
							</tr>
				";
			}
			
			$outputs .= '</table>';
			header('Content-Type: application/xls');
			header('Content-Disposition: attachment; filename=download.xls');
			echo $outputs;
		}
		
	}
?>

<?php  
	//export.php  
	$connect = mysqli_connect("localhost", "root", "", "testing");
	$output = '';
	if(isset($_POST["export"]))
	{
		 $query = "SELECT * FROM tbl_customer";
		 $result = mysqli_query($connect, $query);
		 if(mysqli_num_rows($result) > 0)
		 {
			$output .= '
						<table class="table" bordered="1">  
						<tr>  
							 <th>Name</th>  
							 <th>Address</th>  
							 <th>City</th>  
							 <th>Postal Code</th>
							 <th>Country</th>
						</tr>
					';
		  while($row = mysqli_fetch_array($result))
		  {
		   $output .= '
			<tr>  
								 <td>'.$row["CustomerName"].'</td>  
								 <td>'.$row["Address"].'</td>  
								 <td>'.$row["City"].'</td>  
								 <td>'.$row["PostalCode"].'</td>  
								 <td>'.$row["Country"].'</td>
							</tr>
		   ';
		  }
		  $output .= '</table>';
		  header('Content-Type: application/xls');
		  header('Content-Disposition: attachment; filename=download.xls');
		  echo $output;
		 }
	}
?>