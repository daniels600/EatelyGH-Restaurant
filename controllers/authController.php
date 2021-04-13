<?php 

session_start();
 
// Include config file
include_once ("../config/db_conn.php");

class authController{

    public function Login($post){

        //creating an instance of db_connection 
        $db = new DB_connection();

        $admin_email = $db->connect()->real_escape_string($_POST['admin_email']);
        $admin_password = $db->connect()->real_escape_string($_POST['admin_password']);

        //Kindly uncomment for PHPUnit Testing of the Login
        //$admin_email = 'admin@gov.com';
        //$admin_password = 'password123';

        //Validating login if not empty and email is correct 
        if(!empty($admin_email) && !empty($admin_password) && !filter_var($admin_email, FILTER_VALIDATE_EMAIL)){
            return false;

        }
        else{

            // Prepare a select statement
            $sql = "SELECT restaurant_id, restaurant_email, restaurant_password FROM Restaurants WHERE restaurant_email ='$admin_email'";
                
            //Executing the query 
            $result =  $db->connect()->query($sql);

            if($result === false){
                //end connection
                die(mysqli_error($db->connect()));
            } 

            else{


                //Checking if query brought a result or affected a row
                if(mysqli_num_rows($result) == 0){
                    return false;
                } else {
                    $row = $result->fetch_array();
                    
                    //creating variables for the fields from the DB
                    $id =  $row[0];
                    $password = $row[2];

                    //checking admin email and verifying the password
                    if(($row[1] == $admin_email) && password_verify($admin_password,$password)){
                        
                        // Creating a Session for the Admin
                        $_SESSION['restaurant_id'] = $row[0];
                        $_SESSION['admin_email'] = $row[1];

                        return true;

                    } else {
                        //error message
                        return false;
                    }
                }
                
                } 
            }
       
    }
        
}


//Logout Admin and destroy all sessions 
if(isset($_GET['logout'])){
    session_destroy();

    unset($_SESSION['admin_id']);
    unset($_SESSION['admin_email']);
    
    //redirect admin to the login page
    header('Location: ../index.php');
    // exit();
} 






?>