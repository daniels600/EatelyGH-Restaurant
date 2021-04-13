<?php
session_start();


include "../config/db_conn.php";
//creating an instance of db_connection 
$db = new DB_connection();

$id = $_SESSION['restaurant_id'];

if(isset($_POST['update'])){
    $menu_id =$db->connect()->real_escape_string($_POST['menu_id']);
    $mealName =$db->connect()->real_escape_string($_POST['mealName']);
    $mealPrice = $db->connect()->real_escape_string($_POST['mealPrice']);
   

    $sql = "UPDATE menu set meal_name='$mealName', meal_price='$mealPrice' where menu_id=$menu_id";

    $updateMeal = $db->connect()->query($sql);

    if($updateMeal){
        header('Location: ../views/restaurant.php?edit=success&id='.$id);
    }else{
        //header('Location: restaurant_menu.php');
        echo $updateMeal;
        exit;
    }
}