<?php
	
class Login{
		
	function isloggedin(){
		
		if (isset($_COOKIE['SNID_ADMIN'])){
			if (DB::query('SELECT admin_id FROM admin_logintokens WHERE token=:token', array(':token' => sha1($_COOKIE['SNID_ADMIN'])))){
				
				$user_id = DB::query('SELECT admin_id FROM admin_logintokens WHERE token=:token',array(':token' => sha1($_COOKIE['SNID_ADMIN'])))[0]['admin_id'];
				
				if (isset($_COOKIE['SNID_AD'])){
					return $user_id;
				}
				else{
					$cstrong = True;
					$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
					
					DB::query('INSERT INTO admin_logintokens VALUES (\'\', :token, :adminid)', array(':token' => sha1($token),':adminid' => $user_id));
					DB::query('DELETE FROM admin_logintokens WHERE token = :token', array(':token' =>sha1($_COOKIE['SNID_ADMIN'])));
				
					//validity  of token
					setcookie("SNID_ADMIN", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
					setcookie("SNID_AD", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
					
					return $user_id;
				}
			}
		}
		return false;
	}
	
}
?>