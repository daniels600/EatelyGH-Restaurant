<?php

// Include config file
include "../config/db_conn.php";

//creating an instance of db_connection 
$db = new DB_connection();
 
 
// Processing form data when form is submitted
if(isset($_POST['submit'])){
 
    $admin_mail = $db->connect()->real_escape_string($_POST['email']);
    $new_password = $db->connect()->real_escape_string($_POST['new_password']);
    
    //a query to get the record of an admin with the specified email
    $sql =  "SELECT * from Restaurants WHERE restaurant_email = '$admin_mail'";

    $results = $db->connect()->query($sql);
    

    
    if (mysqli_num_rows($results) > 0 && $results) {
        $row = $results->fetch_assoc();
        $password = $row['restaurant_password'];

        // Check input errors before updating the database
        if ( $row['restaurant_email'] == $admin_mail) {
            
            //hash new password 
            $new_password = password_hash($new_password,PASSWORD_DEFAULT);

            // Prepare an update statement to update the password of the admin
            $sql_up = "UPDATE Restaurants SET restaurant_password = '$new_password' WHERE restaurant_email = '$admin_mail'";

            $updatePass = $db->connect()->query($sql_up);

            //checking if the update was successful
            if (isset($updatePass)) {
                header('Location: ../views/password.php?reset=success');
            } else {
                header('Location: ../views/password.php?error=resetfailed');
            }

        } else{
            header('Location: ../views/password.php?error=resetfailed');
        }
    } else {
        header('Location: ../views/password.php?error=resetfailed');
    }

    // Close connection
    $db->connect()->close();
}
?>
 