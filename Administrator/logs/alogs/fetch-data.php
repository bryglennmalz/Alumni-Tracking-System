<?php
	//fetch_data.php
	$connect = new PDO("mysql:host=localhost;dbname=atis", "root", "");

	$method = $_SERVER['REQUEST_METHOD'];

	if($method == 'GET'){
		$data = array(
						':log_type_id'   => "%" . $_GET['Log Time'] . "%",
						':date_time'   => "%" . $_GET['Date Time'] . "%",
						':admin_id'     => "%" . $_GET['Admin'] . "%"
				);
		$query = "SELECT * FROM adminlogs WHERE log_type_id LIKE :log_type_id AND date_time LIKE :date_time AND admin_id LIKE :admin_id ORDER BY id DESC";

		$statement = $connect->prepare($query);
		$statement->execute($data);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output[] = array(
								'id'    => $row['id'],   
								'Description'  => $row['description'],
								'Log Type'   => $row['log_type_id'],
								'Date Time'    => $row['date_time'],
								'Admin'   => $row['admin_id']
			);
		}
		header("Content-Type: application/json");
		echo json_encode($output);
	}

	/*if($method == "POST"){
		$data = array(
						':first_name'  => $_POST['first_name'],
						':last_name'  => $_POST["last_name"],
						':age'    => $_POST["age"],
						':gender'   => $_POST["gender"]
		);

		$query = "INSERT INTO sample_data (first_name, last_name, age, gender) VALUES (:first_name, :last_name, :age, :gender)";
		$statement = $connect->prepare($query);
		$statement->execute($data);
	}*/

	/*if($method == 'PUT'){
		parse_str(file_get_contents("php://input"), $_PUT);
		$data = array(
						':id'   => $_PUT['id'],
						':first_name' => $_PUT['first_name'],
						':last_name' => $_PUT['last_name'],
						':age'   => $_PUT['age'],
						':gender'  => $_PUT['gender']
		);
		
		$query = "
					UPDATE sample_data 
					SET first_name = :first_name, 
					last_name = :last_name, 
					age = :age, 
					gender = :gender 
					WHERE id = :id
				";
		$statement = $connect->prepare($query);
		$statement->execute($data);
	}*/

	/*if($method == "DELETE"){
		parse_str(file_get_contents("php://input"), $_DELETE);
		$query = "DELETE FROM sample_data WHERE id = '".$_DELETE["id"]."'";
		$statement = $connect->prepare($query);
		$statement->execute();
	}*/

?>