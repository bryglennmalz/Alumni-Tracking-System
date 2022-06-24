<?php

$username = 'root';
$password = '';
$connection = new PDO( 'mysql:host=127.0.0.1;dbname=atis', $username, $password );


try{
	$connection = new PDO('mysql:host=127.0.0.1;dbname=atis; charset-utf-8','root','');
} catch(PDOExemption $ex){
	echo $ex->getMessage();
	exit();
}
?>