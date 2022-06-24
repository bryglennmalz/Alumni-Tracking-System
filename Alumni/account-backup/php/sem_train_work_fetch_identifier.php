   <?php  
 //fetch.php  
 ob_start();
	session_start();
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
 
 $connect = mysqli_connect("localhost", "root", "", "alumnitracking");  
 
 if(isset($_POST["stwid"]))  
 {  
	$loggedin = Login::isloggedin();
      $query = "SELECT * FROM affiliation_sem_train_workshop WHERE stw_id = '".$_POST["stwid"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>