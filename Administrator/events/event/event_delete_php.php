<?php
	ob_start();
	session_start();
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	
	$connect = mysqli_connect("localhost", "root", "", "alumnitracking");  
	
	if (isset($_POST['eventid'])){
		
				$cntvoteeach =("SELECT event_vote.id FROM event_vote WHERE event_vote.event_id = :id");
		
				$pdo_cntVoteEach_Res = $pdoConnect ->prepare($cntvoteeach);
				$pdoExec = $pdo_cntVoteEach_Res -> execute(array(':id'=>$_POST['eventid']));
				$pdo_poll_each_likes = $pdo_cntVoteEach_Res->rowCount();
				
				if($pdo_poll_each_likes != 0){
					DB::query("DELETE FROM alumnitracking.event_vote WHERE event_id = :id",
					array(":id"=>$_POST['eventid']));
				}
				
		DB::query("DELETE FROM alumnitracking.events WHERE event_id = :id",
				array(":id"=>$_POST['eventid']));
		
		header("location:cmu-events.php");
		
		echo"This event has successfully removed from the database!";
	}
?>