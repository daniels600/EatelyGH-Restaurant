<?php

session_start();

include "../config/db_conn.php";

$id = $_SESSION['restaurant_id'];

if(isset($id) ){
    //creating an instance of db_connection 
    $db = new DB_connection();


    // $restaurant_id = isset($_SESSION['admin_id'])? $_SESSION['admin_id'] : "";

    $restaurant = "SELECT * FROM Restaurants WHERE restaurant_id='$id'";

    $menu = "SELECT * FROM menu WHERE restaurant_id='$id'";

    $result = $db->connect()->query($restaurant);

    $menu_result = $db->connect()->query($menu);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){ 
            $restaurant_name = $row['restaurant_name'];
            $restaurant_loc = $row['restaurant_address'];
            $restaurant_email = $row['restaurant_email'];
            $restaurant_openTime = $row['restaurant_opening_time'];
            $restaurant_closeTime = $row['restaurant_closing_time'];
            $restaurant_des = $row['restaurant_description'];
            $restaurant_id = $row['restaurant_id'];


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
    <title>Eately GH</title>
    <link rel="icon" href="./assets/images/imageedit_28_3939584200.png" type="image/png">
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link href="../assets/css/parsley.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="restaurant.php" style="font-weight: 600;">Eately GH</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <!-- <a class="dropdown-item" href="./views/settings.php">Settings</a> -->
                    <!-- <a class="dropdown-item" href="./views/password.php">Reset Password</a> -->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="password.php">Reset password</a>
                    <a class="dropdown-item" href="../index.php?logout=yes">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="restaurant.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Management
                            <!-- <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div> -->
                        </a>
                        <div>
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="orders.php">Orders</a>
                                <a class="nav-link" href="reservation.php">Reservations</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as: </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active" style="font-weight: 800; font-size: 30px"><?php echo $restaurant_name; ?></li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Menu
                            <button class="btn btn-primary" style="float:right; margin-right:auto" onclick="document.location=`add_meal_form.php?restaurant_id=${<?php echo $restaurant_id; ?>}`"><i class="fas fa-plus"></i> Add</button>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-toggle ="table" data-show-toggle="true" data-toolbar="#toolbar" data-show-fullscreen="true" data-pagination-pre-text="Previous">
                                    
                                    <thead>
                                        <tr>
                                            <th>Meal Image</th>
                                            <th>Meal Name</th>
                                            <th>Meal Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                            
                                    <tbody>
                                    <?php
                                        
                                        if(mysqli_num_rows($menu_result) > 0):
                                            while($row = mysqli_fetch_array($menu_result)){ 
                                                $image = base64_encode($row['meal_image']);
                                        ?><?php
                                                echo'
                                                <tr>
                                                    <td>'.'<img src=data:image/jpg;charset=utf8;base64,'."$image".' alt="" height=100 width=100></img>'.'</td>
                                                    <td>'.$row['meal_name'].'</td>
                                                    <td>'.'GH₵ '.$row['meal_price'].'.00'.'</td>
                                                    <td>'.'<a class="btn btn-success" href="update_meal_form.php?edit=yes&id='.$row['menu_id'].'" role="button"><i class="fas fa-edit"></i></a><span>  </span><a class="btn btn-danger" href="../actions/delete_meal.php?id='.$row['menu_id'].'" role="button"><i class="fas fa-trash-alt"></i></a>'.'</td>
                                                </tr>
                                              
                                                ';
                                        
                                                ?><?php } endif;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
            <form><input type="hidden" value= <?php echo $id; ?>></form>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Eately GH 2021</div>
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
    <?php if(isset($_GET['message'])) : ?>
        <div class='flash-data' data-flashdata="<? $_GET['message'];?>"></div>
    <?php endif; ?>
    <?php if(isset($_GET['edit'])) : ?>
        <div class='flash-edit' data-flashedit="<? $_GET['edit'];?>"></div>
    <?php endif; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../assets/js/datatables-demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script>
     //checking if the delete button is click and display message 
     $(".btn-danger").on('click', function(e){
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({
                icon:'warning',
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if(result.value){
                        document.location.href = href;
                    }
                    
                })
        })
        //showing message after a delete success
        const flashdata = $('.flash-data').data('flashdata');

        const flashedit = $('.flash-edit').data('flashedit');

        
        if(flashdata) {
            Swal.fire({
                icon:'success',
                type: 'success',
                title: 'Deleted successfully',
                text: 'Meal record deleted!',
                    
            }).then(function () {
                window.location.href = `restaurant.php?id=${<?php echo $id; ?>}`;
            });
        }

        if(flashedit) {
            Swal.fire({
                icon: 'success',
                title: 'Meal Updated successfully',
                allowOutsideClick: true,                  
                type: "success" 
            }).then(function () {
                window.location.href = `restaurant.php?id=${<?php echo $id; ?>}`;
            });
        }


    </script>
</body>

</html>

