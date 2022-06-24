<?php
	
	if (isset($_POST['Forgotpword'])){
		
		$email = $_POST['email'];
		
		$cstrong = True;
		$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
		
		
		$adminid = DB::query('SELECT admin_id FROM admin WHERE email = :email', array(':email' => $email))[0]['id']);
		DB::query('INSERT INTO admin_passtokens VALUES (\'\', :token, :admin_id)', array(':token' =>sha1($token),':admin_id' => $aadminid));
	}
	

?>