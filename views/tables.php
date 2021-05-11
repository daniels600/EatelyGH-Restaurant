<?php

session_start();

include "../config/db_conn.php";

$id = $_SESSION['restaurant_id'];

$email = $_SESSION['admin_email'];

if (isset($id)) {
    //creating an instance of db_connection 
    $db = new DB_connection();


    // $restaurant_id = isset($_SESSION['admin_id'])? $_SESSION['admin_id'] : "";

    $restaurant = "SELECT * FROM Restaurants WHERE restaurant_id='$id'";

    $tables = "SELECT * FROM tables WHERE restaurant_id='$id'";

    $result = $db->connect()->query($restaurant);

    $table_result = $db->connect()->query($tables);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
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
                                <a class="nav-link" href="restaurant.php">Menu List</a>
                                <a class="nav-link" href="tables.php">Tables</a>
                                <a class="nav-link" href="orders.php">Orders</a>
                                <a class="nav-link" href="reservation.php">Reservations</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as: <?php echo $email; ?></div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>

                <div class="container-fluid">
                    <!-- <div class="alert alert-success alert-dismissible fade show" id="wlcm-alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Welcome! <?php echo $restaurant_name; ?> </strong> Kindly add a meal to your Menu
                    </div> -->
                    <h1 class="mt-4">Tables/Seats</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active" style="font-weight: 800; font-size: 30px"><?php echo $restaurant_name; ?></li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Tables / Seats
                            <button class="btn btn-primary" style="float:right; margin-right:auto" onclick="document.location=`add_table_form.php?restaurant_id=${<?php echo $restaurant_id; ?>}`"><i class="fas fa-plus"></i> Add</button>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="./../actions/update_Table.php" method="post">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-toggle="table" data-show-toggle="true" data-toolbar="#toolbar" data-show-fullscreen="true" data-pagination-pre-text="Previous">

                                        <thead>
                                            <tr>
                                                <th>Table #</th>
                                                <th>Capacity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php

                                            if (mysqli_num_rows($table_result) > 0) :
                                                while ($row = mysqli_fetch_array($table_result)) {
                                                    //$image = base64_encode($row['meal_image']);
                                                    $status = $row["table_status"];

                                                    $check  = ($status == "Occupied")? "checked" : "";
                                            ?><?php
                                                    echo '
                                                
                                                <tr>
                                                        <td>' . $row['table_name'] . '</td>
                                                        <td>' . $row['capacity'] . '</td>
                                                        <td>' . '<label class="switch">
                                                        <input type="checkbox" class="table_avail" data-id=' . $row["table_id"] . ' value='. $row["table_status"] .' '.$check.' '.'>
                                                        <span class="slider round"></span>
                                                        </label>' . '</td>
                                                    
                                                </tr>
                                               
                                              
                                                ';

                                            ?><?php }
                                            endif; ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
            <form><input type="hidden" value=<?php echo $id; ?>></form>
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
    <?php if (isset($_GET['message'])) : ?>
        <div class='flash-data' data-flashdata="<? $_GET['message']; ?>"></div>
    <?php endif; ?>
    <?php if (isset($_GET['edit'])) : ?>
        <div class='flash-edit' data-flashedit="<? $_GET['edit']; ?>"></div>
    <?php endif; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/datatables-demo.js"></script>
    <script>
        //checking if the delete button is click and display message 
        $(".btn-danger").on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }

            })
        })
        //showing message after a delete success
        const flashdata = $('.flash-data').data('flashdata');

        const flashedit = $('.flash-edit').data('flashedit');


        if (flashdata) {
            Swal.fire({
                icon: 'success',
                type: 'success',
                title: 'Deleted successfully',
                text: 'Meal record deleted!',

            }).then(function() {
                window.location.href = `restaurant.php?id=${<?php echo $id; ?>}`;
            });
        }

        if (flashedit) {
            Swal.fire({
                icon: 'success',
                title: 'Meal Updated successfully',
                allowOutsideClick: true,
                type: "success"
            }).then(function() {
                window.location.href = `restaurant.php?id=${<?php echo $id; ?>}`;
            });
        }


        $(document).ready(function() {
            $('input[type="checkbox"]').click(function() {
                var table_id = $(this).data('id');

                if ($(this).prop("checked") == true) {

                    console.log("Checkbox is checked.");

                    var table_id = $(this).data('id');

                    console.log('Table id', $(this).data('id'));

                    $.ajax({
                        type: "POST",
                        url: './../actions/update_Table.php',
                        data: {
                            table_id: table_id,
                            status: 'Occupied'
                        },


                    }).done(function(data) {
                        data = JSON.parse(data);
                        console.log(data);

                        $('input[type="checkbox"]').val('Occupied');

                        localStorage.setItem(data['table_id'], JSON.stringify(data));

                        console.log($('input[type="checkbox"]').val());


                    });

                } else if ($(this).prop("checked") == false) {

                    console.log("Checkbox is unchecked.");

                    var table_id = $(this).data('id');

                    console.log('Table id', $(this).data('id'));

                    $.ajax({
                        type: "POST",
                        url: './../actions/update_Table.php',
                        data: {
                            table_id: table_id,
                            status: 'Available'
                        },


                    }).done(function(data) {
                        data = JSON.parse(data);
                        console.log(data);

                        $('input[type="checkbox"]').val('Available');

                        localStorage.setItem(data['table_id'], JSON.stringify(data))

                        console.log($('input[type="checkbox"]').val());

                    });

                }

            });

        });



        $(document).ready(function() {

            // var MyRows = $('table#dataTable').find('tbody').find('tr');

            // for (var i = 0; i < MyRows.length; i++) {
            //     var MyIndexValue = $(MyRows[i]).find('td:eq(2)').html();

            //     var Value = $(MyRows[i]).find('td:eq(2)').html();

            //     var n = $('MyIndexValue').find('input[type="checkbox"]').val();
            //     console.log(n);
            // }

            $('tbody tr').each(function(index, value) {
                //var checkVal = $(this).find(".table_avail").val(); 
                var checkVal = $('.table_avail').val();
                var id = $(this).data('id');

                // var MyRows = $('table#htmlTable').find('tbody').find('tr');

                // for (var i = 0; i < MyRows.length; i++) {
                //     var MyIndexValue = $(MyRows[i]).find('td:eq(0)').html();
                //     console.log(MyIndexValue);
                // }

                //console.log("row"+index+" : "+rowValues);


                //console.log(checkVal, id);
                if (checkVal == 'Occupied') {
                    var val = $('input[type="checkbox"]').data('id');
                    //console.log(val);
                    //$('#'.val).prop('checked', true);
                } else {
                    //var val = $(this).data('id'); 
                    var val = $('input[type="checkbox"]').data('id');
                    //console.log(val);
                    //$('.table_avail').prop('checked', false);
                }
            });

            function doShowAll() {

                console.log('I am working ');

                var key = "";
                var i = 0;

                var tblBody = $('table tbody');

                let arr = JSON.parse(localStorage.getItem('addedIds'));

                for (i = 0; i < arr.length; i++) {

                    n = localStorage.getItem(arr[i]);
                    n = JSON.parse(n);

                    var row = `<tr data-rowId= ${arr[i]}><td><div class='product-item'><a class='product-thumb' href='#''> <img width='100%' src='thumb.php?src=${n.image}&q=50&w=750&h=972' alt='Product'></a> <div class="product-info"><h4 class="product-title"><a href="#"> ${n.name} </a></h4><span><em>Size:</em> 10.5</span><span><em>Color:</em> Dark Blue</span></div> </div></td> <form action="{{route('cart.update', '')}}" id='cart-form'> <td class="text-center"> <div class="count-input">
    <input type="number" class="form-control" min="1" name="quantity" id="quantity" value=${n.quantity} data-id= ${arr[i]}></div> <td class="text-center text-lg text-medium"><span id=${arr[i]}><span>&#8373;</span> ${n.item_cost}</span></td> <input type="hidden" class="form-control" id="item_id"  name='item_id' 
    value=${arr[i]}> </form> </td> <td class="text-center"> <a class="remove-from-cart" href="{{route('cart.destroy', '')}}" data-toggle="tooltip" name="remove_item" data-original-title="Remove item" data-id= ${arr[i]}><i class="fa fa-trash"></i></a></td></tr>`;

                    tblBody.append(row);


                }


            }


        });
    </script>
</body>

</html>