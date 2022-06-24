   <?php  
 //fetch.php  
 ob_start();
	session_start();
	
	require '../../php/myconnection.php';
	require '../../php/home-php.php';
 
 $connect = mysqli_connect("localhost", "root", "", "alumnitracking");  
 
 if(isset($_POST["surveyid"]))  
 {  
	$loggedin = Login::isloggedin();
      $query = "SELECT * FROM survey WHERE survey_id = '".$_POST["surveyid"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }   
 ?>