<?php
	
class Login{
		
	function isloggedin(){
		
		if (isset($_COOKIE['SNID'])){
			if (DB::query('SELECT alumni_id FROM alumni_logintokens WHERE token=:token', array(':token' => sha1($_COOKIE['SNID'])))){
				
				$user_id = DB::query('SELECT alumni_id FROM alumni_logintokens WHERE token=:token',array(':token' => sha1($_COOKIE['SNID'])))[0]['alumni_id'];
				
				if (isset($_COOKIE['SNID_'])){
					return $user_id;
				}
				else{
					$cstrong = True;
					$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
					
					DB::query('INSERT INTO alumni_logintokens VALUES (\'\', :token, :alumniid)', array(':token' => sha1($token),':alumniid' => $user_id));
					DB::query('DELETE FROM alumni_logintokens WHERE token = :token', array(':token' =>sha1($_COOKIE['SNID'])));
				
					//validity  of token
					setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
					setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
					
					return $user_id;
				}
			}
		}
		return false;
	}
	
}
?>