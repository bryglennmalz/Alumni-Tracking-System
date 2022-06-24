<?php
	ob_start();
	session_start();
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
	
	$connect = mysqli_connect("localhost", "root", "", "alumnitracking");  
	
	if (isset($_POST['forumcid'])){
		
		DB::query("DELETE FROM alumnitracking.forum_comment WHERE f_comment_id = :id",
				array(":id"=>$_POST['forumcid']));
		
		
		
		header("location:forum-corner.php");
		echo "This post has been deleted.";
	}
?>