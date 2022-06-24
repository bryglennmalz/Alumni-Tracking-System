<?php
date_default_timezone_set("Asia/Hong_Kong");
class DB{
	
	private static function connect(){
			$connection = new PDO('mysql:host=127.0.0.1;dbname=alumnet; charset-utf-8','root','');
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $connection;
	}
	
	public static function query($query,$params=array()){
		$statement = self::connect()->prepare($query);
		$statement->execute($params);
		
		if (explode(' ', $query)[0] == 'SELECT'){
			$data = $statement->fetchAll();
			return $data;
		}
	}
	
}

	try{
		$pdoConnect = new PDO('mysql:host=127.0.0.1;dbname=alumnet; charset-utf-8','root','');
	} catch(PDOExemption $ex){
		echo $ex->getMessage();
		exit();
	}


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