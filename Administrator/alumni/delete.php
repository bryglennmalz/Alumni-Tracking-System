<?php

include('db.php');
include("function.php");

if(isset($_POST["user_id"]))
{
	$statement = $connection->prepare(
		"UPDATE alumnitracking.admin SET verified = 2 WHERE admin_id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	convert_string('encrypt',$_POST["user_id"])
		)
	);
	
	if(!empty($result))
	{
		echo 'Data Deleted';
	}
}



?>