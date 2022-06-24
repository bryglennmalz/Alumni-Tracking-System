   <?php  
 //fetch.php  
 ob_start();
	session_start();
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
 
 $connect = mysqli_connect("localhost", "root", "", "alumnitracking");  
 
 if(isset($_POST["cmuedid"]))  
 {  
	$loggedin = Login::isloggedin();
      $query = "SELECT * FROM educations WHERE educ_id = '".$_POST["cmuedid"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 } 


 if(isset($_POST["edid"]))  
 {  
	$loggedin = Login::isloggedin();
      $query = "SELECT * FROM educations WHERE educ_id = '".$_POST["edid"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }   
 ?>