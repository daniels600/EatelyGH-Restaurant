<?php
require_once ('./../controllers/authController.php');

//Creating an instance of authController

$authControl = new authController();

//an array to save the errors
$response = [];

 if(isset($_POST['submit'])){
    if($authControl->Login($_POST)){
        header('Location: login.php?login=success');
    }else{
        $response['message'] = "Invalid Credentials";
    }
 }

//Checking for a login in the url 
if(isset($_GET['login'])){
    if($_GET['login'] = 'success'){
        $msg = "Login Successful";
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
    <title>Login</title>
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link href="../assets/css/parsley.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>

</head>

<body class="bg-primary" style="background-image: url('../images/slider-03.jpg');height: 100%;  background-position: center;background-repeat: no-repeat;background-size: cover;">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <a class="btn btn-primary" href="../index.php" role="button" style="margin-left: 5%; margin-top: 2%;">Back</a>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <!-- Showing a message if any -->
                                <?php if(isset($response) && count($response) > 0): ?>
                                    <div class= 'alert alert-danger'>
                                        <?php echo '<li style="text-align:center">'. $response['message'] .'</li>'?>
                                    </div>
                                <?php endif; ?>
                                <?php
                                //Showing a message if any and redirect to the Dashboard after 1.5 secs
                                if (isset($msg)) {
                                    echo '<div class="alert alert-success">' .
                                    '<li style="text-align:center">'.$msg.'</li>'
                                    . '</div>';
                                    echo "<script>setTimeout(\"location.href = 'restaurant.php';\",1500);</script>";
                                }

                                ?>
                               
                               
                                <div class="card-body">
                                    <!-- Form validation with parsley js and regex -->
                                    <form action='login.php' method='POST' class='login-form' data-parsley-validate>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control py-4" id="inputEmailAddress" type="email" placeholder="Enter email address" name='admin_email' data-parsley-group="email_input" data-parsley-type="email" data-parsley-required="true" data-parsley-trigger="keyup" autofocus/>
                                        </div>

                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" name='admin_password' data-parsley-group="password_input" data-parsley-length="[4, 20]" data-parsley-required="true" data-parsley-trigger="keyup" />
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.php">Reset Password?</a>
                                            <input class="btn btn-primary" name="submit" type="submit" value="Login">
                                
                                        </div>
                                        <div class="invalid-form-error-message"></div>
                                    </form>
                                </div>
                                <p style="margin: auto; margin-bottom: 20px; ">Don't have an account? <a href="signup.php"><span style="font-weight: 400; color: blue">Sign up</span></a></p>
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
                        <div class="text-muted">Copyright &copy; MAD 2021</div>
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
</body>

</html>