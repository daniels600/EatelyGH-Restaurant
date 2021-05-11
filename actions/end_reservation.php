<?php

session_start();

include "../config/db_conn.php";


if(isset($_GET['id'])){

    $db = new DB_connection();

    
    $id  = $_GET['id'];

    $ended = "Ended";

    $sql = "UPDATE Reservation SET reservation_status = '$ended'  WHERE reservation_id = '$id'";


    //Executing the query 
    $result =  $db->connect()->query($sql);

    if($result){
        // $message['status'] = "success";
        // $message['table_id'] = $table_id;
        // $message['table_status'] = $status;

        header('Location: ../views/reservation.php?message=success');
    }

}


?>