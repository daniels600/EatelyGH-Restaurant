<?php

//checking for a reset in the url to this page
if (isset($_GET['reset'])) {
    $msg = "Password reset Successfully";
}


//checking for an error in the url to this page
if (isset($_GET['error'])) {
    $err_msg = "Password reset unsuccessful!";
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
    <title>Register</title>
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link href="../assets/css/parsley.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body class="bg-primary" style="background-image: url('../images/slider-01.jpg');height: 100%;  background-position: center;background-repeat: no-repeat;background-size: cover; background-attachment: fixed;">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content" style="margin-bottom: 40px;">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Restaurant registration</h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // showing the error message
                                    if (isset($err_msg)) {
                                        echo '<div class="alert alert-danger">' .
                                            '<li style="text-align:center">' . $err_msg . '</li>'
                                            . '</div>';
                                    }
                                    ?>
                                    <?php
                                    //showing the success message if any
                                    if (isset($msg)) {
                                        echo '<div class="alert alert-success">' .
                                            '<li style="text-align:center">' . $msg . '</li>'
                                            . '</div>';
                                        echo "<script>setTimeout(\"location.href = '../index.php';\",1500);</script>";
                                    }

                                    ?>
                                    <div class="small mb-3 text-muted">Complete the form below with the valid information.</div>
                                    <!-- form validation using parsley js -->
                                    <form action='./../actions/addRestaurant.php' method="POST" data-parsley-validate id="form">
                                        <div class="form-group">
                                            <label>Restaurant name</label>
                                            <input class="form-control py-4" type="text" aria-describedby="emailHelp" placeholder="Enter restaurant's name" required data-parsley-trigger="keyup" name='res_name' data-parsley-pattern="^[a-zA-Z ]+$" />
                                        </div>
                                        <div class="form-group">
                                            <label>Restaurant telephone</label>
                                            <input class="form-control py-4" type="tel" aria-describedby="emailHelp" placeholder="Enter mobile number" required data-parsley-trigger="keyup" name='res_tel' data-parsley-pattern="^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$" />
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="FirstName">Restaurant Opening time</label>
                                                    <input class="form-control" type="time" name="openingTime" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="LastName">Restaurant Closing time</label>
                                                    <input class="form-control" type="time" name="closingTime" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Restaurant Email</label>
                                            <input class="form-control py-4" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required data-parsley-trigger="keyup" name='Email' />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1">Password</label>
                                            <input class="form-control py-4" id="new_password" type="password" placeholder="Password" data-parsley-trigger="keyup" data-parsley-minlength="6" data-parsley-maxlength="16" name='Password' required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1">Confirm Password</label>
                                            <input class="form-control py-4" type="password" placeholder="Confirm password" data-parsley-equalto="#new_password" data-parsley-trigger="keyup" data-parsley-minlength="6" data-parsley-maxlength="16" data-parsley-error-message='Passwords are not the same' required name='confirm_password' />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Restaurant Description/ Main Servings</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="res_description" data-parsley-trigger="keyup" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <p id="demo" style="color: green;"></p>
                                            <button type="button" class="btn btn-primary btn-lg" onclick="getLocation()"><i class="fas fa-compass"></i><span style="margin-right: 10px;"></span>Get Location</button>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="res_location" id="restaurant_location">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="res_lat" id="restaurant_latitude">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="res_long" id="restaurant_longitude">
                                        </div>

                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="login.php">Return to login</a>
                                            <button class="btn btn-primary" name="submit" id="submit">register</button>
                                        </div>
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
                        <div class="text-muted">Copyright &copy; MAD 2020</div>
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- Getting the message from the insertion of case record and creating a flash message -->
    <?php if (isset($_GET['message'])) : ?>
        <div class='flash-data' data-flashdata="<? $_GET['message'];?>"></div>
    <?php endif; ?>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        // creating a display message
        const flashdata = $('.flash-data').data('flashdata');

        if (flashdata) {
            Swal.fire({
                icon: 'success',
                title: 'Welcome to Eately GH',
                text: 'Your restaurant has been added successfully',
                footer: '<a href=login.php>Click here!</a>',
                type: "success"
            }).then(function() {
                window.location.href = 'login.php';
            });
        }


            var x = document.getElementById("demo");

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
            }

            function showPosition(position) {
                x.innerHTML = "Your Location is identified successfully";
                let lat = position.coords.latitude;
                let lng = position.coords.longitude;
                let address = "";

                
                const KEY = "AIzaSyALX08Dj7c9KkiydoaNCNrK95mXE-SCMwg";

                let URL = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${KEY}`;


                fetch(URL)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        let parts = data.results[0].address_components;
                        address = data.results[0].formatted_address;
                        console.log(data.results[0].formatted_address);

                        document.getElementById("restaurant_location").value = address;
                        document.getElementById("restaurant_latitude").value = lat;
                        document.getElementById("restaurant_longitude").value = lng;
                    })
                    .catch(err => {
                        console.warn(err.message);
                    })

                

            }

            $('#submit').click(function(e) {
                $('#form').parsley().subscribe('parsley:form:validate', function (formInstance) {
                    formInstance.submitEvent.preventDefault(); //stops normal form submit
                    if (formInstance.isValid() == true) { // check if form valid or not
                        //code for ajax event here
                        
                    $.ajax({
                        type: "POST",
                        url: "./../actions/addRestaurant.php",
                        data: $('#form').serialize(),
                        dataType: "json",
                        encode: true,
                    }).done(function (data) {
                        console.log(data);
                        if(data.status == true){
                            Swal.fire({
                            icon: 'success',
                            title: 'Welcome to Eately GH',
                            text: 'Your restaurant has been added successfully',
                            footer: '<a href=login.php>Click here!</a>',
                                type: "success"
                            }).then(function() {
                                window.location.href = 'login.php';
                            });
                        }else {
                            Swal.fire({
                            icon: 'warning',
                            title: 'An error occurred',
                            text: 'Your restaurant was not accepted',
                            footer: '<a href=signup.php>Click here!</a>',
                            type: "error"
                            }).then(function() {
                                window.location.href = 'signup.php';
                            });
                        }
                        
                    });
                }});
            });


            // $('#submit').click(function(e) {
            //         e.preventDefault();
            //         if ( $(this).parsley().isValid() ) {

            //         console.log('I am here ');

            //         console.log($('form').serialize());

                
            //         $.ajax({
            //             type: "POST",
            //             url: "./../actions/addRestaurant.php",
            //             data: $('#form').serialize(),
            //             dataType: "json",
            //             encode: true,
            //         }).done(function (data) {
            //             console.log(data);
            //             Swal.fire({
            //                 icon: 'success',
            //                 title: 'Welcome to Eately GH',
            //                 text: 'Your restaurant has been added successfully',
            //                 footer: '<a href=login.php>Click here!</a>',
            //                 type: "success"
            //             }).then(function() {
            //                 window.location.href = 'login.php';
            //             });
            //         });
            //     }

            // });


        //Preview the inserted image 
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };

    </script>
</body>

</html>