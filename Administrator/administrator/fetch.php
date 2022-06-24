<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM admin ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE admin_id LIKE "%'.convert_string('encrypt',$_POST["search"]["value"]).'%" ';
	$query .= 'OR fname LIKE "%'.convert_string('encrypt',$_POST["search"]["value"]).'%" ';
	$query .= 'OR lname LIKE "%'.convert_string('encrypt',$_POST["search"]["value"]).'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY admin_id ASC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$adid = "";
	$adfname = "";
	$admname = "";
	$adlname = "";
	$adextname = "";
	$adtype = "";
	$adhead = "";
	
	$adid = $row["admin_id"];
	$adfname = convert_string('decrypt',$row['fname']);
	$admname = convert_string('decrypt',$row['mname']);
	$adlname = convert_string('decrypt',$row['lname']);
	$adextname = convert_string('decrypt',$row['nameext']);
	$adverify = $row['verified'];
	$adhead = $row['type'];
	
	if ($adverify == 1){
		$verifieds = "";
		$verifieds = "Verified";
	}
	else if($adverify == 2){
		$verifieds = "";
		$verifieds = "Disabled";
	}
	else{
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
	
	$sub_array = array();
	$sub_array[] = convert_string('decrypt',$adid);
	$sub_array[] = implode($names);
	$sub_array[] = convert_string('decrypt',$adhead);
	$sub_array[] = $verifieds;
	//$sub_array[] = "<button type='button' name='update' id='".$adid."' class='btn btn-warning btn-xs update'>Update</button> <button type='button' name='disable' id='".$adid."' class='btn btn-danger btn-xs disable'>Disable</button>";
	$data[] = $sub_array;
}//
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>