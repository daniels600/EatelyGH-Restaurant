<?php


include "../config/db_conn.php";

session_start();




if(isset($_POST['submit'])){
    $db = new DB_connection();

     //Getting all the post or submitted input values
     $mealName =$db->connect()->real_escape_string($_POST['mealName']);
     $mealPrice = $db->connect()->real_escape_string($_POST['mealPrice']);

     $restaurant_id = $_SESSION['restaurant_id'];

     if(!empty($_FILES['image']['name'])){
        $image_name = basename($_FILES['image']['name']);
        $image_type = $_FILES['image']['type'];

        $allowed = array("image/jpeg", "image/gif", "image/png", "image/jpg");

        if (in_array($image_type, $allowed)) {
            $image = $_FILES['image']['tmp_name'];
            $data  = addslashes(file_get_contents($image));

            $sql = "INSERT INTO menu(restaurant_id, meal_name, meal_price, meal_image, meal_type) 
                    VALUES ('$restaurant_id','$mealName','$mealPrice', '$data','$image_type')";

            //Executing the query 
            $result =  $db->connect()->query($sql);

            // echo(`Here I am too`);
            // die();

            if($result){

                header('Location: ../views/add_meal_form.php?message=success');
            }
            
        }else{

            

            header('Location: ../views/add_meal_form.php?message=error');
        } 
     }else{
         header('Location: ./views/add_meal_form.php?message=error');
     }


}


?>