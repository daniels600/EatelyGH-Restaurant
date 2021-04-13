<?php

session_start();

include "../config/db_conn.php";
//creating an instance of db_connection 
$db = new DB_connection();

$menu_id= isset($_GET['id'])? $_GET['id'] : "";

// echo $menu_id;
// exit;

if(isset($menu_id)){
    //$menu_id= isset($_GET['id'])? $_GET['id'] : "";

    $menu = "SELECT * FROM menu where menu_id='$menu_id'";

    $selectMeal = $db->connect()->query($menu);
    if($selectMeal){
        if(mysqli_num_rows($selectMeal) > 0){

            while($row = mysqli_fetch_array($selectMeal)){
                $menu_id =$row['menu_id'];
                $mealName =$row['meal_name'];
                $mealPrice = $row['meal_price'];
                $image_name = base64_encode($row['meal_image']);
                
            }

        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Update Meal</title>
    <link rel="icon" href="../../assets/images/imageedit_28_3939584200.png" type="image/png">
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link href="../assets/css/parsley.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body class="bg-primary" style="background-color: #FFF5C0 !important;">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content" style="margin-bottom: 40px;">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Meal Details</h3>
                                </div>
                                <?php
                                //Showing a message if any and redirect to the Dashboard after 1.5 secs
                                if (isset($err_message)) {
                                    echo '<div class="alert alert-danger">' .
                                    '<li style="text-align:center">'.$err_message.'</li>'
                                    . '</div>';
                                }

                                ?>
                                <div class="card-body">
                                    <!-- Using parsley js to validate the form inputs -->
                                    <form action='../actions/update_meal.php' method='POST' enctype="multipart/form-data" data-parsley-validate>
                                        <div class="form-group">
                                            <label class="small mb-1">Meal name</label>
                                            <input class="form-control py-4"  type="text" placeholder="Enter meal name" data-parsley-required="true"  data-parsley-trigger="keyup" data-parsley-pattern="^[a-zA-Z ]+$"name='mealName' value="<?php echo isset($mealName)? $mealName : ""; ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="nationality">Meal Price</label>
                                            <input class="form-control py-4"  type="number" placeholder="Enter meal price" data-parsley-required="true"  data-parsley-trigger="keyup" data-parsley-pattern="^[0-9]+$"name='mealPrice' value="<?php echo isset($mealPrice)? $mealPrice : ""; ?>" />
                                        </div>
                                     
                                        <div class="form-group">
                                            <p><input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)" style="display: none;"></p>
                                            <p><label class="btn btn-primary"for="file" style="cursor: pointer;"> Meal Image</label></p>
                                            <p><img src=data:image/jpg;charset=utf8;base64,<?php echo $image_name; ?> id="output" width="200" name="image"/></p>
                                           
                                        </div>
                                        <input type='hidden' name='menu_id' value="<?php echo $menu_id  ?>" >
                                        <?php if(isset($_GET['error'])){if($_GET['error'] == 'wrongImage') {echo "Upload a *jpeg  *gif *png *jpg";}}?>
                                        <br />
                                        <button type="submit" name="update" class="btn btn-primary btn-lg btn-block" required>Update Meal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Team 10 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
     <!-- Getting the message from the insertion of prisoner record and creating a flash message -->
    <?php if(isset($_GET['message'])) : ?>
        <div class='flash-data' data-flashdata="<? $_GET['message'];?>"></div>
    <?php endif; ?>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
    // Using sweetalert to show an alert
    const flashdata = $('.flash-data').data('flashdata');

    

        if(flashdata) {
            Swal.fire({
                icon: 'success',
                title: 'Meal Updated successfully',
                allowOutsideClick: true,                  
                type: "success" 
            }).then(function () {
                window.location.href = 'restaurant.php';
            });
        }

        //Preview the inserted image 
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
</body>

</html>