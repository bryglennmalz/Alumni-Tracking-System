<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM admin_logs";
if(isset($_POST["search"]["value"]))
{
	//$query .= 'WHERE admin.fname LIKE "%'.convert_string('encrypt',$_POST["search"]["value"]).'%" ';
	//$query .= 'OR admin.lname LIKE "%'.convert_string('encrypt',$_POST["search"]["value"]).'%" ';
	$query .= 'WHERE admin_id LIKE "%'.convert_string('encrypt',$_POST["search"]["value"]).'%" ';
	$query .= 'OR log_type LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR date_time LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY date_time ASC ';
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
	$admin_id = "";
	$adfname = "";
	$admname = "";
	$adlname = "";
	$adextname = "";
	$type = "";

	$log_type = $row["log_type"];
	$description = $row["description"];
	$date_time = $row["date_time"];
	$admin_id = $row["admin_id"];


	/*$query2 .= "SELECT * FROM admin_logs WHERE admin_id = :id";
	$statement2 = $connection->prepare($query2);
	$statement2->execute(array(':id'=> $admin_id));
	$result2 = $statement2->fetchAll()
	foreach($result2 as $row){
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
	}*/

	$sub_array = array();
	//$sub_array[] = implode($names);
	$sub_array[] = convert_string('decrypt',$admin_id);
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
