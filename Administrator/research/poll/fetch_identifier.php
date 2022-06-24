   <?php  
 //fetch.php  
 ob_start();
	session_start();
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
 
 $connect = mysqli_connect("localhost", "root", "", "alumnitracking");  
 
 if(isset($_POST["poll_id"]))  
 {  
	$loggedin = Login::isloggedin();
      $query = "SELECT * FROM poll WHERE poll_id = '".$_POST["poll_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>