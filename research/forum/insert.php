<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO staff (id,fname, mname, lname, nameext, email, pword) 
			VALUES (:adminID, :fname, :mname, :lname, :nameext, :email, :pword)
		");
		$result = $statement->execute(
			array(
				':adminID'	=>	$_POST["first_name"],
				':fname'	=>	$_POST["last_name"],
				':mname'	=>	$_POST["last_name"],
				':lname'	=>	$_POST["last_name"],
				':nameext'	=>	$_POST["last_name"],
				':email'	=>	$_POST["last_name"],
				':pword'	=>	$_POST["last_name"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$statement = $connection->prepare(
			"UPDATE staff 
			SET fname = :fname, mname=:mname, lname = :lname, nameext = :nameext, pword = :pword 
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':fname'	=>	$_POST["f-name"],
				':mname'	=>	$_POST["mi"],
				':lname'	=>	$_POST["l-name"],
				':nameext'	=>	$_POST["ext-name"],
				':pword'	=>	$_POST["p-word"],
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>