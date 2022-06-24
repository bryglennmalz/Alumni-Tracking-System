   <?php  
 //fetch.php  
 ob_start();
	session_start();
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
 
 $connect = mysqli_connect("localhost", "root", "", "alumnet");  
 
 if(isset($_POST["postid"]))  
 {  
	$loggedin = Login::isloggedin();
      $query = "SELECT * FROM forum_poll WHERE post_id = '".$_POST["postid"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>