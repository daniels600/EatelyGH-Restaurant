<?php
session_start();

include "../config/db_conn.php";
//creating an instance of db_connection 
$db = new DB_connection();


if(isset($_GET['id'])){
    $menu_id = $_GET['id'];

    $restaurant_id = $_SESSION['restaurant_id'];

    $sql = "DELETE FROM menu WHERE menu_id= '$menu_id'";

    $deleteMeal = $db->connect()->query($sql);

    if($deleteMeal){
        header('Location: ../views/restaurant.php?message=success&id='.$restaurant_id);
    }

}