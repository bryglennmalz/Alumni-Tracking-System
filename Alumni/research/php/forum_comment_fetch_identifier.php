   <?php  
 //fetch.php  
 ob_start();
	session_start();
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
 
 $connect = mysqli_connect("localhost", "root", "", "alumnitracking");  
 
 if(isset($_POST["forumcid"]))  
 {  
	$loggedin = Login::isloggedin();
      $query = "SELECT * FROM alumnitracking.forum_comment WHERE f_comment_id = '".$_POST["forumcid"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>