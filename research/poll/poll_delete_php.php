<?php
	ob_start();
	session_start();
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	
	$connect = mysqli_connect("localhost", "root", "", "alumnitracking");  
	
	if (isset($_POST['pollid'])){
		
		$queryx= DB::query('SELECT * FROM `poll_choices` WHERE `poll_id`=:id ',array(':id'=>$_POST['pollid']));
			foreach($queryx as $p){
				$choiceid = $p['id'];
				
				$cntvoteeach =("SELECT poll_votes.p_vote_id FROM poll_votes WHERE poll_votes.p_choices_id = :choices");
		
				$pdo_cntVoteEach_Res = $pdoConnect ->prepare($cntvoteeach);
				$pdoExec = $pdo_cntVoteEach_Res -> execute(array(':choices' => $choiceid));
				$pdo_poll_each_likes = $pdo_cntVoteEach_Res->rowCount();
				
				if($pdo_poll_each_likes != 0){
					DB::query("DELETE FROM alumnitracking.poll_votes WHERE p_choices_id = :choiceid",
					array(":choiceid"=>$choiceid));
				}
				
			}
			
		DB::query("DELETE FROM alumnitracking.`poll_choices` WHERE `poll_id` = :id",
				array(":id"=>$_POST['pollid']));
				
		DB::query("DELETE FROM alumnitracking.poll WHERE poll_id = :id",
				array(":id"=>$_POST['pollid']));
		
		header("location:../poll-corner.php");
	}
?>