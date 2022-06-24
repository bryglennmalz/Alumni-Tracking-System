<?php

/*function upload_image()
{
	if(isset($_FILES["user_image"]))
	{
		$extension = explode('.', $_FILES['user_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = './upload/' . $new_name;
		move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
		return $new_name;
	}
}

function get_image_name($user_id)
{
	include('db.php');
	$statement = $connection->prepare("SELECT image FROM alumni.alumni WHERE id = '$user_id'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["image"];
	}
}*/

function get_total_all_records()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM admin");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

function convert_string($action, $string)
{
 $output = '';
 $encrypt_method = "AES-256-CBC";
    $secret_key = 'eaiYYkYTysia2lnHiw0N0vx7t7a3kEJVLfbTKoQIx5o=';
    $secret_iv = 'eaiYYkYTysia2lnHiw0N0';
    // hash
    $key = hash('sha256', $secret_key);
 $initialization_vector = substr(hash('sha256', $secret_iv), 0, 16);
 if($string != '')
 {
  if($action == 'encrypt')
  {
   $output = openssl_encrypt($string, $encrypt_method, $key, 0, $initialization_vector);
   $output = base64_encode($output);
  } 
  if($action == 'decrypt') 
  {
   $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $initialization_vector);
  }
 }
 return $output;
}

?>