<?php

session_start();

include "../config/db_conn.php";


if(isset($_POST['submit'])){
    $db = new DB_connection();


     //Getting all the post or submitted input values
     $tableName =$db->connect()->real_escape_string($_POST['tableNum']);
     $tableCap = $db->connect()->real_escape_string($_POST['tableCap']);

     $restaurant_id = $_SESSION['restaurant_id'];

     $sql = "INSERT INTO `tables`(`table_name`, `restaurant_id`, `capacity`, `table_status`) 
                    VALUES ('$tableName', '$restaurant_id', '$tableCap', 'Available')";

    //Executing the query 
    $result =  $db->connect()->query($sql);

    if($result){
        header('Location: ../views/add_table_form.php?message=success');
    }
            
    else{
        // printf($result);
        // die();
        header('Location: ../views/add_table_form.php?message=error');
    } 


}


?>