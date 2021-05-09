<?php

session_start();

include "../config/db_conn.php";



// POST Data
$data['table_id'] = $_POST['table_id'];
$data['status'] = $_POST['status'];



//die($data['table_id']);


$table_id = $data['table_id'];

$status = $data['status'];

$db = new DB_connection();


//$occupied = 'Occupied';

$sql = "UPDATE tables SET table_status = '$status'  WHERE table_id = '$table_id'";


//Executing the query 
$result =  $db->connect()->query($sql);

if($result){
    $message['status'] = "success";
    $message['table_id'] = $table_id;
    $message['table_status'] = $status;
}



echo json_encode($message);
//exit;


// if(isset($_GET['table_id'])){
//     $table_id = $_GET['table_id'];

//     $db = new DB_connection();


//      //Getting all the post or submitted input values
//     //  $tableName =$db->connect()->real_escape_string($_POST['tableNum']);
//     //  $tableCap = $db->connect()->real_escape_string($_POST['tableCap']);

//      $restaurant_id = $_SESSION['restaurant_id'];
    
//      $occupied = 'Occupied';

//      $sql = "UPDATE tables SET table_status = '$occupied'  WHERE table_id = '$table_id'";


//     //Executing the query 
//     $result =  $db->connect()->query($sql);


// }


// if(isset($_GET['value'])){
//     $table_id = $_GET['table_id'];

//     //$table_id = $_GET['value'];

//     $db = new DB_connection();

//     $restaurant_id = $_SESSION['restaurant_id'];
    

//     $available = "Available";


//     $sql2 = "UPDATE tables SET table_status = '$available'  WHERE table_id = '$table_id'";

//     $result2 =  $db->connect()->query($sql2);

//     // if($result2){
//     //     header('Location: ../views/add_table_form.php?message=success');
//     // }
            
//     // else{
//     //     // printf($result);
//     //     // die();
//     //     header('Location: ../views/add_table_form.php?message=error');
//     // } 

// }


?>