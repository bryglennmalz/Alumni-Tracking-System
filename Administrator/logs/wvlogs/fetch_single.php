<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM alumni.staff 
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["alumID"] = $row["id"];
		$output["fname"] = $row["fname"];
		$output['mname'] = $row['mname'];
		$output["lname"] = $row["lname"];
		$output['nameext'] = $row['nameext'];
		$output['email'] = $row['email'];
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