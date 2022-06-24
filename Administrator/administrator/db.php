<?php

$username = 'root';
$password = '';
$connection = new PDO( 'mysql:host=127.0.0.1;dbname=alumnet', $username, $password );


try{
	$connection = new PDO('mysql:host=127.0.0.1;dbname=alumnet; charset-utf-8','root','');
} catch(PDOExemption $ex){
	echo $ex->getMessage();
	exit();
}
?>