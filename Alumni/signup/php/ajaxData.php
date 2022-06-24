<?php
//Include database configuration file
include('dbConfig.php');

if(isset($_POST["country_id"]) && !empty($_POST["country_id"])){
    //Get all state data
    $query = $db->query("SELECT * FROM address_province WHERE c_id = ".$_POST['country_id']." ORDER BY ps_name ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display states list
    if($rowCount > 0){
        echo '<option value="">Select state</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['ps_id'].'">'.$row['ps_name'].'</option>';
        }
    }else{
        echo '<option value="">State not available</option>';
    }
}

if(isset($_POST["state_id"]) && !empty($_POST["state_id"])){
    //Get all city data
    $query = $db->query("SELECT * FROM address_city_mun WHERE ps_id = ".$_POST['state_id']." ORDER BY cm_name ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display cities list
    if($rowCount > 0){
        echo '<option value="">Select city</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['cm_id'].'">'.$row['cm_name'].'</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }
}
?>