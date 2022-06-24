<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT admin_logs.log_type AS log_type, admin_logs.description AS description, admin_logs.date_time AS date_time, admin.fname AS fname, admin.mname AS mname, admin.lname AS lname, admin.nameext AS nameext, admin.type AS type FROM admin_logs INNER JOIN admin ON admin_logs.admin_id = admin.admin_id";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE admin.fname LIKE "%'.convert_string('encrypt',$_POST["search"]["value"]).'%" ';
	$query .= 'OR admin.lname LIKE "%'.convert_string('encrypt',$_POST["search"]["value"]).'%" ';
	$query .= 'OR admin_logs.log_type LIKE "%'.convert_string('encrypt',$_POST["search"]["value"]).'%" ';
	$query .= 'OR admin_logs.date_time LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY admin_logs.date_time ASC ';
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
	$log_type = "";
	$description = "";
	$date_time = "";
	$adfname = "";
	$admname = "";
	$adlname = "";
	$adextname = "";
	$type = "";
	
	$log_type = $row["log_type"];
	$description = $row["description"];
	$date_time = $row["date_time"];
	$adfname = convert_string('decrypt',$row['fname']);
	$admname = convert_string('decrypt',$row['mname']);
	$adlname = convert_string('decrypt',$row['lname']);
	$adextname = convert_string('decrypt',$row['nameext']);
	$type	 = convert_string('decrypt',$row['type']);
	
																
	if ($adextname == null){
		$names = "";
		$names = array($adfname , " " , $admname ," ", $adlname);
	}
		else{
		$names = "";
		$names = array($adfname , " " , $admname ," ", $adlname, " ", $adextname);
	}
	
	$sub_array = array();
	$sub_array[] = implode($names);
	$sub_array[] = convert_string('decrypt',$type);
	$sub_array[] = $log_type;
	$sub_array[] = $description;
	$sub_array[] = $date_time;
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