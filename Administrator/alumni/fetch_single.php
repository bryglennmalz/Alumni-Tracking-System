<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM admin 
		WHERE admin_id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["alumID"] = convert_string('decrypt',$row["admin_id"]);
		$output["fname"] = convert_string('decrypt',$row["fname"]);
		$output['mname'] = convert_string('decrypt',$row['mname']);
		$output["lname"] = convert_string('decrypt',$row["lname"]);
		$output['nameext'] = convert_string('decrypt',$row['nameext']);
		$output['email'] = convert_string('decrypt',$row['email']);
		$output['pword'] = $row['pword'];
		
		/*if($row["image"] != '')
		{
			$output['user_image'] = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}*/
	}
	echo json_encode($output);
}
?>