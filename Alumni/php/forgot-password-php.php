<?php
	
	if (isset($_POST['Forgotpword'])){
		
		$email = $_POST['email'];
		
		$cstrong = True;
		$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
		
		
		$alumniid = DB::query('SELECT id FROM alumni.alumni WHERE email = :email', array(':email' => $email))[0]['id']);
		DB::query('INSERT INTO passwordtokens VALUES (\'\', :token, :alumniid)', array(':token' =>sha1($token),':alumniid' => $alumniid));
	}
	

?>