<?php

session_start();

include "../config/db_conn.php";

//checking for an error in the url to this page
if (isset($_GET['error'])) {
    $err_msg = "Password reset unsuccessful!";
}

$message = array();

// if (isset($_POST['submit'])) {
    
// }

$db = new DB_connection();

    $restaurant_email = $db->connect()->real_escape_string($_POST['Email']);
    $restaurant_password = $db->connect()->real_escape_string($_POST['Password']);
    $restaurant_password = $db->connect()->real_escape_string($_POST['confirm_password']);
    $resName = $db->connect()->real_escape_string($_POST['res_name']);
    $reslat = $db->connect()->real_escape_string($_POST['res_lat']);
    $reslong = $db->connect()->real_escape_string($_POST['res_long']);
    $resTel = $db->connect()->real_escape_string($_POST['res_tel']);
    $resLoc = $db->connect()->real_escape_string($_POST['res_location']);
    $resOpenTime = $db->connect()->real_escape_string($_POST['openingTime']);
    $resCloseTime = $db->connect()->real_escape_string($_POST['closingTime']);
    $resDescription = $db->connect()->real_escape_string($_POST['res_description']);


    $restaurant_password = password_hash($restaurant_password, PASSWORD_DEFAULT);

    
    // Prepare a select statement
    $sql = "INSERT INTO Restaurants(restaurant_email, restaurant_password, restaurant_address,restaurant_latitude, restaurant_longitude, restaurant_name, restaurant_telephone, restaurant_opening_time, restaurant_closing_time, restaurant_description) 
    VALUES (?,?,?,?,?,?,?,?,?,?)";

    $stmt = $db->connect()->prepare($sql);

    $stmt->bind_param('ssssssssss', $restaurant_email,$restaurant_password,$resLoc, $reslat, $reslong, $resName,$resTel,$resOpenTime,$resCloseTime,$resDescription);

    //checking the execution of the query statement
    if ($stmt->execute()) {
        //header("Location: ../views/signup.php?message=success");

        $message['msg'] = "New restaurant added";
        $message['status'] = true;
    } else {
        $message['msg'] = "New restaurant not added";
        $message['status'] = false;
    }



echo json_encode($message);


?>
